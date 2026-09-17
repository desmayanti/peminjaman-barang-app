# ðŸ“¦ Sistem Peminjaman Barang & Peralatan (PinjamBarang)

Aplikasi web modern untuk manajemen dan pengajuan peminjaman barang/aset inventaris berbasis **Laravel 13**, **Tailwind CSS**, dan **SQLite**. Dilengkapi landing page interaktif, formulir peminjaman dengan data peminjam lengkap, tiket pelacakan mandiri, dan panel kontrol admin terintegrasi.

---

## ðŸš€ Fitur Utama

- **Katalog Inventaris Real-Time**: Daftar barang siap pakai dengan filter kategori, pencarian cepat, dan status sisa kuota/stok.
- **Formulir Peminjaman Lengkap**:
  - *Nickname* (nama panggilan peminjam)
  - Nama Lengkap (sesuai identitas)
  - No. Telepon / WhatsApp (tersedia link chat langsung untuk petugas)
  - Alamat Email aktif (otomatis masuk ke sistem notifikasi admin)
  - Pilihan barang & jumlah unit (dengan validasi stok)
  - Tanggal peminjaman & pengembalian barang (dengan tombol durasi cepat)
  - Alasan / keperluan peminjaman
- **Tiket Resi Digital**: Menghasilkan kode unik peminjaman (misal: `#PJ-10293`) dengan fitur salin 1-klik.
- **Pelacakan Status Mandiri (`/cek-status`)**: Pengguna dapat memantau proses verifikasi admin secara langsung via kode tiket atau nomor kontak.
- **Panel Admin Terintegrasi (`/admin/loans` & `/dashboard`)**:
  - Tinjau seluruh permohonan yang masuk secara *real-time*.
  - Aksi **Setujui** (stok barang berkurang otomatis).
  - Aksi **Tolak** (disertai catatan admin).
  - Aksi **Barang Kembali** (stok barang bertambah kembali secara otomatis).
  - Fitur **Ubah Tanggal** untuk perpanjangan jadwal peminjaman.
- **ðŸ“± 100% Responsif (HP & Laptop)**:
  - *Di HP*: Bilah menu bawah (*Mobile Bottom Navigation*), tombol pilihan tanggal instan, dan kartu ringkas di dashboard.
  - *Di Laptop*: Tampilan katalog lebar, metrik statistik lengkap, dan tabel data luas.

---

## ðŸ› ï¸ Teknologi yang Digunakan

- **Backend**: Laravel 13 & PHP 8.3
- **Frontend**: Blade Templates, Tailwind CSS, Vite
- **Autentikasi**: Laravel Breeze
- **Basis Data**: SQLite (Praktis & siap pakai)

---

## ðŸ’» Panduan Instalasi Lokal

1. **Clone Repositori**:
   ```bash
   git clone https://github.com/raissawulan/peminjaman-barang.git
   cd peminjaman-barang
   ```

2. **Instal Dependensi**:
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment**:
   ```bash
   copy .env.example .env
   php artisan key:generate
   ```

4. **Migrasi & Data Sampel**:
   ```bash
   php artisan migrate --seed
   npm run build
   ```

5. **Jalankan Aplikasi**:
   ```bash
   php artisan serve
   ```
   Buka di browser Anda di: `http://localhost:8000`

---

## ðŸ”‘ Akun Demo Administrator

- **Halaman Login**: `http://localhost:8000/login`
- **Email**: `admin@admin.com`
- **Password**: `password123`

---

Dibuat dengan â¤ï¸ oleh [Raissa](https://github.com/raissawulan).