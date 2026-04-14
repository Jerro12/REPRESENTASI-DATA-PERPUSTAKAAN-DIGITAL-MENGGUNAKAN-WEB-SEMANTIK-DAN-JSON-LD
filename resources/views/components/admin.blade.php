<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} — Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-background text-foreground transition-colors duration-300" 
      x-data="{ 
        sidebarOpen: window.innerWidth > 1024,
        mobileMenuOpen: false,
        toggleSidebar() { this.sidebarOpen = !this.sidebarOpen }
      }"
      @resize.window="if (window.innerWidth > 1024) mobileMenuOpen = false">
    
    <div class="flex h-screen overflow-hidden">
        {{-- Sidebar --}}
        <x-sidebar />

        {{-- Main content area --}}
        <div class="flex-1 flex flex-col overflow-hidden transition-all duration-300"
             :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-20'">
            
            {{-- Header --}}
            <header class="bg-card shadow-sm border-b border-border sticky top-0 z-40">
                <div class="flex justify-between items-center px-6 py-4">
                    <div class="flex items-center gap-4">
                        <button @click="toggleSidebar()" class="p-2 rounded-lg hover:bg-secondary text-muted-foreground transition-colors">
                            <svg class="w-5 h-5 transition-transform duration-300" :class="!sidebarOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                            </svg>
                        </button>
                        <h1 class="text-lg font-bold text-foreground">Admin Panel</h1>
                    </div>

                    <div class="flex items-center space-x-4">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-secondary transition-all">
                                    <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-primary-foreground font-bold shadow-lg shadow-primary/20">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <span class="text-sm font-semibold text-foreground hidden sm:block">{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 9l-7 7-7-7" stroke-width="2" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="px-4 py-2 border-b border-border">
                                    <p class="text-xs font-bold text-muted-foreground uppercase tracking-widest">Akun Saya</p>
                                    <p class="text-sm font-medium text-foreground truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="text-destructive hover:bg-destructive/10 transition-colors">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke-width="2"/>
                                            </svg>
                                            {{ __('Log Out') }}
                                        </div>
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </header>

            {{-- Main content --}}
            <main class="flex-1 overflow-auto bg-background w-full">
                <div class="p-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>

</html>