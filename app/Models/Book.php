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

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Accessor untuk JSON-LD
    public function getCollectionTypeAttribute()
    {
        return $this->category ? $this->category->collection_type : null;
    }

    public function getSchemaAboutAttribute()
    {
        return $this->subjek ?? ($this->category ? $this->category->schema_about : null);
    }

    public function favoredByUsers()
    {
        return $this->belongsToMany(User::class, 'book_user')->withTimestamps();
    }

    /**
     * Generate JSON-LD for the book/article
     */
    public function toJsonLd()
    {
        $type = $this->category->collection_type ?? 'Book';
        
        $data = [
            '@type' => $type,
            'name' => $this->judul,
            'author' => [
                '@type' => 'Person',
                'name' => $this->penulis,
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => $this->penerbit ?: 'SMA 4 Pinrang',
            ],
            'datePublished' => $this->tahun_terbit,
            'description' => $this->deskripsi,
            'inLanguage' => $this->bahasa,
        ];

        if ($type === 'Book') {
            $data['isbn'] = $this->isbn;
            $data['numberOfPages'] = $this->jumlah_halaman;
        }

        if ($this->subjek) {
            $data['about'] = $this->subjek;
        }

        if ($this->cover) {
            $data['image'] = asset('storage/' . $this->cover);
        }

        if ($this->file_path) {
            $data['url'] = asset('storage/' . $this->file_path);
        }

        return $data;
    }
}
