# Kasir Laravel

Aplikasi kasir berbasis web menggunakan Laravel + Livewire.

> **Status:** 🚧 Masih dalam tahap pengembangan

## Fitur (Rencana)
- Manajemen pengguna (admin, kasir)
- Manajemen produk
- Transaksi penjualan
- Laporan penjualan

## Instalasi

1. **Clone repository**
   ```bash
   git clone <repo-anda>
   cd kasir-laravel
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   npm run dev
   ```

3. **Copy file environment**
   ```bash
   cp .env.example .env
   ```

4. **Generate key**
   ```bash
   php artisan key:generate
   ```

5. **Atur koneksi database**  
   Edit file `.env` dan sesuaikan konfigurasi database Anda.

6. **Migrasi database**
   ```bash
   php artisan migrate
   ```

7. **Jalankan aplikasi**
   ```bash
   php artisan serve
   ```

## Catatan
- Proyek ini masih dalam pengembangan, fitur dan tampilan dapat berubah sewaktu-waktu.
- Silakan laporkan bug atau saran melalui issues.
