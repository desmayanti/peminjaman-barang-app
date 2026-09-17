<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PinjamBarang - Layanan Peminjaman Aset & Peralatan Mudah</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-slate-100 antialiased font-sans min-h-screen flex flex-col selection:bg-indigo-500 selection:text-white">

    <!-- Header / Navbar -->
    <header class="sticky top-0 z-50 bg-slate-950/80 backdrop-blur-xl border-b border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="{{ route('home') }}" class="flex items-center space-x-3.5 group">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-indigo-600 via-indigo-500 to-violet-500 flex items-center justify-center text-white shadow-lg shadow-indigo-500/25 group-hover:scale-105 transition-transform duration-300">
                        <svg class="w-6 h-6" style="width: 24px; height: 24px; max-width: 24px; max-height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-xl font-extrabold tracking-tight bg-gradient-to-r from-white via-slate-100 to-indigo-300 bg-clip-text text-transparent">PinjamBarang</span>
                        <span class="text-xs block text-indigo-400 font-semibold tracking-wide uppercase">Asset Management Hub</span>
                    </div>
                </a>

                <nav class="hidden md:flex items-center space-x-8">
                    <a href="#katalog" class="text-sm font-medium text-slate-300 hover:text-white transition">Katalog Barang</a>
                    <a href="{{ route('loans.create') }}" class="text-sm font-medium text-slate-300 hover:text-white transition">Ajukan Pinjaman</a>
                    <a href="{{ route('loans.track') }}" class="text-sm font-medium text-emerald-400 hover:text-emerald-300 transition flex items-center gap-1.5 bg-emerald-950/40 border border-emerald-800/60 px-3 py-1 rounded-full">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Cek Status
                    </a>
                </nav>

                <div class="flex items-center space-x-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm font-semibold bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2.5 rounded-xl transition shadow-lg shadow-indigo-600/30 flex items-center gap-2">
                            <span>Panel Admin</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-white border border-slate-700/80 hover:border-indigo-500 hover:bg-indigo-950/20 px-4 py-2 rounded-xl transition">
                            Login Admin
                        </a>
                        <a href="{{ route('loans.create') }}" class="hidden sm:inline-flex text-sm font-semibold bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white px-4 py-2 rounded-xl shadow-lg shadow-indigo-500/25 transition">
                            Pinjam Sekarang
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <main class="flex-grow pb-16 md:pb-0">
        <section class="relative overflow-hidden pt-12 pb-24 lg:pt-20 lg:pb-32">
            <!-- Background Glow & Shapes -->
            <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-indigo-600/15 blur-[140px] pointer-events-none rounded-full"></div>
            <div class="absolute top-1/3 right-10 w-96 h-96 bg-violet-600/10 blur-[120px] pointer-events-none rounded-full"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center max-w-3xl mx-auto">
                    <!-- Pill Badge -->
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-slate-900 border border-slate-700/80 text-xs font-semibold text-indigo-300 shadow-inner mb-6">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                        <span>Sistem Peminjaman Otomatis & Terintegrasi Admin</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight">
                        Pinjam Peralatan & Aset Lebih <span class="bg-gradient-to-r from-indigo-400 via-violet-300 to-emerald-400 bg-clip-text text-transparent">Cepat dan Transparan</span>
                    </h1>

                    <p class="mt-6 text-lg sm:text-xl text-slate-300 leading-relaxed">
                        Cukup isi identitas nama, nickname, kontak, dan tanggal peminjaman. Permohonan langsung diteruskan ke admin secara real-time dengan status yang dapat Anda pantau mandiri.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('loans.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-bold text-base shadow-xl shadow-indigo-600/30 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Ajukan Peminjaman Barang</span>
                        </a>

                        <a href="{{ route('loans.track') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-4 rounded-2xl bg-slate-900/90 hover:bg-slate-800 text-slate-200 hover:text-white font-semibold text-base border border-slate-700/80 transition-all duration-200">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <span>Lacak Status Pengajuan</span>
                        </a>
                    </div>

                    <!-- Metrics Stats -->
                    <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 pt-10 border-t border-slate-800/80">
                        <div class="p-4 rounded-2xl bg-slate-900/50 border border-slate-800">
                            <div class="text-2xl sm:text-3xl font-extrabold text-white">{{ $stats['total_items'] ?? 8 }}</div>
                            <div class="text-xs text-slate-400 mt-1">Total Aset Barang</div>
                        </div>
                        <div class="p-4 rounded-2xl bg-slate-900/50 border border-slate-800">
                            <div class="text-2xl sm:text-3xl font-extrabold text-emerald-400">{{ $stats['available_items'] ?? 8 }}</div>
                            <div class="text-xs text-slate-400 mt-1">Barang Siap Dipinjam</div>
                        </div>
                        <div class="p-4 rounded-2xl bg-slate-900/50 border border-slate-800">
                            <div class="text-2xl sm:text-3xl font-extrabold text-indigo-400">{{ $stats['total_loans'] ?? 0 }}</div>
                            <div class="text-xs text-slate-400 mt-1">Total Peminjaman</div>
                        </div>
                        <div class="p-4 rounded-2xl bg-slate-900/50 border border-slate-800">
                            <div class="text-2xl sm:text-3xl font-extrabold text-amber-400">{{ $stats['active_loans'] ?? 0 }}</div>
                            <div class="text-xs text-slate-400 mt-1">Sedang Diproses/Aktif</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Feature Benefits Section -->
        <section class="py-16 bg-slate-900/40 border-y border-slate-800/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <h2 class="text-2xl sm:text-3xl font-bold text-white">Alur Peminjaman Praktis 3 Langkah</h2>
                    <p class="text-slate-400 text-sm sm:text-base mt-2">Semua data peminjam langsung tersinkronisasi ke admin tanpa ribet berkas manual.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800 relative hover:border-slate-700 transition">
                        <div class="w-12 h-12 rounded-xl bg-indigo-600/20 text-indigo-400 flex items-center justify-center font-bold text-lg mb-4 border border-indigo-500/30">
                            1
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Pilih Barang & Isi Formulir</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">Pilih peralatan yang tersedia, isi nickname, nama lengkap, kontak WhatsApp, email, dan durasi tanggal pinjam.</p>
                    </div>

                    <div class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800 relative hover:border-slate-700 transition">
                        <div class="w-12 h-12 rounded-xl bg-violet-600/20 text-violet-400 flex items-center justify-center font-bold text-lg mb-4 border border-violet-500/30">
                            2
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Notifikasi Masuk ke Admin</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">Admin akan langsung memverifikasi permohonan melalui dashboard admin dan menyetujui ketersediaan stok barang.</p>
                    </div>

                    <div class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800 relative hover:border-slate-700 transition">
                        <div class="w-12 h-12 rounded-xl bg-emerald-600/20 text-emerald-400 flex items-center justify-center font-bold text-lg mb-4 border border-emerald-500/30">
                            3
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Ambil Barang & Pantau Status</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">Dapatkan tiket kode peminjaman unik (misal #PJ-10293). Cek status kapan saja apakah sudah disetujui atau siap diambil.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Catalog Section -->
        <section id="katalog" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-indigo-400">Daftar Inventaris</span>
                    <h2 class="text-3xl font-extrabold text-white mt-1">Katalog Barang Tersedia</h2>
                    <p class="text-slate-400 text-sm mt-1">Pilih barang yang Anda butuhkan untuk kegiatan, tugas, atau operasional.</p>
                </div>

                <!-- Search & Filters -->
                <form action="{{ route('home') }}#katalog" method="GET" class="flex flex-wrap items-center gap-3">
                    <div class="relative">
                        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama barang..." class="bg-slate-900 border border-slate-700 text-white placeholder-slate-500 text-sm rounded-xl pl-9 pr-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 w-56 sm:w-64">
                        <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition">
                        Cari
                    </button>
                    
                    @if(!empty($search) || !empty($category))
                        <a href="{{ route('home') }}#katalog" class="text-xs text-slate-400 hover:text-white underline self-center">Reset Filter</a>
                    @endif
                </form>
            </div>

            <!-- Category Pills -->
            <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-8 text-sm scrollbar-none">
                <a href="{{ route('home', ['search' => $search]) }}#katalog" class="px-4 py-1.5 rounded-full font-medium transition {{ empty($category) || $category == 'Semua' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'bg-slate-900 text-slate-400 hover:text-white border border-slate-800' }}">
                    Semua Kategori
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('home', ['category' => $cat, 'search' => $search]) }}#katalog" class="px-4 py-1.5 rounded-full font-medium transition whitespace-nowrap {{ ($category ?? '') == $cat ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'bg-slate-900 text-slate-400 hover:text-white border border-slate-800' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            <!-- Items Grid -->
            @if($items->isEmpty())
                <div class="text-center py-16 bg-slate-900/30 rounded-3xl border border-slate-800">
                    <svg class="w-12 h-12 text-slate-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="text-lg font-bold text-white">Tidak ada barang ditemukan</h3>
                    <p class="text-sm text-slate-400 mt-1">Coba gunakan kata kunci pencarian lain atau pilih kategori Semua.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($items as $item)
                        <div class="group flex flex-col justify-between rounded-2xl bg-slate-900/70 border border-slate-800 hover:border-indigo-500/50 hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-300 overflow-hidden">
                            <!-- Card Header Visual -->
                            <div class="p-5 pb-3">
                                <div class="flex items-start justify-between gap-3 mb-4">
                                    <span class="text-xs font-semibold px-2.5 py-1 rounded-lg bg-slate-800 text-indigo-300 border border-slate-700/80">
                                        {{ $item->category }}
                                    </span>

                                    @if($item->available_stock > 0)
                                        <span class="text-xs font-semibold px-2.5 py-1 rounded-lg bg-emerald-950/80 text-emerald-300 border border-emerald-800 flex items-center gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                            Stok: {{ $item->available_stock }}
                                        </span>
                                    @else
                                        <span class="text-xs font-semibold px-2.5 py-1 rounded-lg bg-rose-950/80 text-rose-300 border border-rose-800">
                                            Habis Dipinjam
                                        </span>
                                    @endif
                                </div>

                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-slate-800 to-indigo-950/50 border border-slate-700/60 flex items-center justify-center text-indigo-400 mb-4 group-hover:scale-110 transition duration-300 shadow-inner">
                                    @if($item->category == 'Multimedia')
                                        <svg class="w-7 h-7" style="width: 28px; height: 28px; max-width: 28px; max-height: 28px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    @elseif($item->category == 'Elektronik')
                                        <svg class="w-7 h-7" style="width: 28px; height: 28px; max-width: 28px; max-height: 28px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    @elseif($item->category == 'Audio')
                                        <svg class="w-7 h-7" style="width: 28px; height: 28px; max-width: 28px; max-height: 28px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                                        </svg>
                                    @elseif($item->category == 'Presentasi')
                                        <svg class="w-7 h-7" style="width: 28px; height: 28px; max-width: 28px; max-height: 28px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                        </svg>
                                    @else
                                        <svg class="w-7 h-7" style="width: 28px; height: 28px; max-width: 28px; max-height: 28px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    @endif
                                </div>

                                <span class="text-xs text-slate-500 font-mono">Kode: {{ $item->code }}</span>
                                <h3 class="text-base font-bold text-white group-hover:text-indigo-300 transition duration-200 line-clamp-2 mt-1">
                                    {{ $item->name }}
                                </h3>
                                <p class="text-xs text-slate-400 mt-2 line-clamp-2 leading-relaxed">
                                    {{ $item->description }}
                                </p>
                            </div>

                            <!-- Card Action -->
                            <div class="p-5 pt-3 border-t border-slate-800/80 bg-slate-900/30">
                                @if($item->available_stock > 0)
                                    <a href="{{ route('loans.create', ['item' => $item->id]) }}" class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-indigo-600/90 hover:bg-indigo-600 text-white text-xs font-semibold transition duration-200 shadow-md shadow-indigo-600/20 group-hover:shadow-indigo-600/40">
                                        <span>Pinjam Barang Ini</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                @else
                                    <button disabled class="w-full inline-flex items-center justify-center py-2.5 px-4 rounded-xl bg-slate-800 text-slate-500 text-xs font-semibold cursor-not-allowed">
                                        Stok Sedang Kosong
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-950 border-t border-slate-800/80 text-slate-400 py-12 text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-bold text-sm">
                    PB
                </div>
                <span class="font-bold text-white">PinjamBarang</span>
                <span class="text-xs text-slate-500">Â© 2026 Hak Cipta Dilindungi</span>
            </div>

            <div class="flex items-center space-x-6 text-xs text-slate-400">
                <a href="#katalog" class="hover:text-white transition">Katalog</a>
                <a href="{{ route('loans.create') }}" class="hover:text-white transition">Form Pinjam</a>
                <a href="{{ route('loans.track') }}" class="hover:text-white transition">Lacak Status</a>
                <a href="{{ route('login') }}" class="hover:text-indigo-300 transition">Login Admin</a>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Navigation Bar (Khusus Tampilan HP) -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-slate-950/95 backdrop-blur-xl border-t border-slate-800/90 px-3 py-2">
        <div class="grid grid-cols-4 gap-1 text-center">
            <a href="{{ route('home') }}" class="flex flex-col items-center justify-center py-1.5 text-indigo-400 hover:text-white transition">
                <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-[10px] font-semibold">Beranda</span>
            </a>

            <a href="#katalog" class="flex flex-col items-center justify-center py-1.5 text-slate-400 hover:text-white transition">
                <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
                <span class="text-[10px] font-semibold">Katalog</span>
            </a>

            <a href="{{ route('loans.create') }}" class="flex flex-col items-center justify-center py-1 text-white bg-indigo-600 rounded-xl shadow-md shadow-indigo-600/40">
                <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span class="text-[10px] font-bold">Pinjam</span>
            </a>

            <a href="{{ route('loans.track') }}" class="flex flex-col items-center justify-center py-1.5 text-slate-400 hover:text-white transition">
                <svg class="w-5 h-5 mb-0.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-[10px] font-semibold text-emerald-400">Status</span>
            </a>
        </div>
    </div>
</body>
</html>