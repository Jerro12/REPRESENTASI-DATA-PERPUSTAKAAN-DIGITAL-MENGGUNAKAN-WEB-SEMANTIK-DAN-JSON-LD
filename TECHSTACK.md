# Tech Stack - Perpustakaan Digital (Semantic Search Edition)

Dokumen ini merangkum seluruh teknologi yang digunakan dalam pengembangan aplikasi Perpustakaan Digital ini.

## 🛠 Backend (Inti Aplikasi)
- **Framework**: [Laravel 12.x](https://laravel.com/) - Framework PHP modern dengan arsitektur MVC yang kuat dan aman.
- **Bahasa Pemrograman**: PHP 8.2+
- **Database**: MySQL / MariaDB (via Laragon)
- **Authentication**: [Laravel Breeze](https://laravel.com/docs/12.x/starter-kits#laravel-breeze) - Sistem login, registrasi, dan manajemen profil yang ringan dan aman.
- **Roles & Permissions**: [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission/v6/introduction) - Manajemen hak akses user (Admin vs Petugas vs Anggota).

## 🔍 Search Engine (Sistem Pencarian Cerdas)
Ini adalah fitur unggulan aplikasi ini yang menggabungkan beberapa teknologi:
- **Laravel Scout**: Driver pencarian tingkat lanjut untuk Laravel.
- **TNTSearch Driver**: Search engine *full-text* berbasis database lokal yang sangat cepat tanpa ketergantungan layanan luar.
- **Sastrawi (Stemmer)**: Library NLP (Natural Language Processing) khusus Bahasa Indonesia untuk memproses kata dasar.
- **NLP Logic**: Logika kustom untuk ekstraksi entitas (tahun, penulis, kategori) langsung dari kalimat pencarian (SearchEngineCOntroller).

## 🌐 Semantic Web & SEO
- **JSON-LD**: Implementasi data terstruktur sesuai standar [Schema.org](https://schema.org/) untuk entitas `Book` dan `Breadcrumbs`.
- **Metadata Search**: Optimasi metadata dinamis untuk setiap hasil pencarian guna meningkatkan visibilitas di mesin pencari.

## 🎨 Frontend (Tampilan & UI)
- **CSS Framework**: [Tailwind CSS](https://tailwindcss.com/) - Framework CSS utility-first untuk desain UI yang modern, responsif, dan premium.
- **Templating**: Laravel Blade - Sistem templating bawaan Laravel yang efisien.
- **Interactivity**: [Alpine.js](https://alpinejs.dev/) - Framework JavaScript ringan untuk komponen interaktif (dropdown, modal, toggle).
- **Icons**: Lucide Icons / Heroicons.
- **Fonts**: Inter & Figtree (Google Fonts).

## 🚀 Tooling & Dev Environment
- **Local Server**: [Laragon](https://laragon.org/) - Lingkungan pengembangan WAMP yang cepat dan terisolasi.
- **Build Tool**: [Vite](https://vitejs.dev/) - Bundler frontend generasi terbaru untuk performa pengembangan yang kilat.
- **Package Managers**: Composer (PHP) & NPM (Node.js).

---
*Dokumen ini diperbarui secara berkala seiring dengan penambahan fitur baru.*
