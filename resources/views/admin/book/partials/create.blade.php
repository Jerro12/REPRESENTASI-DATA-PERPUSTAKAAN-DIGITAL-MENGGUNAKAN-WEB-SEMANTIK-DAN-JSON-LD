<form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="p-6">
        <h3 class="text-lg font-bold mb-4">Tambah Buku</h3>

        {{-- Kode Buku --}}
        <div class="mb-4">
            <x-input-label for="kode_buku" value="Kode Buku" />
            <x-text-input id="kode_buku" name="kode_buku" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('kode_buku')" class="mt-2" />
        </div>

        {{-- Judul --}}
        <div class="mb-4">
            <x-input-label for="judul" value="Judul Buku" />
            <x-text-input id="judul" name="judul" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
        </div>

        {{-- Penulis --}}
        <div class="mb-4">
            <x-input-label for="penulis" value="Penulis" />
            <x-text-input id="penulis" name="penulis" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('penulis')" class="mt-2" />
        </div>

        {{-- Kategori --}}
        <div class="mb-4">
            <x-input-label for="category_id" value="Kategori" />
            <x-select-input id="category_id" name="category_id" class="mt-1 block w-full" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->nama }}</option>
                @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
        </div>

        {{-- Subjek / About --}}
        <div class="mb-4">
            <x-input-label for="subjek" value="Subjek / About" />
            <x-text-input id="subjek" name="subjek" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('subjek')" class="mt-2" />
        </div>

        {{-- Penerbit --}}
        <div class="mb-4">
            <x-input-label for="penerbit" value="Penerbit" />
            <x-text-input id="penerbit" name="penerbit" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('penerbit')" class="mt-2" />
        </div>

        {{-- Tahun Terbit --}}
        <div class="mb-4">
            <x-input-label for="tahun_terbit" value="Tahun Terbit" />
            <x-text-input id="tahun_terbit" name="tahun_terbit" type="number" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('tahun_terbit')" class="mt-2" />
        </div>

        {{-- ISBN --}}
        <div class="mb-4">
            <x-input-label for="isbn" value="ISBN" />
            <x-text-input id="isbn" name="isbn" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('isbn')" class="mt-2" />
        </div>

        {{-- Bahasa --}}
        <div class="mb-4">
            <x-input-label for="bahasa" value="Bahasa" />
            <x-text-input id="bahasa" name="bahasa" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('bahasa')" class="mt-2" />
        </div>

        {{-- Jumlah Halaman --}}
        <div class="mb-4">
            <x-input-label for="jumlah_halaman" value="Jumlah Halaman" />
            <x-text-input id="jumlah_halaman" name="jumlah_halaman" type="number" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('jumlah_halaman')" class="mt-2" />
        </div>

        {{-- File Path --}}
        <div class="mb-4">
            <x-input-label for="file_path" value="File PDF Buku" />
            <input id="file_path" name="file_path" type="file" accept=".pdf" class="file-input file-input-bordered file-input-primary w-full mt-1" />
            <x-input-error :messages="$errors->get('file_path')" class="mt-2" />
        </div>

        {{-- Cover --}}
        <div class="mb-4">
            <x-input-label for="cover" value="Cover Gambar" />
            <input id="cover" name="cover" type="file" accept="image/*" class="file-input file-input-bordered file-input-primary w-full mt-1" />
            <x-input-error :messages="$errors->get('cover')" class="mt-2" />
        </div>

        {{-- Status Aktif --}}
        {{-- <div class="mb-4 flex items-center gap-2">
            <input id="status" name="status" type="checkbox" class="checkbox" checked />
            <x-input-label for="status" value="Aktif" />
        </div> --}}

        {{-- Tombol aksi --}}
        <div class="flex justify-end gap-2">
            <x-secondary-button type="button" x-on:click="$dispatch('close-modal', 'tambah-buku')">
                Batal
            </x-secondary-button>
            <x-primary-button type="submit">Simpan</x-primary-button>
        </div>
    </div>
</form>