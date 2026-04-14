<x-admin title="Kelola Buku">
    <div class="p-8 animate-fade-in" x-data="{ 
        showModal: false, 
        showDeleteModal: false,
        isEdit: false, 
        actionUrl: '', 
        deleteUrl: '',
        deleteTitle: '',
        form: {
            id: '',
            kode_buku: '',
            judul: '',
            penulis: '',
            penerbit: '',
            tahun_terbit: '',
            isbn: '',
            bahasa: 'Indonesia',
            category_id: '',
            deskripsi: '',
            subjek: '',
            jumlah_halaman: '',
            status: 'aktif',
            cover: '',
            file_path: '',
            created_at: '',
            updated_at: ''
        },
        openAdd() {
            this.isEdit = false;
            this.actionUrl = '{{ route('admin.books.store') }}';
            this.form = { id: '', kode_buku: '', judul: '', penulis: '', penerbit: '', tahun_terbit: '{{ date('Y') }}', isbn: '', bahasa: 'Indonesia', category_id: '', deskripsi: '', subjek: '', jumlah_halaman: '', status: 'aktif', cover: '', file_path: '', created_at: '', updated_at: '' };
            this.showModal = true;
        },
        openEdit(book) {
            this.isEdit = true;
            this.actionUrl = '{{ url('admin/books') }}/' + book.id;
            this.form = { ...book };
            this.showModal = true;
        },
        openDelete(book) {
            this.deleteUrl = '{{ url('admin/books') }}/' + book.id;
            this.deleteTitle = book.judul;
            this.showDeleteModal = true;
        }
    }">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-foreground">Data Buku</h1>
                <p class="text-muted-foreground text-sm mt-1">Kelola koleksi buku perpustakaan</p>
            </div>
            <button @click="openAdd()"
                class="flex items-center gap-2 bg-primary text-primary-foreground px-4 py-2 rounded-lg font-semibold hover:opacity-90 transition-all shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path d="M12 5v14M5 12h14" />
                </svg>
                Tambah Buku
            </button>
        </div>

        {{-- Search & Table --}}
        <div class="bg-card border border-border rounded-xl overflow-hidden shadow-sm">
            {{-- Search Bar --}}
            <div class="p-4 border-b border-border bg-card">
                <form action="{{ route('admin.books.index') }}" method="GET" class="relative max-w-sm">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.3-4.3" />
                    </svg>
                    <input type="text" name="search" placeholder="Cari judul, penulis, kode..."
                        value="{{ request('search') }}"
                        class="w-full pl-10 pr-4 py-2.5 bg-secondary border-none rounded-lg text-sm text-foreground placeholder:text-muted-foreground focus:ring-2 focus:ring-ring transition-all" />
                </form>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-secondary/50">
                            <th
                                class="text-left px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">
                                Sampul</th>
                            <th
                                class="text-left px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">
                                Kode</th>
                            <th
                                class="text-left px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">
                                Judul</th>
                            <th
                                class="text-left px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">
                                Penulis</th>
                            <th
                                class="text-left px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">
                                Kategori</th>
                            <th
                                class="text-left px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">
                                Tahun</th>
                            <th
                                class="text-left px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">
                                Status</th>
                            <th
                                class="text-left px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @forelse ($books as $book)
                            <tr class="hover:bg-secondary/30 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="w-12 h-16 rounded-lg overflow-hidden bg-secondary border border-border shadow-sm flex items-center justify-center">
                                        @if($book->cover)
                                            <img src="{{ asset('storage/' . $book->cover) }}" alt="" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-6 h-6 text-muted-foreground opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" /></svg>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm font-mono font-semibold text-primary italic">
                                    {{ $book->kode_buku }}</td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-bold text-foreground">{{ $book->judul }}</p>
                                    <p class="text-[10px] text-muted-foreground">{{ $book->penerbit }}</p>
                                </td>
                                <td class="px-6 py-4 text-sm text-muted-foreground">{{ $book->penulis }}</td>
                                <td class="px-6 py-4">
                                    <span class="badge-info">{{ $book->category->nama ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-muted-foreground">{{ $book->tahun_terbit }}</td>
                                <td class="px-6 py-4">
                                    @if ($book->status === 'aktif')
                                        <span class="badge-success">Aktif</span>
                                    @else
                                        <span class="badge-danger">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <button @click="openEdit({{ $book->toJson() }})"
                                            class="h-8 w-8 rounded-lg border border-border flex items-center justify-center hover:bg-secondary transition-all text-muted-foreground hover:text-foreground">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                stroke-width="2">
                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" />
                                            </svg>
                                        </button>
                                        <button @click="openDelete({{ $book->toJson() }})"
                                            class="h-8 w-8 rounded-lg border border-destructive/20 flex items-center justify-center hover:bg-destructive/10 transition-all text-destructive">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" stroke-width="2">
                                                <path
                                                    d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M10 11v6M14 11v6" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-12 text-muted-foreground">Tidak ada data buku
                                    ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modal Form --}}
        <div x-show="showModal"
            class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-[100] p-4"
            x-transition.opacity @click.away="showModal = false" style="display: none;">
            <div class="bg-card rounded-2xl w-full max-w-xl max-h-[90vh] overflow-y-auto animate-scale-in" @click.stop>
                <div class="flex items-center justify-between p-6 border-b border-border bg-card sticky top-0 z-10">
                    <h3 class="text-xl font-bold text-foreground" x-text="isEdit ? 'Edit Buku' : 'Tambah Buku Baru'"></h3>
                    <button @click="showModal = false" class="text-muted-foreground hover:text-foreground">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M18 6L6 18M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form :action="actionUrl" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf
                    <template x-if="isEdit">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <div class="grid grid-cols-2 gap-5">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold uppercase tracking-widest text-[#94A3B8]">Kode Buku</label>
                            <input name="kode_buku" required x-model="form.kode_buku"
                                class="w-full px-4 py-3 bg-secondary border-none rounded-xl text-sm focus:ring-2 focus:ring-ring transition-all" />
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold uppercase tracking-widest text-[#94A3B8]">Tahun Terbit</label>
                            <input name="tahun_terbit" type="number" required x-model="form.tahun_terbit"
                                class="w-full px-4 py-3 bg-secondary border-none rounded-xl text-sm focus:ring-2 focus:ring-ring transition-all" />
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-widest text-[#94A3B8]">Judul Buku</label>
                        <input name="judul" required x-model="form.judul"
                            class="w-full px-4 py-3 bg-secondary border-none rounded-xl text-sm focus:ring-2 focus:ring-ring transition-all" />
                    </div>

                    <div class="grid grid-cols-2 gap-5">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold uppercase tracking-widest text-[#94A3B8]">Penulis</label>
                            <input name="penulis" required x-model="form.penulis"
                                class="w-full px-4 py-3 bg-secondary border-none rounded-xl text-sm focus:ring-2 focus:ring-ring transition-all" />
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold uppercase tracking-widest text-[#94A3B8]">Penerbit</label>
                            <input name="penerbit" x-model="form.penerbit"
                                class="w-full px-4 py-3 bg-secondary border-none rounded-xl text-sm focus:ring-2 focus:ring-ring transition-all" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-5">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold uppercase tracking-widest text-[#94A3B8]">Kategori</label>
                            <select name="category_id" required x-model="form.category_id"
                                class="w-full px-4 py-3 bg-secondary border-none rounded-xl text-sm focus:ring-2 focus:ring-ring transition-all">
                                <option value="">-- Pilih --</option>
                                @foreach ($categories as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold uppercase tracking-widest text-[#94A3B8]">Jumlah Halaman</label>
                            <input name="jumlah_halaman" type="number" x-model="form.jumlah_halaman"
                                class="w-full px-4 py-3 bg-secondary border-none rounded-xl text-sm focus:ring-2 focus:ring-ring transition-all" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-5">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold uppercase tracking-widest text-[#94A3B8]">ISBN</label>
                            <input name="isbn" x-model="form.isbn" placeholder="Contoh: 978-602-..."
                                class="w-full px-4 py-3 bg-secondary border-none rounded-xl text-sm focus:ring-2 focus:ring-ring transition-all" />
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold uppercase tracking-widest text-[#94A3B8]">Bahasa</label>
                            <input name="bahasa" x-model="form.bahasa"
                                class="w-full px-4 py-3 bg-secondary border-none rounded-xl text-sm focus:ring-2 focus:ring-ring transition-all" />
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-widest text-[#94A3B8]">Subjek / Keyword</label>
                        <input name="subjek" x-model="form.subjek" placeholder="Contoh: Teknologi, Sejarah, Pendidikan"
                            class="w-full px-4 py-3 bg-secondary border-none rounded-xl text-sm focus:ring-2 focus:ring-ring transition-all" />
                    </div>

                    <template x-if="form.cover">
                        <div class="p-4 bg-secondary/50 rounded-2xl flex items-center gap-4 border border-border/50">
                            <div class="w-16 h-20 rounded-lg overflow-hidden border border-border bg-card">
                                <img :src="'{{ asset('storage') }}/' + form.cover" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-1">Sampul Saat Ini</p>
                                <p class="text-xs font-semibold text-foreground italic">File tersimpan di server</p>
                            </div>
                        </div>
                    </template>

                    <div class="grid grid-cols-2 gap-5">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold uppercase tracking-widest text-[#94A3B8]">Cover Buku</label>
                            <input type="file" name="cover" accept="image/*"
                                class="w-full text-xs text-muted-foreground file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20" />
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold uppercase tracking-widest text-[#94A3B8]">File PDF</label>
                            <input type="file" name="file_path" accept=".pdf"
                                class="w-full text-xs text-muted-foreground file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-accent/10 file:text-accent hover:file:bg-accent/20" />
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-widest text-[#94A3B8]">Status</label>
                        <select name="status" x-model="form.status"
                            class="w-full px-4 py-3 bg-secondary border-none rounded-xl text-sm focus:ring-2 focus:ring-ring transition-all">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-widest text-[#94A3B8]">Deskripsi</label>
                        <textarea name="deskripsi" rows="3" x-model="form.deskripsi"
                            class="w-full px-4 py-3 bg-secondary border-none rounded-xl text-sm focus:ring-2 focus:ring-ring transition-all resize-none"></textarea>
                    </div>

                    <template x-if="isEdit">
                        <div class="p-4 bg-muted/30 rounded-xl border border-border/40 grid grid-cols-2 gap-y-2 gap-x-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground/60">
                            <div class="flex flex-col gap-1">ID: <span class="text-foreground/80" x-text="form.id"></span></div>
                            <div class="flex flex-col gap-1 text-right">Dibuat: <span class="text-foreground/80" x-text="new Date(form.created_at).toLocaleString('id-ID')"></span></div>
                            <div class="flex flex-col gap-1 col-span-2 pt-2 border-t border-border/50">Terakhir Diubah: <span class="text-foreground/80" x-text="new Date(form.updated_at).toLocaleString('id-ID')"></span></div>
                        </div>
                    </template>

                    <div class="flex gap-4 pt-4 sticky bottom-0 bg-card">
                        <button type="submit"
                            class="flex-1 bg-primary text-primary-foreground py-3 rounded-xl font-bold hover:opacity-90 transition-all shadow-lg shadow-primary/20"
                            x-text="isEdit ? 'Update Buku' : 'Simpan Buku'"></button>
                        <button type="button" @click="showModal = false"
                            class="flex-1 bg-secondary text-foreground py-3 rounded-xl font-bold hover:bg-border transition-all">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        {{-- Delete Confirmation Modal --}}
        <div x-show="showDeleteModal"
            class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-[110] p-4"
            x-transition.opacity style="display: none;">
            <div class="bg-card rounded-2xl w-full max-w-sm p-8 animate-scale-in" @click.away="showDeleteModal = false">
                <div class="w-16 h-16 bg-destructive/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-destructive" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-foreground text-center mb-2">Hapus Buku?</h3>
                <p class="text-muted-foreground text-center text-sm mb-8">
                    Apakah Anda yakin ingin menghapus buku <span class="font-bold text-foreground" x-text="deleteTitle"></span>? Tindakan ini tidak dapat dibatalkan.
                </p>
                <div class="flex gap-4">
                    <form :action="deleteUrl" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-destructive text-destructive-foreground py-3 rounded-xl font-bold hover:opacity-90 transition-all shadow-lg shadow-destructive/20">
                            Ya, Hapus
                        </button>
                    </form>
                    <button @click="showDeleteModal = false" class="flex-1 bg-secondary text-foreground py-3 rounded-xl font-bold hover:bg-border transition-all">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-admin>