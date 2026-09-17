<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lacak Status Peminjaman - PinjamBarang</title>
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
                        <span>Katalog</span>
                    </a>
                    <a href="{{ route('loans.create') }}" class="text-xs sm:text-sm font-semibold text-indigo-400 hover:text-indigo-300">
                        + Form Pinjam
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-950/60 border border-emerald-800/80 text-xs font-semibold text-emerald-300 mb-3">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Pelacakan Mandiri Real-time</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white">Cek Status Pengajuan Peminjaman</h1>
                <p class="text-slate-400 text-sm mt-1">Masukkan Kode Tiket (misal: PJ-10293), Nomor WhatsApp, atau Alamat Email Anda.</p>
            </div>

            <!-- Search Form -->
            <form action="{{ route('loans.track') }}" method="GET" class="mb-10">
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-grow">
                        <input type="text" name="query" value="{{ $query ?? '' }}" required placeholder="Contoh: PJ-10293 atau 081234567890" class="w-full bg-slate-900 border border-slate-700 rounded-2xl pl-12 pr-4 py-3.5 text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-inner">
                        <svg class="w-5 h-5 text-slate-400 absolute left-4 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <button type="submit" class="px-7 py-3.5 rounded-2xl bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold shadow-lg shadow-indigo-600/30 transition">
                        Cari Status
                    </button>
                </div>
            </form>

            <!-- Results Section -->
            @if(isset($loans))
                @if($loans->isEmpty())
                    <div class="text-center py-12 px-4 rounded-3xl bg-slate-900/50 border border-slate-800">
                        <svg class="w-12 h-12 text-slate-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-base font-bold text-white">Data Tidak Ditemukan</h3>
                        <p class="text-xs text-slate-400 mt-1">Pastikan kode tiket atau nomor kontak yang dimasukkan sudah benar.</p>
                    </div>
                @else
                    <div class="space-y-6">
                        @foreach($loans as $loan)
                            <div class="rounded-3xl bg-slate-900/80 border border-slate-800 p-6 sm:p-7 shadow-xl backdrop-blur-sm">
                                <!-- Card Top -->
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-5 border-b border-slate-800 gap-3">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs font-semibold text-slate-400 uppercase">Tiket Peminjaman</span>
                                            <span class="font-mono font-extrabold text-base text-indigo-400">#{{ $loan->loan_code }}</span>
                                        </div>
                                        <span class="text-xs text-slate-500">Diajukan pada {{ $loan->created_at->format('d M Y, H:i') }}</span>
                                    </div>

                                    <div>
                                        @if($loan->status == 'pending')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-950/80 border border-amber-800 text-amber-300 text-xs font-semibold">
                                                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                                                Menunggu Verifikasi Admin
                                            </span>
                                        @elseif($loan->status == 'approved')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-950/80 border border-emerald-800 text-emerald-300 text-xs font-semibold">
                                                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                                Disetujui (Siap Diambil)
                                            </span>
                                        @elseif($loan->status == 'rejected')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-950/80 border border-rose-800 text-rose-300 text-xs font-semibold">
                                                Permohonan Ditolak
                                            </span>
                                        @elseif($loan->status == 'returned')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-950/80 border border-blue-800 text-blue-300 text-xs font-semibold">
                                                Barang Telah Dikembalikan
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Progress Visual Indicator -->
                                <div class="py-6 border-b border-slate-800/80">
                                    <div class="grid grid-cols-4 gap-2 text-center text-[11px]">
                                        <div class="flex flex-col items-center">
                                            <div class="w-8 h-8 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold mb-1 shadow-md shadow-indigo-600/30">âœ“</div>
                                            <span class="font-semibold text-white">Diajukan</span>
                                        </div>
                                        <div class="flex flex-col items-center">
                                            <div class="w-8 h-8 rounded-full {{ in_array($loan->status, ['pending', 'approved', 'returned']) ? 'bg-indigo-600 text-white' : 'bg-slate-800 text-slate-500' }} flex items-center justify-center font-bold mb-1">
                                                {{ in_array($loan->status, ['approved', 'returned']) ? 'âœ“' : '2' }}
                                            </div>
                                            <span class="font-semibold {{ $loan->status == 'pending' ? 'text-amber-300' : 'text-slate-300' }}">Review Admin</span>
                                        </div>
                                        <div class="flex flex-col items-center">
                                            <div class="w-8 h-8 rounded-full {{ in_array($loan->status, ['approved', 'returned']) ? 'bg-emerald-600 text-white' : ($loan->status == 'rejected' ? 'bg-rose-600 text-white' : 'bg-slate-800 text-slate-500') }} flex items-center justify-center font-bold mb-1">
                                                {{ in_array($loan->status, ['approved', 'returned']) ? 'âœ“' : ($loan->status == 'rejected' ? 'âœ•' : '3') }}
                                            </div>
                                            <span class="font-semibold {{ $loan->status == 'approved' ? 'text-emerald-300' : ($loan->status == 'rejected' ? 'text-rose-400' : 'text-slate-400') }}">
                                                {{ $loan->status == 'rejected' ? 'Ditolak' : 'Disetujui' }}
                                            </span>
                                        </div>
                                        <div class="flex flex-col items-center">
                                            <div class="w-8 h-8 rounded-full {{ $loan->status == 'returned' ? 'bg-blue-600 text-white' : 'bg-slate-800 text-slate-500' }} flex items-center justify-center font-bold mb-1">
                                                {{ $loan->status == 'returned' ? 'âœ“' : '4' }}
                                            </div>
                                            <span class="font-semibold {{ $loan->status == 'returned' ? 'text-blue-300' : 'text-slate-400' }}">Kembali</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Detail List -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 text-xs">
                                    <div>
                                        <span class="text-slate-400 block mb-0.5">Nama Peminjam (Nickname)</span>
                                        <span class="font-semibold text-white">{{ $loan->borrower_name }} (<span class="text-indigo-300">{{ $loan->nickname }}</span>)</span>
                                    </div>
                                    <div>
                                        <span class="text-slate-400 block mb-0.5">Barang yang Dipinjam</span>
                                        <span class="font-semibold text-white">{{ $loan->item->name ?? 'Barang' }} &bull; {{ $loan->quantity }} Unit</span>
                                    </div>
                                    <div>
                                        <span class="text-slate-400 block mb-0.5">Jadwal Pengambilan & Pengembalian</span>
                                        <span class="text-slate-200">{{ \Carbon\Carbon::parse($loan->borrow_date)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}</span>
                                    </div>
                                    <div>
                                        <span class="text-slate-400 block mb-0.5">Catatan Admin</span>
                                        <span class="text-slate-300 italic">{{ $loan->admin_notes ?: 'Belum ada catatan dari admin.' }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif

        </div>
    </main>

</body>
</html>