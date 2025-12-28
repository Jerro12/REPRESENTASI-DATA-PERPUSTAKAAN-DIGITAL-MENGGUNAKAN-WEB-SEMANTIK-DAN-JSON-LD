<section class="p-6 bg-white shadow sm:rounded-lg">
    <header>
        <h2 class="text-lg font-medium text-[#1dc2fe]">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password"
                class="mt-1 block w-full bg-[#094054] border border-[#0b556d] text-white placeholder-[#cbd5e1] focus:border-[#1dc2fe] focus:ring-2 focus:ring-[#1dc2fe]"
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password"
                class="mt-1 block w-full bg-[#094054] border border-[#0b556d] text-white placeholder-[#cbd5e1] focus:border-[#1dc2fe] focus:ring-2 focus:ring-[#1dc2fe]"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password