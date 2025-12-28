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
