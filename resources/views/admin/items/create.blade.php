<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.items.index') }}" class="p-2 rounded-xl bg-white/[0.05] hover:bg-white/[0.1] border border-white/10 text-slate-300 hover:text-white transition-all shadow-sm" title="Kembali ke Manajemen Aset">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-purple-400 mb-0.5">
                        <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                        <span>/</span>
                        <a href="{{ route('admin.items.index') }}" class="hover:underline">Katalog Aset</a>
                        <span>/</span>
                        <span class="text-slate-400">Tambah Baru</span>
                    </div>
                    <h2 class="font-extrabold text-xl sm:text-2xl text-white font-display flex items-center gap-2">
                        Tambah Aset &amp; Barang Baru
                    </h2>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('admin.items.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-semibold text-slate-300 hover:text-white bg-white/[0.04] hover:bg-white/[0.08] border border-white/10 transition">
                    <span>Batal &amp; Kembali</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-sm flex items-center gap-3 shadow-lg shadow-emerald-500/5">
                    <div class="w-8 h-8 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (isset($errors) && $errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-sm flex items-start gap-3 shadow-lg shadow-rose-500/5">
                    <div class="w-8 h-8 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="font-bold mb-1">Terdapat beberapa kesalahan input:</div>
                        <ul class="list-disc pl-4 space-y-0.5 text-xs text-rose-300/90">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.items.store') }}" method="POST" id="itemForm">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- LEFT COLUMN: Main Form Inputs (8 cols) -->
                    <div class="lg:col-span-8 space-y-6">

                        <!-- CARD 1: Informasi Pokok Barang -->
                        <div class="p-6 sm:p-7 rounded-3xl bg-[#0e0e1a]/80 backdrop-blur-xl border border-white/[0.08] shadow-2xl relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-48 h-48 bg-purple-500/5 blur-[50px] rounded-full pointer-events-none"></div>

                            <div class="flex items-center gap-3 pb-5 border-b border-white/[0.08] mb-6">
                                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-purple-600 to-indigo-600 text-white flex items-center justify-center shadow-md shadow-purple-600/30">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-base font-bold text-white font-display">Informasi Dasar Barang</h3>
                                    <p class="text-xs text-slate-400">Identitas utama inventaris yang akan tampil pada katalog pengguna.</p>
                                </div>
                            </div>

                            <div class="space-y-5">
                                <!-- Nama Barang -->
                                <div>
                                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                        Nama Barang <span class="text-rose-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="name" id="name" required 
                                            class="w-full bg-[#131224] text-white border border-white/10 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all placeholder-slate-500 shadow-inner" 
                                            placeholder="Contoh: Kamera DSLR Canon EOS 80D + Lensa" 
                                            value="{{ old('name') }}"
                                            oninput="updatePreview()">
                                    </div>
                                    @error('name') <span class="text-rose-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Kode Barang & Kategori -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <!-- Kode Barang -->
                                    <div>
                                        <div class="flex items-center justify-between mb-2">
                                            <label for="code" class="block text-xs font-bold uppercase tracking-wider text-slate-300">
                                                Kode Unik Barang <span class="text-rose-500">*</span>
                                            </label>
                                            <button type="button" onclick="generateCode()" class="text-[11px] font-semibold text-purple-400 hover:text-purple-300 transition-colors flex items-center gap-1">
                                                <span>⚡ Buat Acak</span>
                                            </button>
                                        </div>
                                        <div class="relative">
                                            <input type="text" name="code" id="code" required 
                                                class="w-full bg-[#131224] text-white font-mono border border-white/10 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all placeholder-slate-500 shadow-inner uppercase tracking-wider" 
                                                placeholder="Contoh: CMR-001" 
                                                value="{{ old('code') }}"
                                                oninput="updatePreview()">
                                        </div>
                                        @error('code') <span class="text-rose-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Kategori -->
                                    <div>
                                        <label for="category" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                            Kategori Barang <span class="text-rose-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="text" name="category" id="category" required 
                                                class="w-full bg-[#131224] text-white border border-white/10 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all placeholder-slate-500 shadow-inner" 
                                                placeholder="Misal: Multimedia" 
                                                value="{{ old('category') }}"
                                                oninput="updatePreview()">
                                        </div>
                                        <!-- Quick Tag Chips -->
                                        <div class="flex items-center gap-1.5 mt-2 flex-wrap">
                                            <span class="text-[10px] text-slate-500">Pilih cepat:</span>
                                            @foreach(['Multimedia', 'Elektronik', 'Audio', 'Presentasi', 'Aksesoris', 'Logistik', 'ATK'] as $chip)
                                                <button type="button" onclick="setCategory('{{ $chip }}')" class="text-[10px] font-semibold px-2 py-0.5 rounded-lg bg-white/[0.04] hover:bg-purple-600/20 text-slate-400 hover:text-purple-300 border border-white/5 hover:border-purple-500/30 transition-all">
                                                    {{ $chip }}
                                                </button>
                                            @endforeach
                                        </div>
                                        @error('category') <span class="text-rose-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Total Stok -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label for="total_stock" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                            Total Unit Stok Awal <span class="text-rose-500">*</span>
                                        </label>
                                        <div class="relative flex items-center">
                                            <input type="number" name="total_stock" id="total_stock" min="1" required 
                                                class="w-full bg-[#131224] text-white border border-white/10 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all placeholder-slate-500 shadow-inner font-mono font-bold" 
                                                placeholder="1" 
                                                value="{{ old('total_stock', 1) }}"
                                                oninput="updatePreview()">
                                            <span class="absolute right-4 text-xs font-semibold text-slate-500 uppercase pointer-events-none">Unit</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-1">Stok yang tersedia otomatis sama dengan stok awal.</p>
                                        @error('total_stock') <span class="text-rose-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Ikon Visual -->
                                    <div>
                                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                            Ikon Representasi
                                        </label>
                                        <input type="hidden" name="icon" id="iconInput" value="{{ old('icon', 'box') }}">
                                        <div class="grid grid-cols-4 gap-2" id="iconGrid">
                                            @php
                                                $icons = [
                                                    ['key' => 'camera', 'label' => 'Kamera', 'emoji' => '📷'],
                                                    ['key' => 'laptop', 'label' => 'Laptop', 'emoji' => '💻'],
                                                    ['key' => 'projector', 'label' => 'Proyektor', 'emoji' => '📽️'],
                                                    ['key' => 'microphone', 'label' => 'Mic', 'emoji' => '🎙️'],
                                                    ['key' => 'drone', 'label' => 'Drone', 'emoji' => '🛸'],
                                                    ['key' => 'speaker', 'label' => 'Speaker', 'emoji' => '🔊'],
                                                    ['key' => 'tripod', 'label' => 'Tripod', 'emoji' => '📐'],
                                                    ['key' => 'box', 'label' => 'Box/Lain', 'emoji' => '📦'],
                                                ];
                                            @endphp
                                            @foreach($icons as $ic)
                                                <button type="button" onclick="selectIcon('{{ $ic['key'] }}', '{{ $ic['emoji'] }}')" data-icon-key="{{ $ic['key'] }}" class="icon-btn p-2 rounded-xl text-center border text-xs flex flex-col items-center justify-center gap-1 transition-all {{ (old('icon', 'box') == $ic['key']) ? 'bg-purple-600/30 border-purple-500 text-white shadow-sm' : 'bg-white/[0.03] border-white/5 text-slate-400 hover:text-white hover:bg-white/[0.06]' }}">
                                                    <span class="text-base">{{ $ic['emoji'] }}</span>
                                                    <span class="text-[9px] font-medium leading-none">{{ $ic['label'] }}</span>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Deskripsi -->
                                <div>
                                    <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                        Deskripsi &amp; Spesifikasi Lengkap
                                    </label>
                                    <textarea name="description" id="description" rows="3" 
                                        class="w-full bg-[#131224] text-white border border-white/10 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all placeholder-slate-500 shadow-inner" 
                                        placeholder="Tuliskan spesifikasi detail, kelengkapan aksesoris, atau catatan penggunaan barang ini..."
                                        oninput="updatePreview()">{{ old('description') }}</textarea>
                                    @error('description') <span class="text-rose-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- CARD 2: Tipe Konfigurasi Barang -->
                        <div class="p-6 sm:p-7 rounded-3xl bg-[#0e0e1a]/80 backdrop-blur-xl border border-white/[0.08] shadow-2xl relative overflow-hidden">
                            <div class="flex items-center gap-3 pb-5 border-b border-white/[0.08] mb-6">
                                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-indigo-600 to-blue-600 text-white flex items-center justify-center shadow-md shadow-indigo-600/30">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-base font-bold text-white font-display">Tipe Peminjaman &amp; Logistik</h3>
                                    <p class="text-xs text-slate-400">Tentukan apakah barang ini wajib dikembalikan atau bersifat konsumtif / habis pakai.</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Option 1: Barang Pinjam Standar -->
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="is_consumable" value="0" class="peer sr-only" {{ old('is_consumable', '0') == '0' ? 'checked' : '' }} onchange="handleTypeChange(0)">
                                    <div class="p-5 rounded-2xl bg-[#131224] border-2 border-white/10 peer-checked:border-purple-500 peer-checked:bg-purple-600/10 hover:border-white/20 transition-all flex flex-col justify-between h-full group-hover:scale-[1.01]">
                                        <div class="flex items-start gap-3.5 mb-3">
                                            <div class="w-10 h-10 rounded-xl bg-purple-500/20 text-purple-400 flex items-center justify-center shrink-0">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="flex items-center gap-2">
                                                    <h4 class="font-bold text-sm text-white font-display">Barang Pinjam (Wajib Kembali)</h4>
                                                </div>
                                                <p class="text-xs text-slate-400 mt-1 leading-relaxed">Aset inventaris bernilai. Peminjam wajib menentukan tanggal pengembalian dan mengembalikan unit.</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between pt-3 border-t border-white/5 text-[11px] text-purple-300 font-semibold">
                                            <span>Format: Pinjam &bull; Lacak &bull; Dikembalikan</span>
                                            <span class="w-2.5 h-2.5 rounded-full border-2 border-purple-500 peer-checked:bg-purple-500"></span>
                                        </div>
                                    </div>
                                </label>

                                <!-- Option 2: Barang Habis Pakai -->
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="is_consumable" value="1" class="peer sr-only" {{ old('is_consumable') == '1' ? 'checked' : '' }} onchange="handleTypeChange(1)">
                                    <div class="p-5 rounded-2xl bg-[#131224] border-2 border-white/10 peer-checked:border-emerald-500 peer-checked:bg-emerald-600/10 hover:border-white/20 transition-all flex flex-col justify-between h-full group-hover:scale-[1.01]">
                                        <div class="flex items-start gap-3.5 mb-3">
                                            <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="flex items-center gap-2">
                                                    <h4 class="font-bold text-sm text-white font-display">Barang Diminta (Habis Pakai)</h4>
                                                </div>
                                                <p class="text-xs text-slate-400 mt-1 leading-relaxed">Barang logistik atau konsumsi (misal: spidol, lakban, baterai). Tidak perlu dikembalikan dan mengurangi stok permanen.</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between pt-3 border-t border-white/5 text-[11px] text-emerald-300 font-semibold">
                                            <span>Format: Permintaan Bebas Pengembalian</span>
                                            <span class="w-2.5 h-2.5 rounded-full border-2 border-emerald-500 peer-checked:bg-emerald-500"></span>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- Limit Field Container (Dynamic) -->
                            <div id="limit_field_container" class="{{ old('is_consumable') == '1' ? 'block' : 'hidden' }} mt-5 p-4 rounded-2xl bg-[#131224] border border-emerald-500/30 transition-all">
                                <label for="max_request_qty" class="block text-xs font-bold uppercase tracking-wider text-emerald-400 mb-1 flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Batas Maksimal Permintaan per Orang
                                </label>
                                <p class="text-xs text-slate-400 mb-2.5">Cegah monopoli stok dengan membatasi jumlah unit yang dapat diminta dalam satu formulir.</p>
                                <div class="max-w-xs relative flex items-center">
                                    <input type="number" name="max_request_qty" id="max_request_qty" min="1" 
                                        class="w-full bg-[#0a0a14] text-white border border-white/10 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 placeholder-slate-500 font-mono" 
                                        placeholder="Misal: 2 (Kosong = Bebas)" 
                                        value="{{ old('max_request_qty') }}">
                                    <span class="absolute right-3.5 text-xs text-slate-500">Unit / User</span>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button Section -->
                        <div class="pt-2 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <a href="{{ route('admin.items.index') }}" class="w-full sm:w-auto px-6 py-3.5 rounded-2xl bg-white/[0.04] hover:bg-white/[0.08] text-slate-300 hover:text-white font-semibold text-xs transition border border-white/10 text-center">
                                Batal &amp; Kembali
                            </a>

                            <button type="submit" class="w-full sm:w-auto px-8 py-3.5 rounded-2xl bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white font-bold text-sm shadow-[0_0_25px_rgba(147,51,234,0.4)] hover:shadow-[0_0_35px_rgba(147,51,234,0.6)] transform hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                <span>Simpan &amp; Terbitkan Barang</span>
                            </button>
                        </div>

                    </div>

                    <!-- RIGHT COLUMN: Real-Time Live Preview & Guidelines (4 cols) -->
                    <div class="lg:col-span-4 space-y-6 sticky top-24">

                        <!-- LIVE PREVIEW CARD -->
                        <div class="p-6 rounded-3xl bg-[#0e0e1a]/90 backdrop-blur-xl border border-white/[0.1] shadow-2xl relative overflow-hidden">
                            <div class="flex items-center justify-between mb-4 pb-3 border-b border-white/[0.08]">
                                <span class="text-[11px] font-extrabold uppercase tracking-wider text-purple-400 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-purple-400 animate-pulse"></span>
                                    Live Preview Publik
                                </span>
                                <span class="text-[10px] text-slate-500">Tampilan di Katalog</span>
                            </div>

                            <!-- Mock Card Preview -->
                            <div class="rounded-2xl bg-[#141328] border border-white/10 p-5 shadow-xl transition-all">
                                <!-- Card Header -->
                                <div class="flex items-start justify-between gap-3 mb-4">
                                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-purple-600/30 to-indigo-600/30 border border-purple-500/40 flex items-center justify-center text-2xl shadow-inner" id="prevIcon">
                                        📦
                                    </div>
                                    <div class="text-right">
                                        <span class="font-mono text-xs font-extrabold px-2 py-0.5 rounded-lg bg-white/[0.06] text-purple-300 border border-purple-500/30 uppercase" id="prevCode">
                                            PRJ-001
                                        </span>
                                        <div class="mt-1">
                                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-purple-500/20 text-purple-300" id="prevCategory">
                                                Multimedia
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Title & Desc -->
                                <h4 class="font-bold text-white text-base leading-snug line-clamp-2 mb-2 font-display" id="prevName">
                                    Nama Barang Baru
                                </h4>
                                <p class="text-xs text-slate-400 line-clamp-2 mb-4 leading-relaxed" id="prevDesc">
                                    Deskripsi dan rincian spesifikasi barang akan tampil di sini untuk peminjam.
                                </p>

                                <!-- Stock & Type Badges -->
                                <div class="pt-3 border-t border-white/5 flex items-center justify-between text-xs">
                                    <div class="flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                        <span class="text-slate-300 font-semibold text-[11px]">Stok: <strong class="text-white" id="prevStock">1 Unit</strong></span>
                                    </div>
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30" id="prevType">
                                        Pinjam
                                    </span>
                                </div>
                            </div>
                            <p class="text-[11px] text-slate-500 text-center mt-3">Kartu di atas menyesuaikan secara otomatis saat Anda mengetik data.</p>
                        </div>

                        <!-- PANDUAN PENGISIAN -->
                        <div class="p-6 rounded-3xl bg-[#0e0e1a]/60 backdrop-blur-xl border border-white/[0.06] text-xs text-slate-400 space-y-3">
                            <h4 class="font-bold text-white text-sm flex items-center gap-2">
                                <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Tips Manajemen Aset
                            </h4>
                            <ul class="space-y-2 leading-relaxed">
                                <li class="flex items-start gap-2">
                                    <span class="text-purple-400 font-bold">&bull;</span>
                                    <span><strong>Kode Barang Unik:</strong> Gunakan format 3 huruf + nomor, misal <code class="text-purple-300 font-mono">CMR-001</code> atau <code class="text-purple-300 font-mono">LPT-002</code>.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-purple-400 font-bold">&bull;</span>
                                    <span><strong>Barang Habis Pakai:</strong> Pilih opsi ini untuk barang yang tidak dikembalikan agar sistem tidak menagih pengembalian.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-purple-400 font-bold">&bull;</span>
                                    <span><strong>Foto / Gambar:</strong> Saat ini ikon visual digunakan untuk katalog modern yang cepat dan ringan diakses.</span>
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>
            </form>

        </div>
    </div>

    <!-- Interactive Script for Live Preview, Category Chip & Random Code Generator -->
    <script>
        const emojiMap = {
            'camera': '📷',
            'laptop': '💻',
            'projector': '📽️',
            'microphone': '🎙️',
            'drone': '🛸',
            'speaker': '🔊',
            'tripod': '📐',
            'box': '📦'
        };

        function setCategory(cat) {
            const catInput = document.getElementById('category');
            catInput.value = cat;
            updatePreview();
        }

        function selectIcon(key, emoji) {
            document.getElementById('iconInput').value = key;
            document.getElementById('prevIcon').innerText = emoji;

            document.querySelectorAll('.icon-btn').forEach(btn => {
                if (btn.getAttribute('data-icon-key') === key) {
                    btn.classList.add('bg-purple-600/30', 'border-purple-500', 'text-white');
                    btn.classList.remove('bg-white/[0.03]', 'border-white/5', 'text-slate-400');
                } else {
                    btn.classList.remove('bg-purple-600/30', 'border-purple-500', 'text-white');
                    btn.classList.add('bg-white/[0.03]', 'border-white/5', 'text-slate-400');
                }
            });
        }

        function generateCode() {
            const prefixes = ['AST', 'EQP', 'ITM', 'INV', 'LOG'];
            const prefix = prefixes[Math.floor(Math.random() * prefixes.length)];
            const num = Math.floor(100 + Math.random() * 900);
            const code = `${prefix}-${num}`;
            document.getElementById('code').value = code;
            updatePreview();
        }

        function handleTypeChange(val) {
            const limitContainer = document.getElementById('limit_field_container');
            const limitInput = document.getElementById('max_request_qty');
            const prevType = document.getElementById('prevType');

            if (val === 1) {
                limitContainer.classList.remove('hidden');
                prevType.innerText = 'Habis Pakai';
                prevType.className = 'px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30';
            } else {
                limitContainer.classList.add('hidden');
                if (limitInput) limitInput.value = '';
                prevType.innerText = 'Pinjam';
                prevType.className = 'px-2 py-0.5 rounded-md text-[10px] font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30';
            }
        }

        function updatePreview() {
            const name = document.getElementById('name').value.trim() || 'Nama Barang Baru';
            const code = document.getElementById('code').value.trim() || 'PRJ-001';
            const category = document.getElementById('category').value.trim() || 'Kategori';
            const stock = document.getElementById('total_stock').value.trim() || '1';
            const desc = document.getElementById('description').value.trim() || 'Deskripsi barang akan tampil di sini untuk peminjam.';
            const iconKey = document.getElementById('iconInput').value || 'box';

            document.getElementById('prevName').innerText = name;
            document.getElementById('prevCode').innerText = code;
            document.getElementById('prevCategory').innerText = category;
            document.getElementById('prevStock').innerText = `${stock} Unit`;
            document.getElementById('prevDesc').innerText = desc;
            document.getElementById('prevIcon').innerText = emojiMap[iconKey] || '📦';
        }

        document.addEventListener('DOMContentLoaded', function() {
            updatePreview();
        });
    </script>
</x-app-layout>
