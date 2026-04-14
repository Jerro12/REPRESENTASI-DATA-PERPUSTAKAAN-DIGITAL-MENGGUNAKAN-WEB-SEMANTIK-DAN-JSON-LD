<x-guest-layout>
    <x-navbar />
    <!-- Header -->
    <div class="hero-gradient text-white py-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 pointer-events-none" 
             style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')">
        </div>
        <div class="max-w-7xl mx-auto px-6 relative">
            <a href="/" class="inline-flex items-center gap-2 text-sm opacity-80 hover:opacity-100 mb-6 transition-all group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 12H5m7 7-7-7 7-7"/></svg>
                Kembali ke Beranda
            </a>
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-md">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" /></svg>
                </div>
                <h1 class="text-4xl font-black tracking-tight">Katalog Buku</h1>
            </div>
            <p class="text-lg opacity-80 max-w-xl">Cari dan temukan koleksi digital terbaik untuk mendukung proses belajar Anda.</p>

            <!-- Search Bar -->
            <form action="{{ route('katalog.index') }}" method="GET" class="mt-8 relative max-w-2xl group">
                <div class="absolute left-5 top-1/2 -translate-y-1/2 opacity-50 group-focus-within:opacity-100 group-focus-within:text-accent transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><circle cx="11" cy="11" r="8" /><path d="m21 21-4.3-4.3"/></svg>
                </div>
                <input
                    type="text"
                    name="q"
                    placeholder="Cari judul buku, penulis, atau kata kunci..."
                    value="{{ request('q') }}"
                    class="w-full pl-14 pr-6 py-4 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-white placeholder:text-white/40 focus:outline-none focus:ring-2 focus:ring-accent/50 text-sm transition-all"
                />
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Filters Sidebar -->
            <aside class="lg:w-72 shrink-0">
                <div class="bg-card border border-border rounded-3xl p-6 sticky top-24 shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-foreground flex items-center gap-2">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M22 3H2l8 9.46V19l4 2v-8.54L22 3z"/></svg>
                            Filter Katalog
                        </h3>
                        <a href="{{ route('katalog.index') }}" class="text-[10px] font-bold text-accent uppercase tracking-widest hover:underline">Reset</a>
                    </div>

                    <form action="{{ route('katalog.index') }}" method="GET" id="filterForm" class="space-y-6">
                        @if(request('q'))
                            <input type="hidden" name="q" value="{{ request('q') }}">
                        @endif

                        <div>
                            <label class="text-[10px] font-bold text-muted-foreground uppercase tracking-widest block mb-2 px-1">Kategori</label>
                            <select name="kategori" onchange="this.form.submit()" class="w-full px-4 py-3 bg-secondary border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-accent/30 transition-all font-medium">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $k)
                                    <option value="{{ $k->id }}" {{ request('kategori') == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-muted-foreground uppercase tracking-widest block mb-2 px-1">Tahun Terbit</label>
                            <select name="tahun" onchange="this.form.submit()" class="w-full px-4 py-3 bg-secondary border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-accent/30 transition-all font-medium">
                                <option value="">Semua Tahun</option>
                                @foreach($years as $t)
                                    <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>{{ $t }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-muted-foreground uppercase tracking-widest block mb-2 px-1">Penulis</label>
                            <select name="penulis" onchange="this.form.submit()" class="w-full px-4 py-3 bg-secondary border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-accent/30 transition-all font-medium">
                                <option value="">Semua Penulis</option>
                                @foreach($authors as $p)
                                    <option value="{{ $p }}" {{ request('penulis') == $p ? 'selected' : '' }}>{{ $p }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </aside>

            <!-- Results -->
            <div class="flex-1">
                <div class="flex items-center justify-between mb-6">
                    <p class="text-sm font-medium text-muted-foreground">
                        Menampilkan <span class="text-foreground font-bold">{{ $books->firstItem() ?? 0 }}-{{ $books->lastItem() ?? 0 }}</span> dari <span class="text-foreground font-bold">{{ $books->total() }}</span> koleksi
                    </p>
                </div>
                
                @if($books->isEmpty())
                    <div class="text-center py-24 bg-card rounded-3xl border border-dashed border-border shadow-sm">
                        <div class="w-20 h-20 bg-secondary rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-muted-foreground/40" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <h2 class="text-xl font-bold text-foreground">Buku Tidak Ditemukan</h2>
                        <p class="text-muted-foreground mt-2 max-w-xs mx-auto">Coba gunakan kata kunci lain atau hapus beberapa filter pencarian.</p>
                        <x-button variant="outline" class="mt-8" onclick="window.location.href='{{ route('katalog.index') }}'">Reset Filter</x-button>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach ($books as $b)
                            <x-book-card :book="$b" />
                        @endforeach
                    </div>

                    <div class="mt-12">
                        {{ $books->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>