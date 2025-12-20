<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'collection_type',
        'schema_about',
        'is_active',
    ];


    /**
     * Relasi: satu kategori memiliki banyak buku
     */
    public function books()
    {
        return $this->hasMany(Book::class, 'category_id');
    }
}