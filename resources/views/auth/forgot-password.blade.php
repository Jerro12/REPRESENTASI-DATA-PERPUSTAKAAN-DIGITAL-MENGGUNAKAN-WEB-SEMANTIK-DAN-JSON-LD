<x-guest-layout>
    <div class="mb-4 text-sm text-[#cbd5e1]">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input id="email"
                class="block mt-1 w-full bg-[#094054] border border-[#0b556d] text-white placeholder-[#cbd5e1] focus:border-[#1dc2fe] focus:ring-2 focus:ring-[#1dc2fe] rounded-md"
                type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="bg-[#1dc2fe] hover:bg-[#0bb0e6] text-[#081e26]">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>