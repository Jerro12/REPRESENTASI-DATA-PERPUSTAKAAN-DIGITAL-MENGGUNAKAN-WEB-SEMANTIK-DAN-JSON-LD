<x-guest-layout>
    <div class="mb-4 text-sm text-[#cbd5e1]">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full
                bg-[#094054]
                border border-[#0b556d]
                text-white placeholder-[#cbd5e1]
                focus:border-[#1dc2fe] focus:ring-2 focus:ring-[#1dc2fe]
                rounded-md shadow-sm
                transition duration-150 ease-in-out" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button class="bg-[#1dc2fe] hover:bg-[#0bb0e6] text-[#081e26]">
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>