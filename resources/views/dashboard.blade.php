<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
                    {{ __('Dashboard Ringkasan Admin') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
                    Selamat datang kembali, {{ Auth::user()->name }}. Kelola permohonan peminjaman dan data barang dengan mudah.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.loans.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold bg-indigo-600 hover:bg-indigo-500 text-white shadow-md shadow-indigo-600/20 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span>Buka Semua Permohonan</span>
                </a>
            </div>
        </div>
    </x-slot>

    @php
        $totalItems = \App\Models\Item::count();
        $totalLoans = \App\Models\Loan::count();
        $pendingLoans = \App\Models\Loan::where('status', 'pending')->count();
        $approvedLoans = \App\Models\Loan::where('status', 'approved')->count();
        $recentLoans = \App\Models\Loan::with('item')->latest()->take(5)->get();
    @endphp

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Stats Widgets -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-amber-500">Perlu Verifikasi</span>
                        <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $pendingLoans }}</div>
                    <a href="{{ route('admin.loans.index', ['status' => 'pending']) }}" class="text-xs font-semibold text-amber-600 dark:text-amber-400 hover:underline mt-2 inline-block">
                        Lihat permohonan pending &rarr;
                    </a>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-500">Sedang Dipinjam</span>
                        <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $approvedLoans }}</div>
                    <a href="{{ route('admin.loans.index', ['status' => 'approved']) }}" class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 hover:underline mt-2 inline-block">
                        Daftar barang dipinjam &rarr;
                    </a>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-indigo-500">Total Permohonan</span>
                        <div class="w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-500 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $totalLoans }}</div>
                    <span class="text-xs text-gray-400 mt-2 block">Riwayat keseluruhan</span>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-violet-500">Total Aset Barang</span>
                        <div class="w-10 h-10 rounded-xl bg-violet-500/10 text-violet-500 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $totalItems }}</div>
                    <a href="{{ route('home') }}#katalog" target="_blank" class="text-xs font-semibold text-violet-600 dark:text-violet-400 hover:underline mt-2 inline-block">
                        Lihat katalog live &rarr;
                    </a>
                </div>
            </div>

            <!-- Recent Loans Table Section -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden p-6">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Permohonan Peminjaman Terbaru</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">5 pengajuan terakhir yang masuk dari pengguna.</p>
                    </div>
                    <a href="{{ route('admin.loans.index') }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">
                        Lihat Semua &rarr;
                    </a>
                </div>

                @if($recentLoans->isEmpty())
                    <p class="text-sm text-gray-500 text-center py-6">Belum ada data peminjaman.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="border-b border-gray-100 dark:border-gray-700 text-gray-400 uppercase font-semibold">
                                    <th class="py-2.5">Kode</th>
                                    <th class="py-2.5">Peminjam</th>
                                    <th class="py-2.5">Barang</th>
                                    <th class="py-2.5">Durasi</th>
                                    <th class="py-2.5">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700/50">
                                @foreach($recentLoans as $loan)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/20">
                                        <td class="py-3 font-mono font-bold text-indigo-600 dark:text-indigo-400">
                                            #{{ $loan->loan_code }}
                                        </td>
                                        <td class="py-3">
                                            <span class="font-bold text-gray-900 dark:text-gray-100">{{ $loan->borrower_name }}</span>
                                            <span class="text-gray-400 block text-[11px]">Nickname: {{ $loan->nickname }}</span>
                                        </td>
                                        <td class="py-3 font-medium text-gray-800 dark:text-gray-200">
                                            {{ $loan->item->name ?? 'Barang' }} ({{ $loan->quantity }} Unit)
                                        </td>
                                        <td class="py-3 text-gray-500 dark:text-gray-400">
                                            {{ \Carbon\Carbon::parse($loan->borrow_date)->format('d M') }} s/d {{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}
                                        </td>
                                        <td class="py-3">
                                            @if($loan->status == 'pending')
                                                <span class="px-2 py-0.5 rounded-md bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 font-semibold border border-amber-200 dark:border-amber-800">
                                                    Pending
                                                </span>
                                            @elseif($loan->status == 'approved')
                                                <span class="px-2 py-0.5 rounded-md bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 font-semibold border border-emerald-200 dark:border-emerald-800">
                                                    Disetujui
                                                </span>
                                            @elseif($loan->status == 'returned')
                                                <span class="px-2 py-0.5 rounded-md bg-blue-50 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 font-semibold border border-blue-200 dark:border-blue-800">
                                                    Dikembalikan
                                                </span>
                                            @else
                                                <span class="px-2 py-0.5 rounded-md bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 font-semibold border border-rose-200 dark:border-rose-800">
                                                    Ditolak
                                                </span>
                                            @endif
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