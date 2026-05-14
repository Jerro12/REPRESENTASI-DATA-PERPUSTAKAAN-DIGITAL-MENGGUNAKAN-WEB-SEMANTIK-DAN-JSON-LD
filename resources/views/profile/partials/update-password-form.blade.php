<section>
    <header>
        <h2 class="text-xl font-black text-foreground">
            {{ __('Keamanan Akun') }}
        </h2>

        <p class="mt-1 text-sm text-muted-foreground">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('put')

        <div class="space-y-2">
            <x-input-label for="update_password_current_password" :value="__('Kata Sandi Saat Ini')" class="text-[10px] font-black uppercase tracking-widest text-muted-foreground opacity-60 ml-1" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" 
                class="w-full px-5 py-3.5 rounded-2xl bg-secondary/50 border-border focus:bg-white focus:ring-4 focus:ring-primary/10 transition-all font-bold text-sm"
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <x-input-label for="update_password_password" :value="__('Kata Sandi Baru')" class="text-[10px] font-black uppercase tracking-widest text-muted-foreground opacity-60 ml-1" />
            <x-text-input id="update_password_password" name="password" type="password" 
                class="w-full px-5 py-3.5 rounded-2xl bg-secondary/50 border-border focus:bg-white focus:ring-4 focus:ring-primary/10 transition-all font-bold text-sm"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="text-[10px] font-black uppercase tracking-widest text-muted-foreground opacity-60 ml-1" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                class="w-full px-5 py-3.5 rounded-2xl bg-secondary/50 border-border focus:bg-white focus:ring-4 focus:ring-primary/10 transition-all font-bold text-sm"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <x-button type="submit" variant="default" class="rounded-2xl px-8 py-4 font-black uppercase tracking-widest text-[11px] shadow-xl shadow-primary/30">
                {{ __('Ubah Kata Sandi') }}
            </x-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-emerald-500 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    {{ __('Berhasil diubah.') }}
                </p>
            @endif
        </div>
    </form>
</section>