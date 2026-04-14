<x-guest-layout>
    <x-navbar />
    <!-- Hero -->
    <section class="hero-gradient text-primary-foreground py-24 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 pointer-events-none" 
             style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')">
        </div>
        <div class="max-w-7xl mx-auto px-6 relative">
            <div class="max-w-2xl animate-fade-in text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-[10px] font-bold uppercase tracking-widest mb-6 backdrop-blur-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-accent animate-pulse"></span>
                    SMA 4 PINRANG
                </div>
                <h1 class="text-4xl md:text-6xl font-extrabold mb-6 leading-[1.1] tracking-tight">
                    Jembatan Menuju<br /><span class="text-accent underline decoration-white/20 underline-offset-8 italic">Ilmu Pengetahuan</span>
                </h1>
                <p class="text-lg opacity-90 mb-10 leading-relaxed text-sidebar-text">
                    Selamat datang di Library Hub SMA 4 Pinrang. Temukan ribuan koleksi buku digital, 
                    telusuri berdasarkan kategori favorit Anda, dan nikmati kemudahan akses literasi kapan pun.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="/katalog" 
                       class="bg-accent text-accent-foreground px-8 py-4 rounded-2xl font-bold flex items-center gap-3 hover:bg-white hover:text-primary transition-all shadow-xl shadow-accent/20 group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <circle cx="11" cy="11" r="8" /><path d="m21 21-4.3-4.3"/>
                        </svg>
                        Jelajahi Katalog
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="py-12 -mt-16 relative z-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
                <!-- Stat 1 -->
                <div class="stat-card-bg rounded-2xl p-8 animate-slide-up shadow-2xl border border-white/10">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-md">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-widest text-[#94A3B8] opacity-70">Total Buku</p>
                            <p class="text-4xl font-black text-white leading-none mt-1">{{ number_format($stats['total_books']) }}</p>
                        </div>
                    </div>
                </div>
                <!-- Stat 2 -->
                <div class="stat-card-bg rounded-2xl p-8 animate-slide-up shadow-2xl border border-white/10" style="animation-delay: 100ms">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-md">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M7 7h10M7 12h10M7 17h10" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-widest text-[#94A3B8] opacity-70">Kategori</p>
                            <p class="text-4xl font-black text-white leading-none mt-1">{{ number_format($stats['total_categories']) }}</p>
                        </div>
                    </div>
                </div>
                <!-- Stat 3 -->
                <div class="stat-card-bg rounded-2xl p-8 animate-slide-up shadow-2xl border border-white/10" style="animation-delay: 200ms">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-md">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-widest text-[#94A3B8] opacity-70">Penulis</p>
                            <p class="text-4xl font-black text-white leading-none mt-1">{{ number_format($stats['total_writers']) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Books -->
    <section id="terbaru" class="py-24 text-left scroll-mt-24">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold text-foreground tracking-tight">Koleksi Terbaru</h2>
                    <p class="text-muted-foreground mt-2 max-w-md">Eksplorasi rilisan buku terbaru yang baru saja mendarat di koleksi perpustakaan kami.</p>
                </div>
                <a href="/katalog" class="flex items-center gap-2 text-primary font-bold hover:gap-3 transition-all group">
                    Lihat Semua Koleksi
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($books as $book)
                    <x-book-card :book="$book" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section id="kategori" class="py-24 bg-secondary/30 relative text-center scroll-mt-24">
        <div class="max-w-7xl mx-auto px-6">
            <div class="max-w-xl mx-auto mb-16">
                <h2 class="text-3xl font-extrabold text-foreground tracking-tight">Berdasarkan Kategori</h2>
                <p class="text-muted-foreground mt-3 uppercase text-[11px] font-bold tracking-[0.2em]">Temukan Minat Bacaan Anda</p>
            </div>
            
                <div class="mt-12">
                    <a href="{{ route('kategori.index') }}" class="inline-flex items-center gap-3 px-8 py-3 bg-primary/5 text-primary rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-primary hover:text-white transition-all shadow-sm">
                        Eksplorasi Semua Kategori
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                </div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach ($categories as $k)
                    <a href="{{ route('katalog.index', ['kategori' => $k->id]) }}" class="bg-card border border-border rounded-3xl p-8 text-center hover:border-primary hover:shadow-2xl transition-all group hover:-translate-y-2 shadow-sm">
                        <div class="w-16 h-16 rounded-2xl bg-secondary mx-auto mb-5 flex items-center justify-center group-hover:bg-primary shadow-inner transition-all duration-300">
                            <svg class="w-7 h-7 text-primary group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-sm text-foreground mb-1 group-hover:text-primary transition-colors truncate">{{ $k->nama }}</h3>
                        <p class="text-[10px] font-bold text-muted-foreground uppercase tracking-widest opacity-60">{{ $k->books_count }} buku</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <footer class="hero-gradient text-primary-foreground py-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 text-left mb-16 px-4 md:px-0">
                <div>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-md">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                            </svg>
                        </div>
                        <span class="text-3xl font-black tracking-tight cursor-default">SIPerpus</span>
                    </div>
                    <p class="text-sidebar-text text-sm max-w-sm leading-relaxed font-medium">Sistem Informasi Perpustakaan Digital SMA 4 Pinrang. Berbasis Web Semantik & JSON-LD untuk memfasilitasi kebutuhan literasi masa depan.</p>
                </div>
                <div class="md:text-right border-l md:border-l-0 md:border-r border-white/10 md:pr-0">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-white/40 mb-3">Lokasi</p>
                    <p class="text-white font-black text-xl mb-3 tracking-tight">SMA 4 PINRANG</p>
                    <p class="text-sidebar-text text-sm leading-relaxed opacity-80 font-medium">
                        2JJ8+MC6, Watang Suppa, Kec. Suppa,<br/>
                        Kabupaten Pinrang, Sulawesi Selatan 91272
                    </p>
                </div>
            </div>

            <div class="pt-10 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-6 px-4 md:px-0">
                <p class="text-[11px] font-black uppercase tracking-[0.2em] text-sidebar-text opacity-60 italic">&copy; {{ date('Y') }} SIPerpus Ecosystem &middot; SMA 4 Pinrang</p>
                <div class="flex gap-8">
                    <a href="#" class="text-xs font-bold text-sidebar-text hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="text-xs font-bold text-sidebar-text hover:text-white transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
        <!-- Decoration -->
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-accent/20 rounded-full blur-[100px]"></div>
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary/20 rounded-full blur-[100px]"></div>
    </footer>
</x-guest-layout>
