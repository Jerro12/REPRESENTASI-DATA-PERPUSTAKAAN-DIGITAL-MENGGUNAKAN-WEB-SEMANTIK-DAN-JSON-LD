<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1dc2fe] leading-tight">
            {{ $book->judul ?? 'Detail Buku' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Card Detail Buku -->
            <div class="bg-[#094054] shadow-sm rounded-lg p-6 text-[#cbd5e1]">

                <!-- Cover -->
                <div class="mb-6 flex justify-center">
                    @if($book->cover)
                        <img src="{{ asset($book->cover) }}" alt="{{ $book->judul }}" class="h-64 object-contain rounded">
                    @else
                        <div
                            class="h-64 w-full bg-[#081e26] rounded flex items-center justify-center text-[#cbd5e1] text-sm">
                            Cover Buku
                        </div>
                    @endif
                </div>

                <!-- Info Buku -->
                <div class="space-y-2">
                    <h1 class="text-2xl font-bold text-white">{{ $book->judul }}</h1>
                    <p>Penulis: {{ $book->penulis ?? '-' }}</p>
                    <p>Penerbit: {{ $book->penerbit ?? '-' }}</p>
                    <p>Tahun Terbit: {{ $book->tahun_terbit ?? '-' }}</p>
                    <p>Kategori: {{ $book->category->nama ?? '-' }}</p>
                    <p>Bahasa: {{ $book->bahasa ?? '-' }}</p>
                    <p>Jumlah Halaman: {{ $book->jumlah_halaman ?? '-' }}</p>

                    <p class="mt-2">
                        Status:
                        <span class="inline-block px-3 py-1 rounded-full
                        {{ $book->status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                            {{ ucfirst($book->status) }}
                        </span>
                    </p>

                    <p class="mt-4">{{ $book->deskripsi ?? 'Deskripsi buku belum tersedia.' }}</p>
                </div>

                <!-- Tombol Kembali -->
                <div class="mt-6">
                    <x-primary-button as="a" href="{{ route('katalog.index') }}">
                        Kembali ke Katalog
                    </x-primary-button>
                </div>
            </div>

            {{-- JSON-LD Metadata (aktifkan kalau mau web semantik) --}}
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