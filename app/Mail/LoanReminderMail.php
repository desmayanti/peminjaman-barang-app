<?php

namespace App\Mail;

use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoanReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public Loan $loan;
    public int $daysOverdue;

    /**
     * Create a new message instance.
     */
    public function __construct(Loan $loan, ?int $daysOverdue = null)
    {
        $this->loan = $loan;
        $this->daysOverdue = $daysOverdue !== null
            ? max(0, $daysOverdue)
            : self::calculateDaysOverdue($loan);
    }

    /**
     * Hitung selisih hari keterlambatan dari batas pengembalian hingga hari ini (WIB).
     */
    public static function calculateDaysOverdue(Loan $loan, ?Carbon $referenceDate = null): int
    {
        $dueDate = $loan->return_date ?? $loan->tanggal_selesai;
        if (! $dueDate) {
            return 0;
        }

        $today = ($referenceDate ?? now('Asia/Jakarta'))->copy()->setTimezone('Asia/Jakarta')->startOfDay();
        $dueDay = Carbon::parse(Carbon::parse($dueDate)->toDateString(), 'Asia/Jakarta')->startOfDay();

        return max(0, (int) $dueDay->diffInDays($today, false));
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = $this->daysOverdue > 0
            ? "[Peringatan Telat {$this->daysOverdue} Hari] Segera Kembalikan Aset #{$this->loan->loan_code}"
            : "[Peringatan Sarpras] Pengingat Batas Pengembalian Aset #{$this->loan->loan_code}";

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.loan-reminder',
            with: [
                'loan' => $this->loan,
                'item' => $this->loan->item,
                'daysOverdue' => $this->daysOverdue,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
