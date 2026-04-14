<x-guest-layout>
    <x-navbar />

    <!-- Header -->
    <div class="hero-gradient text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 pointer-events-none" 
             style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')">
        </div>
        <div class="max-w-7xl mx-auto px-6 relative text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 text-[10px] font-black uppercase tracking-[0.2em] mb-6 backdrop-blur-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-accent animate-pulse"></span>
                Koleksi Terorganisir
            </div>
            <h1 class="text-4xl md:text-5xl font-black tracking-tight mb-4 leading-tight">Jelajahi Berdasarkan<br/><span class="text-accent underline decoration-white/20 underline-offset-8 italic">Kategori Buku</span></h1>
            <p class="text-lg opacity-80 max-w-2xl mx-auto font-medium leading-relaxed italic">"Buku adalah pesawat, kereta api, dan jalan raya. Mereka adalah tujuan, dan perjalanan. Mereka adalah rumah."</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach ($categories as $c)
                <a href="{{ route('katalog.index', ['kategori' => $c->id]) }}" class="group">
                    <div class="bg-card border border-border rounded-[32px] p-8 h-full hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 relative overflow-hidden border-b-4 border-b-primary/10 hover:border-b-primary/50 shadow-sm flex flex-col items-center text-center">
                        {{-- Background Accent --}}
                        <div class="absolute -top-12 -right-12 w-32 h-32 bg-primary/5 rounded-full blur-2xl group-hover:bg-primary/10 transition-colors"></div>
                        
                        {{-- Icon Box --}}
                        <div class="w-20 h-20 rounded-3xl bg-secondary mb-6 flex items-center justify-center group-hover:bg-primary group-hover:scale-110 transition-all duration-500 group-hover:rotate-6 shadow-inner">
                            <svg class="w-10 h-10 text-primary group-hover:text-primary-foreground transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>

                        <h3 class="text-xl font-black text-foreground mb-3 group-hover:text-primary transition-colors leading-tight line-clamp-2">{{ $c->nama }}</h3>
                        
                        <div class="mt-auto">
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-secondary transition-all group-hover:bg-primary/10 group-hover:border-primary/20 border border-transparent">
                                <span class="text-[11px] font-black text-primary tracking-widest uppercase">{{ $c->books_count }} Buku</span>
                            </div>
                        </div>
                        
                        <div class="mt-6 flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-muted-foreground group-hover:text-primary transition-all opacity-0 group-hover:opacity-100 -translate-y-2 group-hover:translate-y-0 duration-300">
                            Lihat Katalog
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-guest-layout>
