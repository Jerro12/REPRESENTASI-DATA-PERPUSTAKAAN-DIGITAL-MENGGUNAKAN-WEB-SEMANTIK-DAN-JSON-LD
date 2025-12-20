<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            // Menentukan tipe koleksi untuk JSON-LD
            $table->enum('collection_type', ['Book', 'ScholarlyArticle'])
                ->default('Book')
                ->after('deskripsi');

            // Metadata tambahan untuk schema.org (about/genre)
            $table->string('schema_about')
                ->nullable()
                ->after('collection_type');

            // Status kategori
            $table->boolean('is_active')
                ->default(true)
                ->after('schema_about');
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn([
                'collection_type',
                'schema_about',
                'is_active',
            ]);
        });
    }
};