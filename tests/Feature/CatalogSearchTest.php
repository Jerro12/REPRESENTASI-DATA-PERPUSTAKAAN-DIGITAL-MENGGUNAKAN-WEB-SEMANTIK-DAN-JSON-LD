<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Book;

class CatalogSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalog_requires_authentication(): void
    {
        $response = $this->get('/katalog');

        $response->assertRedirect(route('login'));
    }

    public function test_catalog_can_be_rendered_with_auth(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/katalog');

        $response->assertStatus(200);
        $response->assertSee('PerpusSearch');
    }

    public function test_catalog_semantic_search_extracts_entities(): void
    {
        $user = User::factory()->create();

        $category = Category::create([
            'nama' => 'Sejarah',
            'deskripsi' => 'Buku sejarah',
            'collection_type' => 'Book',
            'schema_about' => 'History',
            'is_active' => true,
        ]);

        $book = Book::create([
            'kode_buku' => 'B001',
            'judul' => 'Perang Pasifik',
            'penulis' => 'Jerro',
            'penerbit' => 'Erlangga',
            'tahun_terbit' => 2020,
            'isbn' => '978-602-1234-56-7',
            'bahasa' => 'Indonesia',
            'category_id' => $category->id,
            'deskripsi' => 'Buku tentang perang pasifik.',
            'status' => 'aktif',
        ]);

        // Search with semantic mode
        $response = $this->actingAs($user)->get('/katalog?q=novel sejarah tahun 2020&mode=semantic');

        $response->assertStatus(200);
        $response->assertSee('Hasil Ekstraksi Semantik');
        $response->assertSee('Sejarah');
        $response->assertSee('2020');
    }

    public function test_catalog_regular_search_does_literal_match(): void
    {
        $user = User::factory()->create();

        $category = Category::create([
            'nama' => 'Sains',
            'deskripsi' => 'Buku sains',
            'collection_type' => 'Book',
            'schema_about' => 'Science',
            'is_active' => true,
        ]);

        $book = Book::create([
            'kode_buku' => 'B002',
            'judul' => 'Dasar Fisika',
            'penulis' => 'Jerro',
            'penerbit' => 'Erlangga',
            'tahun_terbit' => 2021,
            'isbn' => '978-602-1234-56-8',
            'bahasa' => 'Indonesia',
            'category_id' => $category->id,
            'deskripsi' => 'Buku dasar fisika.',
            'status' => 'aktif',
        ]);

        // Search with regular mode
        $response = $this->actingAs($user)->get('/katalog?q=Fisika&mode=regular');

        $response->assertStatus(200);
        // Should not see the semantic extraction card
        $response->assertDontSee('Hasil Ekstraksi Semantik');
        $response->assertSee('Dasar Fisika');
    }
}
