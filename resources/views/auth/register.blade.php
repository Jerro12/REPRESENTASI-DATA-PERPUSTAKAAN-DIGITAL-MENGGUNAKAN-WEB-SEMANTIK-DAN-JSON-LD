<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <x-input-label for="name" :value="__('Name')" class="text-white" />
            <x-text-input id="name"
                class="block mt-1 w-full bg-[#094054] border border-[#0b556d] text-white placeholder-[#cbd5e1] focus:border-[#1dc2fe] focus:ring-2 focus:ring-[#1dc2fe] rounded-md"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input id="email"
                class="block mt-1 w-full bg-[#094054] border border-[#0b556d] text-white placeholder-[#cbd5e1] focus:border-[#1dc2fe] focus:ring-2 focus:ring-[#1dc2fe] rounded-md"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" class="text-white" />
            <x-text-input id="password"
                class="block mt-1 w-full bg-[#094054] border border-[#0b556d] text-white placeholder-[#cbd5e1] focus:border-[#1dc2fe] focus:ring-2 focus:ring-[#1dc2fe] rounded-md"
                type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white" />
            <x-text-input id="password_confirmation"
                class="block mt-1 w-full bg-[#094054] border border-[#0b556d] text-white placeholder-[#cbd5e1] focus:border-[#1dc2fe] focus:ring-2 focus:ring-[#1dc2fe] rounded-md"
                type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
        </div>

        <div class="flex items-center justify-end mt-4 gap-4">
            <a class="underline text-sm text-[#cbd5e1] hover:text-[#1dc2fe] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1dc2fe]"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4 bg-[#1dc2fe] hover:bg-[#0bb0e6] text-[#081e26]">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>