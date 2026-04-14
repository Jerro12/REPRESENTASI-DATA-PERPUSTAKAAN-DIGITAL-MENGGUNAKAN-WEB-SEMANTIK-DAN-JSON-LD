<x-admin title="Kategori Buku">
    <div class="p-8 animate-fade-in" x-data="{ 
        showModal: false, 
        showDeleteModal: false,
        isEdit: false, 
        actionUrl: '', 
        deleteUrl: '',
        deleteName: '',
        form: {
            nama: '',
            deskripsi: '',
            collection_type: 'Book',
            schema_about: '',
            is_active: true
        },
        openAdd() {
            this.isEdit = false;
            this.actionUrl = '{{ route('admin.categories.store') }}';
            this.form = { nama: '', deskripsi: '', collection_type: 'Book', schema_about: '', is_active: true };
            this.showModal = true;
        },
        openEdit(cat) {
            this.isEdit = true;
            this.actionUrl = '{{ url('admin/categories') }}/' + cat.id;
            this.form = { ...cat, is_active: cat.is_active == 1 };
            this.showModal = true;
        },
        openDelete(cat) {
            this.deleteUrl = '{{ url('admin/categories') }}/' + cat.id;
            this.deleteName = cat.nama;
            this.showDeleteModal = true;
        }
    }">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-foreground">Kategori Buku</h1>
                <p class="text-muted-foreground text-sm mt-1">Kelola kategori koleksi perpustakaan</p>
            </div>
            <button @click="openAdd()"
                class="flex items-center gap-2 bg-primary text-primary-foreground px-4 py-2 rounded-lg font-semibold hover:opacity-90 transition-all shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path d="M12 5v14M5 12h14" />
                </svg>
                Tambah Kategori
            </button>
        </div>

        {{-- Grid Kategori --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($categories as $cat)
                <div class="bg-card border border-border rounded-xl p-6 hover:shadow-md transition-all group flex flex-col h-full">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-foreground text-lg truncate">{{ $cat->nama }}</h3>
                            <p class="text-[10px] text-sidebar-section font-bold mt-0.5 tracking-widest uppercase">{{ $cat->collection_type }}</p>
                        </div>
                        <span class="badge-info flex-shrink-0">{{ $cat->books_count }} buku</span>
                    </div>
                    
                    <p class="text-sm text-muted-foreground line-clamp-3 mb-6 flex-1">
                        {{ $cat->deskripsi ?? 'Tidak ada deskripsi untuk kategori ini.' }}
                    </p>

                    <div class="flex items-center justify-between pt-4 border-t border-border mt-auto">
                        <div class="flex gap-2">
                            <button @click="openEdit({{ $cat->toJson() }})"
                                class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-border text-[11px] font-bold uppercase tracking-wider text-foreground hover:bg-secondary transition-all">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" />
                                </svg>
                                Edit
                            </button>
                            <button @click="openDelete({{ $cat->toJson() }})"
                                class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-destructive/20 text-[11px] font-bold uppercase tracking-wider text-destructive hover:bg-destructive/10 transition-all">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M10 11v6M14 11v6" />
                                </svg>
                                Hapus
                            </button>
                        </div>
                        @if (!$cat->is_active)
                            <span class="text-[10px] font-bold uppercase text-destructive italic">Nonaktif</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center bg-card border border-dashed border-border rounded-xl">
                    <p class="text-muted-foreground">Belum ada kategori ditemukan.</p>
                </div>
            @endforelse
        </div>

        {{-- Modal Form --}}
        <div x-show="showModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-[100] p-4"
            x-transition.opacity @click.away="showModal = false" style="display: none;">
            <div class="bg-card rounded-2xl w-full max-w-md animate-scale-in" @click.stop>
                <div class="flex items-center justify-between p-6 border-b border-border bg-card sticky top-0 z-10">
                    <h3 class="text-xl font-bold text-foreground" x-text="isEdit ? 'Edit Kategori' : 'Tambah Kategori'"></h3>
                    <button @click="showModal = false" class="text-muted-foreground hover:text-foreground transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M18 6L6 18M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <form :action="actionUrl" method="POST" class="p-6 space-y-5">
                    @csrf
                    <template x-if="isEdit">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-widest text-[#94A3B8]">Nama Kategori</label>
                        <input name="nama" required x-model="form.nama"
                            class="w-full px-4 py-3 bg-secondary border-none rounded-xl text-sm focus:ring-2 focus:ring-ring transition-all" />
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-widest text-[#94A3B8]">Tipe Koleksi</label>
                        <select name="collection_type" required x-model="form.collection_type"
                            class="w-full px-4 py-3 bg-secondary border-none rounded-xl text-sm focus:ring-2 focus:ring-ring transition-all">
                            <option value="Book">Buku (Book)</option>
                            <option value="ScholarlyArticle">Artikel Ilmiah (ScholarlyArticle)</option>
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-widest text-[#94A3B8]">Genre / About</label>
                        <input name="schema_about" x-model="form.schema_about"
                            class="w-full px-4 py-3 bg-secondary border-none rounded-xl text-sm focus:ring-2 focus:ring-ring transition-all" />
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-widest text-[#94A3B8]">Deskripsi</label>
                        <textarea name="deskripsi" rows="3" x-model="form.deskripsi"
                            class="w-full px-4 py-3 bg-secondary border-none rounded-xl text-sm focus:ring-2 focus:ring-ring transition-all resize-none"></textarea>
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="is_active" value="1" x-model="form.is_active"
                            class="rounded border-border bg-secondary text-primary focus:ring-primary h-4 w-4">
                        <label for="is_active" class="text-sm text-foreground font-medium">Kategori Aktif</label>
                    </div>

                    <div class="flex gap-4 pt-2">
                        <button type="submit"
                            class="flex-1 bg-primary text-primary-foreground py-3 rounded-xl font-bold hover:opacity-90 transition-all shadow-lg shadow-primary/20"
                            x-text="isEdit ? 'Update' : 'Simpan'"></button>
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
                <h3 class="text-xl font-bold text-foreground text-center mb-2">Hapus Kategori?</h3>
                <p class="text-muted-foreground text-center text-sm mb-8">
                    Apakah Anda yakin ingin menghapus kategori <span class="font-bold text-foreground" x-text="deleteName"></span>? Semua buku dalam kategori ini akan kehilangan kaitan kategorinya.
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