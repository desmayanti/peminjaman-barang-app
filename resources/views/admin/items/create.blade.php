<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.loans.index') }}" class="text-gray-400 hover:text-gray-200 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-extrabold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
                {{ __('Manajemen Aset') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-sm flex items-center gap-3 shadow-sm">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-slate-800 rounded-xl border border-slate-700 shadow-lg overflow-hidden">
                <div class="p-8">
                    <!-- Header -->
                    <div class="mb-8 border-b border-slate-700 pb-6">
                        <h3 class="text-2xl font-bold text-white flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            Tambah Aset / Barang Baru
                        </h3>
                        <p class="text-slate-400 mt-2 text-sm">Silakan isi formulir di bawah ini dengan lengkap untuk menambahkan item baru ke dalam sistem katalog peminjaman.</p>
                    </div>

                    <form action="{{ route('admin.items.store') }}" method="POST">
                        @csrf

                        <div class="space-y-6">
                            
                            <!-- Nama Barang & Kode -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-slate-300 mb-1.5">Nama Barang <span class="text-rose-500">*</span></label>
                                    <input type="text" name="name" id="name" required class="w-full bg-slate-900 text-white border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow placeholder-slate-500" placeholder="Misal: Proyektor Epson" value="{{ old('name') }}">
                                    @error('name') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="code" class="block text-sm font-semibold text-slate-300 mb-1.5">Kode Barang <span class="text-rose-500">*</span></label>
                                    <input type="text" name="code" id="code" required class="w-full bg-slate-900 text-white border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow placeholder-slate-500 font-mono" placeholder="Misal: PRJ-001" value="{{ old('code') }}">
                                    @error('code') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Kategori & Stok -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="category" class="block text-sm font-semibold text-slate-300 mb-1.5">Kategori <span class="text-rose-500">*</span></label>
                                    <input type="text" name="category" id="category" required class="w-full bg-slate-900 text-white border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow placeholder-slate-500" placeholder="Misal: Elektronik" value="{{ old('category') }}">
                                    @error('category') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="total_stock" class="block text-sm font-semibold text-slate-300 mb-1.5">Total Stok Awal <span class="text-rose-500">*</span></label>
                                    <input type="number" name="total_stock" id="total_stock" min="0" required class="w-full bg-slate-900 text-white border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow placeholder-slate-500" placeholder="0" value="{{ old('total_stock') }}">
                                    @error('total_stock') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <label for="description" class="block text-sm font-semibold text-slate-300 mb-1.5">Deskripsi Lengkap</label>
                                <textarea name="description" id="description" rows="3" class="w-full bg-slate-900 text-white border border-slate-700 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow placeholder-slate-500" placeholder="Tuliskan spesifikasi atau keterangan mengenai barang ini...">{{ old('description') }}</textarea>
                                @error('description') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Tipe Barang (Cards) -->
                            <div class="pt-4 border-t border-slate-700">
                                <label class="block text-sm font-semibold text-slate-300 mb-3">Tipe Konfigurasi Barang <span class="text-rose-500">*</span></label>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Option 1: Barang Pinjam -->
                                    <label class="relative cursor-pointer group">
                                        <input type="radio" name="is_consumable" value="0" class="peer sr-only" {{ old('is_consumable', '0') == '0' ? 'checked' : '' }} onchange="toggleLimitField()">
                                        <div class="p-5 rounded-xl bg-slate-900 border-2 border-slate-700 peer-checked:border-blue-500 peer-checked:bg-blue-500/10 hover:border-slate-500 transition-all flex items-start gap-4 h-full">
                                            <div class="w-10 h-10 rounded-full bg-slate-800 peer-checked:bg-blue-600 flex items-center justify-center text-slate-400 peer-checked:text-white shrink-0 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-white mb-1">Barang Pinjam (Normal)</h4>
                                                <p class="text-xs text-slate-400 leading-relaxed">Barang inventaris yang harus dikembalikan. User akan diberikan form peminjaman standar dengan batas tanggal pengembalian.</p>
                                            </div>
                                            
                                            <!-- Check Icon active state -->
                                            <div class="absolute top-4 right-4 text-blue-500 opacity-0 peer-checked:opacity-100 transition-opacity">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </label>

                                    <!-- Option 2: Barang Habis Pakai -->
                                    <label class="relative cursor-pointer group">
                                        <input type="radio" name="is_consumable" value="1" class="peer sr-only" {{ old('is_consumable') == '1' ? 'checked' : '' }} onchange="toggleLimitField()">
                                        <div class="p-5 rounded-xl bg-slate-900 border-2 border-slate-700 peer-checked:border-blue-500 peer-checked:bg-blue-500/10 hover:border-slate-500 transition-all flex items-start gap-4 h-full">
                                            <div class="w-10 h-10 rounded-full bg-slate-800 peer-checked:bg-blue-600 flex items-center justify-center text-slate-400 peer-checked:text-white shrink-0 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-white mb-1">Barang Diminta (Habis Pakai)</h4>
                                                <p class="text-xs text-slate-400 leading-relaxed">Barang logistik atau konsumsi (misal: sabun, spidol). Tidak perlu dikembalikan dan mengurangi stok permanen setelah disetujui.</p>
                                            </div>
                                            
                                            <!-- Check Icon active state -->
                                            <div class="absolute top-4 right-4 text-blue-500 opacity-0 peer-checked:opacity-100 transition-opacity">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Max Request Qty (Hidden by default unless Consumable) -->
                            <div id="limit_field_container" class="hidden animate-[fadeIn_0.3s_ease-in-out] bg-slate-900/50 p-5 rounded-xl border border-slate-700/50 mt-4">
                                <label for="max_request_qty" class="block text-sm font-semibold text-blue-400 mb-1.5 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Batas Maksimal Permintaan per User
                                </label>
                                <p class="text-xs text-slate-400 mb-3">Tentukan jumlah maksimal item ini yang boleh diminta oleh satu orang dalam sekali permohonan. (Kosongkan jika tidak dibatasi).</p>
                                <input type="number" name="max_request_qty" id="max_request_qty" min="1" class="w-full md:w-1/3 bg-slate-900 text-white border border-slate-600 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow placeholder-slate-500" placeholder="Misal: 2" value="{{ old('max_request_qty') }}">
                                @error('max_request_qty') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                        </div>

                        <!-- Submit Button -->
                        <div class="mt-10">
                            <button type="submit" class="w-full py-3.5 px-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-blue-900/30 hover:shadow-blue-900/50 transform hover:-translate-y-0.5 transition-all duration-200 uppercase tracking-widest flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                Simpan Barang Baru
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <script>
        function toggleLimitField() {
            const isConsumable = document.querySelector('input[name="is_consumable"]:checked').value === '1';
            const limitContainer = document.getElementById('limit_field_container');
            const limitInput = document.getElementById('max_request_qty');
            
            if (isConsumable) {
                limitContainer.classList.remove('hidden');
                limitContainer.classList.add('block');
            } else {
                limitContainer.classList.add('hidden');
                limitContainer.classList.remove('block');
                limitInput.value = ''; // clear input when switching back
            }
        }

        // Jalankan saat halaman di-load
        document.addEventListener('DOMContentLoaded', function() {
            toggleLimitField();
        });
    </script>
</x-app-layout>
