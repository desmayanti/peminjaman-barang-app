<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog &amp; Inventaris Sarpras - PinjamBarang</title>
    <link rel="icon" type="image/webp" href="{{ asset('images/logo-pb.webp') }}">

    <!-- Smart Theme Override & Anti-FOUC Engine -->
    <x-smart-theme-override />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
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
        .font-display { font-family: 'Space Grotesk', sans-serif; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FAF8FF] dark:bg-[#030305] text-slate-800 dark:text-slate-100 font-sans antialiased min-h-screen selection:bg-purple-500 selection:text-white relative overflow-x-hidden transition-colors duration-300">
    
    <!-- Background Ambient Glow -->
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[450px] bg-purple-200/40 dark:bg-purple-600/15 blur-[140px] rounded-full pointer-events-none -z-10 transition-colors duration-500"></div>
    <div class="fixed bottom-0 right-1/4 w-[500px] h-[350px] bg-indigo-100/40 dark:bg-indigo-600/10 blur-[130px] rounded-full pointer-events-none -z-10 transition-colors duration-500"></div>

    <!-- Sticky Navbar -->
    <nav class="fixed top-0 left-0 w-full z-50 bg-white/95 dark:bg-[#030305]/95 border-b border-purple-100 dark:border-white/[0.08] px-4 sm:px-8 py-3.5 flex items-center justify-between transition-colors duration-300 shadow-sm shadow-purple-100/50 dark:shadow-none">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center gap-3 group">
            <img src="{{ asset('images/logo-pb.webp') }}" alt="Logo PB" class="h-9 w-9 rounded-xl object-cover shadow-sm group-hover:scale-105 transition-transform">
            <span class="text-slate-900 dark:text-white font-extrabold text-lg tracking-tight font-display">Pinjam<span class="text-purple-600 dark:text-purple-400">Barang.</span></span>
        </a>

        <!-- Nav Action Buttons -->
        <div class="flex items-center gap-2 sm:gap-3">
            <x-theme-toggle size="sm" />

            <a href="{{ url('/') }}" class="inline-flex items-center gap-1.5 px-3.5 sm:px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold text-slate-700 dark:text-slate-300 hover:text-purple-700 dark:hover:text-white bg-purple-50 dark:bg-white/[0.05] hover:bg-purple-100 dark:hover:bg-white/[0.1] border border-purple-200 dark:border-white/10 transition-all shadow-sm">
                <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Beranda</span>
            </a>

            <a href="{{ url('/') }}#ajukan" class="px-4 sm:px-5 py-2 rounded-xl text-xs sm:text-sm font-bold bg-purple-600 hover:bg-purple-500 text-white transition-all shadow-[0_0_15px_rgba(147,51,234,0.35)]">
                Ajukan Peminjaman
            </a>
        </div>
    </nav>

    <!-- Main Content Katalog -->
    <main class="pt-28 sm:pt-32 pb-20 px-4 sm:px-6 lg:px-12 max-w-7xl mx-auto">
        
        <!-- Header Section -->
        <div class="text-center max-w-2xl mx-auto mb-12 sm:mb-16">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-purple-100 dark:bg-purple-500/10 border border-purple-200 dark:border-purple-500/30 text-xs font-semibold text-purple-700 dark:text-purple-300 mb-3 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-purple-600 dark:bg-purple-400 animate-pulse"></span>
                <span>Katalog Inventaris Resmi</span>
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold font-display text-slate-900 dark:text-white mb-3">
                Katalog Sarpras &amp; <span class="text-purple-600 dark:text-purple-400">Inventaris Lengkap</span>
            </h1>
            <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm leading-relaxed">
                Daftar seluruh aset, perangkat proyektor, audio, multimedia, dan perlengkapan acara. Cek status ketersediaan stok secara real-time.
            </p>
        </div>

        <!-- Grid Katalog Barang -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($items as $item)
                <div class="rounded-2xl p-6 border border-purple-100 dark:border-white/10 bg-white dark:bg-white/[0.03] backdrop-blur-xl flex flex-col justify-between relative overflow-hidden group hover:border-purple-400 dark:hover:border-purple-500/40 transition-all shadow-sm shadow-purple-100/60 dark:shadow-xl">
                    <div class="absolute top-0 right-0 w-28 h-28 bg-purple-500/5 blur-[35px] rounded-full pointer-events-none group-hover:scale-125 transition-transform"></div>

                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-[10px] font-mono font-bold px-2.5 py-1 rounded-lg bg-purple-50 dark:bg-white/[0.05] text-purple-700 dark:text-purple-300 border border-purple-200 dark:border-purple-500/30 uppercase tracking-wider">
                                {{ $item->code }}
                            </span>
                            @if($item->available_stock > 0)
                                <span class="flex items-center gap-1.5 text-[11px] font-bold text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-500/10 px-2.5 py-0.5 rounded-full border border-emerald-200 dark:border-emerald-500/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 dark:bg-emerald-400 animate-pulse"></span> Stok: {{ $item->available_stock }}
                                </span>
                            @else
                                <span class="flex items-center gap-1 text-[11px] font-bold text-rose-700 dark:text-rose-400 bg-rose-50 dark:bg-rose-500/10 px-2.5 py-0.5 rounded-full border border-rose-200 dark:border-rose-500/20">
                                    ❌ Habis (0)
                                </span>
                            @endif
                        </div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-white mb-1.5 group-hover:text-purple-600 dark:group-hover:text-purple-300 transition-colors font-display line-clamp-2">
                            {{ str_replace(['RÃ˜DE', 'RÃ˜DE'], 'RODE', $item->name) }}
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-4">
                            Kondisi: <span class="text-slate-700 dark:text-slate-200 font-semibold">{{ $item->condition ?? 'Baik' }}</span>
                            @if($item->category)
                                &bull; <span class="text-purple-600 dark:text-purple-400 font-medium">{{ $item->category }}</span>
                            @endif
                        </p>
                    </div>

                    <div class="relative z-10 pt-2">
                        @if($item->available_stock > 0)
                            <a href="{{ url('/') }}#ajukan" class="w-full py-2.5 rounded-xl font-bold text-xs text-center block bg-purple-100 dark:bg-purple-600/30 border border-purple-200 dark:border-purple-500/40 text-purple-700 dark:text-purple-200 hover:bg-purple-600 hover:text-white transition-all shadow-sm">
                                Pinjam Barang Ini
                            </a>
                        @else
                            <button disabled class="w-full py-2.5 rounded-xl font-bold text-xs text-center block bg-rose-50 dark:bg-rose-500/10 border border-rose-200 dark:border-rose-500/20 text-rose-600 dark:text-rose-400 cursor-not-allowed">
                                Stok Kosong (Restock)
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Bottom Back to Landing Page & CTA Banner -->
        <div class="mt-20 pt-12 border-t border-purple-100 dark:border-white/[0.08] text-center flex flex-col items-center">
            <div class="p-8 sm:p-10 rounded-3xl bg-gradient-to-r from-purple-100/80 via-white to-indigo-100/80 dark:from-purple-950/40 dark:via-[#0e0e1a] dark:to-indigo-950/40 border border-purple-200 dark:border-purple-500/25 max-w-2xl w-full shadow-xl shadow-purple-100/60 dark:shadow-2xl relative overflow-hidden backdrop-blur-xl">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-purple-200 to-indigo-200 dark:from-purple-600/30 dark:to-indigo-600/30 text-purple-700 dark:text-purple-300 flex items-center justify-center mx-auto mb-4 border border-purple-300 dark:border-purple-500/40 shadow-lg shadow-purple-200/50 dark:shadow-purple-600/20">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white mb-2 font-display">Sudah Menemukan Barang yang Dicari?</h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 mb-7 leading-relaxed max-w-md mx-auto">
                    Kembali ke halaman utama untuk melihat panduan peminjaman atau langsung mengisi formulir permohonan pinjam secara mandiri.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                    <a href="{{ url('/') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-white dark:bg-white/[0.08] hover:bg-purple-50 dark:hover:bg-white/[0.15] text-slate-800 dark:text-white text-xs sm:text-sm font-bold border border-purple-200 dark:border-white/10 transition-all shadow-md">
                        <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Kembali ke Halaman Beranda</span>
                    </a>
                    <a href="{{ url('/') }}#ajukan" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-purple-600 hover:bg-purple-500 text-white text-xs sm:text-sm font-bold shadow-[0_0_20px_rgba(147,51,234,0.4)] transition-all">
                        <span>Ajukan Peminjaman Sekarang &rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Simple Text Link at the bottom -->
            <div class="mt-8">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-slate-600 dark:text-slate-400 hover:text-purple-600 dark:hover:text-purple-300 transition-colors py-2 px-4 rounded-xl hover:bg-purple-50 dark:hover:bg-white/[0.04]">
                    <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Landing Page Utama</span>
                </a>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="py-6 border-t border-purple-100 dark:border-white/[0.05] text-center text-xs text-slate-500">
        <p>&copy; {{ date('Y') }} PinjamBarang &bull; Sistem Inventaris &amp; Peminjaman Sarpras</p>
    </footer>

</body>
</html>
