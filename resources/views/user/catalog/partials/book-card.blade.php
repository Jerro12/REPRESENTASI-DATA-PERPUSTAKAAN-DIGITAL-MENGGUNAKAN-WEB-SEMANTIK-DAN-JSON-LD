<div class="bg-[#094054] rounded-lg shadow-sm p-5 hover:shadow-md transition">
    <h3 class="text-lg font-semibold text-[#1dc2fe]">
        {{ $book->judul ?? 'Judul Buku' }}
    </h3>

    <p class="text-sm text-[#cbd5e1] mt-1">
        Penulis: {{ $book->penulis ?? '-' }}
    </p>

    <p class="text-sm text-[#cbd5e1]">
        Tahun: {{ $book->tahun_terbit ?? '-' }}
    </p>

    <p class="text-sm text-[#cbd5e1]">
        Kategori: {{ $book->category->nama ?? '-' }}
    </p>

    {{-- Deskripsi hanya tampil kalau flag true --}}
    @if($showDescription ?? false)
        <p class="text-sm text-[#cbd5e1] mt-2 line-clamp-3">
            {{ $book->deskripsi ?? '-' }}
        </p>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <a href="{{ route('katalog.show', $book) }}" class="text-[#1dc2fe] hover:underline text-sm font-medium">
            Lihat Detail
        </a>

        @auth
            @php
                $isFavorited = auth()->user()->favoriteBooks->contains($book->id);
            @endphp

            <button
                class="text-sm px-2 py-1 rounded {{ $isFavorited ? 'bg-red-100 text-red-700' : 'bg-gray-200 text-gray-600' }}"
                onclick="toggleFavorite({{ $book->id }}, this)">
                {{ $isFavorited ? 'Disimpan' : 'Simpan' }}
            </button>
        @endauth
    </div>

    <script>
        function toggleFavorite(bookId, btn) {
            fetch(`/koleksi/toggle/${bookId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'added') {
                        btn.textContent = 'Disimpan';
                        btn.classList.remove('bg-gray-200', 'text-gray-600');
                        btn.classList.add('bg-red-100', 'text-red-700');
                    } else {
                        btn.textContent = 'Simpan';
                        btn.classList.remove('bg-red-100', 'text-red-700');
                        btn.classList.add('bg-gray-200', 'text-gray-600');
                    }
                });
        }
    </script>
</div>