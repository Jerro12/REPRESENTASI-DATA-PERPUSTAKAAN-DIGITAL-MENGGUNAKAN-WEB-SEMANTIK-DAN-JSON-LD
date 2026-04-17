<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$book1 = App\Models\Book::where('judul', 'like', '%sistem informasi rumah sakit%')->first();
$book2 = App\Models\Book::where('judul', 'like', '%pemrograman web%')->first();
$book3 = App\Models\Book::where('judul', 'like', '%vintage%')->first(); // wait, there's no vintage book, it's just "kriptografi"

echo "Book 1 (Sistem Informasi): Category ID = " . ($book1 ? $book1->category_id : 'null') . "\n";
echo "Book 2 (Pemrograman Web): Category ID = " . ($book2 ? $book2->category_id : 'null') . "\n";

$cat1 = App\Models\Category::where('nama', 'Sistem Informasi')->first();
$cat2 = App\Models\Category::where('nama', 'Pemrograman Web')->first();

echo "Cat 1 ID: " . ($cat1 ? $cat1->id : 'null') . "\n";
echo "Cat 2 ID: " . ($cat2 ? $cat2->id : 'null') . "\n";

