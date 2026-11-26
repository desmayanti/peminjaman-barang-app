<?php

namespace App\Console\Commands;

use App\Mail\LoanReminderMail;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendLoanReminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loans:remind-email {--loan= : Kode peminjaman tertentu (contoh: PJ-94150)} {--all : Kirim ke seluruh peminjaman aktif tanpa filter jatuh tempo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim email peringatan otomatis untuk peminjaman barang yang telah melewati batas pengembalian';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $loanCode = $this->option('loan');
        $includeAll = (bool) $this->option('all');
        $today = now('Asia/Jakarta')->startOfDay();
        $todayDate = $today->toDateString();

        $this->info('🤖 Memulai Bot Pengingat Email Keterlambatan Peminjaman Sarpras...');

        $query = Loan::with('item')
            ->where('status', 'approved')
            ->whereNotNull('email')
            ->where('email', '!=', '')
            ->where(function ($q) {
                $q->where('type', 'pinjam')
                  ->orWhereNull('type');
            });

        if ($loanCode) {
            $query->where('loan_code', $loanCode);
        } elseif (! $includeAll) {
            // Mode produksi: hanya ambil peminjaman aktif yang tanggal pengembaliannya sudah lewat hari ini
            $query->where(function ($q) use ($todayDate) {
                $q->where(function ($sub) use ($todayDate) {
                    $sub->whereNotNull('return_date')
                        ->whereDate('return_date', '<', $todayDate);
                })->orWhere(function ($sub) use ($todayDate) {
                    $sub->whereNull('return_date')
                        ->whereNotNull('tanggal_selesai')
                        ->whereDate('tanggal_selesai', '<', $todayDate);
                });
            });
        }

        $loans = $query->orderByRaw('COALESCE(return_date, tanggal_selesai) asc')->get();

        if ($loans->isEmpty()) {
            $this->info('✅ Tidak ada peminjaman aktif yang melewati batas waktu pengembalian hari ini.');
            return Command::SUCCESS;
        }

        $this->info("📧 Ditemukan {$loans->count()} peminjaman yang perlu dikirim pengingat. Memproses pengiriman email...");

        $sentCount = 0;
        $failedCount = 0;
        $tableRows = [];

        foreach ($loans as $index => $loan) {
            $itemTitle = $loan->item ? $loan->item->name : 'Barang Sarpras';
            $dueDate = $loan->return_date ?? $loan->tanggal_selesai;
            $tglKembali = $dueDate ? Carbon::parse($dueDate)->format('d-m-Y') : 'Belum Ditentukan';
            $daysOverdue = LoanReminderMail::calculateDaysOverdue($loan, $today);
            $telatLabel = $daysOverdue > 0 ? "{$daysOverdue} Hari" : 'Belum Telat';

            // Jeda antar pengiriman massal agar mematuhi batas rate-limit SMTP
            if ($index > 0) {
                sleep(4);
            }

            $attempt = 0;
            $success = false;
            $lastError = '';

            while ($attempt < 4 && ! $success) {
                $attempt++;
                try {
                    Mail::to($loan->email)->send(new LoanReminderMail($loan, $daysOverdue));
                    $success = true;
                    $sentCount++;
                    $tableRows[] = [
                        $loan->loan_code,
                        $loan->borrower_name,
                        $loan->email,
                        $itemTitle,
                        $tglKembali,
                        $telatLabel,
                        '✅ Terkirim',
                    ];
                    $this->line("   [OK] Email peringatan terkirim ke: {$loan->email} (#{$loan->loan_code} - {$itemTitle}, {$telatLabel})");
                } catch (\Throwable $e) {
                    $lastError = $e->getMessage();
                    if (str_contains($lastError, 'Too many emails per second') && $attempt < 4) {
                        sleep(5);
                        continue;
                    }
                    break;
                }
            }

            if (! $success) {
                $failedCount++;
                $tableRows[] = [
                    $loan->loan_code,
                    $loan->borrower_name,
                    $loan->email,
                    $itemTitle,
                    $tglKembali,
                    $telatLabel,
                    '❌ Gagal: ' . substr($lastError, 0, 30),
                ];
                $this->error("   [GAGAL] Gagal mengirim ke {$loan->email}: {$lastError}");
            }
        }

        $this->newLine();
        $this->table(['Kode PJ', 'Nama Peminjam', 'Email Tujuan', 'Barang', 'Tgl Kembali', 'Telat', 'Status'], $tableRows);
        $this->newLine();

        if ($sentCount > 0) {
            $this->info("✨ Sukses! {$sentCount} email peringatan keterlambatan berhasil dikirim.");
        }

        if ($failedCount > 0) {
            $this->warn("Terdapat {$failedCount} email yang gagal terkirim.");
        }

        return Command::SUCCESS;
    }
}
