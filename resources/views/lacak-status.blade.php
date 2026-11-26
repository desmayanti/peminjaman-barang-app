<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Status Peminjaman - PinjamBarang</title>
    <link rel="icon" type="image/webp" href="{{ asset('images/logo-pb.webp') }}">

    <!-- Smart Theme Override & Anti-FOUC Engine -->
    <x-smart-theme-override />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        display: ['"Space Grotesk"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { 
            background-color: #FAF8FF; 
            color: #0f172a; 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        html.dark body { 
            background-color: #030305; 
            color: #f1f5f9; 
        }
        .font-display { 
            font-family: 'Space Grotesk', sans-serif; 
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased min-h-screen flex flex-col bg-[#FAF8FF] dark:bg-[#030305] text-slate-800 dark:text-slate-100 relative selection:bg-purple-500 selection:text-white overflow-x-hidden transition-colors duration-300">
    
    <!-- Background Glow Effect -->
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[450px] bg-purple-200/40 dark:bg-purple-600/15 blur-[140px] rounded-full pointer-events-none -z-10 transition-colors duration-500"></div>
    <div class="fixed bottom-0 right-1/4 w-[500px] h-[350px] bg-indigo-100/40 dark:bg-indigo-600/10 blur-[130px] rounded-full pointer-events-none -z-10 transition-colors duration-500"></div>

    <!-- Top Navigation Bar -->
    <header class="sticky top-0 z-50 bg-white/95 dark:bg-[#030305]/95 border-b border-purple-100 dark:border-white/[0.08] transition-colors duration-300 shadow-sm shadow-purple-100/50 dark:shadow-none">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Brand / Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo-pb.webp') }}" alt="Logo PB" class="h-9 w-9 rounded-xl object-cover shadow-sm group-hover:scale-105 transition-transform">
                    <span class="text-slate-900 dark:text-white font-extrabold text-lg tracking-tight font-display">Pinjam<span class="text-purple-600 dark:text-purple-400">Barang.</span></span>
                </a>

                <!-- Quick Nav Links -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <x-theme-toggle size="sm" />

                    <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs sm:text-sm font-semibold text-slate-700 dark:text-slate-300 hover:text-purple-700 dark:hover:text-white bg-purple-50 dark:bg-white/[0.05] hover:bg-purple-100 dark:hover:bg-white/[0.1] border border-purple-200 dark:border-white/10 transition-all shadow-sm">
                        <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Kembali ke Beranda</span>
                    </a>

                    <a href="{{ route('loans.create') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs sm:text-sm font-semibold text-purple-700 dark:text-purple-300 hover:text-purple-900 dark:hover:text-purple-200 bg-purple-100 dark:bg-purple-500/10 hover:bg-purple-200 dark:hover:bg-purple-500/20 border border-purple-200 dark:border-purple-500/30 transition-all">
                        <span>+ Form Pinjam</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow pt-8 sm:pt-12 pb-16 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto w-full flex flex-col items-center z-10 relative">
        
        <!-- Header Title -->
        <div class="text-center mb-6 sm:mb-8">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-100 dark:bg-purple-500/10 border border-purple-200 dark:border-purple-500/30 text-xs font-semibold text-purple-700 dark:text-purple-300 mb-3 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-purple-600 dark:bg-purple-400 animate-pulse"></span>
                <span>Pelacakan Status Real-Time</span>
            </div>
            @if(isset($loan) && $loan && ($loan->type === 'minta' || ($loan->item && $loan->item->is_consumable) || empty($loan->tanggal_selesai)))
                <h1 class="text-2xl sm:text-3xl font-extrabold font-display text-slate-900 dark:text-white mb-2">Status Permintaan</h1>
                <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm">Lacak status permohonan menggunakan Kode Permintaan atau No. WhatsApp.</p>
            @else
                <h1 class="text-2xl sm:text-3xl font-extrabold font-display text-slate-900 dark:text-white mb-2">Status Peminjaman</h1>
                <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm">Lacak status permohonan menggunakan Kode Peminjaman atau No. WhatsApp.</p>
            @endif
        </div>

        <!-- Kotak Pencarian (Search Bar) -->
        <div class="w-full max-w-xl mb-8">
            <form action="{{ route('lacak.status') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Contoh: PJ-27702 atau 0812..." required class="w-full px-5 py-3.5 pl-11 rounded-xl bg-white dark:bg-white/[0.03] border border-purple-200 dark:border-white/10 text-slate-800 dark:text-white focus:ring-2 focus:ring-purple-300 focus:border-purple-500 outline-none placeholder-slate-400 dark:placeholder-slate-500 transition-all shadow-sm">
                    <svg class="w-5 h-5 text-purple-500 dark:text-slate-500 absolute left-3.5 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <button type="submit" class="px-8 py-3.5 rounded-xl font-bold text-white bg-purple-600 hover:bg-purple-500 transition-all shadow-[0_0_20px_rgba(147,51,234,0.4)] flex items-center justify-center gap-2">
                    <span>Lacak</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </form>
        </div>

        <!-- Hasil Pelacakan -->
        <div class="w-full">
            @if(request()->has('keyword') && $loan)
                <!-- JIKA DATA DITEMUKAN -->
                <div class="glass-card p-6 md:p-8 rounded-2xl border border-purple-100 dark:border-white/10 w-full relative overflow-hidden bg-white dark:bg-white/[0.03] backdrop-blur-xl shadow-xl shadow-purple-100/70 dark:shadow-2xl">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-purple-500/10 blur-[50px] rounded-full pointer-events-none"></div>
                    
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 pb-6 border-b border-purple-100 dark:border-white/10 gap-4">
                        <div>
                            @if(isset($loan) && $loan && ($loan->type === 'minta' || ($loan->item && $loan->item->is_consumable) || empty($loan->tanggal_selesai)))
                                <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1 font-semibold">Kode Permintaan</p>
                            @else
                                <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1 font-semibold">Kode Peminjaman</p>
                            @endif
                            <h2 class="text-3xl font-mono font-extrabold text-purple-700 dark:text-white tracking-wide" id="loanCodeText">{{ $loan->loan_code }}</h2>
                            
                            <!-- Salin Kode Box -->
                            <div class="mt-2.5 inline-flex items-center gap-2 p-2 px-3 border border-red-300 dark:border-red-500/60 bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 text-xs rounded-lg font-medium cursor-pointer hover:bg-red-100 dark:hover:bg-red-500/20 transition-colors" onclick="copyLoanCode()" title="Klik untuk menyalin">
                                <span>Salin kode ini untuk melacak status peminjaman</span>
                                <svg class="w-3.5 h-3.5 text-red-500 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                <span id="copyIndicator" class="hidden text-emerald-600 dark:text-emerald-400 font-bold ml-1">✓ Tersalin!</span>
                            </div>
                        </div>
                        
                        <!-- Badge Status Dinamis -->
                        <div>
                            @if($loan->status == 'pending')
                                <span class="px-4 py-2 rounded-full text-xs font-bold bg-amber-100 dark:bg-amber-500/20 text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-500/40 inline-flex items-center gap-1.5 shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-amber-500 dark:bg-amber-400 animate-ping"></span>
                                    ⏳ Menunggu Review
                                </span>
                            @elseif($loan->status == 'approved')
                                <span class="px-4 py-2 rounded-full text-xs font-bold bg-emerald-100 dark:bg-emerald-500/20 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-500/40 inline-flex items-center gap-1.5 shadow-sm">
                                    ✅ Disetujui
                                </span>
                            @elseif($loan->status == 'rejected')
                                <span class="px-4 py-2 rounded-full text-xs font-bold bg-rose-100 dark:bg-rose-500/20 text-rose-700 dark:text-rose-300 border border-rose-200 dark:border-rose-500/40 inline-flex items-center gap-1.5 shadow-sm">
                                    ❌ Ditolak
                                </span>
                            @else
                                <span class="px-4 py-2 rounded-full text-xs font-bold bg-blue-100 dark:bg-blue-500/20 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-500/40 inline-flex items-center gap-1.5 shadow-sm">
                                    📦 Dikembalikan
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Detail Peminjam & Barang -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">
                        <div class="bg-purple-50/50 dark:bg-white/[0.02] p-3.5 rounded-xl border border-purple-100 dark:border-white/5">
                            <p class="text-[11px] text-purple-700 dark:text-purple-400 uppercase font-semibold mb-1">Peminjam</p>
                            <p class="text-sm text-slate-800 dark:text-slate-100 font-medium">{{ $loan->borrower_name }} <span class="text-purple-600 dark:text-purple-300 font-semibold">({{ $loan->nickname }})</span></p>
                        </div>
                        <div class="bg-purple-50/50 dark:bg-white/[0.02] p-3.5 rounded-xl border border-purple-100 dark:border-white/5">
                            <p class="text-[11px] text-purple-700 dark:text-purple-400 uppercase font-semibold mb-1">Kontak WhatsApp</p>
                            <p class="text-sm text-slate-800 dark:text-slate-100 font-mono font-medium">{{ $loan->phone_number }}</p>
                        </div>
                        <div class="bg-purple-50/50 dark:bg-white/[0.02] p-3.5 rounded-xl border border-purple-100 dark:border-white/5">
                            <p class="text-[11px] text-purple-700 dark:text-purple-400 uppercase font-semibold mb-1">Barang Dipinjam</p>
                            <p class="text-sm text-slate-800 dark:text-slate-100 font-medium">{{ $loan->item->name ?? 'Barang tidak diketahui' }} @if($loan->quantity) ({{ $loan->quantity }} Unit) @endif</p>
                        </div>
                        <div class="bg-purple-50/50 dark:bg-white/[0.02] p-3.5 rounded-xl border border-purple-100 dark:border-white/5">
                            <p class="text-[11px] text-purple-700 dark:text-purple-400 uppercase font-semibold mb-1">Durasi Pinjam</p>
                            @if(empty($loan->tanggal_selesai))
                                <p class="text-sm text-slate-800 dark:text-slate-100 font-medium">Barang Diminta / Tidak Dikembalikan</p>
                            @else
                                <p class="text-sm text-slate-800 dark:text-slate-100 font-medium">{{ \Carbon\Carbon::parse($loan->borrow_date)->format('d M Y') }} &mdash; {{ \Carbon\Carbon::parse($loan->tanggal_selesai)->format('d M Y') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Catatan Status -->
                    <div class="p-4 rounded-xl bg-purple-50 dark:bg-purple-950/20 border border-purple-200 dark:border-purple-800/30">
                        <p class="text-xs font-bold text-purple-800 dark:text-purple-300 mb-1 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Catatan Sistem / Admin:
                        </p>
                        <p class="text-xs sm:text-sm text-slate-700 dark:text-slate-300 pl-5">
                            @if($loan->status == 'pending')
                                Permohonan sedang dalam antrean. Silakan tunggu persetujuan admin.
                            @elseif($loan->status == 'approved')
                                Disetujui oleh admin. Silakan ambil barang di ruang logistik sesuai jadwal.
                            @elseif($loan->status == 'rejected')
                                Mohon maaf, permohonan ditolak. (Silakan hubungi admin untuk detailnya).
                            @else
                                Selesai. Barang telah dikembalikan. Terima kasih!
                            @endif
                        </p>
                    </div>

                    <!-- Card Actions -->
                    <div class="mt-8 pt-6 border-t border-purple-100 dark:border-white/10 flex flex-col sm:flex-row items-center justify-between gap-3">
                        <a href="{{ route('home') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-white dark:bg-white/[0.08] hover:bg-purple-50 dark:hover:bg-white/[0.15] text-slate-800 dark:text-white text-xs sm:text-sm font-bold border border-purple-200 dark:border-white/10 transition-all shadow-sm">
                            <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            <span>Kembali ke Beranda (Landing Page)</span>
                        </a>

                        <div>
                            <a href="{{ route('lacak.status') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 px-4 py-3 rounded-xl bg-purple-100 dark:bg-purple-600/30 hover:bg-purple-200 dark:hover:bg-purple-600/50 text-purple-700 dark:text-purple-200 hover:text-purple-900 dark:hover:text-white text-xs sm:text-sm font-semibold border border-purple-200 dark:border-purple-500/30 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <span>Cari Tiket Lain</span>
                            </a>
                        </div>
                    </div>
                </div>

            @elseif(request()->has('keyword') && !$loan)
                <!-- JIKA DATA TIDAK DITEMUKAN -->
                <div class="p-8 rounded-2xl border border-rose-200 dark:border-rose-500/20 bg-rose-50 dark:bg-rose-500/5 text-center max-w-md mx-auto backdrop-blur-sm shadow-sm">
                    <div class="w-14 h-14 rounded-2xl bg-rose-100 dark:bg-rose-500/20 text-rose-600 dark:text-rose-400 flex items-center justify-center mx-auto mb-4 border border-rose-200 dark:border-rose-500/30 shadow-sm">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-rose-600 dark:text-rose-400 mb-2">Data Tidak Ditemukan</h3>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 mb-6 leading-relaxed">
                        Kami tidak dapat menemukan data peminjaman dengan kode atau nomor WhatsApp "<strong>{{ request('keyword') }}</strong>". Pastikan data yang dimasukkan sudah sesuai.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-2.5 justify-center">
                        <a href="{{ route('lacak.status') }}" class="px-5 py-2.5 rounded-xl bg-purple-100 dark:bg-slate-800 hover:bg-purple-200 dark:hover:bg-slate-700 text-purple-700 dark:text-slate-200 text-xs font-semibold transition-colors">
                            Coba Cari Ulang
                        </a>
                        <a href="{{ route('home') }}" class="px-5 py-2.5 rounded-xl bg-purple-600 hover:bg-purple-500 text-white text-xs font-bold transition-all shadow-md shadow-purple-600/30">
                            ← Kembali ke Beranda
                        </a>
                    </div>
                </div>
            @else
                <!-- STATE AWAL (BELUM MENCARI) -->
                <div class="text-center py-12 px-6 rounded-2xl bg-white dark:bg-white/[0.02] border border-purple-100 dark:border-white/5 max-w-lg mx-auto shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-500/10 text-purple-700 dark:text-purple-400 flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 2m0 0l-2-2m2 2V9a2 2 0 00-2-2H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-slate-600 dark:text-slate-400 text-sm mb-4">Masukkan Kode Tiket atau Nomor WhatsApp pada kolom pencarian di atas untuk memeriksa status.</p>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-semibold text-purple-700 dark:text-purple-300 hover:text-purple-900 dark:hover:text-white bg-purple-100 dark:bg-purple-500/10 hover:bg-purple-200 dark:hover:bg-purple-500/20 border border-purple-200 dark:border-purple-500/30 transition-all">
                        ← Kembali ke Halaman Utama
                    </a>
                </div>
            @endif
            
            <!-- Bottom Navigation Link -->
            <div class="text-center mt-10">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-slate-600 dark:text-slate-400 hover:text-purple-600 dark:hover:text-purple-300 transition-colors py-2 px-4 rounded-xl hover:bg-purple-50 dark:hover:bg-white/[0.04]">
                    <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Halaman Landing Awal</span>
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-6 border-t border-purple-100 dark:border-white/[0.05] text-center text-xs text-slate-500">
        <p>&copy; {{ date('Y') }} PinjamBarang &bull; Sistem Inventaris & Peminjaman Barang</p>
    </footer>

    <!-- Copy Code Helper Script -->
    <script>
        function copyLoanCode() {
            const codeEl = document.getElementById('loanCodeText');
            if (!codeEl) return;
            const code = codeEl.innerText.trim();
            navigator.clipboard.writeText(code).then(() => {
                const indicator = document.getElementById('copyIndicator');
                if (indicator) {
                    indicator.classList.remove('hidden');
                    setTimeout(() => {
                        indicator.classList.add('hidden');
                    }, 2500);
                }
            }).catch(err => {
                console.error('Failed to copy: ', err);
            });
        }
    </script>
</body>
</html>
