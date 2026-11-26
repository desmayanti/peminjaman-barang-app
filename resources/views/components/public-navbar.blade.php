<header class="sticky top-0 z-50 bg-white/95 dark:bg-slate-900/95 border-b border-purple-100 dark:border-slate-800 text-slate-800 dark:text-white transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-3">
                <a href="javascript:void(0)" onclick="secretAdminLogin()" class="flex items-center space-x-3 group cursor-pointer select-none">
                    <img src="{{ asset('images/logo-pb.webp') }}" alt="Logo PB" class="h-10 w-10 rounded-xl object-cover shadow-md shadow-purple-500/30 group-hover:scale-105 transition duration-200">
                    <div>
                        <span class="text-xl font-bold bg-gradient-to-r from-purple-800 via-purple-600 to-indigo-600 dark:from-white dark:via-indigo-200 dark:to-indigo-400 bg-clip-text text-transparent">PinjamBarang</span>
                        <span class="text-xs block text-slate-500 dark:text-slate-400 font-normal">Asset & Equipment Hub</span>
                    </div>
                </a>
            </div>
            
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}#katalog" class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-purple-700 dark:hover:text-white transition">Katalog Barang</a>
                <a href="{{ route('loans.create') }}" class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-purple-700 dark:hover:text-white transition">Form Pinjam</a>
                <a href="{{ route('loans.track') }}" class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-purple-700 dark:hover:text-white transition flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-emerald-500 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Cek Status
                </a>
            </nav>

            <div class="flex items-center space-x-3 sm:space-x-4">
                <!-- Theme Switcher -->
                <x-theme-toggle size="sm" />

                <a href="{{ route('loans.track') }}" class="md:hidden text-xs text-emerald-700 dark:text-emerald-400 bg-emerald-100/80 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 px-3 py-1.5 rounded-lg">Cek Status</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-xs sm:text-sm font-medium bg-purple-600 hover:bg-purple-500 text-white px-4 py-2 rounded-xl transition shadow-md shadow-purple-600/30 flex items-center gap-2">
                        <span>Dashboard Admin</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>

<script>
    let clickCount = 0;
    let clickTimer;

    function secretAdminLogin() {
        clickCount++;
        clearTimeout(clickTimer);
        
        // Reset hitungan jika tidak diklik lagi dalam 2 detik
        clickTimer = setTimeout(() => {
            clickCount = 0;
        }, 2000);

        // Jika diklik 3 kali berturut-turut, arahkan ke halaman login
        // Jika diklik 3 kali berturut-turut, arahkan ke pintu rahasia portal admin (auto-reset sesi & paksa form login)
        if (clickCount === 3) {
            window.location.href = "{{ route('login') }}"; 
            window.location.href = "{{ route('admin.portal') }}"; 
        }
    }
</script>