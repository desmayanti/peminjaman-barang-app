<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    @if(request()->isSecure())
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulir Peminjaman Barang - PinjamBarang</title>

    <!-- Smart Theme Override & Anti-FOUC Engine -->
    <x-smart-theme-override />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FAF8FF] dark:bg-slate-950 text-slate-800 dark:text-slate-100 antialiased font-sans min-h-screen flex flex-col transition-colors duration-300">

    <!-- Header Navigation -->
    <header class="sticky top-0 z-50 bg-white/95 dark:bg-slate-950/95 border-b border-purple-100 dark:border-slate-800/80 transition-colors duration-300 shadow-sm shadow-purple-100/50 dark:shadow-none">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-purple-600 to-indigo-500 flex items-center justify-center text-white shadow-md group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <span class="text-lg font-extrabold tracking-tight text-slate-900 dark:text-white font-display">Pinjam<span class="text-purple-600 dark:text-purple-400">Barang</span></span>
                </a>
                
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <x-theme-toggle size="sm" />

                    <a href="{{ route('home') }}" class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 hover:text-purple-700 dark:hover:text-white transition flex items-center gap-1">
                        <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Kembali ke Katalog</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            
            <!-- Breadcrumb & Header Title -->
            <div class="mb-8 text-center sm:text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-100 dark:bg-indigo-950/60 border border-purple-200 dark:border-indigo-800/80 text-xs font-semibold text-purple-700 dark:text-indigo-300 mb-3 shadow-sm">
                    <span>Pengajuan Terbuka</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white font-display">Formulir Pengajuan Peminjaman Barang</h1>
                <p class="text-slate-600 dark:text-slate-400 text-sm mt-1">Lengkapi data diri dan rincian peminjaman di bawah ini. Data Anda akan langsung diteruskan ke Admin untuk diverifikasi.</p>
            </div>

            <!-- Error Alerts -->
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-200 text-sm shadow-sm">
                    <div class="font-bold flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-rose-500 dark:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>Mohon periksa kembali formulir Anda:</span>
                    </div>
                    <ul class="list-disc list-inside space-y-1 text-xs">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Card -->
            <form action="{{ route('loans.store') }}" method="POST" class="bg-white dark:bg-slate-900/80 border border-purple-100 dark:border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl shadow-purple-100/70 dark:shadow-xl relative overflow-hidden backdrop-blur-sm transition-colors duration-300">
                @csrf

                <!-- Section 1: Informasi Peminjam -->
                <div class="mb-8">
                    <div class="flex items-center gap-2 pb-3 border-b border-purple-100 dark:border-slate-800 mb-6">
                        <div class="w-7 h-7 rounded-lg bg-purple-100 dark:bg-indigo-600/20 text-purple-700 dark:text-indigo-400 flex items-center justify-center font-bold text-xs border border-purple-200 dark:border-indigo-500/30">1</div>
                        <h2 class="text-base font-bold text-slate-900 dark:text-white">Identitas & Kontak Peminjam</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Nickname (Wajib sesuai request pengguna) -->
                        <div>
                            <label for="nickname" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                                Nickname / Nama Panggilan <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="nickname" name="nickname" value="{{ old('nickname') }}" required placeholder="Contoh: Budi, Siti, Alex" class="w-full bg-purple-50/40 dark:bg-slate-950 border border-purple-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-purple-500 transition shadow-sm">
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1">Nama panggilan akrab untuk memudahkan komunikasi petugas.</p>
                        </div>

                        <!-- Nama Lengkap -->
                        <div>
                            <label for="borrower_name" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                                Nama Lengkap Peminjam <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="borrower_name" name="borrower_name" value="{{ old('borrower_name') }}" required placeholder="Masukkan nama sesuai kartu identitas" class="w-full bg-purple-50/40 dark:bg-slate-950 border border-purple-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-purple-500 transition shadow-sm">
                        </div>

                        <!-- No. Telepon / WhatsApp -->
                        <div>
                            <label for="phone_number" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                                No. Telepon / WhatsApp <span class="text-rose-500">*</span>
                            </label>
                            <input type="tel" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required placeholder="Contoh: 081234567890" class="w-full bg-purple-50/40 dark:bg-slate-950 border border-purple-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-purple-500 transition shadow-sm">
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1">Admin akan menghubungi nomor ini saat konfirmasi pengambilan barang.</p>
                        </div>

                        <!-- Email Peminjam -->
                        <div>
                            <label for="email" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                                Alamat Email Aktif <span class="text-rose-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com" class="w-full bg-purple-50/40 dark:bg-slate-950 border border-purple-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-purple-500 transition shadow-sm">
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1">Tercatat pada sistem admin untuk bukti digital permohonan.</p>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Detail Barang & Jadwal -->
                <div class="mb-8">
                    <div class="flex items-center gap-2 pb-3 border-b border-purple-100 dark:border-slate-800 mb-6">
                        <div class="w-7 h-7 rounded-lg bg-purple-100 dark:bg-indigo-600/20 text-purple-700 dark:text-indigo-400 flex items-center justify-center font-bold text-xs border border-purple-200 dark:border-indigo-500/30">2</div>
                        <h2 class="text-base font-bold text-slate-900 dark:text-white">Detail Barang & Waktu Peminjaman</h2>
                    </div>

                    <!-- Jenis Pengajuan -->
                    <div class="mb-6">
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-3">
                            Jenis Pengajuan <span class="text-rose-500">*</span>
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="request_type" value="pinjam" class="peer sr-only" checked onchange="toggleRequestType()">
                                <div class="p-4 rounded-xl border-2 border-purple-200 dark:border-slate-700 bg-purple-50/40 dark:bg-slate-900 peer-checked:border-purple-500 peer-checked:bg-purple-100 dark:peer-checked:bg-indigo-600/10 group-hover:border-purple-300 dark:group-hover:border-slate-500 transition-all text-center">
                                    <span class="block text-sm font-bold text-slate-600 dark:text-slate-400 peer-checked:text-purple-700 dark:peer-checked:text-indigo-400">Pinjam Aset</span>
                                </div>
                            </label>
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="request_type" value="minta" class="peer sr-only" onchange="toggleRequestType()">
                                <div class="p-4 rounded-xl border-2 border-purple-200 dark:border-slate-700 bg-purple-50/40 dark:bg-slate-900 peer-checked:border-pink-500 peer-checked:bg-pink-100 dark:peer-checked:bg-emerald-600/10 group-hover:border-purple-300 dark:group-hover:border-slate-500 transition-all text-center">
                                    <span class="block text-sm font-bold text-slate-600 dark:text-slate-400 peer-checked:text-pink-700 dark:peer-checked:text-emerald-400">Minta Barang Habis Pakai</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-5">
                        <!-- Pilihan Barang -->
                        <div class="sm:col-span-2">
                            <label for="item_id" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                                Pilih Barang yang Ingin Dipinjam <span class="text-rose-500">*</span>
                            </label>
                            <select id="item_id" name="item_id" required class="w-full bg-purple-50/40 dark:bg-slate-950 border border-purple-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-purple-500 transition shadow-sm">
                                <option value="">-- Pilih Barang dari Katalog --</option>
                            </select>
                        </div>

                        <!-- Jumlah / Qty -->
                        <div>
                            <label for="quantity" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                                Jumlah Unit <span class="text-rose-500">*</span>
                            </label>
                            <input type="number" id="quantity" name="quantity" min="1" max="10" value="{{ old('quantity', 1) }}" required class="w-full bg-purple-50/40 dark:bg-slate-950 border border-purple-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-purple-500 transition shadow-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                        <!-- Tanggal Peminjaman -->
                        <div class="space-y-2">
                            <label for="borrow_date" class="flex items-center justify-between text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                <span>Tanggal Mulai Pinjam <span class="text-rose-500">*</span></span>
                                <span class="text-[11px] text-purple-600 dark:text-indigo-400 font-normal lowercase">(klik kotak untuk buka kalender)</span>
                            </label>
                            <div class="relative">
                                <input type="date" id="borrow_date" name="borrow_date" 
                                    value="{{ old('borrow_date', date('Y-m-d')) }}" 
                                    onclick="try{this.showPicker()}catch(e){}"
                                    onchange="updateReturnDateMin()"
                                    required 
                                    class="w-full bg-purple-50/40 dark:bg-slate-950 border border-purple-200 dark:border-slate-700 hover:border-purple-400 dark:hover:border-indigo-500 rounded-xl px-4 py-3.5 text-sm text-slate-800 dark:text-white cursor-pointer focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-purple-500 transition shadow-sm">
                            </div>
                            <!-- Quick Buttons for Borrow Date -->
                            <div class="flex flex-wrap items-center gap-1.5 pt-1">
                                <span class="text-[11px] text-slate-500 dark:text-slate-400">Pilih cepat:</span>
                                <button type="button" onclick="setBorrowDate(0)" class="text-[11px] px-2.5 py-1 rounded-lg bg-purple-100 hover:bg-purple-200 dark:bg-slate-800 dark:hover:bg-indigo-600 text-purple-700 hover:text-purple-900 dark:text-slate-200 dark:hover:text-white transition font-medium">Hari ini</button>
                                <button type="button" onclick="setBorrowDate(1)" class="text-[11px] px-2.5 py-1 rounded-lg bg-purple-100 hover:bg-purple-200 dark:bg-slate-800 dark:hover:bg-indigo-600 text-purple-700 hover:text-purple-900 dark:text-slate-200 dark:hover:text-white transition font-medium">Besok</button>
                                <button type="button" onclick="setBorrowDate(2)" class="text-[11px] px-2.5 py-1 rounded-lg bg-purple-100 hover:bg-purple-200 dark:bg-slate-800 dark:hover:bg-indigo-600 text-purple-700 hover:text-purple-900 dark:text-slate-200 dark:hover:text-white transition font-medium">Lusa</button>
                            </div>
                        </div>

                        <!-- Tanggal Pengembalian -->
                        <div id="return_date_container" class="space-y-2">
                            <label for="return_date" class="flex items-center justify-between text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                <span>Tanggal Pengembalian Barang <span class="text-rose-500">*</span></span>
                                <span id="durationBadge" class="text-[11px] text-emerald-600 dark:text-emerald-400 font-semibold lowercase">3 hari pinjam</span>
                            </label>
                            <div class="relative">
                                <input type="date" id="return_date" name="return_date" 
                                    value="{{ old('return_date', date('Y-m-d', strtotime('+3 days'))) }}" 
                                    onclick="try{this.showPicker()}catch(e){}"
                                    onchange="calcDuration()"
                                    required 
                                    class="w-full bg-purple-50/40 dark:bg-slate-950 border border-purple-200 dark:border-slate-700 hover:border-purple-400 dark:hover:border-indigo-500 rounded-xl px-4 py-3.5 text-sm text-slate-800 dark:text-white cursor-pointer focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-purple-500 transition shadow-sm">
                            </div>
                            <!-- Quick Buttons for Return Date -->
                            <div class="flex flex-wrap items-center gap-1.5 pt-1">
                                <span class="text-[11px] text-slate-500 dark:text-slate-400">Durasi:</span>
                                <button type="button" onclick="setDurationDays(1)" class="text-[11px] px-2.5 py-1 rounded-lg bg-purple-100 hover:bg-purple-200 dark:bg-slate-800 dark:hover:bg-indigo-600 text-purple-700 hover:text-purple-900 dark:text-slate-200 dark:hover:text-white transition font-medium">1 Hari</button>
                                <button type="button" onclick="setDurationDays(3)" class="text-[11px] px-2.5 py-1 rounded-lg bg-purple-100 hover:bg-purple-200 dark:bg-slate-800 dark:hover:bg-indigo-600 text-purple-700 hover:text-purple-900 dark:text-slate-200 dark:hover:text-white transition font-medium">3 Hari</button>
                                <button type="button" onclick="setDurationDays(7)" class="text-[11px] px-2.5 py-1 rounded-lg bg-purple-100 hover:bg-purple-200 dark:bg-slate-800 dark:hover:bg-indigo-600 text-purple-700 hover:text-purple-900 dark:text-slate-200 dark:hover:text-white transition font-medium">1 Minggu</button>
                                <button type="button" onclick="setDurationDays(14)" class="text-[11px] px-2.5 py-1 rounded-lg bg-purple-100 hover:bg-purple-200 dark:bg-slate-800 dark:hover:bg-indigo-600 text-purple-700 hover:text-purple-900 dark:text-slate-200 dark:hover:text-white transition font-medium">2 Minggu</button>
                            </div>
                        </div>
                    </div>

                    <!-- Keperluan Peminjaman -->
                    <div>
                        <label id="purposeLabel" for="purpose" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                            Alasan / Keperluan Peminjaman <span class="text-rose-500">*</span>
                        </label>
                        <textarea id="purpose" name="purpose" rows="3" required placeholder="Jelaskan secara ringkas kegiatan atau keperluan penggunaan barang ini..." class="w-full bg-purple-50/40 dark:bg-slate-950 border border-purple-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-purple-500 transition shadow-sm">{{ old('purpose') }}</textarea>
                    </div>
                </div>

                <!-- Terms & Notice -->
                <div id="termsDiv" class="p-4 rounded-2xl bg-purple-50 dark:bg-indigo-950/30 border border-purple-200 dark:border-indigo-900/50 text-xs text-purple-800 dark:text-indigo-300 flex items-start gap-3 mb-6">
                    <svg class="w-5 h-5 text-purple-600 dark:text-indigo-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <span class="font-bold text-slate-900 dark:text-white">Ketentuan Peminjam:</span> Peminjam bertanggung jawab penuh atas keutuhan, kebersihan, dan keselamatan peralatan hingga barang diserahkan kembali kepada Admin.
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-4 border-t border-purple-100 dark:border-slate-800">
                    <a href="{{ route('home') }}" class="w-full sm:w-auto px-6 py-3.5 rounded-xl border border-purple-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:text-purple-700 dark:hover:text-white hover:bg-purple-50 dark:hover:bg-transparent text-center text-sm font-semibold transition">
                        Batal
                    </a>
                    <button type="submit" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-purple-600 hover:bg-purple-700 text-white text-sm font-bold shadow-lg shadow-purple-600/30 hover:scale-[1.01] active:scale-[0.99] transition flex items-center justify-center gap-2">
                        <span id="submitBtnText">Kirim Permohonan ke Admin</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function formatDateISO(date) {
            const y = date.getFullYear();
            const m = String(date.getMonth() + 1).padStart(2, '0');
            const d = String(date.getDate()).padStart(2, '0');
            return `${y}-${m}-${d}`;
        }

        function setBorrowDate(offsetDays) {
            const bDate = new Date();
            bDate.setDate(bDate.getDate() + offsetDays);
            document.getElementById('borrow_date').value = formatDateISO(bDate);
            updateReturnDateMin();
            calcDuration();
        }

        function setDurationDays(days) {
            const bInput = document.getElementById('borrow_date');
            const baseDate = bInput.value ? new Date(bInput.value) : new Date();
            const rDate = new Date(baseDate);
            rDate.setDate(rDate.getDate() + days);
            document.getElementById('return_date').value = formatDateISO(rDate);
            calcDuration();
        }

        function updateReturnDateMin() {
            const bVal = document.getElementById('borrow_date').value;
            if (bVal) {
                document.getElementById('return_date').min = bVal;
            }
            calcDuration();
        }

        function calcDuration() {
            const bVal = document.getElementById('borrow_date').value;
            const rVal = document.getElementById('return_date').value;
            const badge = document.getElementById('durationBadge');
            if (bVal && rVal) {
                const b = new Date(bVal);
                const r = new Date(rVal);
                const diffTime = r - b;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                if (diffDays >= 0) {
                    badge.innerText = `${diffDays === 0 ? 1 : diffDays} hari peminjaman`;
                    badge.className = 'text-[11px] text-emerald-600 dark:text-emerald-400 font-semibold lowercase';
                } else {
                    badge.innerText = 'tanggal kembali mendahului pinjam!';
                    badge.className = 'text-[11px] text-rose-600 dark:text-rose-400 font-semibold lowercase';
                }
            }
        }

        const allItems = @json($items);
        const selectedItemId = "{{ old('item_id', $selectedItem->id ?? '') }}";

        function toggleRequestType() {
            const isMinta = document.querySelector('input[name="request_type"]:checked').value === 'minta';
            const select = document.getElementById('item_id');
            const currentVal = select.value || selectedItemId;
            
            // Kosongkan dropdown
            select.innerHTML = '<option value="">-- Pilih Barang dari Katalog --</option>';
            
            // Isi HANYA dengan barang sesuai tipe pengajuan
            allItems.forEach(item => {
                const isConsumable = item.is_consumable ? true : false;
                if (isMinta === isConsumable) {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.setAttribute('data-stock', item.available_stock);
                    option.setAttribute('data-consumable', item.is_consumable ? '1' : '0');
                    option.setAttribute('data-maxqty', item.max_request_qty || '');
                    option.textContent = `[${item.category}] ${item.name} (Sisa Stok: ${item.available_stock} unit)`;
                    
                    if (currentVal == item.id) {
                        option.selected = true;
                    }
                    select.appendChild(option);
                }
            });
            
            // Atur kotak tanggal pengembalian
            const returnDateContainer = document.getElementById('return_date_container');
            const returnDateInput = document.getElementById('return_date');
            if (isMinta) {
                returnDateContainer.style.display = 'none';
                returnDateInput.removeAttribute('required');
            } else {
                returnDateContainer.style.display = 'block';
                returnDateInput.setAttribute('required', 'required');
            }

            if (typeof updateFormType === 'function') {
                updateFormType();
            }
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', () => {
            calcDuration();

            const itemSelect = document.getElementById('item_id');
            const submitBtnText = document.getElementById('submitBtnText');
            const purposeLabel = document.getElementById('purposeLabel');
            const termsDiv = document.getElementById('termsDiv');
            const qtyInput = document.getElementById('quantity');

            window.updateFormType = function() {
                if(itemSelect.selectedIndex <= 0) {
                    const isMinta = document.querySelector('input[name="request_type"]:checked').value === 'minta';
                    submitBtnText.innerText = isMinta ? 'Minta Barang' : 'Kirim Permohonan ke Admin';
                    purposeLabel.innerHTML = isMinta ? 'Tujuan / Alasan Permintaan <span class="text-rose-500">*</span>' : 'Alasan / Keperluan Peminjaman <span class="text-rose-500">*</span>';
                    termsDiv.style.display = isMinta ? 'none' : 'flex';
                    return;
                }
                const option = itemSelect.options[itemSelect.selectedIndex];
                const isConsumable = option.getAttribute('data-consumable') === '1';
                const maxQty = option.getAttribute('data-maxqty');
                const availableStock = parseInt(option.getAttribute('data-stock'), 10) || 10;

                let currentMax = availableStock;

                if(isConsumable) {
                    submitBtnText.innerText = 'Minta Barang';
                    purposeLabel.innerHTML = 'Tujuan / Alasan Permintaan <span class="text-rose-500">*</span>';
                    termsDiv.style.display = 'none';
                    if (maxQty) {
                        currentMax = Math.min(availableStock, parseInt(maxQty, 10));
                    }
                } else {
                    submitBtnText.innerText = 'Kirim Permohonan ke Admin';
                    purposeLabel.innerHTML = 'Alasan / Keperluan Peminjaman <span class="text-rose-500">*</span>';
                    termsDiv.style.display = 'flex';
                }

                qtyInput.max = currentMax;
                if (parseInt(qtyInput.value, 10) > currentMax) {
                    qtyInput.value = currentMax;
                }
            };

            itemSelect.addEventListener('change', updateFormType);
            toggleRequestType();
        });
    </script>
</body>
</html>