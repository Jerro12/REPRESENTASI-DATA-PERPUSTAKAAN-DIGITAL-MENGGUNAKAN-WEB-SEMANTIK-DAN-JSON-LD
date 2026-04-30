<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Book;

$cleanQ = "matematika diskrit itb";
$smartAuthor = "prof arya";

$booksQuery = Book::query();
$words = array_filter(explode(' ', $cleanQ));
$booksQuery->where(function ($query) use ($words) {
    foreach ($words as $word) {
        $query->where(function ($q) use ($word) {
            $q->where('judul', 'like', "%$word%")
              ->orWhere('penulis', 'like', "%$word%")
              ->orWhere('deskripsi', 'like', "%$word%")
              ->orWhere('penerbit', 'like', "%$word%")
              ->orWhere('isbn', 'like', "%$word%")
              ->orWhere('subjek', 'like', "%$word%");
        });
    }
});

if ($smartAuthor) {
    $booksQuery->where('penulis', 'like', '%' . $smartAuthor . '%');
}

echo "Query: " . $booksQuery->toSql() . "\n";
echo "Bindings: " . json_encode($booksQuery->getBindings()) . "\n";

$books = $booksQuery->get();
echo "Count: " . $books->count() . "\n";
foreach($books as $b) {
    echo "- " . $b->judul . " | " . $b->penulis . " | " . $b->penerbit . "\n";
}
