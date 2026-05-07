<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Book extends Model
{
    use HasFactory, SoftDeletes, Searchable;


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
        'stok_buku',
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

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
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


    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
        $stemmer = $stemmerFactory->createStemmer();

        // Kita indeks versi aslinya DAN versi kata dasarnya (stemmed) agar pencarian sangat akurat
        $judulStemmed = $stemmer->stem($this->judul);
        $deskripsiStemmed = $stemmer->stem($this->deskripsi);

        return [
            'id' => (int) $this->id,
            'judul' => $this->judul . ' ' . $judulStemmed,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'tahun_terbit' => (int) $this->tahun_terbit,
            'isbn' => $this->isbn,
            'deskripsi' => $this->deskripsi . ' ' . $deskripsiStemmed,
            'subjek' => $this->subjek,
            'category_id' => (int) $this->category_id,
            'kategori' => $this->category ? $this->category->nama : null,
        ];
    }


    /**
     * Helper untuk menyoroti (highlight) kata kunci pencarian pada teks apapun
     */
    public static function highlightText($text, $query, $stemmer = null)
    {
        if (!$query || !$text) return $text;

        if (!$stemmer) {
            $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
            $stemmer = $stemmerFactory->createStemmer();
        }
        
        $words = array_filter(explode(' ', $query));
        
        $searchTerms = [];
        foreach($words as $word) {
            if (strlen($word) < 3) continue;
            $searchTerms[] = $word;
            $stemmed = $stemmer->stem($word);
            if (strlen($stemmed) >= 3 && $stemmed != $word) {
                $searchTerms[] = $stemmed;
            }
        }
        
        usort($searchTerms, function($a, $b) {
            return strlen($b) - strlen($a);
        });
        $searchTerms = array_unique($searchTerms);

        if (empty($searchTerms)) return $text;

        $pattern = '/(' . implode('|', array_map(fn($t) => preg_quote($t, '/'), $searchTerms)) . ')/i';
        // Gunakan inline style agar tidak terkena purge Tailwind
        return preg_replace($pattern, '<mark style="background-color: #fef08a; color: #000; padding: 0 2px; border-radius: 4px;">$1</mark>', $text);
    }

    public function getHighlighted($field, $query)
    {
        $text = $this->{$field} ?? '';
        if (!$query || empty($text)) return $text;

        $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
        $stemmer = $stemmerFactory->createStemmer();

        $words = array_filter(explode(' ', $query));
        $searchTerms = [];
        foreach($words as $word) {
            if (strlen($word) < 3) continue;
            $searchTerms[] = $word;
            $stemmed = $stemmer->stem($word);
            if (strlen($stemmed) >= 3 && $stemmed != $word) {
                $searchTerms[] = $stemmed;
            }
        }

        // Ambil potongan teks untuk deskripsi (lebih pendek agar muat di 2 baris kartu)
        if ($field === 'deskripsi' && strlen($text) > 120) {
            $foundPos = -1;
            foreach ($searchTerms as $term) {
                $pos = stripos($text, $term);
                if ($pos !== false) {
                    $foundPos = $pos;
                    break;
                }
            }

            if ($foundPos !== -1) {
                $start = max(0, $foundPos - 50);
                $text = ($start > 0 ? '...' : '') . mb_substr($text, $start, 120) . '...';
            } else {
                $text = mb_substr($text, 0, 120) . '...';
            }
        }

        return self::highlightText($text, $query, $stemmer);
    }




}


