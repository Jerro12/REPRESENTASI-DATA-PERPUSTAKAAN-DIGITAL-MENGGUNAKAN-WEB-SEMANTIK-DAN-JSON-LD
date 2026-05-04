@props(['book', 'query' => null])

<a href="{{ route('katalog.show', $book->id) }}" class="group block h-full">
    <div class="bg-card border border-border rounded-3xl overflow-hidden hover:shadow-2xl transition-all hover:-translate-y-2 flex flex-col h-full shadow-sm">
        <div class="aspect-[4/3] relative overflow-hidden bg-secondary">
            @if($book->cover)
                <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            @else
                <div class="w-full h-full hero-gradient flex items-center justify-center">
                    <svg class="w-12 h-12 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                    </svg>
                </div>
            @endif
            <div class="absolute top-4 left-4">
                <span class="badge-info backdrop-blur-md px-3 py-1 text-[10px] font-black uppercase tracking-widest shadow-lg">
                    {!! \App\Models\Book::highlightText($book->category->nama ?? 'Buku', $query) !!}
                </span>
            </div>

        </div>
        <div class="p-6 flex-1 flex flex-col">
            <h3 class="font-bold text-foreground text-lg group-hover:text-primary transition-colors line-clamp-1 truncate">
                {!! $book->getHighlighted('judul', $query) !!}
            </h3>
            <p class="text-xs text-muted-foreground mt-1 flex-1 line-clamp-1">
                Oleh: {!! $book->getHighlighted('penulis', $query) !!}
            </p>
            
            @if($query)
                <div class="mt-3 text-[11px] text-slate-500 line-clamp-2 italic leading-relaxed border-l-2 border-primary/20 pl-2">
                    {!! $book->getHighlighted('deskripsi', $query) !!}
                </div>
            @endif


            <div class="flex items-center justify-between pt-4 border-t border-border mt-auto">
                <div class="text-[10px] font-bold text-muted-foreground uppercase tracking-widest">
                    {{ $book->tahun_terbit }} · {{ $book->penerbit }}
                </div>
                @if($book->stok_buku > 0)
                    <span class="badge-success text-[10px] font-black tracking-widest uppercase">Tersedia</span>
                @else
                    <span class="badge-danger text-[10px] font-black tracking-widest uppercase">Kosong</span>
                @endif
            </div>
        </div>
    </div>
</a>

