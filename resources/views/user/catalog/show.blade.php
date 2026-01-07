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
                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->judul }}" class="h-80 object-contain rounded-lg shadow-lg">
                    @else
                        <div
                            class="h-80 w-56 bg-[#081e26] rounded-lg shadow-lg flex items-center justify-center text-[#cbd5e1] text-sm border border-[#1dc2fe]/30">
                            Cover Tidak Tersedia
                        </div>
                    @endif
                </div>

                <!-- Info Buku -->
                <div class="space-y-4">
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-2">{{ $book->judul }}</h1>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-[#094054] border border-[#1dc2fe] text-[#1dc2fe] rounded-full text-xs font-semibold">
                                {{ $book->category->nama ?? 'Umum' }}
                            </span>
                             <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                {{ $book->status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($book->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-[#cbd5e1]">
                        <p><strong class="text-white">Penulis:</strong> {{ $book->penulis ?? '-' }}</p>
                        <p><strong class="text-white">Penerbit:</strong> {{ $book->penerbit ?? '-' }}</p>
                        <p><strong class="text-white">Tahun Terbit:</strong> {{ $book->tahun_terbit ?? '-' }}</p>
                        <p><strong class="text-white">Bahasa:</strong> {{ $book->bahasa ?? '-' }}</p>
                        <p><strong class="text-white">ISBN:</strong> {{ $book->isbn ?? '-' }}</p>
                        <p><strong class="text-white">Jumlah Halaman:</strong> {{ $book->jumlah_halaman ?? '-' }}</p>
                    </div>

                    <div class="mt-4 pt-4 border-t border-[#0b556d]">
                        <h3 class="text-lg font-semibold text-white mb-2">Deskripsi</h3>
                        <p class="leading-relaxed text-[#94a3b8]">{{ $book->deskripsi ?? 'Deskripsi buku belum tersedia.' }}</p>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <x-primary-button as="a" href="{{ route('katalog.index') }}" class="justify-center">
                        &larr; Kembali ke Katalog
                    </x-primary-button>

                    @if($book->file_path)
                        <a href="{{ asset('storage/' . $book->file_path) }}" target="_blank"
                           class="inline-flex items-center justify-center px-4 py-2 bg-[#1dc2fe] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#17acd8] focus:bg-[#17acd8] active:bg-[#1396bd] focus:outline-none focus:ring-2 focus:ring-[#1dc2fe] focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            Baca Buku Digital
                        </a>
                    @endif
                </div>
            </div>

            {{-- JSON-LD Metadata --}}
            <script type="application/ld+json">
                {!! json_encode([
                    '@context' => 'https://schema.org',
                    '@type' => 'Book',
                    'name' => $book->judul,
                    'author' => [
                        '@type' => 'Person',
                        'name' => $book->penulis
                    ],
                    'datePublished' => (string) $book->tahun_terbit,
                    'publisher' => [
                        '@type' => 'Organization',
                        'name' => $book->penerbit
                    ],
                    'inLanguage' => $book->bahasa,
                    'numberOfPages' => $book->jumlah_halaman,
                    'genre' => $book->category->nama ?? null,
                    'description' => $book->deskripsi,
                    'image' => $book->cover ? asset('storage/' . $book->cover) : null,
                ]) !!}
            </script>
        </div>
    </div>
</x-app-layout>