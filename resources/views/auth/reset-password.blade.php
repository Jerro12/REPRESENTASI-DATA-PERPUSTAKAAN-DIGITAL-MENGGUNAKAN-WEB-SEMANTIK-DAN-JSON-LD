<x-guest-layout>
    <div class="flex flex-col md:flex-row min-h-[500px]">
        <!-- Form Left -->
        <div class="w-full md:w-1/2 p-8 md:p-12 border-b md:border-b-0 md:border-r border-white/10 flex flex-col justify-center">
            <h2 class="text-2xl font-black text-foreground mb-4 tracking-tight leading-tight">Reset Password</h2>
            <p class="text-sm text-muted-foreground mb-8 leading-relaxed font-medium">Buat password baru yang kuat untuk mengamankan akun Anda.</p>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                @csrf
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="space-y-1.5">
                    <label for="email" class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground opacity-70">Email Address</label>
                    <div class="relative group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus readonly
                            class="w-full pl-12 pr-4 py-3.5 rounded-2xl bg-secondary/20 border border-border text-sm font-bold text-muted-foreground cursor-not-allowed opacity-60 transition-all focus:outline-none" />
                    </div>
                </div>

                <!-- Password -->
                <div class="space-y-1.5">
                    <label for="password" class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground opacity-70">Password Baru</label>
                    <div class="relative group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground group-focus-within:text-primary transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input id="password" type="password" name="password" required placeholder="••••••••"
                            class="w-full pl-12 pr-4 py-3.5 rounded-2xl bg-secondary/30 border border-border focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all text-sm font-bold text-foreground placeholder:text-muted-foreground/30" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- Confirm Password -->
                <div class="space-y-1.5">
                    <label for="password_confirmation" class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground opacity-70">Konfirmasi Password Baru</label>
                    <div class="relative group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground group-focus-within:text-primary transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="••••••••"
                            class="w-full pl-12 pr-4 py-3.5 rounded-2xl bg-secondary/30 border border-border focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all text-sm font-bold text-foreground placeholder:text-muted-foreground/30" />
                    </div>
                </div>

                <div class="pt-4">
                    <x-button type="submit" variant="default" size="lg" class="w-full rounded-2xl shadow-xl shadow-primary/30 text-[11px] uppercase tracking-[0.2em] font-black py-4.5">
                        Perbarui Password
                    </x-button>
                </div>
            </form>
        </div>

        <!-- Header Right -->
        <div class="w-full md:w-1/2 p-8 md:p-12 bg-primary/[0.03] flex flex-col items-center justify-center text-center relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent pointer-events-none"></div>
            
            <div class="relative z-10 transition-transform duration-700 group-hover:scale-105">
                <div class="w-20 h-20 bg-primary rounded-3xl mx-auto mb-8 flex items-center justify-center shadow-2xl shadow-primary/20 rotate-6 transition-transform">
                    <svg class="w-10 h-10 text-primary-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h3 class="text-4xl md:text-5xl font-black text-foreground tracking-tight leading-[1.1]">Proteksi<br/><span class="text-primary">Ekstra</span></h3>
                <p class="text-[13px] text-muted-foreground mt-6 font-semibold max-w-[220px] mx-auto leading-relaxed">
                    Sistem kami menggunakan enkripsi end-to-end untuk melindungi kerahasiaan password Anda.
                </p>
                
                <div class="mt-12 flex justify-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-primary/20"></span>
                    <span class="w-2 h-2 rounded-full bg-primary/20"></span>
                    <span class="w-8 h-2 rounded-full bg-primary/40"></span>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>