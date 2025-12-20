@php
    use App\Models\Book;

    $books = Book::with('category')
        ->where('status', 'aktif')
        ->latest()
        ->take(6)
        ->get();
@endphp

<div class="mt-16">
    <div class="max-w-7xl mx-auto px-6 sm:px-12">
        <!-- Section Title -->
        <div class="mb-8 text-center">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">
                Buku Terbaru
            </h2>
            <p class="text-gray-600 mt-2">
                Koleksi buku terbaru yang tersedia dalam perpustakaan digital
            </p>
        </div>

        <!-- Book Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($books as $book)
                <div class="bg-white rounded-lg shadow hover:shadow-md transition p-5">
                    <!-- Cover -->
                    <div class="mb-4">
                        <div class="h-40 bg-gray-100 rounded flex items-center justify-center text-gray-400 text-sm">
                            Cover Buku
                        </div>
                    </div>

                    <!-- Book Info -->
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">
                        {{ $book->judul }}
                    </h3>

                    <p class="text-sm text-gray-600">
                        Penulis: {{ $book->penulis }}
                    </p>

                    <p class="text-sm text-gray-600">
                        Kategori: {{ $book->category->nama ?? '-' }}
                    </p>

                    <p class="text-sm text-gray-500 mt-1">
                        Tahun Terbit: {{ $book->tahun_terbit }}
                    </p>

                    <!-- Status -->
                    <span class="inline-block mt-3 text-xs px-3 py-1 rounded-full
                            {{ $book->status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                        {{ ucfirst($book->status) }}
                    </span>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">
                    Belum ada data buku.
                </div>
            @endforelse
        </div>
    </div>
</div>