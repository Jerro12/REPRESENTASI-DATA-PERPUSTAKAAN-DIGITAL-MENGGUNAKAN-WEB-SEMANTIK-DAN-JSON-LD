<x-guest-layout>
    <div class="flex flex-col md:flex-row min-h-[400px]">
        <!-- Content Left -->
        <div class="w-full md:w-1/2 p-8 md:p-12 border-b md:border-b-0 md:border-r border-white/10 flex flex-col justify-center text-left">
            <h2 class="text-2xl font-black text-foreground mb-4 tracking-tight leading-tight">Verifikasi Email</h2>
            <p class="text-sm text-muted-foreground mb-8 leading-relaxed font-medium">
                Terima kasih telah mendaftar! Harap verifikasi alamat email Anda melalui tautan yang baru saja kami kirimkan. Belum menerima email? Kami dengan senang hati akan mengirimkan ulang.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-8 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-xs font-bold text-emerald-600 flex items-center gap-3 animate-slide-up">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Tautan verifikasi baru telah dikirimkan ke email Anda.
                </div>
            @endif

            <div class="flex flex-col sm:flex-row items-center gap-4">
                <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                    @csrf
                    <x-button type="submit" variant="default" class="w-full sm:w-auto rounded-2xl text-[11px] font-black uppercase tracking-wider py-4 px-8">
                        Kirim Ulang Email
                    </x-button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit" class="w-full sm:w-auto text-xs font-bold text-muted-foreground hover:text-foreground px-4 py-2 border border-transparent hover:border-border rounded-xl transition-all">
                        Keluar Akun
                    </button>
                </form>
            </div>
        </div>

        <!-- Illustration Right -->
        <div class="w-full md:w-1/2 p-8 md:p-12 bg-primary/[0.03] flex flex-col items-center justify-center text-center relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent pointer-events-none"></div>
            
            <div class="relative z-10 transition-transform duration-700 group-hover:scale-105">
                <div class="w-20 h-20 bg-primary rounded-3xl mx-auto mb-8 flex items-center justify-center shadow-2xl shadow-primary/20 rotate-3 group-hover:rotate-12 transition-transform">
                    <svg class="w-10 h-10 text-primary-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-foreground tracking-tight leading-tight">Cek Kotak Masuk</h3>
                <p class="text-[13px] text-muted-foreground mt-4 font-semibold max-w-[220px] mx-auto leading-relaxed italic opacity-70">
                    "Satu langkah lagi untuk mulai menjelajah ribuan koleksi buku digital di SIPerpus."
                </p>
                
                <div class="mt-12 flex justify-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-primary/20"></span>
                    <span class="w-8 h-2 rounded-full bg-primary/40 shadow-sm"></span>
                    <span class="w-2 h-2 rounded-full bg-primary/20"></span>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>