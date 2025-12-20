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

        $books = [];

        // Generate 50 buku dummy
        for ($i = 1; $i <= 50; $i++) {
            $title = "Buku Dummy " . $i;
            $category = $categories->random(); // pilih kategori random dari CategorySeeder
            $status = ($i % 3 == 0) ? 'nonaktif' : 'aktif'; // beberapa nonaktif sebagai variasi

            $books[] = [
                'kode_buku' => 'BK' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'judul' => $title,
                'penulis' => 'Penulis ' . $i,
                'penerbit' => 'Penerbit ' . $i,
                'tahun_terbit' => rand(2010, 2025),
                'isbn' => '978-' . rand(10000, 99999) . '-' . rand(1000, 9999) . '-' . rand(0, 9),
                'bahasa' => 'Indonesia',
                'category_id' => $category->id,
                'deskripsi' => 'Deskripsi singkat untuk ' . $title,
                'subjek' => $category->nama,
                'file_path' => 'files/bk' . str_pad($i, 3, '0', STR_PAD_LEFT) . '.pdf',
                'cover' => 'covers/bk' . str_pad($i, 3, '0', STR_PAD_LEFT) . '.jpg',
                'status' => $status,
                'jumlah_halaman' => rand(100, 500),
            ];
        }

        foreach ($books as $book) {
            // Cek apakah kode_buku sudah ada
            $existing = Book::where('kode_buku', $book['kode_buku'])->first();

            if ($existing) {
                $existing->update($book);
            } else {
                Book::create($book);
            }
        }
    }
}
