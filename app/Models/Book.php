<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'books';

    protected $fillable = [
        'kode_buku',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'bahasa',
        'category_id',
        'deskripsi',
        'subjek',
        'file_path',
        'cover',
        'status',
        'jumlah_halaman',
    ];

    /**
     * Relasi: satu buku milik satu kategori
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
