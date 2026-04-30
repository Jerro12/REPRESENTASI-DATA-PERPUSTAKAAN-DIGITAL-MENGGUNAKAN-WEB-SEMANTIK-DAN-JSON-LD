<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Book;
$b = Book::where('judul', 'like', '%Kalkulus%')->first();
var_dump($b->deleted_at);
var_dump($b->penerbit);
