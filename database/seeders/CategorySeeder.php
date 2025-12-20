<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'nama' => 'Ilmu Komputer',
                'slug' => Str::slug('Ilmu Komputer'),
                'deskripsi' => 'Kategori buku tentang TI dan Sistem Informasi',
                'collection_type' => 'Book',
                'schema_about' => 'TI, Sistem Informasi',
                'is_active' => true,
            ],
            [
                'nama' => 'Teknologi Informasi',
                'slug' => Str::slug('Teknologi Informasi'),
                'deskripsi' => 'Kategori buku tentang teknologi dan komputasi modern',
                'collection_type' => 'Book',
                'schema_about' => 'Teknologi, Komputasi',
                'is_active' => true,
            ],
            [
                'nama' => 'Sistem Informasi',
                'slug' => Str::slug('Sistem Informasi'),
                'deskripsi' => 'Kategori buku tentang sistem informasi dan manajemen data',
                'collection_type' => 'Book',
                'schema_about' => 'Sistem Informasi, Data',
                'is_active' => true,
            ],
            [
                'nama' => 'Rekayasa Perangkat Lunak',
                'slug' => Str::slug('Rekayasa Perangkat Lunak'),
                'deskripsi' => 'Kategori buku tentang pengembangan perangkat lunak',
                'collection_type' => 'Book',
                'schema_about' => 'Software Engineering',
                'is_active' => true,
            ],
            [
                'nama' => 'Jaringan Komputer',
                'slug' => Str::slug('Jaringan Komputer'),
                'deskripsi' => 'Kategori buku tentang jaringan dan komunikasi data',
                'collection_type' => 'Book',
                'schema_about' => 'Jaringan, Networking',
                'is_active' => true,
            ],
            [
                'nama' => 'Keamanan Informasi',
                'slug' => Str::slug('Keamanan Informasi'),
                'deskripsi' => 'Kategori buku tentang keamanan data dan sistem',
                'collection_type' => 'Book',
                'schema_about' => 'Cyber Security',
                'is_active' => true,
            ],
            [
                'nama' => 'Basis Data',
                'slug' => Str::slug('Basis Data'),
                'deskripsi' => 'Kategori buku tentang database dan pengolahan data',
                'collection_type' => 'Book',
                'schema_about' => 'Database, Data Management',
                'is_active' => true,
            ],
            [
                'nama' => 'Kecerdasan Buatan',
                'slug' => Str::slug('Kecerdasan Buatan'),
                'deskripsi' => 'Kategori buku tentang AI dan machine learning',
                'collection_type' => 'Book',
                'schema_about' => 'Artificial Intelligence',
                'is_active' => true,
            ],
            [
                'nama' => 'Data Science',
                'slug' => Str::slug('Data Science'),
                'deskripsi' => 'Kategori buku tentang analisis dan pengolahan data',
                'collection_type' => 'Book',
                'schema_about' => 'Data Science, Analytics',
                'is_active' => true,
            ],
            [
                'nama' => 'Pemrograman Web',
                'slug' => Str::slug('Pemrograman Web'),
                'deskripsi' => 'Kategori buku tentang pengembangan aplikasi web',
                'collection_type' => 'Book',
                'schema_about' => 'Web Development',
                'is_active' => true,
            ],
            [
                'nama' => 'Pemrograman Mobile',
                'slug' => Str::slug('Pemrograman Mobile'),
                'deskripsi' => 'Kategori buku tentang pengembangan aplikasi mobile',
                'collection_type' => 'Book',
                'schema_about' => 'Mobile Development',
                'is_active' => true,
            ],
            [
                'nama' => 'Algoritma dan Struktur Data',
                'slug' => Str::slug('Algoritma dan Struktur Data'),
                'deskripsi' => 'Kategori buku tentang algoritma dan struktur data',
                'collection_type' => 'Book',
                'schema_about' => 'Algoritma, Struktur Data',
                'is_active' => true,
            ],
            [
                'nama' => 'Matematika Informatika',
                'slug' => Str::slug('Matematika Informatika'),
                'deskripsi' => 'Kategori buku tentang matematika untuk komputasi',
                'collection_type' => 'Book',
                'schema_about' => 'Matematika, Informatika',
                'is_active' => true,
            ],
            [
                'nama' => 'Statistika',
                'slug' => Str::slug('Statistika'),
                'deskripsi' => 'Kategori buku tentang statistika dan probabilitas',
                'collection_type' => 'Book',
                'schema_about' => 'Statistika, Probabilitas',
                'is_active' => true,
            ],
            [
                'nama' => 'Manajemen Proyek TI',
                'slug' => Str::slug('Manajemen Proyek TI'),
                'deskripsi' => 'Kategori buku tentang pengelolaan proyek teknologi informasi',
                'collection_type' => 'Book',
                'schema_about' => 'Manajemen Proyek',
                'is_active' => true,
            ],
            [
                'nama' => 'E-Government',
                'slug' => Str::slug('E-Government'),
                'deskripsi' => 'Kategori buku tentang sistem pemerintahan berbasis elektronik',
                'collection_type' => 'Book',
                'schema_about' => 'E-Government, Digital Government',
                'is_active' => true,
            ],
            [
                'nama' => 'Hukum Teknologi Informasi',
                'slug' => Str::slug('Hukum Teknologi Informasi'),
                'deskripsi' => 'Kategori buku tentang hukum dan regulasi teknologi informasi',
                'collection_type' => 'Book',
                'schema_about' => 'Hukum TI',
                'is_active' => true,
            ],
            [
                'nama' => 'Desain UI/UX',
                'slug' => Str::slug('Desain UI/UX'),
                'deskripsi' => 'Kategori buku tentang desain antarmuka dan pengalaman pengguna',
                'collection_type' => 'Book',
                'schema_about' => 'UI/UX Design',
                'is_active' => true,
            ],
            [
                'nama' => 'Multimedia',
                'slug' => Str::slug('Multimedia'),
                'deskripsi' => 'Kategori buku tentang media digital dan grafika',
                'collection_type' => 'Book',
                'schema_about' => 'Multimedia, Grafika',
                'is_active' => true,
            ],
            [
                'nama' => 'Literasi Digital',
                'slug' => Str::slug('Literasi Digital'),
                'deskripsi' => 'Kategori buku tentang pemahaman dan etika penggunaan teknologi',
                'collection_type' => 'Book',
                'schema_about' => 'Literasi Digital',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            // Cek apakah slug sudah ada
            $existing = Category::where('slug', $category['slug'])->first();

            if ($existing) {
                // Update jika sudah ada
                $existing->update($category);
            } else {
                // Buat baru jika belum ada
                Category::create($category);
            }
        }
    }
}
