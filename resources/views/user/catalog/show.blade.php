<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $book->judul ?? 'Detail Buku' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Card Detail Buku -->
            <div class="bg-white shadow-sm rounded-lg p-6">
                <!-- Cover -->
                <div class="mb-6 flex justify-center">
                    @if($book->cover)
                        <img src="{{ asset($book->cover) }}" alt="{{ $book->judul }}" class="h-64 object-contain">
                    @else
                        <div class="h-64 w-full bg-gray-100 rounded flex items-center justify-center text-gray-400">
                            Cover Buku
                        </div>
                    @endif
                </div>

                <!-- Info Buku -->
                <div class="space-y-2">
                    <h1 class="text-2xl font-bold text-gray-800">{{ $book->judul }}</h1>
                    <p class="text-gray-600">Penulis: {{ $book->penulis ?? '-' }}</p>
                    <p class="text-gray-600">Penerbit: {{ $book->penerbit ?? '-' }}</p>
                    <p class="text-gray-600">Tahun Terbit: {{ $book->tahun_terbit ?? '-' }}</p>
                    <p class="text-gray-600">Kategori: {{ $book->category->nama ?? '-' }}</p>
                    <p class="text-gray-600">Bahasa: {{ $book->bahasa ?? '-' }}</p>
                    <p class="text-gray-600">Jumlah Halaman: {{ $book->jumlah_halaman ?? '-' }}</p>

                    <p class="text-gray-600">
                        Status:
                        <span class="inline-block px-3 py-1 rounded-full
                        {{ $book->status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                            {{ ucfirst($book->status) }}
                        </span>
                    </p>

                    <p class="text-gray-600 mt-4">{{ $book->deskripsi ?? 'Deskripsi buku belum tersedia.' }}</p>
                </div>

                <!-- Tombol Kembali -->
                <div class="mt-6">
                    <a href="{{ route('katalog.index') }}"
                        class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Kembali ke Katalog
                    </a>
                </div>
            </div>

            {{-- JSON-LD Metadata --}}
            {{-- Bisa aktifkan nanti untuk web semantik --}}
            {{--
            <script type="application/ld+json">
                {!! json_encode([
                    "@context" => "https://schema.org",
                    "@type" => "Book",
                    "name" => $book->judul,
                    "author" => $book->penulis,
                    "datePublished" => $book->tahun_terbit,
                    "publisher" => $book->penerbit,
                    "inLanguage" => $book->bahasa,
                    "numberOfPages" => $book->jumlah_halaman,
                    "genre" => $book->category->nama ?? null,
                    "description" => $book->deskripsi,
                ]) !!}
            </script>
            --}}

        </div>
    </div>
</x-app-layout>