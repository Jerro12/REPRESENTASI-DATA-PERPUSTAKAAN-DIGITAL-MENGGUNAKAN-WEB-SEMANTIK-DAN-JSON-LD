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

    // Map untuk attach cover satu per satu (hindari n+1 problem berat dengan query simple loop karena cuma 6 item)
    $categories->map(function ($cat) {
        $book = $cat->books()
                    ->where('status', 'aktif')
                    ->whereNotNull('cover')
                    ->orderBy('created_at', 'desc')
                    ->first();
        $cat->cover_image = $book ? $book->cover : null;
        return $cat;
    });
@endphp

<section id="kategori" class="py-16 bg-[#081e26]">
    <div class="max-w-7xl mx-auto px-6 sm:px-12">

        <!-- Section Title -->
        <div class="mb-10 text-center">
            <h2 class="text-2xl sm:text-3xl font-bold text-[#1dc2fe]">
                Kategori Populer
            </h2>
            <p class="text-[#cbd5e1] mt-2 max-w-2xl mx-auto">
                Kategori dengan koleksi buku terbanyak di perpustakaan digital
            </p>
        </div>

        <!-- Category Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($categories as $category)
                <div class="relative group rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 h-40 bg-[#094054]">
                    
                    @if($category->cover_image)
                        <!-- Background Image with Overlay -->
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                             style="background-image: url('{{ asset('storage/' . $category->cover_image) }}');">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-r from-[#081e26] via-[#094054]/90 to-[#094054]/60"></div>
                    @endif

                    <!-- Content -->
                    <div class="relative h-full p-6 flex flex-col justify-between z-10">
                        <div>
                            <h3 class="text-lg font-bold text-white mb-1 drop-shadow-md">
                                {{ $category->nama }}
                            </h3>
                            <p class="text-sm text-[#cbd5e1] line-clamp-2 drop-shadow-sm">
                                {{ $category->deskripsi ?? 'Jelajahi koleksi ' . $category->nama }}
                            </p>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#1dc2fe]/10 text-[#1dc2fe] border border-[#1dc2fe]/20">
                                {{ $category->books_count }} Buku
                            </span>

                            <span class="text-sm text-white/80 italic group-hover:text-[#1dc2fe] transition">
                                Lihat Koleksi &rarr;
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-400">
                    Belum ada kategori tersedia.
                </div>
            @endforelse
        </div>

    </div>
</section>