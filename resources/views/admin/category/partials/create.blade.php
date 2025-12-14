<form action="{{ route('admin.categories.store') }}" method="POST">
    @csrf
    <div class="p-6">
        <h3 class="text-lg font-bold mb-4">Tambah Kategori</h3>

        {{-- Nama Kategori --}}
        <div class="mb-4">
            <x-input-label for="nama" value="Nama Kategori" />
            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <x-input-label for="deskripsi" value="Deskripsi" />
            <x-textarea id="deskripsi" name="deskripsi" class="textarea textarea-bordered w-full mt-1"></x-textarea>
            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
        </div>

        {{-- Tombol aksi --}}
        <div class="flex justify-end gap-2">
            <x-secondary-button type="button" x-on:click="$dispatch('close-modal', 'tambah-kategori')">
                Batal
            </x-secondary-button>

            <x-primary-button type="submit">
                Simpan
            </x-primary-button>
        </div>
    </div>
</form>