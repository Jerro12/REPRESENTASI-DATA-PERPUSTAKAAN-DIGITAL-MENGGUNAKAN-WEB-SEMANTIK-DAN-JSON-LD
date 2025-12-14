<form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="p-6">
        <h3 class="text-lg font-bold mb-4">Edit Kategori</h3>

        {{-- Nama Kategori --}}
        <div class="mb-4">
            <x-input-label for="nama-{{ $category->id }}" value="Nama Kategori" />
            <x-text-input id="nama-{{ $category->id }}" name="nama" type="text" class="mt-1 block w-full"
                :value="old('nama', $category->nama)" required />
            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <x-input-label for="deskripsi-{{ $category->id }}" value="Deskripsi" />
            <x-textarea id="deskripsi-{{ $category->id }}" name="deskripsi" class="mt-1 block w-full">
                {{ old('deskripsi', $category->deskripsi) }}
            </x-textarea>
            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
        </div>

        {{-- Tombol aksi --}}
        <div class="flex justify-end gap-2">
            <x-secondary-button type="button"
                x-on:click="$dispatch('close-modal', 'editCategoryModal-{{ $category->id }}')">
                Batal
            </x-secondary-button>

            <x-primary-button type="submit">
                Simpan
            </x-primary-button>
        </div>
    </div>
</form>