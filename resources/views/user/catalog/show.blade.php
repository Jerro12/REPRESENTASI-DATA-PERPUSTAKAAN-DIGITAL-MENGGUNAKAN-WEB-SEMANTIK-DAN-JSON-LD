<x-guest-layout>
    <x-navbar />
    <!-- Hero -->
    <div class="hero-gradient text-white py-12">
        <div class="max-w-5xl mx-auto px-6">
            <a href="{{ route('katalog.index') }}" class="inline-flex items-center gap-2 text-sm opacity-80 hover:opacity-100 mb-6 transition-opacity group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 12H5m7 7-7-7 7-7"/></svg>
                Kembali ke Katalog
            </a>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-6 -mt-12">
        <div class="bg-card border border-border rounded-3xl shadow-2xl overflow-hidden animate-slide-up">
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

                        {{-- Metadata Sidebar --}}
                        <div class="mt-8 space-y-4">
                            <div class="flex items-center gap-3 p-3 bg-secondary/30 rounded-xl">
                                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                <div>
                                    <p class="text-[10px] uppercase font-bold text-muted-foreground tracking-widest">Penulis</p>
                                    <p class="text-sm font-bold text-foreground">{{ $book->penulis }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-secondary/30 rounded-xl">
                                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
                                <div>
                                    <p class="text-[10px] uppercase font-bold text-muted-foreground tracking-widest">ISBN</p>
                                    <p class="text-sm font-bold text-foreground">{{ $book->isbn ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-4">
                            <span class="badge-info px-4 py-1.5 rounded-full text-[11px] font-black uppercase tracking-[0.2em] shadow-sm">{{ $book->category->nama ?? 'Buku' }}</span>
                            @if($book->stok > 0)
                                <span class="badge-success px-4 py-1.5 rounded-full text-[11px] font-black tracking-[0.2em] shadow-sm lowercase first-letter:uppercase">✓ Tersedia</span>
                            @else
                                <span class="badge-danger px-4 py-1.5 rounded-full text-[11px] font-black tracking-[0.2em] shadow-sm lowercase first-letter:uppercase">✗ Habis</span>
                            @endif
                        </div>
                        
                        <h1 class="text-4xl md:text-5xl font-black text-foreground mt-4 leading-tight tracking-tight">{{ $book->judul }}</h1>
                        <p class="text-xl text-muted-foreground mt-2 font-medium italic">Karya {{ $book->penulis }}</p>

                        <div class="grid grid-cols-2 gap-4 mt-10">
                            @php
                                $infos = [
                                    ['icon' => 'building', 'label' => "Penerbit", 'value' => $book->penerbit ?: "-"],
                                    ['icon' => 'calendar', 'label' => "Tahun Terbit", 'value' => $book->tahun_terbit],
                                    ['icon' => 'hash', 'label' => "Kode Buku", 'value' => $book->kode],
                                    ['icon' => 'layers', 'label' => "Total Stok", 'value' => $book->stok . ' Eksemplar'],
                                ];
                            @endphp

                            @foreach ($infos as $info)
                                <div class="bg-secondary/50 border border-border/50 rounded-2xl p-5 hover:bg-secondary transition-colors group">
                                    <p class="text-[10px] font-black uppercase tracking-widest text-muted-foreground group-hover:text-primary transition-colors mb-2">{{ $info['label'] }}</p>
                                    <p class="text-base font-extrabold text-foreground">{{ $info['value'] }}</p>
                                </div>
                            @endforeach
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
                            @else
                                <x-button variant="default" size="lg" class="rounded-2xl shadow-xl shadow-primary/30 w-full sm:w-auto" onclick="window.location.href='{{ route('login') }}'">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                                    Login untuk Menyimpan
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
                    <div class="mt-12 pt-12 border-t border-border">
                        <h2 class="text-2xl font-black text-foreground mb-6 flex items-center gap-3">
                            <span class="w-2 h-8 bg-accent rounded-full"></span>
                            Sinopsis & Deskripsi
                        </h2>
                        <div class="max-w-none text-muted-foreground leading-relaxed text-lg italic">
                            {!! nl2br(e($book->deskripsi)) !!}
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
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                    @foreach($relatedBooks as $rb)
                        <a href="{{ route('katalog.show', $rb->id) }}" class="group block h-full">
                            <div class="bg-card border border-border rounded-3xl overflow-hidden hover:shadow-2xl transition-all hover:-translate-y-2 flex flex-col h-full shadow-sm">
                                <div class="h-40 relative flex items-center justify-center bg-secondary overflow-hidden">
                                     @if($rb->cover)
                                        <img src="{{ asset('storage/' . $rb->cover) }}" alt="{{ $rb->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full hero-gradient flex items-center justify-center opacity-40">
                                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-6">
                                    <h3 class="font-bold text-foreground text-base group-hover:text-primary transition-colors line-clamp-2 truncate">{{ $rb->judul }}</h3>
                                    <p class="text-xs text-muted-foreground mt-2 uppercase font-bold tracking-widest">{{ $rb->penulis }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-guest-layout>