<x-guest-layout>
    <x-navbar />

    <!-- Header -->
    <div class="hero-gradient text-white py-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 pointer-events-none" 
             style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')">
        </div>
        <div class="max-w-7xl mx-auto px-6 relative">
            <div class="flex items-center gap-6 mb-4">
                <div class="w-16 h-16 rounded-3xl bg-white/10 flex items-center justify-center backdrop-blur-md shadow-2xl">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-4xl font-black tracking-tight">Koleksi Saya</h1>
                    <p class="text-lg opacity-80 mt-1 uppercase text-[11px] font-bold tracking-[0.2em]">Daftar Buku Pilihan & Favorit Anda</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex flex-col gap-8">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-muted-foreground">
                    Menampilkan <span class="text-foreground font-bold">{{ $books->total() }}</span> buku dalam koleksi Anda
                </p>
            </div>

            @if($books->isEmpty())
                <div class="text-center py-24 bg-card rounded-[40px] border border-dashed border-border shadow-sm overflow-hidden relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary/[0.02] to-transparent pointer-events-none"></div>
                    <div class="relative z-10">
                        <div class="w-24 h-24 bg-secondary rounded-full flex items-center justify-center mx-auto mb-8 shadow-inner">
                            <svg class="w-12 h-12 text-muted-foreground/30" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-black text-foreground">Koleksi Masih Kosong</h2>
                        <p class="text-muted-foreground mt-3 max-w-xs mx-auto font-medium leading-relaxed">Mulai jelajahi katalog dan simpan buku-buku menarik ke dalam koleksi pribadi Anda.</p>
                        <x-button variant="default" class="mt-10 rounded-2xl px-8 py-4 shadow-xl shadow-primary/20 font-black uppercase tracking-widest text-[11px]" onclick="window.location.href='{{ route('katalog.index') }}'">Jelajahi Katalog</x-button>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach ($books as $book)
                        <x-book-card :book="$book" />
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $books->links() }}
                </div>
            @endif
        </div>
    </div>
</x-guest-layout>