<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

Auth::loginUsingId(1); // Login as admin or user 1

function simRequest($url) {
    echo "Simulating $url\n";
    $request = Illuminate\Http\Request::create($url, 'GET');
    $response = app()->handle($request);
    $content = $response->getContent();
    
    if (preg_match('/Buku Tidak Ditemukan/', $content)) {
        echo "--> BUKU TIDAK DITEMUKAN (0 results)\n";
    } else {
        preg_match_all('/<h3 class="font-bold text-lg leading-tight line-clamp-2[^>]*>(.*?)<\/h3>/s', $content, $matches);
        if(!empty($matches[1])) {
            echo "--> FOUND " . count($matches[1]) . " BOOKS:\n";
            foreach($matches[1] as $title) {
                echo "   - " . trim(strip_tags($title)) . "\n";
            }
        } else {
            echo "--> NO BOOKS RENDERED. Response length: " . strlen($content) . "\n";
            if ($response->getStatusCode() != 200) {
                echo "--> HTTP STATUS: " . $response->getStatusCode() . "\n";
            }
        }
    }
    echo "---------------------------\n";
}

simRequest('/katalog?q=Tolong+tampilkan+buku+sistem+informasi+yang+terbit+tahun+2020');
simRequest('/katalog?q=Saya+butuh+buku+vintage+karya+Budi+Rahardjo');
simRequest('/katalog?q=Info+dong+buku+pemrograman+web+bestseller');
