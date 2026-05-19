<x-admin title="Kelola Peminjaman">
    <div class="p-8 animate-fade-in" x-data="{ 
        showDeleteModal: false,
        showProfileModal: false,
        studentProfile: null,
        deleteUrl: '',
        deleteTitle: '',
        openDelete(borrowing) {
            this.deleteUrl = '{{ url('admin/borrowings') }}/' + borrowing.id;
            const judul = borrowing.book ? borrowing.book.judul : 'Buku Terhapus';
            const userName = borrowing.user ? borrowing.user.name : 'User Terhapus';
            this.deleteTitle = 'Peminjaman ' + judul + ' oleh ' + userName;
            this.showDeleteModal = true;
        },
        openProfile(user) {
            if (!user) return;
            this.studentProfile = user;
            this.showProfileModal = true;
        }
    }">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-foreground">Data Peminjaman</h1>
                <p class="text-muted-foreground text-sm mt-1">Pantau dan kelola peminjaman buku perpustakaan</p>
            </div>
        </div>

        {{-- Search & Table --}}
        <div class="bg-card border border-border rounded-xl overflow-hidden shadow-sm">
            {{-- Search Bar --}}
            <div class="p-4 border-b border-border bg-card">
                <form action="{{ route('admin.borrowings.index') }}" method="GET" class="relative max-w-sm">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.3-4.3" />
                    </svg>
                    <input type="text" name="search" placeholder="Cari nama user atau judul buku..."
                        value="{{ request('search') }}"
                        class="w-full pl-10 pr-4 py-2.5 bg-secondary border-none rounded-lg text-sm text-foreground placeholder:text-muted-foreground focus:ring-2 focus:ring-ring transition-all" />
                </form>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-secondary/50">
                            <th class="text-left px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Peminjam</th>
                            <th class="text-left px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Buku</th>
                            <th class="text-left px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Tgl Pinjam</th>
                            <th class="text-left px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Batas Kembali</th>
                            <th class="text-left px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Tgl Kembali</th>
                            <th class="text-left px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Status</th>
                            <th class="text-left px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Denda</th>
                            <th class="text-left px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @forelse ($borrowings as $b)
                            <tr class="hover:bg-secondary/30 transition-colors group">
                                <td class="px-6 py-4">
                                    <p class="text-sm font-bold text-foreground">{{ $b->user?->name ?? 'User Terhapus' }}</p>
                                    <p class="text-[10px] text-muted-foreground">{{ $b->user?->email ?? '-' }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-bold text-foreground">{{ $b->book?->judul ?? 'Buku Terhapus' }}</p>
                                    <p class="text-[10px] text-muted-foreground">{{ $b->book?->kode_buku ?? '-' }}</p>
                                </td>
                                <td class="px-6 py-4 text-sm text-muted-foreground">
                                    {{ $b->borrow_date->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-muted-foreground">
                                    {{ $b->due_date->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-muted-foreground">
                                    {{ $b->return_date ? $b->return_date->format('d M Y') : '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($b->status === 'borrowed')
                                        @if($b->due_date < now())
                                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-destructive/10 text-destructive">Terlambat</span>
                                        @else
                                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-primary/10 text-primary">Dipinjam</span>
                                        @endif
                                    @elseif ($b->status === 'returned')
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-500">Dikembalikan</span>
                                    @elseif ($b->status === 'pending')
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-500/10 text-amber-500">Menunggu</span>
                                    @elseif ($b->status === 'rejected')
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-destructive/10 text-destructive">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $denda = $b->denda;
                                        if ($b->status === 'borrowed' && \Carbon\Carbon::now()->startOfDay()->greaterThan(\Carbon\Carbon::parse($b->due_date)->startOfDay())) {
                                            $lateDays = \Carbon\Carbon::parse($b->due_date)->startOfDay()->diffInDays(\Carbon\Carbon::now()->startOfDay());
                                            $denda = $lateDays * 2000;
                                        }
                                    @endphp
                                    @if($denda > 0)
                                        <span class="text-sm font-bold text-destructive">Rp {{ number_format($denda, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-sm text-muted-foreground">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        @if($b->status === 'pending')
                                            <form action="{{ route('admin.borrowings.approve', $b->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" 
                                                    class="h-8 px-3 rounded-lg border border-primary/20 bg-primary/5 text-primary text-xs font-bold hover:bg-primary hover:text-primary-foreground transition-all flex items-center gap-1">
                                                    Setujui
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.borrowings.reject', $b->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" 
                                                    class="h-8 px-3 rounded-lg border border-destructive/20 bg-destructive/5 text-destructive text-xs font-bold hover:bg-destructive hover:text-destructive-foreground transition-all flex items-center gap-1">
                                                    Tolak
                                                </button>
                                            </form>
                                        @elseif($b->status === 'borrowed')
                                            <form action="{{ route('admin.borrowings.return', $b->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" 
                                                    class="h-8 px-3 rounded-lg border border-emerald-500/20 bg-emerald-500/5 text-emerald-500 text-xs font-bold hover:bg-emerald-500 hover:text-white transition-all flex items-center gap-1">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Kembali
                                                </button>
                                            </form>
                                        @endif
                                        <button @click="openProfile({{ $b->user ? $b->user->toJson() : 'null' }})"
                                            class="h-8 w-8 rounded-lg border border-primary/20 flex items-center justify-center hover:bg-primary/10 transition-all text-primary" title="Lihat Profil Siswa">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.644C3.301 7.689 7.488 4.5 12 4.5c4.512 0 8.7 3.189 9.964 7.178.07.207.07.431 0 .638C20.701 16.311 16.512 19.5 12 19.5c-4.512 0-8.7-3.189-9.964-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </button>
                                        <button @click="openDelete({{ $b->toJson() }})"
                                            class="h-8 w-8 rounded-lg border border-destructive/20 flex items-center justify-center hover:bg-destructive/10 transition-all text-destructive" title="Hapus Riwayat">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M10 11v6M14 11v6" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-12 text-muted-foreground">Tidak ada data peminjaman ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($borrowings->hasPages())
                <div class="p-4 border-t border-border bg-card">
                    {{ $borrowings->links() }}
                </div>
            @endif
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
                <h3 class="text-xl font-bold text-foreground text-center mb-2">Hapus Riwayat?</h3>
                <p class="text-muted-foreground text-center text-sm mb-8">
                    Apakah Anda yakin ingin menghapus data <span class="font-bold text-foreground" x-text="deleteTitle"></span>?
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

        {{-- Student Profile Modal --}}
        <div x-show="showProfileModal"
            class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-[110] p-4"
            x-transition.opacity style="display: none;">
            <div class="bg-card rounded-2xl w-full max-w-md overflow-hidden animate-scale-in shadow-2xl border border-border" @click.away="showProfileModal = false">
                <div class="relative h-24 bg-primary/10">
                    <div class="absolute -bottom-10 left-1/2 -translate-x-1/2">
                        <div class="w-20 h-20 rounded-2xl bg-primary flex items-center justify-center text-primary-foreground text-3xl font-black shadow-xl border-4 border-card">
                            <template x-if="studentProfile">
                                <span x-text="studentProfile.name.charAt(0)"></span>
                            </template>
                        </div>
                    </div>
                    <button @click="showProfileModal = false" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-black/10 flex items-center justify-center hover:bg-black/20 transition-all text-foreground">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                
                <div class="pt-12 pb-8 px-8 text-center">
                    <template x-if="studentProfile">
                        <div>
                            <h3 class="text-xl font-bold text-foreground" x-text="studentProfile.name"></h3>
                            <p class="text-sm text-muted-foreground" x-text="studentProfile.email"></p>
                            
                            <div class="mt-8 space-y-4 text-left">
                                <div class="p-4 rounded-xl bg-secondary/50 border border-border">
                                    <p class="text-[10px] font-black uppercase tracking-widest text-muted-foreground opacity-60 mb-1">Nomor Induk Siswa (NIS)</p>
                                    <p class="text-sm font-bold text-foreground" x-text="studentProfile.nis || '-'"></p>
                                </div>
                                
                                <div class="p-4 rounded-xl bg-secondary/50 border border-border">
                                    <p class="text-[10px] font-black uppercase tracking-widest text-muted-foreground opacity-60 mb-1">Nomor Telepon</p>
                                    <p class="text-sm font-bold text-foreground" x-text="studentProfile.no_telp || '-'"></p>
                                </div>
                                
                                <div class="p-4 rounded-xl bg-secondary/50 border border-border">
                                    <p class="text-[10px] font-black uppercase tracking-widest text-muted-foreground opacity-60 mb-1">Alamat</p>
                                    <p class="text-sm font-bold text-foreground" x-text="studentProfile.alamat || '-'"></p>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                
                <div class="px-8 pb-8">
                    <button @click="showProfileModal = false" class="w-full bg-secondary text-foreground py-3 rounded-xl font-bold hover:bg-border transition-all">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-admin>
