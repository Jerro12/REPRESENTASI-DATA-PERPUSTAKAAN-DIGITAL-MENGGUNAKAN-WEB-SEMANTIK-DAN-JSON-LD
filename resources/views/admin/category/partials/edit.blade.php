<form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="p-6">
        <h3 class="text-lg font-bold mb-4">Edit Kategori</h3>

        {{-- Nama Kategori --}}
        <div class="mb-4">
            <x-input-label for="nama-{{ $category->id }}" value="Nama Kategori" />
            <x-text-input id="nama-{{ $category->id }}" name="nama" type="text"
                class="mt-1 block w-full"
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

        {{-- Collection Type --}}
        <div class="mb-4">
            <x-input-label for="collection_type-{{ $category->id }}" value="Tipe Koleksi" />
            <select id="collection_type-{{ $category->id }}" name="collection_type"
                class="select select-bordered w-full mt-1" required>
                <option value="Book" {{ old('collection_type', $category->collection_type) === 'Book' ? 'selected' : '' }}>Book</option>
                <option value="ScholarlyArticle" {{ old('collection_type', $category->collection_type) === 'ScholarlyArticle' ? 'selected' : '' }}>ScholarlyArticle</option>
            </select>
            <x-input-error :messages="$errors->get('collection_type')" class="mt-2" />
        </div>

        {{-- Schema About / Genre --}}
        <div class="mb-4">
            <x-input-label for="schema_about-{{ $category->id }}" value="About / Genre" />
            <x-text-input id="schema_about-{{ $category->id }}" name="schema_about" type="text"
                class="mt-1 block w-full"
                :value="old('schema_about', $category->schema_about)" />
            <x-input-error :messages="$errors->get('schema_about')" class="mt-2" />
        </div>

        {{-- Status Aktif --}}
        <div class="mb-4 flex items-center gap-2">
            <input id="is_active-{{ $category->id }}" name="is_active" type="checkbox" class="checkbox"
                {{ old('is_active', $category->is_active) ? 'checked' : '' }} />
            <x-input-label for="is_active-{{ $category->id }}" value="Aktif" />
            <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
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
