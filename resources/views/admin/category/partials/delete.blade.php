<div class="p-6 text-center">
    <h2 class="text-lg font-semibold text-red-600 mb-4">
        Hapus Kategori?
    </h2>
    <p class="text-gray-700 mb-6">
        Data kategori <strong>{{ $category->nama }}</strong> akan dihapus permanen. Tindakan ini tidak bisa dibatalkan.
    </p>
    <div class="flex justify-center gap-3">
        {{-- Tombol Batal --}}
        <x-secondary-button x-on:click="$dispatch('close-modal', 'hapusCategoryModal-{{ $category->id }}')">
            Batal
        </x-secondary-button>

        {{-- Tombol Hapus --}}
        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <x-danger-button type="submit">
                Hapus
            </x-danger-button>
        </form>
    </div>
</div>