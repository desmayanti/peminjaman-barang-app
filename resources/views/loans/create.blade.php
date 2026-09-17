<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulir Peminjaman Barang - PinjamBarang</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-slate-100 antialiased font-sans min-h-screen flex flex-col">

    <!-- Header Navigation -->
    <header class="sticky top-0 z-50 bg-slate-950/80 backdrop-blur-xl border-b border-slate-800/80">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 flex items-center justify-center text-white shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <span class="text-lg font-extrabold tracking-tight text-white">PinjamBarang</span>
                </a>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-xs sm:text-sm text-slate-400 hover:text-white transition flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-950/60 border border-indigo-800/80 text-xs font-semibold text-indigo-300 mb-3">
                    <span>Pengajuan Terbuka</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white">Formulir Pengajuan Peminjaman Barang</h1>
                <p class="text-slate-400 text-sm mt-1">Lengkapi data diri dan rincian peminjaman di bawah ini. Data Anda akan langsung diteruskan ke Admin untuk diverifikasi.</p>
            </div>

            <!-- Error Alerts -->
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-rose-950/60 border border-rose-800 text-rose-200 text-sm">
                    <div class="font-bold flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <form action="{{ route('loans.store') }}" method="POST" class="bg-slate-900/80 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl relative overflow-hidden backdrop-blur-sm">
                @csrf

                <!-- Section 1: Informasi Peminjam -->
                <div class="mb-8">
                    <div class="flex items-center gap-2 pb-3 border-b border-slate-800 mb-6">
                        <div class="w-7 h-7 rounded-lg bg-indigo-600/20 text-indigo-400 flex items-center justify-center font-bold text-xs border border-indigo-500/30">1</div>
                        <h2 class="text-base font-bold text-white">Identitas & Kontak Peminjam</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Nickname (Wajib sesuai request pengguna) -->
                        <div>
                            <label for="nickname" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                                Nickname / Nama Panggilan <span class="text-rose-400">*</span>
                            </label>
                            <input type="text" id="nickname" name="nickname" value="{{ old('nickname') }}" required placeholder="Contoh: Budi, Siti, Alex" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                            <p class="text-[11px] text-slate-400 mt-1">Nama panggilan akrab untuk memudahkan komunikasi petugas.</p>
                        </div>

                        <!-- Nama Lengkap -->
                        <div>
                            <label for="borrower_name" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                                Nama Lengkap Peminjam <span class="text-rose-400">*</span>
                            </label>
                            <input type="text" id="borrower_name" name="borrower_name" value="{{ old('borrower_name') }}" required placeholder="Masukkan nama sesuai kartu identitas" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        </div>

                        <!-- No. Telepon / WhatsApp -->
                        <div>
                            <label for="phone_number" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                                No. Telepon / WhatsApp <span class="text-rose-400">*</span>
                            </label>
                            <input type="tel" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required placeholder="Contoh: 081234567890" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                            <p class="text-[11px] text-slate-400 mt-1">Admin akan menghubungi nomor ini saat konfirmasi pengambilan barang.</p>
                        </div>

                        <!-- Email Peminjam (Langsung masuk ke admin) -->
                        <div>
                            <label for="email" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                                Alamat Email Aktif <span class="text-rose-400">*</span>
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                            <p class="text-[11px] text-slate-400 mt-1">Tercatat pada sistem admin untuk bukti digital permohonan.</p>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Detail Barang & Jadwal -->
                <div class="mb-8">
                    <div class="flex items-center gap-2 pb-3 border-b border-slate-800 mb-6">
                        <div class="w-7 h-7 rounded-lg bg-indigo-600/20 text-indigo-400 flex items-center justify-center font-bold text-xs border border-indigo-500/30">2</div>
                        <h2 class="text-base font-bold text-white">Detail Barang & Waktu Peminjaman</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-5">
                        <!-- Pilihan Barang -->
                        <div class="sm:col-span-2">
                            <label for="item_id" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                                Pilih Barang yang Ingin Dipinjam <span class="text-rose-400">*</span>
                            </label>
                            <select id="item_id" name="item_id" required class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                                <option value="">-- Pilih Barang dari Katalog --</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}" data-stock="{{ $item->available_stock }}" {{ (old('item_id', $selectedItem->id ?? '') == $item->id) ? 'selected' : '' }}>
                                        [{{ $item->category }}] {{ $item->name }} (Sisa Stok: {{ $item->available_stock }} unit)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Jumlah / Qty -->
                        <div>
                            <label for="quantity" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                                Jumlah Unit <span class="text-rose-400">*</span>
                            </label>
                            <input type="number" id="quantity" name="quantity" min="1" max="10" value="{{ old('quantity', 1) }}" required class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                        <!-- Tanggal Peminjaman -->
                        <div class="space-y-2">
                            <label for="borrow_date" class="flex items-center justify-between text-xs font-semibold text-slate-300 uppercase tracking-wider">
                                <span>Tanggal Mulai Pinjam <span class="text-rose-400">*</span></span>
                                <span class="text-[11px] text-indigo-400 font-normal lowercase">(klik kotak untuk buka kalender)</span>
                            </label>
                            <div class="relative">
                                <input type="date" id="borrow_date" name="borrow_date" 
                                    value="{{ old('borrow_date', date('Y-m-d')) }}" 
                                    onclick="try{this.showPicker()}catch(e){}"
                                    onchange="updateReturnDateMin()"
                                    required 
                                    style="color-scheme: dark;"
                                    class="w-full bg-slate-950 border border-slate-700 hover:border-indigo-500 rounded-xl px-4 py-3.5 text-sm text-white cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-inner">
                            </div>
                            <!-- Quick Buttons for Borrow Date -->
                            <div class="flex flex-wrap items-center gap-1.5 pt-1">
                                <span class="text-[11px] text-slate-400">Pilih cepat:</span>
                                <button type="button" onclick="setBorrowDate(0)" class="text-[11px] px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-indigo-600 text-slate-200 hover:text-white transition">Hari ini</button>
                                <button type="button" onclick="setBorrowDate(1)" class="text-[11px] px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-indigo-600 text-slate-200 hover:text-white transition">Besok</button>
                                <button type="button" onclick="setBorrowDate(2)" class="text-[11px] px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-indigo-600 text-slate-200 hover:text-white transition">Lusa</button>
                            </div>
                        </div>

                        <!-- Tanggal Pengembalian -->
                        <div class="space-y-2">
                            <label for="return_date" class="flex items-center justify-between text-xs font-semibold text-slate-300 uppercase tracking-wider">
                                <span>Tanggal Pengembalian Barang <span class="text-rose-400">*</span></span>
                                <span id="durationBadge" class="text-[11px] text-emerald-400 font-semibold lowercase">3 hari pinjam</span>
                            </label>
                            <div class="relative">
                                <input type="date" id="return_date" name="return_date" 
                                    value="{{ old('return_date', date('Y-m-d', strtotime('+3 days'))) }}" 
                                    onclick="try{this.showPicker()}catch(e){}"
                                    onchange="calcDuration()"
                                    required 
                                    style="color-scheme: dark;"
                                    class="w-full bg-slate-950 border border-slate-700 hover:border-indigo-500 rounded-xl px-4 py-3.5 text-sm text-white cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-inner">
                            </div>
                            <!-- Quick Buttons for Return Date -->
                            <div class="flex flex-wrap items-center gap-1.5 pt-1">
                                <span class="text-[11px] text-slate-400">Durasi:</span>
                                <button type="button" onclick="setDurationDays(1)" class="text-[11px] px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-indigo-600 text-slate-200 hover:text-white transition">1 Hari</button>
                                <button type="button" onclick="setDurationDays(3)" class="text-[11px] px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-indigo-600 text-slate-200 hover:text-white transition">3 Hari</button>
                                <button type="button" onclick="setDurationDays(7)" class="text-[11px] px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-indigo-600 text-slate-200 hover:text-white transition">1 Minggu</button>
                                <button type="button" onclick="setDurationDays(14)" class="text-[11px] px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-indigo-600 text-slate-200 hover:text-white transition">2 Minggu</button>
                            </div>
                        </div>
                    </div>

                    <!-- Keperluan Peminjaman -->
                    <div>
                        <label for="purpose" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                            Alasan / Keperluan Peminjaman <span class="text-rose-400">*</span>
                        </label>
                        <textarea id="purpose" name="purpose" rows="3" required placeholder="Jelaskan secara ringkas kegiatan atau keperluan penggunaan barang ini..." class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">{{ old('purpose') }}</textarea>
                    </div>
                </div>

                <!-- Terms & Notice -->
                <div class="p-4 rounded-2xl bg-indigo-950/30 border border-indigo-900/50 text-xs text-indigo-300 flex items-start gap-3 mb-6">
                    <svg class="w-5 h-5 text-indigo-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <span class="font-semibold text-white">Ketentuan Peminjam:</span> Peminjam bertanggung jawab penuh atas keutuhan, kebersihan, dan keselamatan peralatan hingga barang diserahkan kembali kepada Admin.
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-4 border-t border-slate-800">
                    <a href="{{ route('home') }}" class="w-full sm:w-auto px-6 py-3.5 rounded-xl border border-slate-700 text-slate-300 hover:text-white text-center text-sm font-semibold transition">
                        Batal
                    </a>
                    <button type="submit" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white text-sm font-bold shadow-lg shadow-indigo-600/30 hover:scale-[1.01] active:scale-[0.99] transition flex items-center justify-center gap-2">
                        <span>Kirim Permohonan ke Admin</span>
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
                    badge.className = 'text-[11px] text-emerald-400 font-semibold lowercase';
                } else {
                    badge.innerText = 'tanggal kembali mendahului pinjam!';
                    badge.className = 'text-[11px] text-rose-400 font-semibold lowercase';
                }
            }
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', () => {
            calcDuration();
        });
    </script>
</body>
</html>