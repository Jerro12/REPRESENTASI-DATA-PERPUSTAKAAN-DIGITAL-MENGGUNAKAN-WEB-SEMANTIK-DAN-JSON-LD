<section>
    <header>
        <h2 class="text-xl font-black text-foreground">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-sm text-muted-foreground">
            {{ __("Perbarui informasi profil akun dan alamat email Anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('patch')

        <div class="space-y-2">
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-[10px] font-black uppercase tracking-widest text-muted-foreground opacity-60 ml-1" />
            <x-text-input id="name" name="name" type="text"
                class="w-full px-5 py-3.5 rounded-2xl bg-secondary/50 border-border focus:bg-white focus:ring-4 focus:ring-primary/10 transition-all font-bold text-sm"
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="space-y-2">
            <x-input-label for="nis" :value="__('Nomor Induk Siswa (NIS)')" class="text-[10px] font-black uppercase tracking-widest text-muted-foreground opacity-60 ml-1" />
            <x-text-input id="nis" name="nis" type="text"
                class="w-full px-5 py-3.5 rounded-2xl bg-secondary/50 border-border focus:bg-white focus:ring-4 focus:ring-primary/10 transition-all font-bold text-sm"
                :value="old('nis', $user->nis)" placeholder="Contoh: 123456" />
            <x-input-error class="mt-2" :messages="$errors->get('nis')" />
        </div>

        <div class="space-y-2">
            <x-input-label for="email" :value="__('Alamat Email')" class="text-[10px] font-black uppercase tracking-widest text-muted-foreground opacity-60 ml-1" />
            <x-text-input id="email" name="email" type="email"
                class="w-full px-5 py-3.5 rounded-2xl bg-secondary/50 border-border focus:bg-white focus:ring-4 focus:ring-primary/10 transition-all font-bold text-sm"
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-primary">
                        {{ __('Alamat email Anda belum diverifikasi.') }}

                        <button form="send-verification"
                            class="underline text-sm text-muted-foreground hover:text-primary rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-emerald-500">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4">
            <x-button type="submit" variant="default" class="rounded-2xl px-8 py-4 font-black uppercase tracking-widest text-[11px] shadow-xl shadow-primary/30">
                {{ __('Simpan Perubahan') }}
            </x-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-emerald-500 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    {{ __('Berhasil disimpan.') }}
                </p>
            @endif
        </div>
    </form>
</section>