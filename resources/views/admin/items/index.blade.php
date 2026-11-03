<x-app-layout>
    @php
        $totalItemsCount = $items->count();
        $totalStockSum = $items->sum('total_stock');
        $availableStockSum = $items->sum('available_stock');
        $emptyStockCount = $items->where('available_stock', 0)->count();
        $categoriesCount = $items->pluck('category')->unique()->count();
    @endphp

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-xs font-semibold text-purple-600 dark:text-purple-400 mb-1">
                    <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                    <span>/</span>
                    <span class="text-slate-500 dark:text-slate-400">Katalog Aset</span>
                </div>
                <h2 class="font-extrabold text-2xl sm:text-3xl text-slate-900 dark:text-white font-display flex items-center gap-2">
                    Manajemen Aset &amp; Inventaris
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 mt-1">
                    Kelola data barang sarpras, konfigurasi peminjaman, dan ketersediaan stok secara terpusat.
                </p>
            </div>
            
            <div class="flex items-center gap-2.5">
                <a href="{{ route('admin.items.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl text-xs font-bold bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white shadow-[0_0_20px_rgba(147,51,234,0.35)] transition-all transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Barang Baru</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="p-4 rounded-2xl bg-emerald-100 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/30 text-emerald-800 dark:text-emerald-300 text-sm flex items-center gap-3 shadow-sm">
                    <div class="w-8 h-8 rounded-xl bg-emerald-200 dark:bg-emerald-500/20 text-emerald-700 dark:text-emerald-400 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 rounded-2xl bg-rose-100 dark:bg-rose-500/10 border border-rose-200 dark:border-rose-500/30 text-rose-800 dark:text-rose-300 text-sm flex items-center gap-3 shadow-sm">
                    <div class="w-8 h-8 rounded-xl bg-rose-200 dark:bg-rose-500/20 text-rose-700 dark:text-rose-400 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="font-semibold">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Mini Summary Stats Banner -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="p-4 rounded-2xl bg-white dark:bg-[#0e0e1a]/80 backdrop-blur-xl border border-purple-100 dark:border-white/[0.08] shadow-sm shadow-purple-100/60 dark:shadow-none">
                    <span class="text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider block">Total Jenis Aset</span>
                    <span class="text-2xl font-extrabold text-slate-900 dark:text-white font-display mt-1 block">{{ $totalItemsCount }}</span>
                    <span class="text-[10px] text-purple-600 dark:text-purple-400 mt-0.5 block font-medium">Koleksi terdaftar</span>
                </div>

                <div class="p-4 rounded-2xl bg-white dark:bg-[#0e0e1a]/80 backdrop-blur-xl border border-purple-100 dark:border-white/[0.08] shadow-sm shadow-purple-100/60 dark:shadow-none">
                    <span class="text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider block">Stok Siap Pinjam</span>
                    <span class="text-2xl font-extrabold text-emerald-600 dark:text-emerald-400 font-display mt-1 block">{{ $availableStockSum }} <span class="text-xs font-normal text-slate-400">/ {{ $totalStockSum }}</span></span>
                    <span class="text-[10px] text-emerald-700 dark:text-emerald-300 mt-0.5 block font-medium">Unit tersedia</span>
                </div>

                <div class="p-4 rounded-2xl bg-white dark:bg-[#0e0e1a]/80 backdrop-blur-xl border border-purple-100 dark:border-white/[0.08] shadow-sm shadow-purple-100/60 dark:shadow-none">
                    <span class="text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider block">Stok Habis</span>
                    <span class="text-2xl font-extrabold text-rose-600 dark:text-rose-400 font-display mt-1 block">{{ $emptyStockCount }}</span>
                    <span class="text-[10px] text-rose-700 dark:text-rose-300 mt-0.5 block font-medium">Perlu restock</span>
                </div>

                <div class="p-4 rounded-2xl bg-white dark:bg-[#0e0e1a]/80 backdrop-blur-xl border border-purple-100 dark:border-white/[0.08] shadow-sm shadow-purple-100/60 dark:shadow-none">
                    <span class="text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider block">Kategori</span>
                    <span class="text-2xl font-extrabold text-indigo-600 dark:text-indigo-400 font-display mt-1 block">{{ $categoriesCount }}</span>
                    <span class="text-[10px] text-indigo-700 dark:text-indigo-300 mt-0.5 block font-medium">Klasifikasi barang</span>
                </div>
            </div>

            <!-- Table Card Container -->
            <div class="p-6 sm:p-7 rounded-3xl bg-white dark:bg-[#0e0e1a]/80 backdrop-blur-xl border border-purple-100 dark:border-white/[0.08] shadow-xl shadow-purple-100/70 dark:shadow-2xl overflow-hidden transition-colors">
                
                <!-- Table Search & Filters -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-4 border-b border-purple-100 dark:border-white/[0.08]">
                    <div class="relative flex-1 max-w-md">
                        <input type="text" id="tableSearch" onkeyup="filterItemsTable()" placeholder="Cari nama barang, kode, atau kategori..." class="w-full bg-purple-50/50 dark:bg-[#131224] text-slate-800 dark:text-white border border-purple-200 dark:border-white/10 rounded-2xl pl-10 pr-4 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-purple-500 placeholder-slate-400 dark:placeholder-slate-500 shadow-sm transition">
                        <svg class="w-4 h-4 text-purple-500 dark:text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                        <span>Menampilkan <strong class="text-slate-900 dark:text-white font-bold">{{ $totalItemsCount }}</strong> barang inventaris</span>
                    </div>
                </div>

                <!-- Desktop Table -->
                <div class="overflow-x-auto hidden md:block">
                    <table class="w-full text-left border-collapse" id="itemsTable">
                        <thead>
                            <tr class="text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider border-b border-purple-100 dark:border-white/[0.06] pb-3">
                                <th class="py-3 px-4">Barang &amp; Kode</th>
                                <th class="py-3 px-4">Kategori</th>
                                <th class="py-3 px-4 text-center">Ketersediaan Stok</th>
                                <th class="py-3 px-4 text-center">Tipe Barang</th>
                                <th class="py-3 px-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-purple-100 dark:divide-white/[0.05]">
                            @php
                                $emojiMap = [
                                    'camera' => '📷',
                                    'laptop' => '💻',
                                    'projector' => '📽️',
                                    'microphone' => '🎙️',
                                    'drone' => '🛸',
                                    'speaker' => '🔊',
                                    'tripod' => '📐',
                                    'box' => '📦'
                                ];
                            @endphp
                            @forelse($items as $item)
                                <tr class="hover:bg-purple-50/50 dark:hover:bg-white/[0.02] transition-colors group item-row">
                                    <!-- Nama & Kode -->
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-2xl bg-purple-100 dark:bg-gradient-to-tr dark:from-purple-600/20 dark:to-indigo-600/20 border border-purple-200 dark:border-purple-500/30 flex items-center justify-center text-xl shrink-0">
                                                {{ $emojiMap[$item->icon ?? 'box'] ?? '📦' }}
                                            </div>
                                            <div>
                                                <span class="font-bold text-sm text-slate-800 dark:text-white block group-hover:text-purple-600 dark:group-hover:text-purple-300 transition-colors item-name">
                                                    {{ $item->name }}
                                                </span>
                                                <span class="font-mono text-xs text-purple-700 dark:text-purple-400 font-extrabold uppercase item-code">
                                                    #{{ $item->code }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Kategori -->
                                    <td class="py-4 px-4">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-semibold bg-purple-50 dark:bg-white/[0.04] text-purple-700 dark:text-slate-300 border border-purple-200 dark:border-white/10 item-category">
                                            {{ $item->category }}
                                        </span>
                                    </td>

                                    <!-- Stok -->
                                    <td class="py-4 px-4 text-center">
                                        <div class="inline-flex flex-col items-center">
                                            <div class="flex items-center gap-1.5">
                                                <span class="w-2 h-2 rounded-full {{ $item->available_stock > 0 ? 'bg-emerald-500' : 'bg-rose-500 animate-pulse' }}"></span>
                                                <span class="font-mono font-extrabold text-sm {{ $item->available_stock > 0 ? 'text-slate-800 dark:text-white' : 'text-rose-600 dark:text-rose-400' }}">
                                                    {{ $item->available_stock }} <span class="text-xs text-slate-400">/ {{ $item->total_stock }}</span>
                                                </span>
                                            </div>
                                            <span class="text-[10px] text-slate-500 font-semibold uppercase mt-0.5">Tersedia / Total</span>
                                        </div>
                                    </td>

                                    <!-- Tipe Barang -->
                                    <td class="py-4 px-4 text-center">
                                        @if($item->is_consumable)
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-500/20 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-500/30 text-xs font-bold shadow-sm">
                                                Habis Pakai
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-indigo-100 dark:bg-indigo-500/20 text-indigo-700 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-500/30 text-xs font-bold shadow-sm">
                                                Wajib Kembali
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Aksi -->
                                    <td class="py-4 px-4 text-right whitespace-nowrap">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.items.edit', $item->id) }}" class="p-2 rounded-xl bg-purple-50 dark:bg-white/[0.04] hover:bg-purple-100 dark:hover:bg-purple-600/30 text-purple-700 dark:text-slate-300 hover:text-purple-900 dark:hover:text-white border border-purple-200 dark:border-white/10 hover:border-purple-300 dark:hover:border-purple-500/40 transition-all" title="Edit Aset">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.items.destroy', $item->id) }}" method="POST" onsubmit="confirmDeletion(event, this)">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 rounded-xl bg-rose-50 dark:bg-white/[0.04] hover:bg-rose-100 dark:hover:bg-rose-600/30 text-rose-600 dark:text-slate-400 hover:text-rose-700 dark:hover:text-rose-300 border border-rose-200 dark:border-white/10 hover:border-rose-300 dark:hover:border-rose-500/40 transition-all" title="Hapus Aset">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-slate-500">
                                        <div class="w-12 h-12 rounded-2xl bg-purple-50 dark:bg-white/[0.03] text-slate-400 dark:text-slate-600 flex items-center justify-center mx-auto mb-3">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg>
                                        </div>
                                        <p class="font-semibold text-slate-600 dark:text-slate-400">Belum ada barang di katalog.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Mobile View -->
                <div class="md:hidden divide-y divide-purple-100 dark:divide-white/[0.06] space-y-4">
                    @forelse($items as $item)
                        <div class="pt-4 first:pt-0 space-y-3">
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex items-center gap-2.5">
                                    <span class="text-xl">{{ $emojiMap[$item->icon ?? 'box'] ?? '📦' }}</span>
                                    <div>
                                        <span class="font-bold text-slate-900 dark:text-white block">{{ $item->name }}</span>
                                        <span class="font-mono text-xs text-purple-700 dark:text-purple-400 font-bold">#{{ $item->code }}</span>
                                    </div>
                                </div>
                                <div>
                                    @if($item->is_consumable)
                                        <span class="px-2.5 py-1 rounded-full bg-emerald-100 dark:bg-emerald-500/20 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-500/30 text-[10px] font-bold">Habis Pakai</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full bg-indigo-100 dark:bg-indigo-500/20 text-indigo-700 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-500/30 text-[10px] font-bold">Pinjam</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400 pt-2 border-t border-purple-100 dark:border-white/5">
                                <span>Stok: <strong class="text-slate-800 dark:text-white">{{ $item->available_stock }} / {{ $item->total_stock }}</strong></span>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.items.edit', $item->id) }}" class="px-3 py-1 rounded-lg bg-purple-50 dark:bg-white/[0.05] text-purple-700 dark:text-purple-300 font-semibold border border-purple-200 dark:border-white/10">Edit</a>
                                    <form action="{{ route('admin.items.destroy', $item->id) }}" method="POST" onsubmit="confirmDeletion(event, this)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 rounded-lg bg-rose-50 dark:bg-rose-500/10 text-rose-700 dark:text-rose-300 font-semibold border border-rose-200 dark:border-rose-500/30">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 text-slate-500">Belum ada barang di katalog.</div>
                    @endforelse
                </div>

            </div>

        </div>
    </div>

    <!-- Client-side Fast Table Filter -->
    <script>
        function filterItemsTable() {
            const input = document.getElementById("tableSearch").value.toLowerCase();
            const rows = document.querySelectorAll("#itemsTable tbody tr.item-row");

            rows.forEach(row => {
                const name = row.querySelector(".item-name") ? row.querySelector(".item-name").innerText.toLowerCase() : "";
                const code = row.querySelector(".item-code") ? row.querySelector(".item-code").innerText.toLowerCase() : "";
                const category = row.querySelector(".item-category") ? row.querySelector(".item-category").innerText.toLowerCase() : "";

                if (name.includes(input) || code.includes(input) || category.includes(input)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

        function confirmDeletion(event, form) {
            event.preventDefault();
            const isDark = document.documentElement.classList.contains('dark');
            Swal.fire({
                title: 'Hapus Aset Barang?',
                text: 'Data inventaris dan kode unik barang ini akan dihapus permanen dari sistem.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: isDark ? '#334155' : '#94a3b8',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                background: isDark ? '#111022' : '#ffffff',
                color: isDark ? '#f8fafc' : '#0f172a'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
</x-app-layout>
