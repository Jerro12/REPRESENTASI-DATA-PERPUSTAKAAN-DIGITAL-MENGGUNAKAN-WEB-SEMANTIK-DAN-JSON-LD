## Installation Steps

Jalankan perintah berikut di terminal:

```bash
git clone https://github.com/username/nama-project.git
cd nama-project
composer install
cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpustakaan
DB_USERNAME=root
DB_PASSWORD=
php artisan key:generate
php artisan migrate
npm install
npm run dev
php artisan serve
```

### Penting: Sinkronisasi Mesin Pencari
Karena proyek ini menggunakan **Laravel Scout** dengan **TNTSearch** dan **Sastrawi** (termasuk fitur *Fuzzy Search* toleransi *typo*), Anda wajib membangun index pencarian agar fitur pencarian cerdas berfungsi:

1. **Clear Cache Konfigurasi** (Wajib dilakukan jika ada perubahan pada file konfigurasi seperti `config/scout.php`):
```bash
php artisan optimize:clear
```

2. **Import Data ke Search Engine**:
```bash
php artisan scout:import "App\Models\Book"
```

3. **(Opsional) Flush Index**
Jika sewaktu-waktu Anda ingin menghapus dan mereset index lama secara paksa sebelum melakukan import ulang:
```bash
php artisan scout:flush "App\Models\Book"
```

---

### Cara Mengambil Update Terbaru dari Git (Untuk Rekan Tim)
Jika ada update terbaru dari *repository* Git dan Anda ingin menimpa perubahan lokal yang ada di komputer Anda secara paksa agar kembali persis seperti yang ada di Git, jalankan urutan perintah berikut:

```bash
git fetch origin
git reset --hard origin/main
```
*(Tambahkan `git clean -fd` jika ingin menghapus file-file testing baru yang belum di-commit).*

Setelah melakukan *update*, sangat disarankan untuk menyegarkan kembali pencarian dengan perintah:
```bash
php artisan optimize:clear
php artisan scout:import "App\Models\Book"
```
