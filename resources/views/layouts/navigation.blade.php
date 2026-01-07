<nav x-data="{ open: false }" class="bg-[#081e26] border-b border-[#094054] sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
            <x-application-logo class="w-8 h-8 text-[#1dc2fe]" />
            <span class="font-semibold text-lg text-white">Perpustakaan Digital</span>
        </a>

        <!-- Menu di tengah -->
        <div class="hidden md:flex flex-1 justify-center items-center gap-8 text-sm text-[#cbd5e1]">
            <a href="{{ route('dashboard') }}" 
               class="hover:text-[#1dc2fe] transition {{ request()->routeIs('user.home.dashboard') ? 'text-[#1dc2fe] font-medium' : '' }}">
                Beranda
            </a>
            <a href="{{ route('katalog.index') }}" 
               class="hover:text-[#1dc2fe] transition {{ request()->routeIs('katalog.*') ? 'text-[#1dc2fe] font-medium' : '' }}">
                Katalog
            </a>
            <a href="{{ route('koleksi') }}" 
               class="hover:text-[#1dc2fe] transition {{ request()->routeIs('koleksi') ? 'text-[#1dc2fe] font-medium' : '' }}">
                Koleksi
            </a>
        </div>

        <!-- Right: Profile Dropdown & Hamburger -->
        <div class="flex items-center gap-3">
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-[#cbd5e1] bg-[#094054] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1dc2fe] transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-[#cbd5e1] hover:text-white hover:bg-[#094054] focus:outline-none focus:bg-[#094054] focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('user.home.dashboard')">
                {{ __('Beranda') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('katalog.index')" :active="request()->routeIs('katalog.*')">
                {{ __('Katalog') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('koleksi')" :active="request()->routeIs('koleksi')">
                {{ __('Koleksi') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-[#094054]">
            <div class="px-4">
                <div class="font-medium text-base text-[#cbd5e1]">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-[#94a3b8]">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>