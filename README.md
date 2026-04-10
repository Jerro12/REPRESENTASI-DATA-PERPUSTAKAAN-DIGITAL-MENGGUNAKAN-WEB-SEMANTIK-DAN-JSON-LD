# 📚 Representasi Data Perpustakaan Digital Menggunakan Web Semantik dan JSON-LD

Aplikasi web perpustakaan digital yang mengimplementasikan teknologi **Web Semantik** dan **JSON-LD** untuk merepresentasikan data koleksi buku secara terstruktur dan mudah dipahami mesin pencari.

Dibangun dengan **Laravel 12**, **Tailwind CSS**, dan **Alpine.js**.

---

## 🛠️ Teknologi yang Digunakan

| Teknologi                 | Versi |
| ------------------------- | ----- |
| PHP                       | ^8.2  |
| Laravel                   | ^12.0 |
| Laravel Breeze            | ^2.3  |
| Spatie Laravel Permission | ^6.23 |
| Vite                      | ^7.0  |
| Tailwind CSS              | ^3.1  |
| Alpine.js                 | ^3.4  |

---

## ✅ Persyaratan Sistem

Pastikan perangkat kamu sudah terinstall:

-   **PHP** >= 8.2
-   **Composer** >= 2.x
-   **Node.js** >= 18.x & **NPM** >= 9.x
-   **MySQL** / **MariaDB** (atau database lain yang didukung Laravel)
-   **Git**

---

## 🚀 Langkah Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/Jerro12/REPRESENTASI-DATA-PERPUSTAKAAN-DIGITAL-MENGGUNAKAN-WEB-SEMANTIK-DAN-JSON-LD.git
cd REPRESENTASI-DATA-PERPUSTAKAAN-DIGITAL-MENGGUNAKAN-WEB-SEMANTIK-DAN-JSON-LD
```

---

### 2. Install Dependensi PHP

```bash
composer install
```

---

### 3. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Kemudian buka file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_kamu
DB_USERNAME=root
DB_PASSWORD=password_kamu
```

---

### 4. Generate Application Key

```bash
php artisan key:generate
```

---

### 5. Jalankan Migrasi Database

Pastikan database sudah dibuat terlebih dahulu, lalu jalankan:

```bash
php artisan migrate
```

Jika ada seeder (data awal), jalankan:

```bash
php artisan db:seed
```

---

### 6. Install Dependensi Node.js

```bash
npm install
```

---

### 7. Build Asset Frontend

Untuk **production**:

```bash
npm run build
```

---

### 8. Jalankan Aplikasi

#### Cara Cepat (semua service sekaligus):

```bash
composer run dev
```

Perintah ini akan menjalankan secara bersamaan:

-   PHP development server
-   Queue listener
-   Laravel Pail (log viewer)
-   Vite dev server

#### Cara Manual (terpisah):

Buka **dua terminal** berbeda:

**Terminal 1 — Backend:**

```bash
php artisan serve
```

**Terminal 2 — Frontend:**

```bash
npm run dev
```

---

### 9. Akses Aplikasi

Buka browser dan akses:

```
http://localhost:8000
```

---

## ⚡ Instalasi Cepat (One Command)

Kamu juga bisa menjalankan semua langkah setup sekaligus:

```bash
composer run setup
```

Perintah ini akan otomatis menjalankan:

-   `composer install`
-   Menyalin `.env.example` → `.env`
-   Generate application key
-   Migrasi database
-   `npm install`
-   `npm run build`

> ⚠️ **Catatan:** Pastikan konfigurasi database di `.env` sudah benar sebelum menjalankan perintah ini.

---

## 🧪 Menjalankan Test

```bash
composer run test
```

---

## 📁 Struktur Direktori Utama

```
├── app/                  # Logic aplikasi (Models, Controllers, dll)
├── database/
│   ├── migrations/       # File migrasi database
│   └── seeders/          # Data awal database
├── public/               # Asset publik
├── resources/
│   ├── views/            # Template Blade
│   └── js/               # File JavaScript
├── routes/               # Definisi routing
├── .env.example          # Template konfigurasi environment
├── composer.json
└── package.json
```

---

## 👤 Role & Permission

Aplikasi ini menggunakan **Spatie Laravel Permission** untuk manajemen hak akses pengguna. Role dan permission dapat dikonfigurasi melalui seeder atau panel admin.

---

## 📄 Lisensi

Proyek ini menggunakan lisensi **MIT**.
