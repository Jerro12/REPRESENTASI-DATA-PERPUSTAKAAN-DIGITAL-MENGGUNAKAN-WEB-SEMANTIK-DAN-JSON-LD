<x-admin title="Dashboard Admin">
    <div class="p-8 animate-fade-in">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-foreground">Dashboard</h1>
            <p class="text-muted-foreground mt-1">Selamat datang di panel admin perpustakaan 📚</p>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">
            @php
                $statItems = [
                    ['label' => 'Total Buku', 'value' => $stats['total_buku'], 'svg' => '<path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>'],
                    ['label' => 'Kategori', 'value' => $stats['total_kategori'], 'svg' => '<path d="m15 5 6.3 6.3a2.4 2.4 0 0 1 0 3.4L17 19"/><path d="M9.586 5.586A2 2 0 0 0 8.172 5H3.5a.5.5 0 0 0-.5.5v4.672a2 2 0 0 0 .586 1.414L10 18.5c.379.379.882.586 1.414.586a1.99 1.99 0 0 0 1.414-.586l4.672-4.672a2 2 0 0 0 0-2.828l-7.914-7.914Z"/><path d="M7 10h.01"/>'],
                    ['label' => 'Total Penulis', 'value' => $stats['total_penulis'], 'svg' => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>'],
                    ['label' => 'Total Pustakawan', 'value' => 1, 'svg' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>'],
                ];
            @endphp

            @foreach ($statItems as $s)
                <div class="stat-card-bg rounded-xl p-6 relative overflow-hidden shadow-sm">
                    <div class="absolute top-0 right-0 w-20 h-20 rounded-full bg-white/5 -translate-y-6 translate-x-6"></div>
                    <p class="text-[10px] uppercase font-bold tracking-widest text-[#94A3B8] mb-2">{{ $s['label'] }}</p>
                    <p class="text-3xl font-extrabold text-white">{{ $s['value'] }}</p>
                    <div class="mt-4 flex items-center gap-2">
                        <svg class="w-4 h-4 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            {!! $s['svg'] !!}
                        </svg>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Quick Actions --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
            <a href="{{ route('admin.books.index') }}"
                class="bg-card border border-border rounded-xl p-6 hover:shadow-md hover:-translate-y-0.5 transition-all group">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-xl bg-secondary flex items-center justify-center group-hover:bg-accent/10 transition-colors">
                        <svg class="w-6 h-6 text-primary group-hover:text-accent" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" stroke-width="2">
                            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-foreground">Kelola Buku</h3>
                        <p class="text-sm text-muted-foreground">Tambah, edit, atau hapus data buku</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.categories.index') }}"
                class="bg-card border border-border rounded-xl p-6 hover:shadow-md hover:-translate-y-0.5 transition-all group">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-xl bg-secondary flex items-center justify-center group-hover:bg-accent/10 transition-colors">
                        <svg class="w-6 h-6 text-primary group-hover:text-accent" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" stroke-width="2">
                            <path d="m15 5 6.3 6.3a2.4 2.4 0 0 1 0 3.4L17 19" />
                            <path
                                d="M9.586 5.586A2 2 0 0 0 8.172 5H3.5a.5.5 0 0 0-.5.5v4.672a2 2 0 0 0 .586 1.414L10 18.5c.379.379.882.586 1.414.586a1.99 1.99 0 0 0 1.414-.586l4.672-4.672a2 2 0 0 0 0-2.828l-7.914-7.914Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-foreground">Kelola Kategori</h3>
                        <p class="text-sm text-muted-foreground">Atur kategori buku perpustakaan</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Recent Books --}}
        <div class="bg-card border border-border rounded-xl overflow-hidden shadow-sm">
            <div class="p-6 border-b border-border flex items-center justify-between bg-card">
                <h3 class="font-bold text-foreground">Buku Terbaru</h3>
                <a href="{{ route('admin.books.index') }}"
                    class="px-4 py-2 text-xs font-semibold rounded-lg border border-border hover:bg-secondary transition-colors">Lihat
                    Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-secondary/30">
                            <th
                                class="text-left px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">
                                Kode</th>
                            <th
                                class="text-left px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">
                                Judul</th>
                            <th
                                class="text-left px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">
                                Penulis</th>
                            <th
                                class="text-left px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @foreach ($recentBooks as $buku)
                            <tr class="hover:bg-secondary/20 transition-colors">
                                <td class="px-6 py-4 text-sm font-mono font-semibold text-primary italic">
                                    {{ $buku->kode_buku }}</td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-foreground">{{ $buku->judul }}</div>
                                    <div class="text-[10px] text-muted-foreground">{{ $buku->category->nama ?? '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-muted-foreground">{{ $buku->penulis }}</td>
                                <td class="px-6 py-4">
                                    @if ($buku->status == 'aktif')
                                        <span class="badge-success">Tersedia</span>
                                    @else
                                        <span class="badge-danger">Nonaktif</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin>
