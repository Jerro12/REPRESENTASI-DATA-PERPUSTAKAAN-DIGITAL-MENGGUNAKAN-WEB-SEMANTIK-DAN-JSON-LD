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

<div class="mt-16 w-full -mx-4 sm:-mx-6 lg:-mx-8 bg-[#FFFFFF] border-y border-[#F1F5F9] py-14 text-[#718096]">
    <div class="text-center w-full px-6 sm:px-12">
        <!-- Section Title -->
        <div class="mb-10">
            <h2 class="text-2xl sm:text-3xl font-bold text-[#1A202C]">
                Kategori Populer
            </h2>
            <p class="text-[#718096] mt-2">
                Kategori dengan koleksi buku terbanyak di perpustakaan digital
            </p>
        </div>

        <!-- Category Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($categories as $category)
                <div class="bg-[#FFFFFF] border border-[#F1F5F9] shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] rounded-lg shadow hover:shadow-md transition p-6">
                    <h3 class="text-lg font-semibold mb-2 text-[#1A202C]">
                        {{ $category->nama }}
                    </h3>

                    <p class="text-sm text-[#718096] mb-3">
                        {{ $category->deskripsi ?? '-' }}
                    </p>

                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-[#1DC2FE]">
                            {{ $category->books_count }} Buku
                        </span>

                        <!-- Placeholder link -->
                        <span class="text-sm text-[#718096] italic">
                            Lihat Koleksi
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-[#718096]">
                    Belum ada kategori tersedia.
                </div>
            @endforelse
        </div>
    </div>
</div>