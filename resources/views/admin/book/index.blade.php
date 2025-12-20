<x-admin>
    <div name="header">
        <h1 class="text-2xl py-4 font-bold">Data Buku</h1>
    </div>

    <div x-data>
        {{-- Tombol Tambah Buku --}}
        <div class="mb-4">
            <x-primary-button x-on:click="$dispatch('open-modal', 'tambah-buku')">
                + Tambah Buku
            </x-primary-button>
        </div>

        {{-- Tabel Buku --}}
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="table-auto w-full border-2 border-gray-200">
                <thead class="border-2">
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Kode Buku</th>
                        <th class="px-4 py-2">Judul</th>
                        <th class="px-4 py-2">Penulis</th>
                        <th class="px-4 py-2">Kategori</th>
                        <th class="px-4 py-2">Subjek / About</th>
                        <th class="px-4 py-2">Penerbit</th>
                        <th class="px-4 py-2">Tahun Terbit</th>
                        <th class="px-4 py-2">ISBN</th>
                        <th class="px-4 py-2">Bahasa</th>
                        <th class="px-4 py-2">Jumlah Halaman</th>
                        <th class="px-4 py-2">File Path</th>
                        <th class="px-4 py-2">Cover</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $index => $book)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $book->kode_buku }}</td>
                            <td class="px-4 py-2">{{ $book->judul }}</td>
                            <td class="px-4 py-2">{{ $book->penulis }}</td>
                            <td class="px-4 py-2">{{ $book->category->nama ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $book->subjek ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $book->penerbit ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $book->tahun_terbit ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $book->isbn ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $book->bahasa ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $book->jumlah_halaman ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $book->file_path ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $book->cover ?? '-' }}</td>
                            <td class="px-4 py-2">
                                @if($book->status === 'aktif')
                                    <span
                                        class="px-3 py-1 rounded-full bg-green-100 text-green-800 font-semibold text-sm">Aktif</span>
                                @else
                                    <span
                                        class="px-3 py-1 rounded-full bg-red-100 text-red-800 font-semibold text-sm">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 flex gap-2">
                                {{-- Tombol Edit --}}
                                <x-secondary-button type="button"
                                    x-on:click="$dispatch('open-modal', 'editBookModal-{{ $book->id }}')">
                                    Edit
                                </x-secondary-button>

                                {{-- Tombol Hapus --}}
                                <x-primary-button type="button"
                                    x-on:click="$dispatch('open-modal', 'hapusBookModal-{{ $book->id }}')">
                                    Hapus
                                </x-primary-button>
                            </td>
                        </tr>

                        {{-- Modal Edit per buku --}}
                        <x-modal name="editBookModal-{{ $book->id }}" :show="false" maxWidth="2xl">
                            @include('admin.book.partials.edit', ['book' => $book])
                        </x-modal>

                        {{-- Modal Hapus per buku --}}
                        <x-modal name="hapusBookModal-{{ $book->id }}" maxWidth="sm">
                            @include('admin.book.partials.delete', ['book' => $book])
                        </x-modal>
                    @empty
                        <tr>
                            <td colspan="15" class="text-center py-4 text-gray-500">Belum ada buku.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Modal Tambah Buku --}}
        <x-modal name="tambah-buku" :show="false" maxWidth="2xl">
            @include('admin.book.partials.create', ['categories' => $categories])
        </x-modal>
    </div>
</x-admin>