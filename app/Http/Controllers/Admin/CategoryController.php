<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        // Ambil semua kategori terbaru
        $categories = Category::latest()->get();

        return view('admin.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:categories,nama',
            'deskripsi' => 'nullable|string',
            'collection_type' => 'required|in:Book,ScholarlyArticle',
            'schema_about' => 'nullable|string|max:255',
            // 'is_active' => 'nullable|boolean',
        ]);

        Category::create([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
            'deskripsi' => $request->deskripsi,
            'collection_type' => $request->collection_type,
            'schema_about' => $request->schema_about,
            'is_active' => 1,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:categories,nama,' . $category->id,
            'deskripsi' => 'nullable|string',

            // kolom tambahan
            'collection_type' => 'required|in:Book,ScholarlyArticle',
            'schema_about' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $category->update([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
            'deskripsi' => $request->deskripsi,

            'collection_type' => $request->collection_type,
            'schema_about' => $request->schema_about,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}