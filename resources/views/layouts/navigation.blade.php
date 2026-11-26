<nav x-data="{ open: false }" class="bg-white/95 dark:bg-[#090913]/95 border-b border-purple-100 dark:border-white/[0.08] sticky top-0 z-40 transition-colors duration-300">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <!-- Brand / Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                        <img src="{{ asset('images/logo-pb.webp') }}" alt="Logo PB" class="h-9 w-9 rounded-xl object-cover shadow-sm">
                        <div class="flex items-center gap-2">
                            <span class="text-slate-800 dark:text-white font-extrabold text-base tracking-tight font-display">Pinjam<span class="text-purple-600 dark:text-purple-400">Barang.</span></span>
                            <span class="text-[10px] font-extrabold px-1.5 py-0.5 rounded-md bg-purple-100 dark:bg-purple-500/20 text-purple-700 dark:text-purple-300 border border-purple-200 dark:border-purple-500/30 uppercase tracking-wider">ADMIN</span>
                        </div>
                    </a>
                </div>

                @php
                    $pendingCount = \App\Models\Loan::where('status', 'pending')->count();
                @endphp

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:items-center sm:gap-2">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" class="admin-nav-item inline-flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all {{ request()->routeIs('dashboard') ? 'active-tab bg-purple-100 dark:bg-purple-600/20 text-slate-800 dark:text-purple-300 border border-purple-200 dark:border-purple-500/40 shadow-sm shadow-purple-100 dark:shadow-[0_0_15px_rgba(147,51,234,0.2)]' : 'text-slate-700 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-purple-50 dark:hover:bg-white/[0.05] border border-transparent' }}">
                        <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <!-- Permohonan Pinjam -->
                    <a href="{{ route('admin.loans.index') }}" class="admin-nav-item inline-flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all {{ request()->routeIs('admin.loans.*') ? 'active-tab bg-purple-100 dark:bg-purple-600/20 text-slate-800 dark:text-purple-300 border border-purple-200 dark:border-purple-500/40 shadow-sm shadow-purple-100 dark:shadow-[0_0_15px_rgba(147,51,234,0.2)]' : 'text-slate-700 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-purple-50 dark:hover:bg-white/[0.05] border border-transparent' }}">
                        <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span>Permohonan Pinjam</span>
                        @if($pendingCount > 0)
                            <span class="pending-badge px-1.5 py-0.2 rounded-full text-[10px] font-bold bg-amber-500 text-slate-950 shadow-sm animate-pulse">
                                {{ $pendingCount }}
                            </span>
                        @endif
                    </a>

                    <!-- Katalog Aset -->
                    <a href="{{ route('admin.items.index') }}" class="admin-nav-item inline-flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all {{ request()->routeIs('admin.items.*') ? 'active-tab bg-purple-100 dark:bg-purple-600/20 text-slate-800 dark:text-purple-300 border border-purple-200 dark:border-purple-500/40 shadow-sm shadow-purple-100 dark:shadow-[0_0_15px_rgba(147,51,234,0.2)]' : 'text-slate-700 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-purple-50 dark:hover:bg-white/[0.05] border border-transparent' }}">
                        <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <span>Katalog Aset / Inventaris</span>
                    </a>
                </div>
            </div>

            <!-- Right Nav Items -->
            <div class="hidden sm:flex sm:items-center sm:gap-3">
                <!-- External Landing Link -->
                <a href="{{ route('home') }}" target="_blank" class="admin-nav-item inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white bg-purple-50/80 dark:bg-white/[0.04] hover:bg-purple-100 dark:hover:bg-white/[0.08] border border-purple-200/80 dark:border-white/10 transition-all" title="Buka website publik">
                    <svg class="w-3.5 h-3.5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    <span>Website Publik</span>
                </a>

                <!-- Theme Switcher Toggle Button (Di sebelah profil Administrator Asset) -->
                <x-theme-toggle size="md" />

                <!-- User Dropdown Menu -->
                <div class="relative" x-data="{ userOpen: false }" @click.outside="userOpen = false">
                    <button @click="userOpen = !userOpen" class="admin-user-btn flex items-center gap-2.5 p-1.5 pr-3 rounded-2xl bg-purple-50/70 dark:bg-white/[0.04] hover:bg-purple-100/90 dark:hover:bg-white/[0.08] border border-purple-200/70 dark:border-white/10 text-slate-800 dark:text-slate-200 transition-all focus:outline-none">
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-purple-600 to-indigo-600 flex items-center justify-center text-white text-xs font-extrabold shadow-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="text-left hidden md:block">
                            <div class="text-xs font-bold text-slate-800 dark:text-white leading-tight">{{ Auth::user()->name }}</div>
                            <div class="text-[10px] text-purple-600 dark:text-purple-400 font-medium leading-tight">Administrator Asset</div>
                        </div>
                        <svg class="w-3.5 h-3.5 text-slate-500 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Content -->
                    <div x-show="userOpen" 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                         class="absolute right-0 mt-2 w-56 rounded-2xl bg-white dark:bg-[#111022] border border-purple-100 dark:border-white/10 shadow-xl shadow-purple-200/50 dark:shadow-2xl p-2 z-50 divide-y divide-purple-100 dark:divide-white/5"
                         style="display: none;">
                        <div class="px-3 py-2">
                            <p class="text-xs font-bold text-slate-800 dark:text-white">{{ Auth::user()->name }}</p>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl text-xs font-medium text-slate-700 dark:text-slate-300 hover:text-purple-700 dark:hover:text-white hover:bg-purple-50 dark:hover:bg-white/[0.06] transition-colors">
                                <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>Pengaturan Akun</span>
                            </a>
                            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 px-3 py-2 rounded-xl text-xs font-medium text-slate-700 dark:text-slate-300 hover:text-purple-700 dark:hover:text-white hover:bg-purple-50 dark:hover:bg-white/[0.06] transition-colors">
                                <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                <span>Kunjungi Landing Page</span>
                            </a>
                        </div>
                        <div class="pt-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 rounded-xl text-xs font-medium text-rose-600 dark:text-rose-400 hover:text-rose-700 dark:hover:text-rose-300 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition-colors text-left">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <span>Keluar (Log Out)</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hamburger & Mobile Switcher -->
            <div class="-me-2 flex items-center gap-2 sm:hidden">
                <x-theme-toggle size="sm" />
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-600 dark:text-slate-400 hover:text-purple-700 dark:hover:text-white hover:bg-purple-50 dark:hover:bg-white/[0.06] transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-purple-100 dark:border-white/[0.08] bg-white dark:bg-[#0c0c17]">
        <div class="pt-3 pb-3 px-4 space-y-1.5">
            <a href="{{ route('dashboard') }}" class="admin-nav-item block px-3 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('dashboard') ? 'active-tab bg-purple-100 dark:bg-purple-600/20 text-slate-800 dark:text-purple-300 border border-purple-200 dark:border-purple-500/30' : 'text-slate-700 dark:text-slate-300 hover:bg-purple-50 dark:hover:bg-white/[0.05]' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.loans.index') }}" class="admin-nav-item flex items-center justify-between px-3 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('admin.loans.*') ? 'active-tab bg-purple-100 dark:bg-purple-600/20 text-slate-800 dark:text-purple-300 border border-purple-200 dark:border-purple-500/30' : 'text-slate-700 dark:text-slate-300 hover:bg-purple-50 dark:hover:bg-white/[0.05]' }}">
                <span>Permohonan Pinjam</span>
                @if($pendingCount > 0)
                    <span class="pending-badge px-2 py-0.5 rounded-full text-xs font-bold bg-amber-500 text-slate-950">
                        {{ $pendingCount }}
                    </span>
                @endif
            </a>
            <a href="{{ route('admin.items.index') }}" class="admin-nav-item block px-3 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('admin.items.*') ? 'active-tab bg-purple-100 dark:bg-purple-600/20 text-slate-800 dark:text-purple-300 border border-purple-200 dark:border-purple-500/30' : 'text-slate-700 dark:text-slate-300 hover:bg-purple-50 dark:hover:bg-white/[0.05]' }}">
                Katalog Aset / Inventaris
            </a>
            <a href="{{ route('home') }}" target="_blank" class="admin-nav-item block px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-700 dark:text-purple-400 hover:bg-purple-50 dark:hover:bg-white/[0.05]">
                🌐 Buka Website Publik
            </a>
        </div>

        <div class="pt-3 pb-4 border-t border-purple-100 dark:border-white/[0.08] px-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-8 h-8 rounded-xl bg-purple-600 text-white font-bold flex items-center justify-center text-xs">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-bold text-sm text-slate-800 dark:text-white">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-slate-500 dark:text-slate-400">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-xl text-xs font-medium text-slate-700 dark:text-slate-300 hover:bg-purple-50 dark:hover:bg-white/[0.05]">
                    Pengaturan Akun
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 rounded-xl text-xs font-medium text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-500/10">
                        Keluar (Log Out)
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
