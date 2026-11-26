<x-app-layout>
    @php
        $totalItems = \App\Models\Item::count();
        $availableItems = \App\Models\Item::where('available_stock', '>', 0)->count();
        $totalLoans = \App\Models\Loan::count();
        $pendingLoans = \App\Models\Loan::where('status', 'pending')->count();
        $approvedLoans = \App\Models\Loan::where('status', 'approved')->count();
        $recentLoans = \App\Models\Loan::with('item')->latest()->take(6)->get();
        $outOfStockItems = \App\Models\Item::where('available_stock', 0)->get();
    @endphp

    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-xs font-semibold text-purple-600 dark:text-purple-400 mb-1">
                    <span>Panel Kendali</span>
                    <span>&bull;</span>
                    <span class="text-slate-500 dark:text-slate-400">Ikhtisar Real-Time</span>
                </div>
                <h2 class="font-extrabold text-2xl sm:text-3xl text-slate-900 dark:text-white font-display flex items-center gap-3">
                    Dashboard Ringkasan Admin
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 mt-1">
                    Kelola data inventaris sarana prasarana dan verifikasi permohonan peminjaman dengan cepat.
                </p>
            </div>

            <!-- Quick Action Header Buttons -->
            <div class="flex items-center gap-2.5 flex-wrap">
                <a href="{{ route('admin.items.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl text-xs font-bold bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white shadow-[0_0_20px_rgba(147,51,234,0.35)] transition-all transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Aset Baru</span>
                </a>
                <a href="{{ route('admin.loans.index') }}" class="admin-btn-outline inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl text-xs font-semibold bg-white dark:bg-white/[0.05] hover:bg-purple-50 dark:hover:bg-white/[0.1] text-slate-800 dark:text-slate-200 hover:text-purple-700 dark:hover:text-white border border-purple-200 dark:border-white/10 shadow-sm transition">
                    <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span class="font-bold text-slate-800 dark:text-slate-200">Semua Permohonan</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Hero Welcome Card -->
            <div class="p-6 sm:p-8 rounded-3xl bg-gradient-to-r from-purple-100/90 via-white to-indigo-100/80 dark:from-purple-900/30 dark:via-[#121124] dark:to-indigo-900/20 border border-purple-200 dark:border-purple-500/20 shadow-xl shadow-purple-100/70 dark:shadow-2xl relative overflow-hidden backdrop-blur-xl transition-colors duration-300">
                <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-purple-500/10 blur-[80px] rounded-full pointer-events-none"></div>
                
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
                    <div class="max-w-2xl">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-100 dark:bg-purple-500/20 border border-purple-200 dark:border-purple-500/40 text-xs font-bold text-purple-700 dark:text-purple-300 mb-3 shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 dark:bg-emerald-400 animate-ping"></span>
                            <span>Sistem Operasional Normal</span>
                        </div>
                        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white font-display tracking-tight">
                            Selamat Datang, {{ Auth::user()->name }}! 👋
                        </h1>
                        <p class="text-slate-600 dark:text-slate-300 text-xs sm:text-sm mt-1.5 leading-relaxed">
                            @if($pendingLoans > 0)
                                Terdapat <strong class="text-amber-600 dark:text-amber-400 font-bold underline">{{ $pendingLoans }} permohonan baru</strong> yang menanti review dan persetujuan Anda hari ini.
                            @else
                                Semua permohonan telah ditinjau dengan baik. Tidak ada antrean verifikasi tertunda.
                            @endif
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        @if($pendingLoans > 0)
                            <a href="{{ route('admin.loans.index', ['status' => 'pending']) }}" class="px-5 py-3 rounded-2xl bg-amber-500 hover:bg-amber-400 text-slate-950 text-xs font-bold shadow-lg shadow-amber-500/20 transition-all transform hover:-translate-y-0.5 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-slate-950 animate-pulse"></span>
                                <span>Verifikasi {{ $pendingLoans }} Pengajuan &rarr;</span>
                            </a>
                        @endif
                        <a href="{{ route('home') }}" target="_blank" class="admin-btn-outline px-4 py-3 rounded-2xl bg-white dark:bg-white/[0.06] hover:bg-purple-50 dark:hover:bg-white/[0.12] text-slate-800 dark:text-slate-200 text-xs font-semibold border border-purple-200 dark:border-white/10 transition-colors flex items-center gap-1.5 shadow-sm">
                            <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            <span class="font-bold text-slate-800 dark:text-slate-200">Lihat Katalog Publik</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Restock Alert (If Out of Stock) -->
            @if($outOfStockItems->count() > 0)
                <div class="restock-alert-box p-5 rounded-2xl bg-rose-50 dark:bg-rose-950/30 border border-rose-200 dark:border-rose-800/40 text-xs text-rose-700 dark:text-rose-300 flex items-start justify-between gap-4 shadow-sm">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-xl bg-rose-100 dark:bg-rose-500/20 text-rose-600 dark:text-rose-400 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div>
                            <span class="font-bold text-rose-900 dark:text-white block text-sm">Peringatan: {{ $outOfStockItems->count() }} Barang Kehabisan Stok</span>
                            <span class="text-slate-600 dark:text-slate-400 block mt-0.5">Barang berikut sedang kosong di katalog:</span>
                            <div class="flex flex-wrap gap-1.5 mt-2">
                                @foreach($outOfStockItems as $oos)
                                    <span class="restock-item-badge px-2 py-0.5 rounded-lg bg-rose-100 dark:bg-rose-500/20 text-red-800 dark:text-rose-300 border border-rose-200 dark:border-rose-500/30 font-mono font-bold text-[10px]">
                                        {{ $oos->code }} &bull; {{ $oos->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('admin.items.index') }}" class="px-3.5 py-1.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-semibold text-xs border border-rose-500 shrink-0 transition-colors shadow-sm">
                        Kelola Stok &rarr;
                    </a>
                </div>
            @endif

            <!-- 4 Modern KPI Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                
                <!-- Card 1: Perlu Verifikasi -->
                <div class="p-6 rounded-3xl bg-white dark:bg-[#0e0e1a]/80 backdrop-blur-xl border border-purple-100 dark:border-white/[0.08] hover:border-amber-400 dark:hover:border-amber-500/40 transition-all shadow-sm shadow-purple-100/60 dark:shadow-xl group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-28 h-28 bg-amber-500/10 blur-[40px] rounded-full pointer-events-none group-hover:scale-125 transition-transform"></div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">Perlu Verifikasi</span>
                        <div class="w-10 h-10 rounded-2xl bg-amber-50 dark:bg-amber-500/10 border border-amber-200 dark:border-amber-500/30 text-amber-600 dark:text-amber-400 flex items-center justify-center shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-900 dark:text-white font-display">{{ $pendingLoans }}</div>
                    <div class="mt-3 pt-3 border-t border-purple-100 dark:border-white/5 flex items-center justify-between text-xs">
                        <a href="{{ route('admin.loans.index', ['status' => 'pending']) }}" class="text-amber-600 dark:text-amber-400 hover:text-amber-700 dark:hover:text-amber-300 font-semibold flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                            <span>Tinjau pengajuan</span>
                            <span>&rarr;</span>
                        </a>
                        <span class="text-[10px] text-slate-500">Antrean Aktif</span>
                    </div>
                </div>

                <!-- Card 2: Sedang Dipinjam -->
                <div class="p-6 rounded-3xl bg-white dark:bg-[#0e0e1a]/80 backdrop-blur-xl border border-purple-100 dark:border-white/[0.08] hover:border-emerald-400 dark:hover:border-emerald-500/40 transition-all shadow-sm shadow-purple-100/60 dark:shadow-xl group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-28 h-28 bg-emerald-500/10 blur-[40px] rounded-full pointer-events-none group-hover:scale-125 transition-transform"></div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Sedang Dipinjam</span>
                        <div class="w-10 h-10 rounded-2xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-900 dark:text-white font-display">{{ $approvedLoans }}</div>
                    <div class="mt-3 pt-3 border-t border-purple-100 dark:border-white/5 flex items-center justify-between text-xs">
                        <a href="{{ route('admin.loans.index', ['status' => 'approved']) }}" class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 font-semibold flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                            <span>Daftar dipinjam</span>
                            <span>&rarr;</span>
                        </a>
                        <span class="text-[10px] text-slate-500">Sedang Digunakan</span>
                    </div>
                </div>

                <!-- Card 3: Total Aset Barang -->
                <div class="p-6 rounded-3xl bg-white dark:bg-[#0e0e1a]/80 backdrop-blur-xl border border-purple-100 dark:border-white/[0.08] hover:border-purple-400 dark:hover:border-purple-500/40 transition-all shadow-sm shadow-purple-100/60 dark:shadow-xl group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-28 h-28 bg-purple-500/10 blur-[40px] rounded-full pointer-events-none group-hover:scale-125 transition-transform"></div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-purple-600 dark:text-purple-400">Katalog Aset</span>
                        <div class="w-10 h-10 rounded-2xl bg-purple-50 dark:bg-purple-500/10 border border-purple-200 dark:border-purple-500/30 text-purple-600 dark:text-purple-400 flex items-center justify-center shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-900 dark:text-white font-display">{{ $totalItems }} <span class="text-sm font-normal text-slate-500 dark:text-slate-400">Item</span></div>
                    <div class="mt-3 pt-3 border-t border-purple-100 dark:border-white/5 flex items-center justify-between text-xs">
                        <a href="{{ route('admin.items.index') }}" class="text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 font-semibold flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                            <span>Kelola barang</span>
                            <span>&rarr;</span>
                        </a>
                        <span class="text-[10px] text-slate-500">{{ $availableItems }} Siap Pinjam</span>
                    </div>
                </div>

                <!-- Card 4: Total Riwayat -->
                <div class="p-6 rounded-3xl bg-white dark:bg-[#0e0e1a]/80 backdrop-blur-xl border border-purple-100 dark:border-white/[0.08] hover:border-indigo-400 dark:hover:border-indigo-500/40 transition-all shadow-sm shadow-purple-100/60 dark:shadow-xl group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-28 h-28 bg-indigo-500/10 blur-[40px] rounded-full pointer-events-none group-hover:scale-125 transition-transform"></div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Total Transaksi</span>
                        <div class="w-10 h-10 rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 border border-indigo-200 dark:border-indigo-500/30 text-indigo-600 dark:text-indigo-400 flex items-center justify-center shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-900 dark:text-white font-display">{{ $totalLoans }}</div>
                    <div class="mt-3 pt-3 border-t border-purple-100 dark:border-white/5 flex items-center justify-between text-xs">
                        <a href="{{ route('admin.loans.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 font-semibold flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                            <span>Lihat riwayat</span>
                            <span>&rarr;</span>
                        </a>
                        <span class="text-[10px] text-slate-500">Semua Tiket</span>
                    </div>
                </div>

            </div>

            <!-- Recent Loans Table Section -->
            <div class="p-6 sm:p-7 rounded-3xl bg-white dark:bg-[#0e0e1a]/80 backdrop-blur-xl border border-purple-100 dark:border-white/[0.08] shadow-xl shadow-purple-100/70 dark:shadow-2xl overflow-hidden transition-colors">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-4 border-b border-purple-100 dark:border-white/[0.08]">
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-slate-900 dark:text-white font-display flex items-center gap-2">
                            <span>Permohonan Peminjaman Terbaru</span>
                            <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-purple-100 dark:bg-purple-500/20 text-purple-700 dark:text-purple-300 border border-purple-200 dark:border-transparent">Terbaru</span>
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Daftar peminjam dan status tiket pengajuan terkini.</p>
                    </div>
                    <a href="{{ route('admin.loans.index') }}" class="admin-link-action inline-flex items-center gap-1 text-xs font-bold text-purple-700 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-300 transition-colors">
                        <span>Lihat Semua Permohonan</span>
                        <span>&rarr;</span>
                    </a>
                </div>

                @if($recentLoans->isEmpty())
                    <div class="text-center py-12">
                        <div class="w-12 h-12 rounded-2xl bg-purple-50 dark:bg-white/[0.03] text-slate-400 dark:text-slate-600 flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-slate-600 dark:text-slate-400">Belum ada pengajuan peminjaman yang masuk.</p>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">Data peminjam baru akan otomatis muncul di tabel ini.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider border-b border-purple-100 dark:border-white/[0.06] pb-3">
                                    <th class="py-3 px-3">Kode Tiket</th>
                                    <th class="py-3 px-3">Peminjam</th>
                                    <th class="py-3 px-3">Barang</th>
                                    <th class="py-3 px-3">Durasi Waktu</th>
                                    <th class="py-3 px-3">Status</th>
                                    <th class="py-3 px-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-purple-100 dark:divide-white/[0.05]">
                                @foreach($recentLoans as $loan)
                                    <tr class="hover:bg-purple-50/50 dark:hover:bg-white/[0.02] transition-colors group">
                                        <!-- Kode -->
                                        <td class="py-3.5 px-3">
                                            <span class="font-mono font-extrabold text-xs text-purple-700 dark:text-purple-400 bg-purple-100 dark:bg-purple-500/10 px-2 py-1 rounded-lg border border-purple-200 dark:border-purple-500/30">
                                                #{{ $loan->loan_code }}
                                            </span>
                                            <span class="block text-[10px] text-slate-400 dark:text-slate-500 mt-1 font-mono">
                                                {{ $loan->created_at->format('d/m/Y H:i') }}
                                            </span>
                                        </td>

                                        <!-- Peminjam -->
                                        <td class="py-3.5 px-3">
                                            <div class="flex items-center gap-2.5">
                                                <div class="w-8 h-8 rounded-xl bg-purple-100 dark:bg-gradient-to-tr dark:from-purple-600/30 dark:to-indigo-600/30 border border-purple-200 dark:border-purple-500/40 flex items-center justify-center font-bold text-xs text-purple-700 dark:text-purple-300 shrink-0">
                                                    {{ strtoupper(substr($loan->borrower_name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <span class="font-bold text-slate-800 dark:text-slate-200 block">{{ $loan->borrower_name }}</span>
                                                    <span class="text-[11px] text-slate-500 dark:text-slate-400">{{ $loan->nickname }} &bull; <span class="font-mono text-slate-500 dark:text-slate-400">{{ $loan->phone_number }}</span></span>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Barang -->
                                        <td class="py-3.5 px-3">
                                            <div class="font-semibold text-slate-800 dark:text-slate-200">{{ $loan->item->name ?? 'Barang' }}</div>
                                            <div class="flex items-center gap-1.5 mt-0.5">
                                                <span class="text-[10px] text-slate-500 dark:text-slate-400 font-mono">{{ $loan->quantity }} Unit</span>
                                                @if($loan->type === 'minta' || ($loan->item && $loan->item->is_consumable) || empty($loan->tanggal_selesai))
                                                    <span class="inline-flex items-center px-1.5 py-0.2 rounded text-[10px] font-bold bg-emerald-100 dark:bg-emerald-500/20 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-500/30">
                                                        Habis Pakai
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-1.5 py-0.2 rounded text-[10px] font-bold bg-indigo-100 dark:bg-indigo-500/20 text-indigo-700 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-500/30">
                                                        Pinjam
                                                    </span>
                                                @endif
                                            </div>
                                        </td>

                                        <!-- Durasi -->
                                        <td class="py-3.5 px-3 text-slate-700 dark:text-slate-300">
                                            @if($loan->type === 'minta' || ($loan->item && $loan->item->is_consumable) || empty($loan->tanggal_selesai))
                                                <span class="text-slate-400 dark:text-slate-400 italic text-[11px]">Barang Diminta</span>
                                            @else
                                                <div class="font-medium">{{ \Carbon\Carbon::parse($loan->borrow_date)->format('d M') }} &mdash; {{ \Carbon\Carbon::parse($loan->tanggal_selesai ?? $loan->return_date)->format('d M Y') }}</div>
                                            @endif
                                        </td>

                                        <!-- Status Badge -->
                                        <td class="py-3.5 px-3">
                                            @if($loan->status == 'pending')
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-100 dark:bg-amber-500/20 text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-500/40">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 dark:bg-amber-400 animate-ping"></span>
                                                    Pending
                                                </span>
                                            @elseif($loan->status == 'approved')
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 dark:bg-emerald-500/20 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-500/40">
                                                    Disetujui
                                                </span>
                                            @elseif($loan->status == 'returned')
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-blue-100 dark:bg-blue-500/20 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-500/40">
                                                    Kembali
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 dark:bg-rose-500/20 text-rose-700 dark:text-rose-300 border border-rose-200 dark:border-rose-500/40">
                                                    Ditolak
                                                </span>
                                            @endif
                                        </td>

                                        <!-- Aksi -->
                                        <td class="py-3.5 px-3 text-right">
                                            <a href="{{ route('admin.loans.index') }}" class="admin-btn-outline inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-purple-50 dark:bg-white/[0.04] hover:bg-purple-100 dark:hover:bg-purple-600/20 text-purple-700 dark:text-slate-300 hover:text-purple-900 dark:hover:text-purple-300 border border-purple-200 dark:border-white/10 hover:border-purple-300 dark:hover:border-purple-500/40 transition-all font-semibold text-[11px]">
                                                <span>Tinjau</span>
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>