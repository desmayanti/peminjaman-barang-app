<header class="sticky top-0 z-50 bg-slate-900/90 backdrop-blur-md border-b border-slate-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-3">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 flex items-center justify-center text-white font-bold shadow-lg shadow-indigo-500/30 group-hover:scale-105 transition duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-xl font-bold bg-gradient-to-r from-white via-indigo-200 to-indigo-400 bg-clip-text text-transparent">PinjamBarang</span>
                        <span class="text-xs block text-slate-400 font-normal">Asset & Equipment Hub</span>
                    </div>
                </a>
            </div>
            
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}#katalog" class="text-sm font-medium text-slate-300 hover:text-white transition">Katalog Barang</a>
                <a href="{{ route('loans.create') }}" class="text-sm font-medium text-slate-300 hover:text-white transition">Form Pinjam</a>
                <a href="{{ route('loans.track') }}" class="text-sm font-medium text-slate-300 hover:text-white transition flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Cek Status
                </a>
            </nav>

            <div class="flex items-center space-x-4">
                <a href="{{ route('loans.track') }}" class="md:hidden text-xs text-emerald-400 bg-emerald-950/60 border border-emerald-800 px-3 py-1.5 rounded-lg">Cek Status</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-xs sm:text-sm font-medium bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-xl transition shadow-md shadow-indigo-600/30 flex items-center gap-2">
                        <span>Dashboard Admin</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-xs sm:text-sm font-medium text-slate-300 hover:text-white border border-slate-700 hover:border-slate-500 px-3.5 py-1.5 rounded-xl transition">
                        Login Admin
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>