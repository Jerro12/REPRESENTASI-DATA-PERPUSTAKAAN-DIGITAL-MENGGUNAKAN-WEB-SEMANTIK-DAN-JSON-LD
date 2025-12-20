@php
    use App\Models\Category;

    $categories = Category::withCount([
        'books' => function ($query) {
            $query->where('status', 'aktif');
        }
    ])
        ->where('is_active', true)
        ->orderByDesc('books_count')
        ->take(6)
        ->get();
@endphp

<div class="mt-16 bg-gray-50 py-14">
    <div class="max-w-7xl mx-auto px-6 sm:px-12">
        <!-- Section Title -->
        <div class="mb-10 text-center">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">
                Kategori Populer
            </h2>
            <p class="text-gray-600 mt-2">
                Kategori dengan koleksi buku terbanyak di perpustakaan digital
            </p>
        </div>

        <!-- Category Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($categories as $category)
                <div class="bg-white rounded-lg shadow hover:shadow-md transition p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                        {{ $category->nama }}
                    </h3>

                    <p class="text-sm text-gray-600 mb-3">
                        {{ $category->deskripsi }}
                    </p>

                    <div class="flex items-center justify-between">
                        <span class="text-sm text-blue-600 font-medium">
                            {{ $category->books_count }} Buku
                        </span>

                        <!-- Placeholder link -->
                        <span class="text-sm text-gray-400 italic">
                            Lihat Koleksi
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">
                    Belum ada kategori tersedia.
                </div>
            @endforelse
        </div>
    </div>
</div>