<x-guest-layout>
    <div class="flex flex-col md:flex-row min-h-[600px]">
        <!-- Form Left -->
        <div class="w-full md:w-1/2 p-8 md:p-12 border-b md:border-b-0 md:border-r border-white/10 flex flex-col justify-center">
            <form method="POST" action="{{ route('register') }}" class="space-y-4" id="registerForm">
                @csrf

                <!-- NIS Check Area -->
                <div class="space-y-1 mb-6">
                    <label for="nis" class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground opacity-70">Nomor Induk Siswa (NIS)</label>
                    <div class="relative group flex gap-2">
                        <div class="relative flex-1">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground group-focus-within:text-primary transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" /></svg>
                            </div>
                            <input id="nis" type="text" name="nis" value="{{ old('nis') }}" required autofocus placeholder="Masukkan NIS Anda"
                                class="w-full pl-12 pr-4 py-3 rounded-xl bg-secondary/30 border border-border focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all text-sm font-bold text-foreground placeholder:text-muted-foreground/30" />
                        </div>
                        <button type="button" id="btnCheckNis" class="px-6 py-3 bg-primary text-primary-foreground font-bold rounded-xl shadow-lg shadow-primary/20 hover:bg-primary/90 transition-colors shrink-0">
                            Cek NIS
                        </button>
                    </div>
                    <p id="nisMessage" class="text-xs mt-2 font-medium hidden"></p>
                    @error('nis') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Hidden Biodata & Auth Fields (Shows after NIS is valid) -->
                <div id="biodataSection" class="hidden space-y-4">
                    <hr class="border-border">
                    <p class="text-xs font-bold text-primary mt-2">Biodata Ditemukan!</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 opacity-70 pointer-events-none">
                        <!-- Name -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground">Nama Lengkap</label>
                            <input id="name" type="text" name="name" readonly class="w-full px-4 py-2 rounded-xl bg-secondary border border-border text-sm font-bold text-foreground" />
                        </div>

                        <!-- Tempat Lahir -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground">Tempat Lahir</label>
                            <input id="tempat_lahir" type="text" name="tempat_lahir" readonly class="w-full px-4 py-2 rounded-xl bg-secondary border border-border text-sm font-bold text-foreground" />
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground">Tanggal Lahir</label>
                            <input id="tanggal_lahir" type="text" name="tanggal_lahir" readonly class="w-full px-4 py-2 rounded-xl bg-secondary border border-border text-sm font-bold text-foreground" />
                        </div>

                        <!-- Alamat -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground">Alamat</label>
                            <input id="alamat" type="text" name="alamat" readonly class="w-full px-4 py-2 rounded-xl bg-secondary border border-border text-sm font-bold text-foreground" />
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground opacity-70">No. Telp</label>
                        <input id="no_telp" type="text" name="no_telp" readonly class="w-full px-4 py-2 rounded-xl bg-secondary border border-border text-sm font-bold text-foreground opacity-70 pointer-events-none" />
                    </div>

                    <hr class="border-border mt-4 mb-4">
                    <p class="text-xs text-muted-foreground mb-2">Silakan lengkapi Email dan Password untuk akun Anda:</p>

                    <!-- Email Address -->
                    <div class="space-y-1">
                        <label for="email" class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground opacity-70">Alamat Email <span class="text-red-500">*</span></label>
                        <div class="relative group">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground group-focus-within:text-primary transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com"
                                class="w-full pl-12 pr-4 py-3 rounded-xl bg-secondary/30 border border-border focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all text-sm font-bold text-foreground" />
                        </div>
                        @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-1">
                        <label for="password" class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground opacity-70">Password <span class="text-red-500">*</span></label>
                        <div class="relative group">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground group-focus-within:text-primary transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <input id="password" type="password" name="password" required placeholder="Buat password"
                                class="w-full pl-12 pr-4 py-3 rounded-xl bg-secondary/30 border border-border focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all text-sm font-bold text-foreground" />
                        </div>
                        @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-1">
                        <label for="password_confirmation" class="text-[10px] font-black uppercase tracking-[0.2em] px-1 text-muted-foreground opacity-70">Konfirmasi Password <span class="text-red-500">*</span></label>
                        <div class="relative group">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground group-focus-within:text-primary transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Ulangi password"
                                class="w-full pl-12 pr-4 py-3 rounded-xl bg-secondary/30 border border-border focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all text-sm font-bold text-foreground" />
                        </div>
                    </div>

                    <div class="pt-4">
                        <x-button type="submit" variant="default" size="lg" class="w-full rounded-xl shadow-xl shadow-primary/30 text-[11px] uppercase tracking-[0.2em] font-black py-4">
                            Daftar Akun
                        </x-button>
                    </div>
                </div>
                
                <p class="text-center text-xs text-muted-foreground mt-6">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Masuk Area</a>
                </p>
            </form>

            <script>
                document.getElementById('btnCheckNis').addEventListener('click', function() {
                    const nis = document.getElementById('nis').value;
                    const msgEl = document.getElementById('nisMessage');
                    const section = document.getElementById('biodataSection');
                    const btn = this;

                    if (!nis) {
                        msgEl.textContent = 'Silakan masukkan NIS terlebih dahulu.';
                        msgEl.className = 'text-xs mt-2 font-medium text-red-500 block';
                        return;
                    }

                    btn.textContent = 'Mengecek...';
                    btn.disabled = true;

                    fetch(`/api/check-nis?nis=${nis}`)
                        .then(res => res.json())
                        .then(data => {
                            btn.textContent = 'Cek NIS';
                            btn.disabled = false;

                            if (data.status === 'success') {
                                msgEl.textContent = 'NIS valid, silakan lanjutkan pengisian.';
                                msgEl.className = 'text-xs mt-2 font-medium text-green-500 block';
                                
                                // Auto fill
                                document.getElementById('name').value = data.data.nama;
                                document.getElementById('tempat_lahir').value = data.data.tempat_lahir || '-';
                                document.getElementById('tanggal_lahir').value = data.data.tanggal_lahir || '-';
                                document.getElementById('alamat').value = data.data.alamat || '-';
                                document.getElementById('no_telp').value = data.data.no_telp || '-';

                                section.classList.remove('hidden');
                                document.getElementById('nis').readOnly = true;
                            } else {
                                msgEl.textContent = data.message;
                                msgEl.className = 'text-xs mt-2 font-medium text-red-500 block';
                                section.classList.add('hidden');
                            }
                        })
                        .catch(err => {
                            btn.textContent = 'Cek NIS';
                            btn.disabled = false;
                            msgEl.textContent = 'Terjadi kesalahan jaringan.';
                            msgEl.className = 'text-xs mt-2 font-medium text-red-500 block';
                        });
                });

                // Auto trigger if there are validation errors (old input exists)
                window.addEventListener('DOMContentLoaded', (event) => {
                    const nisInput = document.getElementById('nis');
                    if (nisInput.value.trim() !== '') {
                        document.getElementById('btnCheckNis').click();
                    }
                });
            </script>
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