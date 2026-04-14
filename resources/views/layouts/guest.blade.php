<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html {
            scroll-behavior: smooth;
        }

        .scroll-mt-24 {
            scroll-margin-top: 6rem;
        }
    </style>
</head>

<body class="font-sans antialiased bg-background text-foreground selection:bg-primary/20">
    {{-- Halaman Auth --}}
    @if (request()->routeIs('login', 'register', 'password.*', 'verification.*'))
        <div class="min-h-screen flex flex-col justify-center items-center p-6 hero-gradient relative overflow-hidden">
            <!-- Background Decoration -->
            <div class="absolute -top-48 -left-48 w-[600px] h-[600px] bg-white/10 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute -bottom-48 -right-48 w-[600px] h-[600px] bg-primary/20 rounded-full blur-[120px] pointer-events-none"></div>

            <div class="w-full sm:max-w-4xl relative z-10 animate-fade-in px-4">
                <div class="bg-card/85 backdrop-blur-3xl border border-white/20 shadow-[0_32px_64px_-12px_rgba(0,0,0,0.25)] rounded-[48px] overflow-hidden border-t-white/30">
                    {{ $slot }}
                </div>
                
                <!-- Back Link -->
                <div class="mt-8 text-center">
                    <a href="/" class="text-sm font-bold text-white/60 hover:text-white transition-all flex items-center justify-center gap-2 group">
                        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M19 12H5m7 7-7-7 7-7"/></svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    @else
        {{-- Landing page / guest --}}
        <div class="min-h-screen bg-background text-foreground transition-colors duration-300">
            {{ $slot }}
        </div>
    @endif
    {{-- Notifications --}}
    @if(session('success') || session('error'))
        <div x-data="{ show: true }" 
             x-init="setTimeout(() => show = false, 5000)" 
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-4"
             class="fixed bottom-8 right-8 z-[200] max-w-sm w-full">
            <div class="bg-card/90 backdrop-blur-2xl border border-white/20 shadow-2xl rounded-3xl p-5 flex items-center gap-4 border-t-white/30">
                <div class="w-12 h-12 rounded-2xl flex-shrink-0 flex items-center justify-center {{ session('success') ? 'bg-emerald-500/20 text-emerald-500' : 'bg-destructive/20 text-destructive' }}">
                    @if(session('success'))
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    @else
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    @endif
                </div>
                <div class="flex-1">
                    <p class="text-[10px] font-black uppercase tracking-widest opacity-50 mb-0.5">{{ session('success') ? 'Berhasil' : 'Galat' }}</p>
                    <p class="text-sm font-bold text-foreground">{{ session('success') ?? session('error') }}</p>
                </div>
                <button @click="show = false" class="text-muted-foreground hover:text-foreground transition-colors p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2.5"/></svg>
                </button>
            </div>
            {{-- Progress Bar --}}
            <div class="absolute bottom-0 left-6 right-6 h-1 bg-primary/20 rounded-full overflow-hidden">
                <div class="h-full bg-primary animate-[progress_5s_linear_forwards]"></div>
            </div>
        </div>
        
        <style>
            @keyframes progress {
                from { width: 100%; }
                to { width: 0%; }
            }
        </style>
    @endif
</body>

</html>