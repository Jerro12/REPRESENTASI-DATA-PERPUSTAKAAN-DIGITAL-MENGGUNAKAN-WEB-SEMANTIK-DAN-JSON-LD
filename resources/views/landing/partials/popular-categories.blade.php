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

<section id="kategori" class="py-16 bg-[#FFFFFF]">
    <div class="max-w-7xl mx-auto px-6 sm:px-12">

        <!-- Section Title -->
        <div class="mb-10 text-center">
            <h2 class="text-2xl sm:text-3xl font-bold text-[#1A202C]">
                Kategori Populer
            </h2>
            <p class="text-[#718096] mt-2 max-w-2xl mx-auto">
                Kategori dengan koleksi buku terbanyak di perpustakaan digital
            </p>
        </div>

        <!-- Category Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($categories as $category)
                <div class="relative group rounded-lg shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] border border-[#F1F5F9] overflow-hidden hover:shadow-lg transition-all duration-300 h-40 bg-[#FFFFFF]">
                    
                    @if($category->cover_image)
                        <!-- Background Image with Overlay -->
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                             style="background-image: url('{{ asset('storage/' . $category->cover_image) }}');">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-r from-[#FFFFFF] via-[#FFFFFF]/90 to-[#FFFFFF]/60"></div>
                    @endif

                    <!-- Content -->
                    <div class="relative h-full p-6 flex flex-col justify-between z-10">
                        <div>
                            <h3 class="text-lg font-bold text-[#1A202C] mb-1">
                                {{ $category->nama }}
                            </h3>
                            <p class="text-sm text-[#718096] line-clamp-2">
                                {{ $category->deskripsi ?? 'Jelajahi koleksi ' . $category->nama }}
                            </p>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#1DC2FE]/10 text-[#1DC2FE] border border-[#1DC2FE]/20">
                                {{ $category->books_count }} Buku
                            </span>

                            <span class="text-sm text-[#718096] italic group-hover:text-[#1DC2FE] transition">
                                Lihat Koleksi &rarr;
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-[#718096]">
                    Belum ada kategori tersedia.
                </div>
            @endforelse
        </div>

    </div>
</section>