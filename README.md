# QR Code Generator

Aplikasi web QR Code Generator berbasis **Laravel 11** dan **Bootstrap 5**. Aplikasi ini memungkinkan pengguna untuk membuat berbagai jenis QR Code yang dapat di-scan langsung menggunakan kamera smartphone.

---

## Fitur Utama

### Jenis QR Code
| Jenis | Keterangan |
|-------|------------|
| Website / URL | Generate QR untuk link website |
| Instagram | Generate QR yang membuka profil Instagram |
| WhatsApp | Generate QR yang membuka chat WhatsApp langsung |
| Email | Generate QR yang membuka aplikasi email |
| WiFi | Generate QR untuk koneksi WiFi otomatis |
| Payment | Generate kartu pembayaran dengan QR resmi dari e-wallet |
| Teks Bebas | Generate QR untuk teks apapun |
| Nomor Telepon | Generate QR untuk nomor telepon |

### Fitur Aplikasi
- Autentikasi pengguna (Register, Login, Logout)
- Dashboard dengan statistik QR Code
- History semua QR Code yang pernah dibuat
- Lihat ulang QR Code dari history
- Hapus QR Code dari history
- Download QR Code sebagai file PNG
- Kartu Payment yang bisa di-print atau di-screenshot
- Manajemen profil pengguna (nama, email, password)

---

## Teknologi yang Digunakan

| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| PHP | 8.2+ | Bahasa pemrograman backend |
| Laravel | 11.x | Framework PHP |
| Bootstrap | 5.3.2 | Framework CSS |
| Bootstrap Icons | 1.11.3 | Library ikon |
| SQLite / MySQL | - | Database |
| SimpleSoftwareIO/QrCode | 4.x | Library generate QR Code |
| Laravel Breeze | - | Scaffolding autentikasi |

---

## Kebutuhan Sistem

- PHP >= 8.2
- Composer
- Node.js dan NPM
- SQLite atau MySQL

---

## Cara Instalasi

### 1. Clone repository
```bash
git clone https://github.com/YOUR_USERNAME/qr-code-generator.git
cd qr-code-generator
```

### 2. Install dependensi PHP
```bash
composer install
```

### 3. Salin file environment
```bash
cp .env.example .env
```

### 4. Generate application key
```bash
php artisan key:generate
```

### 5. Konfigurasi database
Buka file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=sqlite
```
Atau untuk MySQL:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=qr_generator
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Jalankan migrasi database
```bash
php artisan migrate
```

### 7. Buat symlink storage
```bash
php artisan storage:link
```

### 8. Jalankan server
```bash
php artisan serve
```

Buka `http://127.0.0.1:8000` di browser.

---

## Struktur Proyek

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
├── database/migrations/
│   ├── create_users_table.php
│   ├── create_qr_code_generators_table.php
│   └── create_payment_profiles_table.php
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php
│   │   └── guest.blade.php
│   ├── qr_codes/
│   │   ├── create.blade.php
│   │   ├── result.blade.php
│   │   └── index.blade.php
│   ├── payment/
│   │   └── result.blade.php
│   ├── dashboard.blade.php
│   └── welcome.blade.php
└── routes/
    └── web.php
```

---

## Skema Database

### Tabel `users`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| name | string | Nama lengkap pengguna |
| email | string | Email pengguna (unik) |
| password | string | Password terenkripsi |

### Tabel `qr_code_generators`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| user_id | bigint | Foreign key ke tabel users |
| qr_type | string | Jenis QR (url, whatsapp, wifi, dll) |
| qr_content | text | Konten yang di-encode ke QR |
| qr_image | string | Path gambar (nullable) |

### Tabel `payment_profiles`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| user_id | bigint | Foreign key ke tabel users |
| slug | string | Identifikasi unik |
| platform | string | Platform pembayaran (DANA, GoPay, dll) |
| nomor | string | Nomor HP atau rekening |
| nama | string | Nama pemilik akun |
| nominal | integer | Nominal pembayaran (nullable) |
| qr_image | string | Path gambar QR dari e-wallet |

---

## Alur Aplikasi

```
Pengguna Register / Login
          |
      Dashboard
          |
   Pilih Jenis QR
          |
     Isi Formulir
          |
  Generate QR Code
          |
  Download / Print
```

### Alur Payment
```
Isi form payment + Upload screenshot QR dari e-wallet
          |
   Data disimpan ke database
          |
   Kartu payment di-generate
          |
   Print / Screenshot / Share
          |
   Orang scan QR di kartu -> Bayar langsung
```

---

## Informasi Proyek

- **Framework**: Laravel 11
- **Mata Kuliah**: Pemrograman Web
- **Tahun**: 2026

---

## Lisensi

Proyek ini bersifat open-source dan tersedia di bawah [MIT License](LICENSE).
