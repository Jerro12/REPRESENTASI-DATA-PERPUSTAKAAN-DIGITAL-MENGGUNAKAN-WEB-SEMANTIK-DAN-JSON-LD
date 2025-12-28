@php
    use App\Models\Book;

    $books = Book::with('category')
        ->where('status', 'aktif')
        ->latest()
        ->take(3)
        ->get();
@endphp

<section id="koleksi" class="py-16 bg-[#081e26]">
    <div class="max-w-7xl mx-auto px-6 sm:px-12">

        <!-- Judul Section -->
        <div class="mb-10 text-center">
            <h2 class="text-2xl sm:text-3xl font-bold text-[#1dc2fe]">
                Koleksi Buku Terbaru
            </h2>
            <p class="text-[#cbd5e1] mt-2 max-w-2xl mx-auto">
                Beberapa koleksi buku terbaru yang tersedia di perpustakaan digital
            </p>
        </div>

        <!-- Grid Buku -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($books as $book)
                    <div class="bg-[#094054] rounded-lg shadow hover:shadow-lg transition p-5">

                        <!-- Cover -->
                        <div class="mb-4">
                            <div class="h-40 bg-gray-200 rounded flex items-center justify-center text-gray-500 text-sm">
                                Cover Buku
                            </div>
                        </div>

                        <!-- Info Buku -->
                        <h3 class="text-lg font-semibold text-white mb-1 line-clamp-2">
                            {{ $book->judul }}
                        </h3>

                        <p class="text-sm text-[#cbd5e1]">
                            Penulis: {{ $book->penulis }}
                        </p>

                        <p class="text-sm text-[#cbd5e1]">
                            Kategori: {{ $book->category->nama ?? '-' }}
                        </p>

                        <p class="text-sm text-gray-400 mt-1">
                            Tahun Terbit: {{ $book->tahun_terbit }}
                        </p>

                        <!-- Status -->
                        <span class="inline-block mt-3 text-xs px-3 py-1 rounded-full
                                    {{ $book->status === 'aktif'
                ? 'bg-green-100 text-green-700'
                : 'bg-gray-200 text-gray-600' }}">
                            {{ ucfirst($book->status) }}
                        </span>
                    </div>
            @empty
                <div class="col-span-full text-center text-gray-400">
                    Belum ada koleksi buku.
                </div>
            @endforelse
        </div>

        <!-- CTA -->
        <div class="text-center mt-12">
            <a href="{{ route('katalog.index') }}"
                class="inline-block px-6 py-3 bg-[#1dc2fe] text-[#081e26] font-bold rounded-lg hover:bg-[#0bb0e6] transition">
                Lihat Semua Buku
            </a>
        </div>

    </div>
</section>