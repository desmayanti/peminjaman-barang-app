<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman Sarpras</title>
    <style>
        @page {
            margin: 12mm 15mm 15mm 15mm;
            size: A4 portrait;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1e293b;
            font-size: 10px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }

        /* Kop Laporan */
        .kop-table {
            width: 100%;
            border-bottom: 2.5px solid #4c1d95;
            padding-bottom: 10px;
            margin-bottom: 14px;
        }

        .kop-table td {
            vertical-align: middle;
        }

        .kop-title {
            font-size: 16px;
            font-weight: bold;
            color: #4c1d95;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0 0 2px 0;
        }

        .kop-subtitle {
            font-size: 12px;
            font-weight: bold;
            color: #0f172a;
            margin: 0 0 3px 0;
        }

        .kop-desc {
            font-size: 9px;
            color: #64748b;
            margin: 0;
        }

        /* Informasi Periode */
        .meta-table {
            width: 100%;
            margin-bottom: 14px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
        }

        .meta-table td {
            padding: 6px 10px;
            font-size: 9.5px;
        }

        .meta-label {
            color: #64748b;
            font-weight: normal;
            width: 15%;
        }

        .meta-value {
            color: #0f172a;
            font-weight: bold;
            width: 35%;
        }

        /* Ringkasan Statistik */
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }

        .summary-card {
            padding: 6px 8px;
            text-align: center;
            border: 1px solid #e2e8f0;
            background-color: #ffffff;
        }

        .summary-label {
            font-size: 8px;
            text-transform: uppercase;
            color: #64748b;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .summary-count {
            font-size: 13px;
            font-weight: bold;
        }

        /* Tabel Utama */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .data-table th {
            background-color: #4c1d95;
            color: #ffffff;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 7px 6px;
            border: 1px solid #371b78;
            text-align: left;
        }

        .data-table th.center {
            text-align: center;
        }

        .data-table td {
            padding: 6px;
            font-size: 9px;
            border: 1px solid #e2e8f0;
            vertical-align: top;
        }

        .data-table tr:nth-child(even) {
            background-color: #fbfbfe;
        }

        /* Badge Status */
        .badge {
            display: inline-block;
            padding: 2px 6px;
            font-size: 8px;
            font-weight: bold;
            border-radius: 3px;
            text-transform: uppercase;
        }

        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }

        .badge-approved {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .badge-returned {
            background-color: #dbeafe;
            color: #1e40af;
            border: 1px solid #bfdbfe;
        }

        .badge-rejected {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .badge-type {
            font-size: 7.5px;
            padding: 1px 4px;
            border-radius: 2px;
            background-color: #ede9fe;
            color: #5b21b6;
            font-weight: bold;
            display: inline-block;
            margin-top: 2px;
        }

        /* Penandatangan */
        .signature-table {
            width: 100%;
            margin-top: 25px;
            page-break-inside: avoid;
        }

        .signature-table td {
            vertical-align: top;
        }

        .sign-title {
            font-size: 9.5px;
            color: #475569;
            margin-bottom: 50px;
        }

        .sign-name {
            font-size: 10px;
            font-weight: bold;
            color: #0f172a;
            text-decoration: underline;
        }

        .sign-nip {
            font-size: 8.5px;
            color: #64748b;
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            font-size: 8px;
            color: #94a3b8;
            text-align: right;
            border-top: 1px solid #f1f5f9;
            padding-top: 4px;
        }
    </style>
</head>
<body>

    <!-- KOP LAPORAN -->
    <table class="kop-table" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width: 70%;">
                <div class="kop-title">Sistem Peminjaman Sarana &amp; Prasarana</div>
                <div class="kop-subtitle">LAPORAN DATA PERMOHONAN PEMINJAMAN ASET</div>
                <div class="kop-desc">Dokumen rekapitulasi data peminjaman barang dan inventaris operasional sarpras.</div>
            </td>
            <td style="width: 30%; text-align: right;">
                <div style="font-size: 9px; color: #64748b;">Tanggal Cetak:</div>
                <div style="font-size: 10px; font-weight: bold; color: #0f172a;">{{ now()->translatedFormat('d F Y, H:i') }} WIB</div>
            </td>
        </tr>
    </table>

    <!-- METADATA PERIODE LAPORAN -->
    <table class="meta-table" cellpadding="0" cellspacing="0">
        <tr>
            <td class="meta-label">Periode Tanggal:</td>
            <td class="meta-value">{{ $awal->translatedFormat('d F Y') }} s/d {{ $akhir->translatedFormat('d F Y') }}</td>
            <td class="meta-label">Filter Status:</td>
            <td class="meta-value">
                @if($status === 'all')
                    Semua Status
                @elseif($status === 'pending')
                    Menunggu Review (Pending)
                @elseif($status === 'approved')
                    Disetujui / Dipinjam
                @elseif($status === 'returned')
                    Sudah Dikembalikan
                @elseif($status === 'rejected')
                    Ditolak
                @else
                    {{ ucfirst($status) }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="meta-label">Total Data:</td>
            <td class="meta-value">{{ $totalLoans }} Transaksi Tercatat</td>
            <td class="meta-label">Dicetak Oleh:</td>
            <td class="meta-value">{{ Auth::user()->name ?? 'Administrator Sarpras' }}</td>
        </tr>
    </table>

    <!-- RINGKASAN REKAPITULASI -->
    <table class="summary-table" cellpadding="0" cellspacing="0">
        <tr>
            <td class="summary-card" style="width: 20%; border-left: 3px solid #7c3aed;">
                <div class="summary-label">Total Pengajuan</div>
                <div class="summary-count" style="color: #4c1d95;">{{ $totalLoans }}</div>
            </td>
            <td class="summary-card" style="width: 20%; border-left: 3px solid #f59e0b;">
                <div class="summary-label">Pending Review</div>
                <div class="summary-count" style="color: #b45309;">{{ $pendingCount }}</div>
            </td>
            <td class="summary-card" style="width: 20%; border-left: 3px solid #10b981;">
                <div class="summary-label">Disetujui</div>
                <div class="summary-count" style="color: #047857;">{{ $approvedCount }}</div>
            </td>
            <td class="summary-card" style="width: 20%; border-left: 3px solid #3b82f6;">
                <div class="summary-label">Dikembalikan</div>
                <div class="summary-count" style="color: #1d4ed8;">{{ $returnedCount }}</div>
            </td>
            <td class="summary-card" style="width: 20%; border-left: 3px solid #ef4444;">
                <div class="summary-label">Ditolak</div>
                <div class="summary-count" style="color: #b91c1c;">{{ $rejectedCount }}</div>
            </td>
        </tr>
    </table>

    <!-- TABEL DATA UTAMA -->
    <table class="data-table" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th class="center" style="width: 5%;">NO</th>
                <th style="width: 14%;">KODE TIKET</th>
                <th style="width: 26%;">PEMINJAM</th>
                <th style="width: 24%;">BARANG &amp; QTY</th>
                <th style="width: 17%;">TANGGAL / PERIODE</th>
                <th class="center" style="width: 14%;">STATUS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loans as $index => $loan)
                <tr>
                    <td style="text-align: center; font-weight: bold; color: #475569;">
                        {{ $index + 1 }}
                    </td>
                    <td>
                        <span style="font-family: monospace; font-weight: bold; color: #4338ca;">#{{ $loan->loan_code }}</span>
                        <div style="font-size: 7.5px; color: #94a3b8; margin-top: 2px;">
                            {{ $loan->created_at ? $loan->created_at->format('d/m/Y H:i') : '-' }}
                        </div>
                    </td>
                    <td>
                        <strong style="color: #0f172a;">{{ $loan->borrower_name }}</strong>
                        @if($loan->nickname)
                            <span style="color: #6366f1;">({{ $loan->nickname }})</span>
                        @endif
                        <div style="font-size: 8px; color: #64748b; margin-top: 1px;">
                            Telp: {{ $loan->phone_number }}
                        </div>
                        @if($loan->email)
                            <div style="font-size: 8px; color: #64748b;">
                                Email: {{ $loan->email }}
                            </div>
                        @endif
                        @if($loan->purpose)
                            <div style="font-size: 7.5px; color: #64748b; font-style: italic; margin-top: 2px;">
                                Ket: {{ Str::limit($loan->purpose, 45) }}
                            </div>
                        @endif
                    </td>
                    <td>
                        <strong style="color: #0f172a;">{{ $loan->item->name ?? 'Barang Terhapus' }}</strong>
                        <div style="font-size: 8px; color: #475569; margin-top: 1px;">
                            Jumlah: <strong>{{ $loan->quantity }} Unit</strong>
                        </div>
                        @if($loan->type === 'minta' || ($loan->item && $loan->item->is_consumable) || empty($loan->tanggal_selesai))
                            <span class="badge-type">Habis Pakai / Minta</span>
                        @else
                            <span class="badge-type" style="background-color: #e0e7ff; color: #3730a3;">Dipinjam</span>
                        @endif
                    </td>
                    <td>
                        @if($loan->type === 'minta' || ($loan->item && $loan->item->is_consumable) || empty($loan->tanggal_selesai))
                            <span style="color: #64748b; font-size: 8px; font-style: italic;">
                                Tgl: {{ \Carbon\Carbon::parse($loan->borrow_date)->translatedFormat('d M Y') }}
                            </span>
                        @else
                            <div style="font-size: 8.5px; font-weight: bold; color: #1e293b;">
                                {{ \Carbon\Carbon::parse($loan->borrow_date)->format('d/m/Y') }}
                            </div>
                            <div style="font-size: 8px; color: #64748b;">
                                s/d {{ \Carbon\Carbon::parse($loan->tanggal_selesai ?? $loan->return_date)->format('d/m/Y') }}
                            </div>
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if($loan->status == 'pending')
                            <span class="badge badge-pending">Pending</span>
                        @elseif($loan->status == 'approved')
                            <span class="badge badge-approved">Disetujui</span>
                        @elseif($loan->status == 'returned')
                            <span class="badge badge-returned">Kembali</span>
                        @elseif($loan->status == 'rejected')
                            <span class="badge badge-rejected">Ditolak</span>
                        @else
                            <span class="badge">{{ ucfirst($loan->status) }}</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 25px 10px; color: #64748b;">
                        <em>Tidak ada data peminjaman yang tercatat dalam rentang tanggal yang dipilih.</em>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- LEMBAR PENGESAHAN / TANDA TANGAN -->
    <table class="signature-table" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width: 60%;">
                <div style="font-size: 8px; color: #64748b; line-height: 1.5;">
                    * Laporan ini dicetak secara otomatis melalui Sistem Informasi Inventaris &amp; Peminjaman Sarana Prasarana.<br>
                    * Harap simpan dokumen ini sebagai bukti arsip rekapitulasi data peminjaman resmi.
                </div>
            </td>
            <td style="width: 40%; text-align: center;">
                <div class="sign-title">
                    Dicetak pada: {{ now()->translatedFormat('d F Y') }}<br>
                    Petugas / Penanggung Jawab Sarpras,
                </div>
                <div class="sign-name">{{ Auth::user()->name ?? 'Administrator Sarpras' }}</div>
                <div class="sign-nip">Petugas Administrasi Sarana Prasarana</div>
            </td>
        </tr>
    </table>

    <!-- FOOTER HALAMAN -->
    <div class="footer">
        Halaman 1 &bull; Laporan Peminjaman Sarpras &bull; Dicetak: {{ now()->format('d/m/Y H:i') }} WIB
    </div>

</body>
</html>
