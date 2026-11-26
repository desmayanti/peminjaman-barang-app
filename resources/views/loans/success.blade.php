<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    @if(request()->isSecure())
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Permohonan Terkirim - PinjamBarang</title>
    <link rel="icon" type="image/webp" href="{{ asset('images/logo-pb.webp') }}">

    <!-- Smart Theme Override & Anti-FOUC Engine -->
    <x-smart-theme-override />

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Figtree', 'sans-serif'],
                        display: ['"Space Grotesk"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FAF8FF] dark:bg-slate-950 text-slate-800 dark:text-slate-100 antialiased font-sans min-h-screen flex flex-col justify-center items-center p-4 transition-colors duration-300 relative">

    <!-- Top Theme Switcher -->
    <div class="absolute top-5 right-5">
        <x-theme-toggle size="sm" />
    </div>

    <div class="max-w-lg w-full">
        <!-- Success Card -->
        <div class="bg-white dark:bg-slate-900 border border-purple-100 dark:border-slate-800 rounded-3xl p-6 sm:p-8 shadow-2xl shadow-purple-100/70 dark:shadow-2xl relative overflow-hidden text-center transition-colors duration-300">
            
            <!-- Success Icon Badge -->
            <div class="w-16 h-16 rounded-3xl bg-emerald-100 dark:bg-emerald-500/20 border border-emerald-200 dark:border-emerald-500/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mx-auto mb-5 shadow-lg shadow-emerald-500/20">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">Permohonan Berhasil Diajukan!</h1>
            <p class="text-sm text-slate-600 dark:text-slate-400 mt-2">Data Anda sudah langsung terkirim ke Admin. Simpan kode peminjaman berikut untuk melacak proses persetujuan.</p>

            <!-- Loan Code Box -->
            <div class="my-6 p-4 rounded-2xl bg-purple-50/60 dark:bg-slate-950 border border-dashed border-purple-300 dark:border-indigo-500/60 flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="text-left">
                    <span class="text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider block">Kode Tiket Peminjaman</span>
                    <span class="text-2xl font-mono font-extrabold text-purple-700 dark:text-indigo-400 tracking-wider" id="loanCodeText">{{ $loan->loan_code }}</span>
                    <div class="mt-2 p-2 border border-red-300 dark:border-red-500 bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-500 text-sm rounded-md font-medium inline-block">Salin kode ini untuk melacak status peminjaman</div>
                </div>
                <button onclick="copyLoanCode()" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-purple-100 hover:bg-purple-200 dark:bg-indigo-600/30 dark:hover:bg-indigo-600 text-purple-700 hover:text-purple-900 dark:text-indigo-200 dark:hover:text-white text-xs font-semibold transition border border-purple-200 dark:border-indigo-500/40">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                    <span id="copyBtnText">Salin Kode</span>
                </button>
            </div>

            <!-- Receipt Summary -->
            <div class="bg-purple-50/40 dark:bg-slate-950/60 rounded-2xl p-4 border border-purple-100 dark:border-slate-800 text-left text-xs space-y-2.5 mb-6">
                <div class="flex justify-between pb-2 border-b border-purple-100 dark:border-slate-800 text-slate-500 dark:text-slate-400">
                    <span>Status Saat Ini</span>
                    <span class="px-2 py-0.5 rounded-md bg-amber-100 dark:bg-amber-950/80 text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-800 font-semibold">
                        Menunggu Verifikasi Admin
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500 dark:text-slate-400">Peminjam</span>
                    <span class="font-semibold text-slate-800 dark:text-white">{{ $loan->borrower_name }} ({{ $loan->nickname }})</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500 dark:text-slate-400">Kontak</span>
                    <span class="font-mono text-slate-700 dark:text-slate-300">{{ $loan->phone_number }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500 dark:text-slate-400">Barang</span>
                    <span class="font-semibold text-slate-800 dark:text-white">{{ $loan->item->name ?? 'Barang' }} ({{ $loan->quantity }} Unit)</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500 dark:text-slate-400">Periode Pinjam</span>
                    <span class="text-slate-700 dark:text-slate-200">
                        @if(empty($loan->tanggal_selesai))
                            Barang Diminta / Tidak Dikembalikan
                        @else
                            {{ \Carbon\Carbon::parse($loan->borrow_date)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($loan->tanggal_selesai)->format('d M Y') }}
                        @endif
                    </span>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('loans.track', ['query' => $loan->loan_code]) }}" class="w-full py-3 px-4 rounded-xl bg-purple-600 hover:bg-purple-700 text-white text-xs font-bold transition shadow-lg shadow-purple-600/30">
                    Lacak Status Permohonan
                </a>
                <a href="{{ route('home') }}" class="w-full py-3 px-4 rounded-xl border border-purple-200 dark:border-slate-700 hover:bg-purple-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-semibold transition">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <script>
        function copyLoanCode() {
            const code = document.getElementById('loanCodeText').innerText;
            navigator.clipboard.writeText(code).then(() => {
                const btn = document.getElementById('copyBtnText');
                btn.innerText = 'Tersalin!';
                setTimeout(() => { btn.innerText = 'Salin Kode'; }, 2000);
            });
        }
    </script>
</body>
</html>