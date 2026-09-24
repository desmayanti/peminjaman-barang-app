<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Status Peminjaman - PinjamBarang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #030305; color: white; font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col items-center justify-center relative overflow-hidden">
    <!-- Background Glow -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-purple-600/20 blur-[120px] rounded-full pointer-events-none -z-10"></div>

    <!-- Main Content -->
    <main class="pt-32 pb-24 px-6 lg:px-12 max-w-3xl mx-auto flex flex-col items-center min-h-screen z-10 relative">
        
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold font-display text-white mb-2">Status Peminjaman</h1>
            <p class="text-slate-400 text-sm">Lacak status permohonan menggunakan Kode Peminjaman atau No. WhatsApp.</p>
        </div>

        <!-- Kotak Pencarian (Search Bar) -->
        <div class="w-full max-w-xl mb-10">
            <form action="{{ route('lacak.status') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Contoh: PJ-12345 atau 0812..." required class="flex-1 px-5 py-3.5 rounded-xl bg-white/[0.03] border border-white/10 text-white focus:ring-1 focus:ring-purple-500 outline-none placeholder-slate-500">
                <button type="submit" class="px-8 py-3.5 rounded-xl font-bold text-white bg-purple-600 hover:bg-purple-500 transition-colors shadow-[0_0_15px_rgba(147,51,234,0.3)]">
                    Lacak
                </button>
            </form>
        </div>

        <!-- Hasil Pelacakan -->
        <div class="w-full">
            @if(request()->has('keyword') && $loan)
                <!-- JIKA DATA DITEMUKAN -->
                <div class="glass-card p-6 md:p-8 rounded-2xl border border-white/10 w-full relative overflow-hidden bg-white/[0.03] backdrop-blur-xl shadow-2xl">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-purple-500/10 blur-[40px] rounded-full pointer-events-none"></div>
                    
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 pb-6 border-b border-white/5 gap-4">
                        <div>
                            <p class="text-xs text-slate-400 uppercase tracking-wider mb-1">Kode Peminjaman</p>
                            <h2 class="text-2xl font-bold text-white">{{ $loan->loan_code }}</h2>
                        </div>
                        
                        <!-- Badge Status Dinamis -->
                        <div>
                            @if($loan->status == 'pending')
                                <span class="px-4 py-1.5 rounded-full text-xs font-bold bg-amber-500/20 text-amber-400 border border-amber-500/30 animate-pulse">⏳ Menunggu Review</span>
                            @elseif($loan->status == 'approved')
                                <span class="px-4 py-1.5 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">✅ Disetujui</span>
                            @elseif($loan->status == 'rejected')
                                <span class="px-4 py-1.5 rounded-full text-xs font-bold bg-rose-500/20 text-rose-400 border border-rose-500/30">❌ Ditolak</span>
                            @else
                                <span class="px-4 py-1.5 rounded-full text-xs font-bold bg-blue-500/20 text-blue-400 border border-blue-500/30">📦 Dikembalikan</span>
                            @endif
                        </div>
                    </div>

                    <!-- Detail Peminjam & Barang -->
                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <p class="text-[10px] text-slate-500 uppercase mb-1">Peminjam</p>
                            <p class="text-sm text-slate-200 font-medium">{{ $loan->borrower_name }} ({{ $loan->nickname }})</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-500 uppercase mb-1">Kontak</p>
                            <p class="text-sm text-slate-200 font-medium">{{ $loan->phone_number }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-500 uppercase mb-1">Barang</p>
                            <p class="text-sm text-slate-200 font-medium">{{ $loan->item->name ?? 'Barang tidak diketahui' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-500 uppercase mb-1">Durasi Pinjam</p>
                            <p class="text-sm text-slate-200 font-medium">{{ \Carbon\Carbon::parse($loan->borrow_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}</p>
                        </div>
                    </div>

                    <!-- Catatan Status -->
                    <div class="p-4 rounded-xl bg-white/[0.02] border border-white/5 mt-6">
                        <p class="text-xs font-semibold text-purple-400 mb-1">Catatan Sistem / Admin:</p>
                        <p class="text-sm text-slate-300">
                            @if($loan->status == 'pending')
                                Permohonan sedang dalam antrean. Silakan tunggu persetujuan admin.
                            @elseif($loan->status == 'approved')
                                Disetujui oleh admin. Silakan ambil barang di ruang logistik sesuai jadwal.
                            @elseif($loan->status == 'rejected')
                                Mohon maaf, permohonan ditolak. (Silakan hubungi admin untuk detailnya).
                            @else
                                Selesai. Barang telah dikembalikan. Terima kasih!
                            @endif
                        </p>
                    </div>
                </div>

            @elseif(request()->has('keyword') && !$loan)
                <!-- JIKA DATA TIDAK DITEMUKAN -->
                <div class="p-8 rounded-2xl border border-rose-500/20 bg-rose-500/5 text-center max-w-md mx-auto">
                    <div class="w-12 h-12 rounded-full bg-rose-500/20 text-rose-400 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-rose-400 mb-2">Data Tidak Ditemukan</h3>
                    <p class="text-sm text-slate-400">Kami tidak dapat menemukan data peminjaman dengan kode atau nomor WhatsApp "<strong>{{ request('keyword') }}</strong>". Pastikan data yang dimasukkan sudah benar.</p>
                </div>
            @else
                <!-- STATE AWAL (BELUM MENCARI) -->
                <div class="text-center mt-10">
                    <p class="text-slate-500 text-sm">Masukkan kode pada kolom di atas untuk melihat status.</p>
                </div>
            @endif
            
            <div class="text-center mt-8">
                <a href="{{ url('/') }}" class="text-sm text-purple-400 hover:text-purple-300 transition-colors">← Kembali ke Beranda</a>
            </div>
        </div>
    </main>
</body>
</html>
