<x-guest-layout>
    <x-navbar />
    <!-- Hero -->
    <div class="hero-gradient text-white pt-12 pb-24">
        <div class="max-w-5xl mx-auto px-6">
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="/" class="text-xs font-bold uppercase tracking-widest text-white/60 hover:text-white transition-colors">Beranda</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-white/30" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{ route('katalog.index') }}" class="ml-1 text-xs font-bold uppercase tracking-widest text-white/60 hover:text-white transition-colors md:ml-2">Katalog</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-white/30" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-xs font-bold uppercase tracking-widest text-white/40 md:ml-2 truncate max-w-[200px]">Detail Buku</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-6 -mt-24">
        <div class="bg-card border border-border rounded-[40px] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.15)] overflow-hidden animate-slide-up">
            <div class="p-8 md:p-12">
                <div class="flex flex-col md:flex-row gap-12">
                    <!-- Cover -->
                    <div class="w-full md:w-64 shrink-0 px-4 md:px-0">
                        <div class="aspect-[3/4] rounded-2xl hero-gradient flex items-center justify-center shadow-2xl shadow-primary/20 relative overflow-hidden group">
                            @if($book->cover)
                                <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <svg class="w-20 h-20 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                                </svg>
                            @endif
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-4">
                            <span class="badge-info px-4 py-1.5 rounded-full text-[11px] font-black uppercase tracking-[0.2em] shadow-sm">{{ $book->category->nama ?? 'Buku' }}</span>
                            @if($book->stok_buku > 0)
                                <span class="badge-success px-4 py-1.5 rounded-full text-[11px] font-black tracking-[0.2em] shadow-sm lowercase first-letter:uppercase">✓ Tersedia ({{ $book->stok_buku }})</span>
                            @else
                                <span class="badge-danger px-4 py-1.5 rounded-full text-[11px] font-black tracking-[0.2em] shadow-sm lowercase first-letter:uppercase text-red-500 bg-red-500/10 border border-red-500/20">✕ Habis</span>
                            @endif
                        </div>
                        
                        <h1 class="text-4xl md:text-5xl font-black text-foreground mt-4 leading-tight tracking-tight">{{ $book->judul }}</h1>
                        <p class="text-xl text-muted-foreground mt-2 font-medium italic">Karya {{ $book->penulis }}</p>

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-10">
                            @php
                                $infos = [
                                    ['icon' => '<path d="M4 19.5A2.5 2.5 0 016.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/>', 'label' => "Kode Buku", 'value' => $book->kode_buku],
                                    ['icon' => '<path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2v16z"/>', 'label' => "ISBN", 'value' => $book->isbn ?: '-'],
                                    ['icon' => '<path d="M3 21h18M3 7v14m18-14v14M3 7l9-4 9 4M5 9h14"/>', 'label' => "Penerbit", 'value' => $book->penerbit ?: "-"],
                                    ['icon' => '<path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>', 'label' => "Tahun Terbit", 'value' => $book->tahun_terbit],
                                    ['icon' => '<path d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/>', 'label' => "Bahasa", 'value' => $book->bahasa ?: 'Indonesia'],
                                    ['icon' => '<path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>', 'label' => "Halaman", 'value' => $book->jumlah_halaman ? $book->jumlah_halaman . ' Hal' : '-'],
                                ];
                            @endphp

                            @foreach ($infos as $info)
                                <div class="bg-secondary/50 border border-border/50 rounded-2xl p-4 hover:bg-secondary transition-colors group">
                                    <div class="flex items-center gap-2 mb-2">
                                        <svg class="w-3.5 h-3.5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            {!! $info['icon'] !!}
                                        </svg>
                                        <p class="text-[9px] font-black uppercase tracking-widest text-muted-foreground group-hover:text-primary transition-colors">{{ $info['label'] }}</p>
                                    </div>
                                    <p class="text-sm font-extrabold text-foreground truncate">{{ $info['value'] }}</p>
                                </div>
                            @endforeach
                            
                            @if($book->subjek)
                                <div class="col-span-full bg-primary/5 border border-primary/10 rounded-2xl p-4">
                                    <div class="flex items-center gap-2 mb-1">
                                        <svg class="w-3.5 h-3.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                        <p class="text-[9px] font-black uppercase tracking-widest text-primary/70">Subjek / Topik Terkait</p>
                                    </div>
                                    <p class="text-sm font-bold text-primary italic">{{ $book->subjek }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="mt-12 flex flex-wrap gap-4">
                            @auth
                                @php
                                    $isFavored = auth()->user()->favoriteBooks()->where('book_id', $book->id)->exists();
                                @endphp
                                <form action="{{ route('koleksi.toggle', $book->id) }}" method="POST" class="w-full sm:w-auto">
                                    @csrf
                                    @if($isFavored)
                                        <x-button type="submit" variant="outline" size="lg" class="rounded-2xl w-full sm:w-auto border-primary/30 hover:bg-primary/5 group/btn">
                                            <svg class="w-5 h-5 mr-2 text-primary fill-primary transition-transform group-hover/btn:scale-110" viewBox="0 0 24 24"><path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                                            Hapus dari Koleksi
                                        </x-button>
                                    @else
                                        <x-button type="submit" variant="default" size="lg" class="rounded-2xl shadow-xl shadow-primary/30 w-full sm:w-auto group/btn">
                                            <svg class="w-5 h-5 mr-2 transition-transform group-hover/btn:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                                            Simpan ke Koleksi
                                        </x-button>
                                    @endif
                                </form>

                                <form action="{{ route('borrowing.store', $book->id) }}" method="POST" class="w-full sm:w-auto">
                                    @csrf
                                    @if($activeBorrowing && $activeBorrowing->status === 'pending')
                                        <x-button type="button" variant="outline" size="lg" class="rounded-2xl w-full sm:w-auto border-amber-500/30 text-amber-500 bg-amber-500/5 cursor-not-allowed" disabled>
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            Menunggu Persetujuan
                                        </x-button>
                                    @elseif($activeBorrowing && $activeBorrowing->status === 'borrowed')
                                        <x-button type="button" variant="outline" size="lg" class="rounded-2xl w-full sm:w-auto border-emerald-500/30 text-emerald-500 bg-emerald-500/5 cursor-not-allowed" disabled>
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                            Sedang Dipinjam
                                        </x-button>
                                    @elseif($activeBorrowing && $activeBorrowing->status === 'overdue')
                                        <x-button type="button" variant="outline" size="lg" class="rounded-2xl w-full sm:w-auto border-red-500/30 text-red-500 bg-red-500/5 cursor-not-allowed" disabled>
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                            Terlambat
                                        </x-button>
                                    @elseif($book->stok_buku > 0)
                                        <x-button type="submit" variant="default" size="lg" class="rounded-2xl shadow-xl shadow-accent/30 w-full sm:w-auto bg-slate-900 text-white hover:bg-slate-800 group/btn">
                                            <svg class="w-5 h-5 mr-2 transition-transform group-hover/btn:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Pinjam Buku
                                        </x-button>
                                    @else
                                        <x-button type="button" variant="outline" size="lg" class="rounded-2xl w-full sm:w-auto opacity-50 cursor-not-allowed" disabled>
                                            Stok Habis
                                        </x-button>
                                    @endif
                                </form>
                            @else
                                <x-button variant="default" size="lg" class="rounded-2xl shadow-xl shadow-primary/30 w-full sm:w-auto" onclick="window.location.href='{{ route('login') }}'">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                                    Login untuk Menyimpan
                                </x-button>

                                <x-button variant="outline" size="lg" class="rounded-2xl w-full sm:w-auto" onclick="window.location.href='{{ route('login') }}'">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Login untuk Pinjam
                                </x-button>
                            @endauth
                            
                            @if($book->pdf || $book->url)
                                <x-button variant="outline" size="lg" class="rounded-2xl w-full sm:w-auto">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    Baca Digital
                                </x-button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Description -->
                @if($book->deskripsi)
                    <div class="mt-16 pt-12 border-t border-border">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-1.5 h-10 bg-accent rounded-full shadow-[0_0_15px_rgba(var(--accent-rgb),0.5)]"></div>
                            <h2 class="text-3xl font-black text-foreground tracking-tight">Sinopsis & Deskripsi</h2>
                        </div>
                        <div class="bg-secondary/20 rounded-[32px] p-8 md:p-10 border border-border/50 relative overflow-hidden">
                            <div class="absolute top-0 right-0 p-8 opacity-5">
                                <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.437.917-4 3.638-4 5.849h3.983v10h-9.979z"/></svg>
                            </div>
                            <div class="max-w-none text-muted-foreground leading-relaxed text-lg relative z-10 font-medium">
                                {!! nl2br(e($book->deskripsi)) !!}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Related Books -->
        @if($relatedBooks->count() > 0)
            <div class="mt-20 mb-20 px-4 md:px-0">
                <div class="flex items-center justify-between mb-10">
                    <h2 class="text-3xl font-black text-foreground tracking-tight">Koleksi Terkait</h2>
                    <a href="{{ route('katalog.index', ['kategori' => $book->category_id]) }}" class="text-sm font-bold text-accent hover:underline">Lihat Semua</a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedBooks as $rb)
                        <x-book-card :book="$rb" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-guest-layout>