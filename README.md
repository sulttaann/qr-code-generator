# QR Code Generator

## Informasi Proyek

| Keterangan | Detail |
|------------|--------|
| Nama | Muhammad Sultan |
| NIM | 240180100 |
| Program Studi | Sistem Informasi |
| Universitas | Universitas Malikussaleh |
| Mata Kuliah | Pemrograman Web 2 |
| Framework | Laravel 11 |

---

## Latar Belakang

Di era digital saat ini, QR Code telah menjadi salah satu media penyampaian informasi yang paling efisien dan mudah digunakan. QR Code dapat menyimpan berbagai jenis data seperti URL, teks, informasi kontak, hingga data pembayaran, dan dapat dibaca hanya dengan menggunakan kamera smartphone tanpa memerlukan aplikasi tambahan.

Aplikasi QR Code Generator ini dikembangkan sebagai proyek tugas mata kuliah Pemrograman Web 2 dengan tujuan mengimplementasikan konsep pengembangan aplikasi web berbasis framework Laravel. Aplikasi ini memungkinkan pengguna untuk membuat, menyimpan, dan mengelola berbagai jenis QR Code secara mudah melalui antarmuka web yang sederhana dan responsif.

---

## Tujuan

1. Mengimplementasikan framework Laravel dalam pengembangan aplikasi web
2. Menerapkan konsep autentikasi pengguna menggunakan Laravel Breeze
3. Mengimplementasikan operasi CRUD pada data QR Code
4. Menerapkan relasi database antara tabel pengguna dan tabel QR Code
5. Menghasilkan QR Code yang dapat di-scan menggunakan kamera smartphone
6. Mengimplementasikan fitur upload file untuk QR pembayaran

---

## Fitur Aplikasi

### Jenis QR Code yang Tersedia

| Jenis | Keterangan |
|-------|------------|
| Website / URL | Membuat QR Code yang mengarah ke alamat website |
| Instagram | Membuat QR Code yang membuka profil Instagram |
| WhatsApp | Membuat QR Code yang membuka percakapan WhatsApp |
| Email | Membuat QR Code yang membuka aplikasi email |
| WiFi | Membuat QR Code untuk koneksi WiFi otomatis |
| Payment | Membuat kartu pembayaran digital dengan QR resmi e-wallet |
| Teks Bebas | Membuat QR Code berisi teks apapun |
| Nomor Telepon | Membuat QR Code berisi nomor telepon |

### Fitur Sistem

- Registrasi dan login pengguna
- Dashboard dengan statistik QR Code
- Riwayat semua QR Code yang pernah dibuat
- Melihat ulang QR Code dari riwayat
- Menghapus QR Code dari riwayat
- Mengunduh QR Code dalam format PNG
- Generate kartu pembayaran yang dapat di-print atau di-screenshot
- Manajemen profil pengguna

---

## Teknologi yang Digunakan

| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| PHP | 8.2+ | Bahasa pemrograman backend |
| Laravel | 11.x | Framework PHP |
| Bootstrap | 5.3.2 | Framework CSS untuk tampilan |
| Bootstrap Icons | 1.11.3 | Library ikon |
| SQLite | - | Database |
| SimpleSoftwareIO/QrCode | 4.x | Library generate QR Code |
| Laravel Breeze | - | Scaffolding autentikasi |

---

## Struktur Database

### Tabel `users`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| name | string | Nama lengkap pengguna |
| email | string | Alamat email pengguna |
| password | string | Password terenkripsi |

### Tabel `qr_code_generators`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| user_id | bigint | Foreign key ke tabel users |
| qr_type | string | Jenis QR Code |
| qr_content | text | Konten yang di-encode ke dalam QR |
| qr_image | string | Path gambar (nullable) |

### Tabel `payment_profiles`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| user_id | bigint | Foreign key ke tabel users |
| slug | string | Identifikasi unik profil |
| platform | string | Platform pembayaran (DANA, GoPay, dll) |
| nomor | string | Nomor HP atau rekening |
| nama | string | Nama pemilik akun |
| nominal | integer | Nominal pembayaran (nullable) |
| qr_image | string | Path gambar QR dari e-wallet |

---

## Alur Aplikasi

```
Pengguna melakukan registrasi atau login
                |
           Dashboard
                |
      Memilih jenis QR Code
                |
        Mengisi formulir
                |
     Generate QR Code
                |
  Download atau print hasil QR
```

### Alur Fitur Payment

```
Pengguna mengisi form payment
dan mengupload screenshot QR dari e-wallet
                |
    Data disimpan ke database
                |
    Kartu payment di-generate
                |
  Print, screenshot, atau share kartu
                |
  Penerima scan QR di kartu untuk bayar
```

---

## Cara Instalasi

### Kebutuhan Sistem
- PHP >= 8.2
- Composer
- Node.js dan NPM

### Langkah Instalasi

**1. Clone repository**
```bash
git clone https://github.com/sulttaann/qr-code-generator.git
cd qr-code-generator
```

**2. Install dependensi PHP**
```bash
composer install
```

**3. Salin file environment**
```bash
cp .env.example .env
```

**4. Generate application key**
```bash
php artisan key:generate
```

**5. Jalankan migrasi database**
```bash
php artisan migrate
```

**6. Buat symlink storage**
```bash
php artisan storage:link
```

**7. Jalankan server**
```bash
php artisan serve
```

Buka `http://127.0.0.1:8000` di browser.

---

## Struktur Direktori

```
qr-code-generator/
├── app/
│   ├── Http/Controllers/
│   │   ├── QrCodeGeneratorController.php
│   │   ├── PaymentProfileController.php
│   │   └── ProfileController.php
│   └── Models/
│       ├── QrCodeGenerator.php
│       ├── PaymentProfile.php
│       └── User.php
├── database/
│   └── migrations/
├── resources/
│   └── views/
│       ├── layouts/
│       ├── qr_codes/
│       ├── payment/
│       └── profile/
└── routes/
    └── web.php
```

---

## Lisensi

Proyek ini dikembangkan untuk keperluan tugas akademik mata kuliah Pemrograman Web 2, Program Studi Sistem Informasi, Universitas Malikussaleh.
