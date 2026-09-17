<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
                    Manajemen Permohonan Peminjaman
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
                    Tinjau data peminjam, setujui permohonan, atau tandai barang yang telah dikembalikan.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    <span>Buka Landing Page</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Flash Alerts -->
            @if(session('success'))
                <div class="p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-sm flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-200 text-sm flex items-center gap-3">
                    <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Quick Metrics Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
                <a href="{{ route('admin.loans.index', ['status' => 'all']) }}" class="p-5 rounded-2xl bg-white dark:bg-gray-800 border {{ ($status == 'all') ? 'border-indigo-500 ring-2 ring-indigo-500/20' : 'border-gray-200 dark:border-gray-700' }} shadow-sm hover:shadow transition">
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 block">Semua Permohonan</span>
                    <span class="text-2xl font-extrabold text-gray-900 dark:text-white mt-1 block">{{ $counts['all'] }}</span>
                </a>

                <a href="{{ route('admin.loans.index', ['status' => 'pending']) }}" class="p-5 rounded-2xl bg-white dark:bg-gray-800 border {{ ($status == 'pending') ? 'border-amber-500 ring-2 ring-amber-500/20' : 'border-gray-200 dark:border-gray-700' }} shadow-sm hover:shadow transition">
                    <span class="text-xs font-medium text-amber-600 dark:text-amber-400 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                        Menunggu Review
                    </span>
                    <span class="text-2xl font-extrabold text-amber-600 dark:text-amber-400 mt-1 block">{{ $counts['pending'] }}</span>
                </a>

                <a href="{{ route('admin.loans.index', ['status' => 'approved']) }}" class="p-5 rounded-2xl bg-white dark:bg-gray-800 border {{ ($status == 'approved') ? 'border-emerald-500 ring-2 ring-emerald-500/20' : 'border-gray-200 dark:border-gray-700' }} shadow-sm hover:shadow transition">
                    <span class="text-xs font-medium text-emerald-600 dark:text-emerald-400 block">Disetujui / Dipinjam</span>
                    <span class="text-2xl font-extrabold text-emerald-600 dark:text-emerald-400 mt-1 block">{{ $counts['approved'] }}</span>
                </a>

                <a href="{{ route('admin.loans.index', ['status' => 'returned']) }}" class="p-5 rounded-2xl bg-white dark:bg-gray-800 border {{ ($status == 'returned') ? 'border-blue-500 ring-2 ring-blue-500/20' : 'border-gray-200 dark:border-gray-700' }} shadow-sm hover:shadow transition">
                    <span class="text-xs font-medium text-blue-600 dark:text-blue-400 block">Sudah Dikembalikan</span>
                    <span class="text-2xl font-extrabold text-blue-600 dark:text-blue-400 mt-1 block">{{ $counts['returned'] }}</span>
                </a>

                <a href="{{ route('admin.loans.index', ['status' => 'rejected']) }}" class="p-5 rounded-2xl bg-white dark:bg-gray-800 border {{ ($status == 'rejected') ? 'border-rose-500 ring-2 ring-rose-500/20' : 'border-gray-200 dark:border-gray-700' }} shadow-sm hover:shadow transition">
                    <span class="text-xs font-medium text-rose-600 dark:text-rose-400 block">Permohonan Ditolak</span>
                    <span class="text-2xl font-extrabold text-rose-600 dark:text-rose-400 mt-1 block">{{ $counts['rejected'] }}</span>
                </a>
            </div>

            <!-- Filter & Search Toolbar -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-1.5 overflow-x-auto w-full sm:w-auto text-xs">
                    @foreach(['all' => 'Semua', 'pending' => 'Pending', 'approved' => 'Disetujui', 'returned' => 'Dikembalikan', 'rejected' => 'Ditolak'] as $key => $label)
                        <a href="{{ route('admin.loans.index', ['status' => $key, 'search' => $search]) }}" class="px-3.5 py-2 rounded-xl font-semibold transition whitespace-nowrap {{ ($status == $key) ? 'bg-indigo-600 text-white' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>

                <form action="{{ route('admin.loans.index') }}" method="GET" class="w-full sm:w-auto flex items-center gap-2">
                    <input type="hidden" name="status" value="{{ $status }}">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama/nickname/kode..." class="w-full sm:w-64 bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-xl px-3.5 py-2 text-xs text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold px-3.5 py-2 rounded-xl transition">
                        Cari
                    </button>
                    @if($search)
                        <a href="{{ route('admin.loans.index', ['status' => $status]) }}" class="text-xs text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 underline">Reset</a>
                    @endif
                </form>
            </div>

            <!-- Loans Table -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                @if($loans->isEmpty())
                    <div class="text-center py-16 px-4">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <h3 class="text-base font-bold text-gray-900 dark:text-white">Tidak ada data peminjaman</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Belum ada permohonan dengan kriteria filter yang dipilih.</p>
                    </div>
                @else
                                        <!-- Mobile Card View (Tampilan Khusus HP) -->
                    <div class="md:hidden divide-y divide-gray-100 dark:divide-gray-700/60 p-4 space-y-4">
                        @foreach($loans as $loan)
                            <div class="pt-4 first:pt-0 space-y-3">
                                <div class="flex items-start justify-between gap-2">
                                    <div>
                                        <span class="font-mono font-bold text-sm text-indigo-600 dark:text-indigo-400">#{{ $loan->loan_code }}</span>
                                        <span class="text-[11px] text-gray-400 block">{{ $loan->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                    <div>
                                        @if($loan->status == 'pending')
                                            <span class="px-2 py-0.5 rounded-lg bg-amber-50 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-800 text-[11px] font-bold">Pending</span>
                                        @elseif($loan->status == 'approved')
                                            <span class="px-2 py-0.5 rounded-lg bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800 text-[11px] font-bold">Disetujui</span>
                                        @elseif($loan->status == 'returned')
                                            <span class="px-2 py-0.5 rounded-lg bg-blue-50 dark:bg-blue-950/60 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800 text-[11px] font-bold">Dikembalikan</span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-lg bg-rose-50 dark:bg-rose-950/60 text-rose-700 dark:text-rose-300 border border-rose-200 dark:border-rose-800 text-[11px] font-bold">Ditolak</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="bg-gray-50 dark:bg-gray-900/60 rounded-2xl p-3 text-xs space-y-1.5">
                                    <div class="font-bold text-gray-900 dark:text-white">
                                        {{ $loan->borrower_name }} <span class="font-normal text-indigo-500">({{ $loan->nickname }})</span>
                                    </div>
                                    <div class="text-gray-600 dark:text-gray-300 flex items-center justify-between">
                                        <span>Barang:</span>
                                        <span class="font-semibold">{{ $loan->item->name ?? 'Barang' }} ({{ $loan->quantity }} Unit)</span>
                                    </div>
                                    <div class="text-gray-600 dark:text-gray-300 flex items-center justify-between">
                                        <span>Jadwal:</span>
                                        <span>{{ \Carbon\Carbon::parse($loan->borrow_date)->format('d M') }} - {{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex items-center gap-3 pt-1 border-t border-gray-200 dark:border-gray-800">
                                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $loan->phone_number)) }}" target="_blank" class="text-emerald-500 font-semibold flex items-center gap-1">
                                            <span>WhatsApp: {{ $loan->phone_number }}</span>
                                        </a>
                                    </div>
                                </div>

                                <!-- Action Buttons on Mobile -->
                                <div class="flex flex-wrap items-center gap-2 pt-1">
                                    <button type="button" onclick="document.getElementById('editDateModal_{{ $loan->id }}').classList.remove('hidden')" class="flex-1 py-2 px-3 rounded-xl border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 text-center text-xs font-semibold">
                                        Ubah Tanggal
                                    </button>

                                    @if($loan->status == 'pending')
                                        <form action="{{ route('admin.loans.status', $loan->id) }}" method="POST" class="flex-1">
                                            @csrf
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="w-full py-2 px-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-center text-xs font-bold">
                                                Setujui
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.loans.status', $loan->id) }}" method="POST" class="flex-1">
                                            @csrf
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="w-full py-2 px-3 rounded-xl bg-rose-600 hover:bg-rose-500 text-white text-center text-xs font-bold">
                                                Tolak
                                            </button>
                                        </form>
                                    @elseif($loan->status == 'approved')
                                        <form action="{{ route('admin.loans.status', $loan->id) }}" method="POST" class="flex-1">
                                            @csrf
                                            <input type="hidden" name="status" value="returned">
                                            <button type="submit" class="w-full py-2 px-3 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-center text-xs font-bold">
                                                Tandai Kembali
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Desktop Table View (Tampilan Khusus Laptop / Layar Lebar) -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full text-left border-collapse text-xs">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-700 bg-gray-50/75 dark:bg-gray-900/50 text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold">
                                    <th class="py-3.5 px-5">Kode / Tanggal Masuk</th>
                                    <th class="py-3.5 px-5">Peminjam (Nickname & Kontak)</th>
                                    <th class="py-3.5 px-5">Barang & Qty</th>
                                    <th class="py-3.5 px-5">Periode Pinjam</th>
                                    <th class="py-3.5 px-5">Status</th>
                                    <th class="py-3.5 px-5 text-right">Aksi Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700/60">
                                @foreach($loans as $loan)
                                    <tr class="hover:bg-gray-50/80 dark:hover:bg-gray-700/30 transition">
                                        <!-- Kode & Tanggal -->
                                        <td class="py-4 px-5">
                                            <span class="font-mono font-bold text-indigo-600 dark:text-indigo-400 block">#{{ $loan->loan_code }}</span>
                                            <span class="text-[11px] text-gray-400">{{ $loan->created_at->format('d M Y, H:i') }}</span>
                                        </td>

                                        <!-- Peminjam Info -->
                                        <td class="py-4 px-5">
                                            <div class="font-bold text-gray-900 dark:text-gray-100">
                                                {{ $loan->borrower_name }}
                                                <span class="text-xs font-normal text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/60 px-2 py-0.5 rounded-md ml-1">
                                                    Nickname: {{ $loan->nickname }}
                                                </span>
                                            </div>
                                            <div class="flex items-center gap-3 mt-1 text-[11px] text-gray-500 dark:text-gray-400">
                                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $loan->phone_number)) }}" target="_blank" class="hover:text-emerald-600 flex items-center gap-1 font-mono">
                                                    <svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.288.043.088.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.174.086.275.073.376-.044.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.203c.043.072.043.419-.101.824z" />
                                                    </svg>
                                                    <span>{{ $loan->phone_number }}</span>
                                                </a>
                                                <span>&bull;</span>
                                                <a href="mailto:{{ $loan->email }}" class="hover:text-indigo-600 truncate max-w-[150px]">
                                                    {{ $loan->email }}
                                                </a>
                                            </div>
                                            <div class="mt-1 text-[11px] text-gray-500 italic">
                                                Keperluan: "{{ Str::limit($loan->purpose, 60) }}"
                                            </div>
                                        </td>

                                        <!-- Barang & Qty -->
                                        <td class="py-4 px-5">
                                            <div class="font-semibold text-gray-900 dark:text-gray-100">
                                                {{ $loan->item->name ?? 'Barang Terhapus' }}
                                            </div>
                                            <span class="text-[11px] text-gray-500 block">
                                                Jumlah: <strong class="text-indigo-600 dark:text-indigo-400">{{ $loan->quantity }} Unit</strong>
                                                (Sisa Stok Tersedia: {{ $loan->item->available_stock ?? 0 }})
                                            </span>
                                        </td>

                                        <!-- Periode -->
                                        <td class="py-4 px-5">
                                            <span class="font-medium text-gray-900 dark:text-gray-100 block">
                                                {{ \Carbon\Carbon::parse($loan->borrow_date)->format('d M') }} - {{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}
                                            </span>
                                            <span class="text-[11px] text-gray-400">
                                                Durasi: {{ \Carbon\Carbon::parse($loan->borrow_date)->diffInDays(\Carbon\Carbon::parse($loan->return_date)) + 1 }} Hari
                                            </span>
                                        </td>

                                        <!-- Status Badge -->
                                        <td class="py-4 px-5">
                                            @if($loan->status == 'pending')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-amber-50 dark:bg-amber-950/60 border border-amber-200 dark:border-amber-800 text-amber-700 dark:text-amber-300 font-semibold">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                                    Menunggu
                                                </span>
                                            @elseif($loan->status == 'approved')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 font-semibold">
                                                    Disetujui
                                                </span>
                                            @elseif($loan->status == 'returned')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-blue-50 dark:bg-blue-950/60 border border-blue-200 dark:border-blue-800 text-blue-700 dark:text-blue-300 font-semibold">
                                                    Dikembalikan
                                                </span>
                                            @elseif($loan->status == 'rejected')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-300 font-semibold">
                                                    Ditolak
                                                </span>
                                            @endif

                                            @if($loan->admin_notes)
                                                <div class="mt-1 text-[10px] text-gray-400 italic">
                                                    Catatan: {{ Str::limit($loan->admin_notes, 30) }}
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Actions Buttons -->
                                        <td class="py-4 px-5 text-right">
                                            <div class="flex items-center justify-end gap-1.5">
    <!-- Tombol Edit Tanggal -->
    <button type="button" onclick="document.getElementById('editDateModal_{{ $loan->id }}').classList.remove('hidden')" class="px-2 py-1.5 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 text-[11px] font-medium transition" title="Ubah Tanggal Peminjaman/Pengembalian">
        Ubah Tanggal
    </button>
                                                @if($loan->status == 'pending')
                                                    <!-- Approve Form -->
                                                    <form action="{{ route('admin.loans.status', $loan->id) }}" method="POST" onsubmit="return confirm('Setujui permohonan pinjam ini? Stok barang akan dikurangi secara otomatis.');">
                                                        @csrf
                                                        <input type="hidden" name="status" value="approved">
                                                        <input type="hidden" name="admin_notes" value="Disetujui oleh admin. Silakan ambil barang di ruang logistik.">
                                                        <button type="submit" class="px-2.5 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-[11px] transition shadow-sm">
                                                            Setujui
                                                        </button>
                                                    </form>

                                                    <!-- Reject Form -->
                                                    <form action="{{ route('admin.loans.status', $loan->id) }}" method="POST" onsubmit="return confirm('Tolak permohonan pinjam ini?');">
                                                        @csrf
                                                        <input type="hidden" name="status" value="rejected">
                                                        <input type="hidden" name="admin_notes" value="Mohon maaf, permohonan tidak dapat diproses saat ini.">
                                                        <button type="submit" class="px-2.5 py-1.5 rounded-lg bg-rose-600 hover:bg-rose-500 text-white font-semibold text-[11px] transition shadow-sm">
                                                            Tolak
                                                        </button>
                                                    </form>
                                                @elseif($loan->status == 'approved')
                                                    <!-- Mark as Returned -->
                                                    <form action="{{ route('admin.loans.status', $loan->id) }}" method="POST" onsubmit="return confirm('Tandai barang telah dikembalikan? Stok barang akan otomatis bertambah kembali.');">
                                                        @csrf
                                                        <input type="hidden" name="status" value="returned">
                                                        <input type="hidden" name="admin_notes" value="Barang telah dikembalikan dalam kondisi baik dan lengkap.">
                                                        <button type="submit" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white font-semibold text-[11px] transition shadow-sm flex items-center gap-1">
                                                            <span>Barang Kembali</span>
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-gray-400 text-[11px]">Selesai</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($loans->hasPages())
                        <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                            {{ $loans->links() }}
                        </div>
                    @endif
                @endif
            </div>

        </div>
    </div>
    <!-- Modal Ubah Tanggal untuk Tiap Pinjaman -->
    @foreach($loans as $loan)
        <div id="editDateModal_{{ $loan->id }}" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white dark:bg-gray-800 rounded-3xl max-w-md w-full p-6 shadow-2xl border border-gray-200 dark:border-gray-700 text-left">
                <div class="flex items-center justify-between pb-3 border-b border-gray-200 dark:border-gray-700 mb-4">
                    <h3 class="font-bold text-base text-gray-900 dark:text-white">Ubah Tanggal #{{ $loan->loan_code }}</h3>
                    <button type="button" onclick="document.getElementById('editDateModal_{{ $loan->id }}').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 text-sm font-bold">âœ•</button>
                </div>
                <form action="{{ route('admin.loans.dates', $loan->id) }}" method="POST">
                    @csrf
                    <div class="space-y-4 text-xs">
                        <div>
                            <label class="block font-semibold text-gray-700 dark:text-gray-300 mb-1">Tanggal Mulai Pinjam</label>
                            <input type="date" name="borrow_date" value="{{ \Carbon\Carbon::parse($loan->borrow_date)->format('Y-m-d') }}" required class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-xl px-3 py-2 text-gray-900 dark:text-white">
                        </div>
                        <div>
                            <label class="block font-semibold text-gray-700 dark:text-gray-300 mb-1">Tanggal Pengembalian Barang</label>
                            <input type="date" name="return_date" value="{{ \Carbon\Carbon::parse($loan->return_date)->format('Y-m-d') }}" required class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-xl px-3 py-2 text-gray-900 dark:text-white">
                        </div>
                        <div>
                            <label class="block font-semibold text-gray-700 dark:text-gray-300 mb-1">Catatan Tambahan (Opsional)</label>
                            <input type="text" name="admin_notes" value="{{ $loan->admin_notes }}" placeholder="Misal: Perpanjangan disetujui..." class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-xl px-3 py-2 text-gray-900 dark:text-white">
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end gap-2">
                        <button type="button" onclick="document.getElementById('editDateModal_{{ $loan->id }}').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-gray-300 text-gray-700 dark:text-gray-300 text-xs font-semibold">Batal</button>
                        <button type="submit" class="px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold shadow-md">Simpan Perubahan Tanggal</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
</x-app-layout>