<section class="space-y-6">
    <header>
        <h2 class="text-xl font-black text-rose-600">
            {{ __('Hapus Akun') }}
        </h2>

        <p class="mt-1 text-sm text-muted-foreground">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="rounded-2xl px-8 py-4 font-black uppercase tracking-widest text-[11px] shadow-xl shadow-rose-500/20"
    >{{ __('Hapus Akun Permanen') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8 md:p-12">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-black text-foreground">
                {{ __('Apakah Anda yakin ingin menghapus akun?') }}
            </h2>

            <p class="mt-4 text-sm text-muted-foreground">
                {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.') }}
            </p>

            <div class="mt-8 space-y-2">
                <x-input-label for="password" value="{{ __('Kata Sandi') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full px-5 py-3.5 rounded-2xl bg-secondary border-border focus:ring-4 focus:ring-rose-500/10 transition-all font-bold text-sm"
                    placeholder="{{ __('Masukkan Kata Sandi Anda') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-10 flex justify-end gap-4">
                <x-button type="button" variant="outline" x-on:click="$dispatch('close')" class="rounded-xl px-6">
                    {{ __('Batal') }}
                </x-button>

                <x-danger-button class="rounded-xl px-8 py-3">
                    {{ __('Ya, Hapus Akun') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>