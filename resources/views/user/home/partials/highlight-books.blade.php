@php
    use App\Models\Book;

    $books = Book::with('category')
        ->where('status', 'aktif')
        ->latest()
        ->take(6)
        ->get();
@endphp

<div class="mt-16 w-full -mx-4 sm:-mx-6 lg:-mx-8">
    <div class="text-center w-full px-6 sm:px-12">
        <!-- Section Title -->
        <div class="mb-8">
            <h2 class="text-2xl sm:text-3xl font-bold text-[#1A202C]">
                Buku Terbaru
            </h2>
            <p class="text-[#718096] mt-2">
                Koleksi buku terbaru yang tersedia dalam perpustakaan digital
            </p>
        </div>

        <!-- Book Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($books as $book)
                <div class="bg-[#FFFFFF] border border-[#F1F5F9] shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] rounded-lg shadow hover:shadow-md transition p-5 text-[#718096]">
                    <!-- Cover -->
                    <div class="mb-4">
                        <div class="h-40 bg-[#F1F5F9] rounded flex items-center justify-center text-[#718096] text-sm">
                            Cover Buku
                        </div>
                    </div>

                    <!-- Book Info -->
                    <h3 class="text-lg font-semibold mb-1 text-[#1A202C]">
                        {{ $book->judul }}
                    </h3>

                    <p class="text-sm">
                        Penulis: {{ $book->penulis }}
                    </p>

                    <p class="text-sm">
                        Kategori: {{ $book->category->nama ?? '-' }}
                    </p>

                    <p class="text-sm mt-1">
                        Tahun Terbit: {{ $book->tahun_terbit }}
                    </p>

                    <!-- Status -->
                    <span class="inline-block mt-3 text-xs px-3 py-1 rounded-full
                            {{ $book->status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                        {{ ucfirst($book->status) }}
                    </span>
                </div>
            @empty
                <div class="col-span-full text-center text-[#718096]">
                    Belum ada data buku.
                </div>
            @endforelse
        </div>
    </div>
</div>