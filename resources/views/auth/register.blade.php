<x-guest-layout>
    <div class="flex flex-col md:flex-row min-h-[600px]">
        <!-- Form Left -->
        <div class="w-full md:w-1/2 p-8 md:p-12 border-b md:border-b-0 md:border-r border-white/10 flex flex-col justify-center">
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- NIS -->
                    <div class="space-y-1">
                        <label for="nis" class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground opacity-70">Nomor Induk Siswa</label>
                        <div class="relative group">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground group-focus-within:text-primary transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" /></svg>
                            </div>
                            <input id="nis" type="text" name="nis" value="{{ old('nis') }}" required autofocus placeholder="Masukkan NIS"
                                class="w-full pl-12 pr-4 py-3 rounded-2xl bg-secondary/30 border border-border focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all text-sm font-bold text-foreground placeholder:text-muted-foreground/30" />
                        </div>
                    </div>

                    <!-- Name -->
                    <div class="space-y-1">
                        <label for="name" class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground opacity-70">Nama Lengkap</label>
                        <div class="relative group">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground group-focus-within:text-primary transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                            </div>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required placeholder="Nama lengkap"
                                class="w-full pl-12 pr-4 py-3 rounded-2xl bg-secondary/30 border border-border focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all text-sm font-bold text-foreground placeholder:text-muted-foreground/30" />
                        </div>
                    </div>

                    <!-- Tempat Lahir -->
                    <div class="space-y-1">
                        <label for="tempat_lahir" class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground opacity-70">Tempat Lahir</label>
                        <div class="relative group">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground group-focus-within:text-primary transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                            </div>
                            <input id="tempat_lahir" type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required placeholder="Kota kelahiran"
                                class="w-full pl-12 pr-4 py-3 rounded-2xl bg-secondary/30 border border-border focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all text-sm font-bold text-foreground placeholder:text-muted-foreground/30" />
                        </div>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="space-y-1">
                        <label for="tanggal_lahir" class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground opacity-70">Tanggal Lahir</label>
                        <div class="relative group">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground group-focus-within:text-primary transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                            </div>
                            <input id="tanggal_lahir" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                                class="w-full pl-12 pr-4 py-3 rounded-2xl bg-secondary/30 border border-border focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all text-sm font-bold text-foreground placeholder:text-muted-foreground/30" />
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="space-y-1">
                        <label for="alamat" class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground opacity-70">Alamat</label>
                        <div class="relative group">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground group-focus-within:text-primary transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                            </div>
                            <input id="alamat" type="text" name="alamat" value="{{ old('alamat') }}" required placeholder="Alamat lengkap"
                                class="w-full pl-12 pr-4 py-3 rounded-2xl bg-secondary/30 border border-border focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all text-sm font-bold text-foreground placeholder:text-muted-foreground/30" />
                        </div>
                    </div>

                    <!-- No Telp -->
                    <div class="space-y-1">
                        <label for="no_telp" class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground opacity-70">No. Telp</label>
                        <div class="relative group">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground group-focus-within:text-primary transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.864-1.051l-3.215-.536c-.538-.09-1.071.124-1.396.561l-1.42 1.905c-3.14-1.501-5.69-4.051-7.19-7.19l1.905-1.42c.437-.325.65-.858.561-1.396l-.536-3.215C10.466 3.6 10.016 3.25 9.5 3.25H8.122A2.25 2.25 0 005.872 5.5v1.25z" /></svg>
                            </div>
                            <input id="no_telp" type="tel" name="no_telp" value="{{ old('no_telp') }}" required placeholder="08xxxxxxxxxx"
                                class="w-full pl-12 pr-4 py-3 rounded-2xl bg-secondary/30 border border-border focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all text-sm font-bold text-foreground placeholder:text-muted-foreground/30" />
                        </div>
                    </div>
                </div>

                <!-- Email Address -->
                <div class="space-y-1">
                    <label for="email" class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground opacity-70">Alamat Email</label>
                    <div class="relative group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground group-focus-within:text-primary transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com"
                            class="w-full pl-12 pr-4 py-3 rounded-2xl bg-secondary/30 border border-border focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all text-sm font-bold text-foreground placeholder:text-muted-foreground/30" />
                    </div>
                </div>

                <!-- Password -->
                <div class="space-y-1">
                    <label for="password" class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground opacity-70">Password</label>
                    <div class="relative group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground group-focus-within:text-primary transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input id="password" type="password" name="password" required placeholder="Buat password"
                            class="w-full pl-12 pr-4 py-3 rounded-2xl bg-secondary/30 border border-border focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all text-sm font-bold text-foreground placeholder:text-muted-foreground/30" />
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="space-y-1">
                    <label for="password_confirmation" class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground opacity-70">Konfirmasi Password</label>
                    <div class="relative group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground group-focus-within:text-primary transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Ulangi password"
                            class="w-full pl-12 pr-4 py-3 rounded-2xl bg-secondary/30 border border-border focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all text-sm font-bold text-foreground placeholder:text-muted-foreground/30" />
                    </div>
                </div>

                <div class="pt-4">
                    <x-button type="submit" variant="default" size="lg" class="w-full rounded-2xl shadow-xl shadow-primary/30 text-[11px] uppercase tracking-[0.2em] font-black py-4">
                        Daftar Akun
                    </x-button>
                </div>
                
                <p class="text-center text-xs text-muted-foreground mt-6">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Masuk Area</a>
                </p>
            </form>
        </div>

        <!-- Header Right -->
        <div class="w-full md:w-1/2 p-8 md:p-12 bg-primary/[0.03] flex flex-col items-center justify-center text-center relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent pointer-events-none"></div>
            
            <div class="relative z-10 transition-transform duration-700 group-hover:scale-105">
                <div class="w-20 h-20 bg-primary rounded-3xl mx-auto mb-8 flex items-center justify-center shadow-2xl shadow-primary/20 -rotate-3 group-hover:rotate-0 transition-transform">
                    <svg class="w-10 h-10 text-primary-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                    </svg>
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-foreground tracking-tight leading-[1.1]">Gabung<br/><span class="text-primary">Sekarang</span></h1>
                <p class="text-sm text-muted-foreground mt-6 font-semibold max-w-[240px] mx-auto leading-relaxed">
                    Buat akun Anda untuk mulai menjelajahi ribuan koleksi buku digital kami.
                </p>
                
                <div class="mt-12 flex justify-center gap-2">
                    <span class="w-8 h-2 rounded-full bg-primary/40"></span>
                    <span class="w-2 h-2 rounded-full bg-primary/20"></span>
                    <span class="w-2 h-2 rounded-full bg-primary/20"></span>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>