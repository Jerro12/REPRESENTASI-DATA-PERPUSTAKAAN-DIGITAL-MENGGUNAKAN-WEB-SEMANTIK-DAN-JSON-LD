<?php

namespace App\Helpers;

use App\Models\Book;
use Illuminate\Support\Collection;

class SchemaHelper
{
    public static function getLibrarySchema(Collection $books = null)
    {
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "Library",
            "name" => "Perpustakaan Digital SMA 4 Pinrang",
            "url" => url('/'),
            "logo" => asset('logo.png'), // Optional logo
            "location" => [
                "@type" => "PostalAddress",
                "streetAddress" => "2JJ8+MC6, Watang Suppa, Kec. Suppa",
                "addressLocality" => "Pinrang",
                "addressRegion" => "Sulawesi Selatan",
                "postalCode" => "91272",
                "addressCountry" => "ID"
            ],
            "description" => "Sistem Informasi Perpustakaan Digital SMA 4 Pinrang. Berbasis Web Semantik & JSON-LD untuk memfasilitasi kebutuhan literasi masa depan.",
        ];

        if ($books && $books->count() > 0) {
            $schema['hasPart'] = $books->map(function (Book $book) {
                return $book->toJsonLd();
            })->values()->all();
        }

        return $schema;
    }

    public static function getBookSchema(Book $book)
    {
        $bookSchema = $book->toJsonLd();
        $bookSchema['@context'] = "https://schema.org";
        return $bookSchema;
    }
}
