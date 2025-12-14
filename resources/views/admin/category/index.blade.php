<x-admin>

    <div name="header">
        <h1 class="text-2xl py-4 font-bold">Kategori Buku</h1>
    </div>

    {{-- Wrapper Alpine.js --}}
    <div x-data>
        {{-- Tombol Tambah Kategori --}}
        <div class="mb-4">
            <x-primary-button x-on:click="$dispatch('open-modal', 'tambah-kategori')">
                + Tambah Kategori
            </x-primary-button>
        </div>

        {{-- Tabel Kategori --}}
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="table-auto w-full border-2 border-gray-200">
                <thead class="border-2">
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Nama Kategori</th>
                        <th class="px-4 py-2">Deskripsi</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $index => $category)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $category->nama }}</td>
                            <td class="px-4 py-2">{{ $category->deskripsi ?? '-' }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                {{-- Tombol Edit --}}
                                <x-secondary-button type="button" class="btn btn-sm btn-warning"
                                    x-on:click="$dispatch('open-modal', 'editCategoryModal-{{ $category->id }}')">
                                    Edit
                                </x-secondary-button>

                                @foreach($categories as $category)
                                    {{-- Tombol Hapus --}}
                                    <x-primary-button
                                        x-on:click="$dispatch('open-modal', 'hapusCategoryModal-{{ $category->id }}')">
                                        Hapus
                                    </x-primary-button>

                                    {{-- Modal Hapus --}}
                                    <x-modal name="hapusCategoryModal-{{ $category->id }}" maxWidth="sm">
                                        @include('admin.category.partials.delete', ['category' => $category])
                                    </x-modal>
                                @endforeach
                            </td>
                        </tr>

                        {{-- Modal Edit per kategori --}}
                        <x-modal name="editCategoryModal-{{ $category->id }}" :show="false" maxWidth="2xl">
                            @include('admin.category.partials.edit', ['category' => $category])
                        </x-modal>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">
                                Belum ada kategori.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Modal Tambah --}}
        <x-modal name="tambah-kategori" :show="false" maxWidth="2xl">
            @include('admin.category.partials.create')
        </x-modal>
    </div>
</x-admin>