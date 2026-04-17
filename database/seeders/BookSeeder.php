<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();
        
        // 10 Data Khusus untuk Tes Search Engine (NLP)
        $specificBooks = [
            [
                'kode_buku' => 'BK-S-001',
                'judul' => 'Sejarah Perkembangan Ilmu Komputer dari Masa ke Masa',
                'penulis' => 'Raditya Dika', // Contoh nama fiktif populer untuk tes
                'penerbit' => 'Gramedia Pustaka',
                'tahun_terbit' => 2019,
                'isbn' => '978-602-000-111-1',
                'bahasa' => 'Indonesia',
                'category_id' => Category::where('nama', 'Ilmu Komputer')->first()->id ?? $categories->first()->id,
                'deskripsi' => 'Buku sejarah lengkap mengenai awal mula komputer ditemukan hingga era modern saat ini.',
                'subjek' => 'Ilmu Komputer, Sejarah',
                'file_path' => 'files/sejarah-komputer.pdf',
                'cover' => 'covers/sejarah-komputer.jpg',
                'status' => 'aktif',
                'jumlah_halaman' => 350,
            ],
            [
                'kode_buku' => 'BK-S-002',
                'judul' => 'Kalkulus Lanjut dan Matematika Diskrit',
                'penulis' => 'Prof. Arya Matematika',
                'penerbit' => 'Penerbit ITB',
                'tahun_terbit' => 2021,
                'isbn' => '978-602-000-222-2',
                'bahasa' => 'Indonesia',
                'category_id' => Category::where('nama', 'Matematika Informatika')->first()->id ?? $categories->first()->id,
                'deskripsi' => 'Buku matematika yang sangat relevan dengan komputasi.',
                'subjek' => 'Matematika',
                'file_path' => 'files/kalkulus.pdf',
                'cover' => 'covers/kalkulus.jpg',
                'status' => 'aktif',
                'jumlah_halaman' => 210,
            ],
            [
                'kode_buku' => 'BK-S-003',
                'judul' => 'Mastering Pemrograman Web Fullstack',
                'penulis' => 'Eko Kurniawan',
                'penerbit' => 'Programmer Zaman Now',
                'tahun_terbit' => 2023,
                'isbn' => '978-602-000-333-3',
                'bahasa' => 'Indonesia',
                'category_id' => Category::where('nama', 'Pemrograman Web')->first()->id ?? $categories->first()->id,
                'deskripsi' => 'Buku terbaru untuk belajar teknik dasar hingga profesional framework Laravel & Vue.',
                'subjek' => 'Pemrograman Web',
                'file_path' => 'files/web-fullstack.pdf',
                'cover' => 'covers/web-fullstack.jpg',
                'status' => 'aktif',
                'jumlah_halaman' => 420,
            ],
            [
                'kode_buku' => 'BK-S-004',
                'judul' => 'Machine Learning & Kecerdasan Buatan Terapan',
                'penulis' => 'Tere Liye', // Nama terkenal untuk di-tes "buku penulis tere liye"
                'penerbit' => 'Republika',
                'tahun_terbit' => 2020,
                'isbn' => '978-602-000-444-4',
                'bahasa' => 'Indonesia',
                'category_id' => Category::where('nama', 'Kecerdasan Buatan')->first()->id ?? $categories->first()->id,
                'deskripsi' => 'Pendekatan AI dan implementasi machine learning dengan python.',
                'subjek' => 'Artificial Intelligence',
                'file_path' => 'files/ai-ml.pdf',
                'cover' => 'covers/ai-ml.jpg',
                'status' => 'aktif',
                'jumlah_halaman' => 500,
            ],
            [
                'kode_buku' => 'BK-S-005',
                'judul' => 'Seni Keamanan Jaringan dan Kriptografi',
                'penulis' => 'Budi Rahardjo',
                'penerbit' => 'Informatika Bandung',
                'tahun_terbit' => 2015, // Test pencarian lawas
                'isbn' => '978-602-000-555-5',
                'bahasa' => 'Indonesia',
                'category_id' => Category::where('nama', 'Keamanan Informasi')->first()->id ?? $categories->first()->id,
                'deskripsi' => 'Buku klasik terkait pengamanan firewall dan enkripsi data.',
                'subjek' => 'Keamanan Informasi',
                'file_path' => 'files/kripto.pdf',
                'cover' => 'covers/kripto.jpg',
                'status' => 'aktif',
                'jumlah_halaman' => 300,
            ],
            [
                'kode_buku' => 'BK-S-006',
                'judul' => 'Data Science for Business Insight',
                'penulis' => 'Dwi Handoko',
                'penerbit' => 'Erlangga',
                'tahun_terbit' => 2022,
                'isbn' => '978-602-000-666-6',
                'bahasa' => 'Inggris',
                'category_id' => Category::where('nama', 'Data Science')->first()->id ?? $categories->first()->id,
                'deskripsi' => 'Panduan eksekutif dalam memanfaatkan data analitik.',
                'subjek' => 'Data Science',
                'file_path' => 'files/ds-business.pdf',
                'cover' => 'covers/ds-business.jpg',
                'status' => 'aktif',
                'jumlah_halaman' => 280,
            ],
            [
                'kode_buku' => 'BK-S-007',
                'judul' => 'Manajemen Proyek TI dan Scrum Framework',
                'penulis' => 'Habiburrahman El Shirazy',
                'penerbit' => 'Andi Offset',
                'tahun_terbit' => 2018,
                'isbn' => '978-602-000-777-7',
                'bahasa' => 'Indonesia',
                'category_id' => Category::where('nama', 'Manajemen Proyek TI')->first()->id ?? $categories->first()->id,
                'deskripsi' => 'Metodologi Agile dan teknik SCRUM komprehensif.',
                'subjek' => 'Manajemen Proyek TI',
                'file_path' => 'files/scrum.pdf',
                'cover' => 'covers/scrum.jpg',
                'status' => 'aktif',
                'jumlah_halaman' => 600,
            ],
            [
                'kode_buku' => 'BK-S-008',
                'judul' => 'Don\'t Make Me Think: Revolusi UI/UX',
                'penulis' => 'Steve Krug',
                'penerbit' => 'Elex Media',
                'tahun_terbit' => 2014,
                'isbn' => '978-602-000-888-8',
                'bahasa' => 'Indonesia',
                'category_id' => Category::where('nama', 'Desain UI/UX')->first()->id ?? $categories->first()->id,
                'deskripsi' => 'Dasar usability engineer pada website dan aplikasi mobile.',
                'subjek' => 'Desain UI/UX',
                'file_path' => 'files/ui-ux.pdf',
                'cover' => 'covers/ui-ux.jpg',
                'status' => 'aktif',
                'jumlah_halaman' => 150,
            ],
            [
                'kode_buku' => 'BK-S-009',
                'judul' => 'Etika Sosial dalam Era Literasi Digital',
                'penulis' => 'Fiersa Besari',
                'penerbit' => 'Kawah Media',
                'tahun_terbit' => 2024,
                'isbn' => '978-602-000-999-9',
                'bahasa' => 'Indonesia',
                'category_id' => Category::where('nama', 'Literasi Digital')->first()->id ?? $categories->first()->id,
                'deskripsi' => 'Berkomunikasi santun dan anti hoaks di internet (Buku Terbaru).',
                'subjek' => 'Literasi Digital',
                'file_path' => 'files/literasi.pdf',
                'cover' => 'covers/literasi.jpg',
                'status' => 'aktif',
                'jumlah_halaman' => 180,
            ],
            [
                'kode_buku' => 'BK-S-010',
                'judul' => 'Pemrograman Sistem Informasi Rumah Sakit',
                'penulis' => 'Romi Satria Wahono',
                'penerbit' => 'Ilmukomputer.com',
                'tahun_terbit' => 2020,
                'isbn' => '978-602-000-110-0',
                'bahasa' => 'Indonesia',
                'category_id' => Category::where('nama', 'Sistem Informasi')->first()->id ?? $categories->first()->id,
                'deskripsi' => 'Panduan lengkap merancang SIMRS berbassis web modern.',
                'subjek' => 'Sistem Informasi',
                'file_path' => 'files/simrs.pdf',
                'cover' => 'covers/simrs.jpg',
                'status' => 'aktif',
                'jumlah_halaman' => 460,
            ],
        ];

        foreach ($specificBooks as $book) {
            $existing = Book::where('kode_buku', $book['kode_buku'])->first();
            if ($existing) {
                $existing->update($book);
            } else {
                Book::create($book);
            }
        }

        // Generate tambahan ~40 buku dummy untuk memenuhi paginasi
        $booksDummy = [];
        for ($i = 11; $i <= 50; $i++) {
            $title = "Buku Materi dan Praktikum Kampus " . $i;
            $category = $categories->random(); // pilih kategori random dari CategorySeeder
            $status = ($i % 5 == 0) ? 'nonaktif' : 'aktif'; // beberapa nonaktif sebagai variasi

            $booksDummy[] = [
                'kode_buku' => 'BKS' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'judul' => $title,
                'penulis' => 'Penulis Dosen ' . $i,
                'penerbit' => 'Penerbit Kampus ' . $i,
                'tahun_terbit' => rand(2010, 2024),
                'isbn' => '978-' . rand(10000, 99999) . '-' . rand(1000, 9999) . '-' . rand(0, 9),
                'bahasa' => 'Indonesia',
                'category_id' => $category->id,
                'deskripsi' => 'Modul pembelajaran mahasiswa dan praktikum dari ' . $title,
                'subjek' => $category->nama,
                'file_path' => 'files/bk' . str_pad($i, 3, '0', STR_PAD_LEFT) . '.pdf',
                'cover' => 'covers/bk' . str_pad($i, 3, '0', STR_PAD_LEFT) . '.jpg',
                'status' => $status,
                'jumlah_halaman' => rand(100, 500),
            ];
        }

        foreach ($booksDummy as $book) {
            $existing = Book::where('kode_buku', $book['kode_buku'])->first();
            if ($existing) {
                $existing->update($book);
            } else {
                Book::create($book);
            }
        }
    }
}
