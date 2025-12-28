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

<div class="mt-16 w-full -mx-4 sm:-mx-6 lg:-mx-8 bg-[#081e26] py-14 text-white">
    <div class="text-center w-full px-6 sm:px-12">
        <!-- Section Title -->
        <div class="mb-10">
            <h2 class="text-2xl sm:text-3xl font-bold">
                Kategori Populer
            </h2>
            <p class="text-[#cbd5e1] mt-2">
                Kategori dengan koleksi buku terbanyak di perpustakaan digital
            </p>
        </div>

        <!-- Category Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($categories as $category)
                <div class="bg-[#094054] rounded-lg shadow hover:shadow-md transition p-6">
                    <h3 class="text-lg font-semibold mb-2">
                        {{ $category->nama }}
                    </h3>

                    <p class="text-sm text-[#cbd5e1] mb-3">
                        {{ $category->deskripsi ?? '-' }}
                    </p>

                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-[#1dc2fe]">
                            {{ $category->books_count }} Buku
                        </span>

                        <!-- Placeholder link -->
                        <span class="text-sm text-[#cbd5e1] italic">
                            Lihat Koleksi
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-[#cbd5e1]">
                    Belum ada kategori tersedia.
                </div>
            @endforelse
        </div>
    </div>
</div>