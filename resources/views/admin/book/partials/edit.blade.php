<form action="{{ route('admin.books.update', $book->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="p-6">
        <h3 class="text-lg font-bold mb-4">Edit Buku</h3>

        {{-- Kode Buku --}}
        <div class="mb-4">
            <x-input-label for="kode_buku-{{ $book->id }}" value="Kode Buku" />
            <x-text-input id="kode_buku-{{ $book->id }}" name="kode_buku" type="text" class="mt-1 block w-full"
                value="{{ old('kode_buku', $book->kode_buku) }}" required />
            <x-input-error :messages="$errors->get('kode_buku')" class="mt-2" />
        </div>

        {{-- Judul --}}
        <div class="mb-4">
            <x-input-label for="judul-{{ $book->id }}" value="Judul Buku" />
            <x-text-input id="judul-{{ $book->id }}" name="judul" type="text" class="mt-1 block w-full"
                value="{{ old('judul', $book->judul) }}" required />
            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
        </div>

        {{-- Penulis --}}
        <div class="mb-4">
            <x-input-label for="penulis-{{ $book->id }}" value="Penulis" />
            <x-text-input id="penulis-{{ $book->id }}" name="penulis" type="text" class="mt-1 block w-full"
                value="{{ old('penulis', $book->penulis) }}" required />
            <x-input-error :messages="$errors->get('penulis')" class="mt-2" />
        </div>

        {{-- Kategori --}}
        <div class="mb-4">
            <x-input-label for="category_id-{{ $book->id }}" value="Kategori" />
            <select id="category_id-{{ $book->id }}" name="category_id" class="select select-bordered w-full mt-1"
                required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->nama }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
        </div>

        {{-- Subjek / About --}}
        <div class="mb-4">
            <x-input-label for="subjek-{{ $book->id }}" value="Subjek / About" />
            <x-text-input id="subjek-{{ $book->id }}" name="subjek" type="text" class="mt-1 block w-full"
                value="{{ old('subjek', $book->subjek) }}" />
            <x-input-error :messages="$errors->get('subjek')" class="mt-2" />
        </div>

        {{-- Penerbit --}}
        <div class="mb-4">
            <x-input-label for="penerbit-{{ $book->id }}" value="Penerbit" />
            <x-text-input id="penerbit-{{ $book->id }}" name="penerbit" type="text" class="mt-1 block w-full"
                value="{{ old('penerbit', $book->penerbit) }}" />
            <x-input-error :messages="$errors->get('penerbit')" class="mt-2" />
        </div>

        {{-- Tahun Terbit --}}
        <div class="mb-4">
            <x-input-label for="tahun_terbit-{{ $book->id }}" value="Tahun Terbit" />
            <x-text-input id="tahun_terbit-{{ $book->id }}" name="tahun_terbit" type="number" class="mt-1 block w-full"
                value="{{ old('tahun_terbit', $book->tahun_terbit) }}" />
            <x-input-error :messages="$errors->get('tahun_terbit')" class="mt-2" />
        </div>

        {{-- ISBN --}}
        <div class="mb-4">
            <x-input-label for="isbn-{{ $book->id }}" value="ISBN" />
            <x-text-input id="isbn-{{ $book->id }}" name="isbn" type="text" class="mt-1 block w-full"
                value="{{ old('isbn', $book->isbn) }}" />
            <x-input-error :messages="$errors->get('isbn')" class="mt-2" />
        </div>

        {{-- Bahasa --}}
        <div class="mb-4">
            <x-input-label for="bahasa-{{ $book->id }}" value="Bahasa" />
            <x-text-input id="bahasa-{{ $book->id }}" name="bahasa" type="text" class="mt-1 block w-full"
                value="{{ old('bahasa', $book->bahasa) }}" />
            <x-input-error :messages="$errors->get('bahasa')" class="mt-2" />
        </div>

        {{-- Jumlah Halaman --}}
        <div class="mb-4">
            <x-input-label for="jumlah_halaman-{{ $book->id }}" value="Jumlah Halaman" />
            <x-text-input id="jumlah_halaman-{{ $book->id }}" name="jumlah_halaman" type="number"
                class="mt-1 block w-full" value="{{ old('jumlah_halaman', $book->jumlah_halaman) }}" />
            <x-input-error :messages="$errors->get('jumlah_halaman')" class="mt-2" />
        </div>

        {{-- File Path --}}
        <div class="mb-4">
            <x-input-label for="file_path-{{ $book->id }}" value="File / Buku Digital" />
            <x-text-input id="file_path-{{ $book->id }}" name="file_path" type="text" class="mt-1 block w-full"
                value="{{ old('file_path', $book->file_path) }}" />
            <x-input-error :messages="$errors->get('file_path')" class="mt-2" />
        </div>

        {{-- Cover --}}
        <div class="mb-4">
            <x-input-label for="cover-{{ $book->id }}" value="Cover" />
            <x-text-input id="cover-{{ $book->id }}" name="cover" type="text" class="mt-1 block w-full"
                value="{{ old('cover', $book->cover) }}" />
            <x-input-error :messages="$errors->get('cover')" class="mt-2" />
        </div>

        {{-- Status --}}
        <div class="mb-4 flex items-center gap-2">
            <x-input-label value="Status" />
            @if(old('status', $book->status) == 'aktif')
                <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 font-semibold text-sm">Aktif</span>
            @else
                <span class="px-3 py-1 rounded-full bg-red-100 text-red-800 font-semibold text-sm">Nonaktif</span>
            @endif
            <select name="status" class="select select-bordered w-40 ml-2">
                <option value="aktif" {{ old('status', $book->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ old('status', $book->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif
                </option>
            </select>
        </div>

        {{-- Tombol aksi --}}
        <div class="flex justify-end gap-2">
            <x-secondary-button type="button" x-on:click="$dispatch('close-modal', 'editBookModal-{{ $book->id }}')">
                Batal
            </x-secondary-button>
            <x-primary-button type="submit">Simpan</x-primary-button>
        </div>
    </div>
</form>