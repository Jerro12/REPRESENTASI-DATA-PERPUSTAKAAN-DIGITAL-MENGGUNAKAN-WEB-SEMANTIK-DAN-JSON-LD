<x-guest-layout>
    <div class="flex flex-col md:flex-row min-h-[400px]">
        <!-- Form Left -->
        <div class="w-full md:w-1/2 p-8 md:p-12 border-b md:border-b-0 md:border-r border-white/10 flex flex-col justify-center">
            <h2 class="text-2xl font-black text-foreground mb-4 tracking-tight leading-tight">Lupa Password?</h2>
            <p class="text-sm text-muted-foreground mb-8 leading-relaxed font-medium">Jangan khawatir. Masukkan email Anda dan kami akan mengirimkan tautan untuk mengatur ulang password Anda.</p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-6" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="space-y-2">
                    <label for="email" class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground opacity-70">Alamat Email</label>
                    <div class="relative group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground group-focus-within:text-primary transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com"
                            class="w-full pl-12 pr-4 py-3.5 rounded-2xl bg-secondary/30 border border-border focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all text-sm font-bold text-foreground placeholder:text-muted-foreground/30" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="pt-2">
                    <x-button type="submit" variant="default" size="lg" class="w-full rounded-2xl shadow-xl shadow-primary/30 text-[11px] uppercase tracking-[0.2em] font-black py-4.5">
                        Kirim Link Pemulihan
                    </x-button>
                </div>
                
                <div class="text-center pt-2">
                    <a href="{{ route('login') }}" class="text-xs font-bold text-primary hover:underline italic">Kembali Login</a>
                </div>
            </form>
        </div>

        <!-- Header Right -->
        <div class="w-full md:w-1/2 p-8 md:p-12 bg-primary/[0.03] flex flex-col items-center justify-center text-center relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent pointer-events-none"></div>
            
            <div class="relative z-10 transition-transform duration-700 group-hover:scale-105">
                <div class="w-20 h-20 bg-accent rounded-3xl mx-auto mb-8 flex items-center justify-center shadow-2xl shadow-accent/20 rotate-6 group-hover:rotate-12 transition-transform">
                    <svg class="w-10 h-10 text-accent-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-foreground tracking-tight leading-tight">Keamanan Akun</h3>
                <p class="text-[13px] text-muted-foreground mt-4 font-semibold max-w-[220px] mx-auto leading-relaxed">
                    Kami akan memandu Anda untuk memulihkan akses akun dengan aman.
                </p>
                
                <div class="mt-12 flex justify-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-accent/20"></span>
                    <span class="w-8 h-2 rounded-full bg-accent/40"></span>
                    <span class="w-2 h-2 rounded-full bg-accent/20"></span>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>