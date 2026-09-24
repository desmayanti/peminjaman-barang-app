<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog &amp; Inventaris Sarpras - PinjamBarang</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#030305] text-slate-100 font-sans antialiased min-h-screen selection:bg-purple-500 selection:text-white">
    
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 w-full z-50 bg-[#030305]/80 backdrop-blur-xl border-b border-white/[0.08] px-6 py-4 flex items-center justify-between">
        <a href="{{ url('/') }}" class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl overflow-hidden border border-purple-500/40 shadow-[0_0_15px_rgba(167,139,250,0.4)]">
                <img src="{{ asset('images/logopeminjamanbarang.png') }}" class="w-full h-full object-cover">
            </div>
            <span class="text-white font-extrabold text-lg tracking-tight font-display">Pinjam<span class="text-purple-400">Barang.</span></span>
        </a>
        <a href="{{ url('/') }}#ajukan" class="px-5 py-2 rounded-full text-xs font-bold bg-white text-purple-950 hover:bg-purple-100 transition">
            Ajukan Peminjaman
        </a>
    </nav>

    <!-- Main Content Katalog -->
    <main class="pt-32 pb-24 px-6 lg:px-12 max-w-7xl mx-auto">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h1 class="text-4xl lg:text-5xl font-extrabold font-display text-white mb-4">
                Katalog Sarpras &amp; <span class="text-purple-400">Inventaris Lengkap</span>
            </h1>
            <p class="text-slate-400 text-sm">Daftar seluruh 250+ perangkat, proyektor, alat lab, dan perlengkapan acara. Cek status ketersediaan stok secara real-time.</p>
        </div>

        <!-- Grid Katalog 250+ Barang -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($items as $item)
                <div class="glass-card rounded-2xl p-6 border border-white/10 flex flex-col justify-between relative overflow-hidden group hover:border-purple-500/40 transition">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-[10px] font-mono font-semibold px-2.5 py-1 rounded-md bg-white/[0.05] text-purple-300 border border-white/10">
                                {{ $item->code }}
                            </span>
                            @if($item->available_stock > 0)
                                <span class="flex items-center gap-1.5 text-[11px] font-bold text-emerald-400 bg-emerald-500/10 px-2.5 py-0.5 rounded-full border border-emerald-500/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> Stok: {{ $item->available_stock }}
                                </span>
                            @else
                                <span class="flex items-center gap-1 text-[11px] font-bold text-rose-400 bg-rose-500/10 px-2.5 py-0.5 rounded-full border border-rose-500/20">
                                    ❌ Habis (0)
                                </span>
                            @endif
                        </div>
                        <h3 class="text-base font-bold text-white mb-2 group-hover:text-purple-300 transition-colors">{{ $item->name }}</h3>
                        <p class="text-xs text-slate-400 mb-4">Kondisi: <span class="text-slate-200 font-medium">{{ $item->condition ?? 'Baik' }}</span></p>
                    </div>

                    <div>
                        @if($item->available_stock > 0)
                            <a href="{{ url('/') }}#ajukan" class="w-full py-2.5 rounded-xl font-bold text-xs text-center block bg-purple-600/30 border border-purple-500/40 text-purple-200 hover:bg-purple-600 hover:text-white transition">
                                Pinjam Barang Ini
                            </a>
                        @else
                            <button disabled class="w-full py-2.5 rounded-xl font-bold text-xs text-center block bg-rose-500/10 border border-rose-500/20 text-rose-400 cursor-not-allowed">
                                Stok Kosong (Restock Needed)
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</body>
</html>
