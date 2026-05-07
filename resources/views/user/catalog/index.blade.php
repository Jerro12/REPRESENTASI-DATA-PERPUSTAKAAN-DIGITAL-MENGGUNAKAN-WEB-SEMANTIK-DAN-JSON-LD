<x-guest-layout>
    <x-navbar />
    <!-- Header -->
    <div class="hero-gradient text-white py-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-30 pointer-events-none" 
             style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%2367e8f9\' fill-opacity=\'0.6\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')">
        </div>
        <div class="max-w-7xl mx-auto px-6 relative">
            <a href="/" class="inline-flex items-center gap-2 text-sm opacity-80 hover:opacity-100 mb-6 transition-all group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 12H5m7 7-7-7 7-7"/></svg>
                Kembali ke Beranda
            </a>
            <div class="flex flex-col items-center justify-center text-center py-8">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 rounded-3xl bg-white/20 flex items-center justify-center backdrop-blur-md shadow-lg ring-1 ring-white/30">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" /></svg>
                    </div>
                    <h1 class="text-5xl font-black tracking-tight drop-shadow-md">Perpus<span class="text-secondary">Search</span></h1>
                </div>
                <p class="text-lg text-white opacity-90 max-w-2xl  mb-8">Telusuri ribuan judul buku, jurnal, dan koleksi digital untuk mendukung proses belajar Anda.</p>

                <!-- Search Bar -->
                <form action="{{ route('katalog.index') }}" method="GET" class="w-full max-w-3xl relative group">
                    <div class="absolute left-6 top-1/2 -translate-y-1/2 text-white group-focus-within:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><circle cx="11" cy="11" r="8" /><path d="m21 21-4.3-4.3"/></svg>
                    </div>
                    <input
                        type="text"
                        name="q"
                        placeholder="Telusuri judul buku, penulis, subjek, atau ISBN..."
                        value="{{ request('q') }}"
                        class="w-full pl-16 pr-32 py-5 rounded-full bg-white/10 backdrop-blur-md border border-white/30 text-white placeholder:text-white/60 focus:outline-none focus:ring-4 focus:ring-white/20 focus:bg-white/20 text-lg shadow-xl transition-all"
                        autocomplete="off"
                        autofocus
                    />
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 bg-white hover:bg-gray-100 text-primary px-8 py-3 rounded-full font-bold text-sm transition-all shadow-md">
                        Cari Buku
                    </button>
                    
                    @if(request('q'))
                        <div class="absolute -bottom-8 left-0 right-0 text-center">
                            <a href="{{ route('katalog.index') }}" class="text-sm text-white/80 hover:text-white underline decoration-white/30 underline-offset-4 transition-all">Bersihkan pencarian</a>
                        </div>
                    @endif
                </form>
                
                <div class="mt-12 flex items-center justify-center gap-4 text-sm text-white/90">
                    <span class="font-medium">Pencarian populer:</span>
                    <a href="{{ route('katalog.index', ['q' => 'Novel']) }}" class="px-4 py-1.5 rounded-full bg-white/5 hover:bg-white/10 border border-white/10 transition-all">Novel</a>
                    <a href="{{ route('katalog.index', ['q' => 'Pemrograman']) }}" class="px-4 py-1.5 rounded-full bg-white/5 hover:bg-white/10 border border-white/10 transition-all">Pemrograman</a>
                    <a href="{{ route('katalog.index', ['q' => 'Ekonomi']) }}" class="px-4 py-1.5 rounded-full bg-white/5 hover:bg-white/10 border border-white/10 transition-all">Ekonomi</a>
                </div>
            </div>
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
                            <label class="text-[10px] font-bold text-primary uppercase tracking-widest block mb-2 px-1">Kategori</label>
                            <select name="kategori" onchange="this.form.submit()" class="w-full px-4 py-3 bg-secondary border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-accent/30 transition-all font-medium">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $k)
                                    <option value="{{ $k->id }}" {{ in_array($k->id, $activeCategories ?? []) ? 'selected' : '' }}>{{ $k->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-primary uppercase tracking-widest block mb-2 px-1">Tahun Terbit</label>
                            <select name="tahun" onchange="this.form.submit()" class="w-full px-4 py-3 bg-secondary border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-accent/30 transition-all font-medium">
                                <option value="">Semua Tahun</option>
                                @foreach($years as $t)
                                    <option value="{{ $t }}" {{ (isset($finalYear) ? $finalYear : request('tahun')) == $t ? 'selected' : '' }}>{{ $t }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-primary uppercase tracking-widest block mb-2 px-1">Penulis</label>
                            <select name="penulis" onchange="this.form.submit()" class="w-full px-4 py-3 bg-secondary border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-accent/30 transition-all font-medium">
                                <option value="">Semua Penulis</option>
                                @foreach($authors as $p)
                                    <option value="{{ $p }}" {{ (isset($finalAuthor) ? $finalAuthor : request('penulis')) == $p ? 'selected' : '' }}>{{ $p }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </aside>

            <!-- Results -->
            <div class="flex-1">
                {{-- ====== SEARCH FEEDBACK PANEL (seperti Google) ====== --}}
                @if(request('q') && !empty($searchFeedback))
                    <div class="mb-6 p-4 bg-card border border-border rounded-2xl shadow-sm" style="border-left: 4px solid hsl(213 100% 26%);">
                        <div class="flex items-start gap-3">
                            <div class="mt-0.5">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs font-bold text-primary uppercase tracking-widest mb-2">Mesin Pencari Memahami</p>
                                <div class="flex flex-wrap gap-2">
                                    {{-- Kategori Terdeteksi --}}
                                    @if(!empty($searchFeedback['categories']))
                                        @foreach($searchFeedback['categories'] as $catName)
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold ring-1" style="background: hsl(213 100% 96%); color: hsl(213 100% 26%); ring-color: hsl(213 100% 86%);">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                                {{ $catName }}
                                            </span>
                                        @endforeach
                                    @endif

                                    {{-- Urutan --}}
                                    @if(!empty($searchFeedback['sort']))
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold ring-1" style="background: hsl(142 76% 94%); color: hsl(142 71% 30%); ring-color: hsl(142 60% 80%);">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/></svg>
                                            {{ $searchFeedback['sort'] }}
                                        </span>
                                    @endif

                                    {{-- Tahun --}}
                                    @if(!empty($searchFeedback['year']))
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold ring-1" style="background: hsl(38 92% 94%); color: hsl(38 92% 35%); ring-color: hsl(38 80% 75%);">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            Tahun {{ $searchFeedback['year'] }}
                                        </span>
                                    @endif

                                    {{-- Penulis --}}
                                    @if(!empty($searchFeedback['author']))
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold ring-1" style="background: hsl(280 67% 94%); color: hsl(280 67% 35%); ring-color: hsl(280 50% 80%);">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            Penulis: {{ $searchFeedback['author'] }}
                                        </span>
                                    @endif

                                    {{-- Penerbit --}}
                                    @if(!empty($searchFeedback['publisher']))
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold ring-1" style="background: hsl(200 80% 94%); color: hsl(200 80% 30%); ring-color: hsl(200 60% 80%);">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                            Penerbit: {{ $searchFeedback['publisher'] }}
                                        </span>
                                    @endif

                                    {{-- Kata Kunci Sisa --}}
                                    @if(!empty($searchFeedback['keywords']))
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold ring-1" style="background: hsl(0 0% 95%); color: hsl(0 0% 30%); ring-color: hsl(0 0% 80%);">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                                            "{{ $searchFeedback['keywords'] }}"
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="flex items-center justify-between mb-6">
                    <p class="text-sm font-medium text-slate-600">
                        Menampilkan <span class="text-primary font-black">{{ $books->firstItem() ?? 0 }}-{{ $books->lastItem() ?? 0 }}</span> dari <span class="text-primary font-black">{{ $books->total() }}</span> koleksi
                    </p>
                </div>
                
                @if($books->isEmpty())
                    <div class="text-center py-24 bg-card rounded-3xl border border-dashed border-border shadow-sm">
                        <div class="w-20 h-20 bg-secondary rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-muted-foreground/40" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <h2 class="text-xl font-bold text-primary">Buku Tidak Ditemukan</h2>
                        <p class="text-slate-500 mt-2 max-w-xs mx-auto">Coba gunakan kata kunci lain atau hapus beberapa filter pencarian.</p>
                        <x-button variant="outline" class="mt-8" onclick="window.location.href='{{ route('katalog.index') }}'">Reset Filter</x-button>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach ($books as $b)
                            <x-book-card :book="$b" :query="$q ?? request('q')" />
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