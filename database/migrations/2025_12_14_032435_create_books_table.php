<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            // Identitas buku
            $table->string('kode_buku')->unique();
            $table->string('judul');
            $table->string('penulis');
            $table->string('penerbit')->nullable();
            $table->year('tahun_terbit')->nullable();
            $table->string('isbn')->nullable()->unique();
            $table->string('bahasa')->nullable();

            // Relasi kategori
            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();

            // Deskripsi
            $table->text('deskripsi')->nullable();
            $table->string('subjek')->nullable();

            // Buku digital
            $table->string('file_path')->nullable();
            $table->string('cover')->nullable();

            // Status
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->integer('jumlah_halaman')->nullable();

            // Audit
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
