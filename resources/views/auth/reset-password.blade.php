<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input id="email"
                class="block mt-1 w-full bg-[#094054] border border-[#0b556d] text-white placeholder-[#cbd5e1] focus:border-[#1dc2fe] focus:ring-2 focus:ring-[#1dc2fe] rounded-md"
                type="email" name="email" :value="old('email', $request->email)" required autofocus
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-white" />
            <x-text-input id="password"
                class="block mt-1 w-full bg-[#094054] border border-[#0b556d] text-white placeholder-[#cbd5e1] focus:border-[#1dc2fe] focus:ring-2 focus:ring-[#1dc2fe] rounded-md"
                type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white" />
            <x-text-input id="password_confirmation"
                class="block mt-1 w-full bg-[#094054] border border-[#0b556d] text-white placeholder-[#cbd5e1] focus:border-[#1dc2fe] focus:ring-2 focus:ring-[#1dc2fe] rounded-md"
                type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="bg-[#1dc2fe] hover:bg-[#0bb0e6] text-[#081e26]">
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input id="email"
                class="block mt-1 w-full bg-[#094054] border border-[#0b556d] text-white placeholder-[#cbd5e1] focus:border-[#1dc2fe] focus:ring-2 focus:ring-[#1dc2fe] rounded-md"
                type="email" name="email" :value="old('email', $request->email)" required autofocus
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-white" />
            <x-text-input id="password"
                class="block mt-1 w-full bg-[#094054] border border-[#0b556d] text-white placeholder-[#cbd5e1] focus:border-[#1dc2fe] focus:ring-2 focus:ring-[#1dc2fe] rounded-md"
                type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white" />
            <x-text-input id="password_confirmation"
                class="block mt-1 w-full bg-[#094054] border border-[#0b556d] text-white placeholder-[#cbd5e1] focus:border-[#1dc2fe] focus:ring-2 focus:ring-[#1dc2fe] rounded-md"
                type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="bg-[#1dc2fe] hover:bg-[#0bb0e6] text-[#081e26]">
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>