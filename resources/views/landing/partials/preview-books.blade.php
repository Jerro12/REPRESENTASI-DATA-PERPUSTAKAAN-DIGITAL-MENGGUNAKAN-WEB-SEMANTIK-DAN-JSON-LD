<section id="#koleksi" class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-8 text-center">
            Koleksi Buku Terbaru
        </h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-6">
            @forelse ($books as $book)
                <div class="bg-white rounded-lg shadow-sm p-4 text-center">
                    <div class="h-32 bg-gray-200 rounded mb-3"></div>

                    <h3 class="text-sm font-medium text-gray-800 line-clamp-2">
                        {{ $book->title }}
                    </h3>

                    <p class="text-xs text-gray-500 mt-1">
                        {{ $book->category->name ?? '-' }}
                    </p>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">
                    Belum ada koleksi buku
                </p>
            @endforelse
        </div>
    </div>
</section>