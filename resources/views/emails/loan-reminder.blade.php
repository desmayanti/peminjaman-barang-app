<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengingat Pengembalian Barang</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #F8FAFC;
            margin: 0;
            padding: 0;
            color: #1E293B;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #FFFFFF;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #E2E8F0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .header {
            background: linear-gradient(135deg, #7C3AED 0%, #6D28D9 100%);
            padding: 32px 28px;
            text-align: center;
            color: #FFFFFF;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .header p {
            margin: 6px 0 0;
            font-size: 13px;
            color: #E9D5FF;
        }
        .content {
            padding: 32px 28px;
        }
        .greeting {
            font-size: 16px;
            font-weight: 700;
            color: #0F172A;
            margin-bottom: 12px;
        }
        .lead {
            font-size: 14px;
            line-height: 1.6;
            color: #475569;
            margin-bottom: 24px;
        }
        .card-info {
            background-color: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 24px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dashed #E2E8F0;
            font-size: 13px;
        }
        .info-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .info-label {
            color: #64748B;
            font-weight: 500;
        }
        .info-value {
            color: #0F172A;
            font-weight: 700;
            text-align: right;
        }
        .badge-warning {
            display: inline-block;
            background-color: #FEF3C7;
            color: #92400E;
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 700;
            border: 1px solid #FCD34D;
        }
        .badge-danger {
            display: inline-block;
            background-color: #FEE2E2;
            color: #991B1B;
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 700;
            border: 1px solid #FCA5A5;
        }
        .alert-box {
            background-color: #FAF5FF;
            border-left: 4px solid #7C3AED;
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 13px;
            line-height: 1.5;
            color: #581C87;
        }
        .btn-wrapper {
            text-align: center;
            margin: 28px 0 10px;
        }
        .btn {
            display: inline-block;
            background: #7C3AED;
            color: #FFFFFF !important;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            padding: 12px 28px;
            border-radius: 9999px;
            box-shadow: 0 4px 10px rgba(124, 58, 237, 0.3);
        }
        .footer {
            background-color: #F8FAFC;
            padding: 20px 28px;
            text-align: center;
            border-top: 1px solid #E2E8F0;
            font-size: 12px;
            color: #94A3B8;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>PinjamBarang.</h1>
            <p>Sistem Pengingat &amp; Sirkulasi Aset Sarpras Otomatis</p>
        </div>

        <!-- Content -->
        <div class="content">
            @php
                $dueDate = $loan->return_date ?? $loan->tanggal_selesai;
                $overdueCount = $daysOverdue ?? 0;
            @endphp
            <div class="greeting">Halo, {{ $loan->borrower_name }} ({{ $loan->nickname }})! 👋</div>
            @if ($overdueCount > 0)
                <p class="lead">
                    Ini adalah pesan peringatan otomatis dari bagian Sarpras. Peminjaman peralatan inventaris berikut telah melewati batas waktu pengembalian selama <strong>{{ $overdueCount }} hari</strong>. Mohon segera kembalikan barang kepada petugas Sarpras.
                </p>
            @else
                <p class="lead">
                    Ini adalah pesan pengingat otomatis dari bagian Sarpras mengenai peminjaman peralatan inventaris yang saat ini masih Anda gunakan.
                </p>
            @endif

            <!-- Card Detail -->
            <div class="card-info">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr style="border-bottom: 1px dashed #E2E8F0;">
                        <td style="padding: 8px 0; color: #64748B; font-size: 13px;">Kode Peminjaman</td>
                        <td style="padding: 8px 0; color: #7C3AED; font-weight: 800; font-size: 13px; text-align: right;">{{ $loan->loan_code }}</td>
                    </tr>
                    <tr style="border-bottom: 1px dashed #E2E8F0;">
                        <td style="padding: 8px 0; color: #64748B; font-size: 13px;">Nama Barang</td>
                        <td style="padding: 8px 0; color: #0F172A; font-weight: 700; font-size: 13px; text-align: right;">{{ $item?->name ?? 'Barang Sarpras' }}</td>
                    </tr>
                    <tr style="border-bottom: 1px dashed #E2E8F0;">
                        <td style="padding: 8px 0; color: #64748B; font-size: 13px;">Jumlah Unit</td>
                        <td style="padding: 8px 0; color: #0F172A; font-weight: 700; font-size: 13px; text-align: right;">{{ $loan->quantity }} Unit</td>
                    </tr>
                    <tr style="border-bottom: 1px dashed #E2E8F0;">
                        <td style="padding: 8px 0; color: #64748B; font-size: 13px;">Tanggal Pinjam</td>
                        <td style="padding: 8px 0; color: #0F172A; font-weight: 600; font-size: 13px; text-align: right;">{{ \Carbon\Carbon::parse($loan->borrow_date)->locale('id')->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr style="border-bottom: 1px dashed #E2E8F0;">
                        <td style="padding: 8px 0; color: #64748B; font-size: 13px;">Batas Waktu Pengembalian</td>
                        <td style="padding: 8px 0; color: #DC2626; font-weight: 800; font-size: 13px; text-align: right;">
                            {{ $dueDate ? \Carbon\Carbon::parse($dueDate)->locale('id')->translatedFormat('d F Y') : 'Sesuai Ketentuan' }}
                        </td>
                    </tr>
                    @if ($overdueCount > 0)
                        <tr style="border-bottom: 1px dashed #E2E8F0;">
                            <td style="padding: 8px 0; color: #64748B; font-size: 13px;">Keterlambatan</td>
                            <td style="padding: 8px 0; color: #DC2626; font-weight: 800; font-size: 13px; text-align: right;">Terlambat {{ $overdueCount }} Hari</td>
                        </tr>
                    @endif
                    <tr>
                        <td style="padding: 8px 0; color: #64748B; font-size: 13px;">Status Peminjaman</td>
                        <td style="padding: 8px 0; text-align: right;">
                            @if ($overdueCount > 0)
                                <span class="badge-danger">Terlambat {{ $overdueCount }} Hari &bull; Wajib Dikembalikan</span>
                            @else
                                <span class="badge-warning">Wajib Dikembalikan</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Alert Notice -->
            <div class="alert-box">
                <strong>⚠️ Peringatan Kondisi Barang:</strong><br>
                Mohon pastikan seluruh kelengkapan (kabel, adaptor, remote, dan aksesori pendukung) dalam keadaan bersih dan berfungsi optimal saat diserahkan kembali kepada petugas Sarpras.
            </div>

            <!-- CTA Button -->
            <div class="btn-wrapper">
                <a href="{{ route('lacak.status', ['keyword' => $loan->loan_code]) }}" class="btn">
                    Lacak &amp; Konfirmasi Pengembalian &rarr;
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p style="margin: 0 0 4px;">Unit Pengelolaan Sarana &amp; Prasarana (Sarpras) PinjamBarang</p>
            <p style="margin: 0;">Email otomatis ini dikirim oleh bot sistem peminjaman aset sekolah.</p>
        </div>
    </div>
</body>
</html>
