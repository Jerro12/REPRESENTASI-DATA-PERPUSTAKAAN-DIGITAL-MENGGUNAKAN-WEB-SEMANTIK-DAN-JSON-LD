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
Karena proyek ini menggunakan **Laravel Scout** dengan **TNTSearch** dan **Sastrawi**, Kamu wajib membangun index pencarian agar fitur pencarian cerdas berfungsi:

```bash
php artisan scout:import "App\Models\Book"
```

Jika kamu menambah data dalam jumlah besar langsung melalui database (bukan lewat aplikasi), jalankan perintah di atas kembali untuk menyegarkan index.
