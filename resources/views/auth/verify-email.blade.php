<x-guest-layout>
    <div class="mb-4 text-sm text-[#cbd5e1]">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-400">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="bg-[#1dc2fe] hover:bg-[#0bb0e6] text-[#081e26]">
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="underline text-sm text-[#cbd5e1] hover:text-[#1dc2fe] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1dc2fe] transition">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>