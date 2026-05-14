<nav x-data="{ 
        activeAnchor: window.location.hash || '',
        isLanding: {{ (request()->path() == '/' || request()->routeIs('dashboard')) ? 'true' : 'false' }} 
     }" 
     x-init="
        window.addEventListener('hashchange', () => {
            activeAnchor = window.location.hash;
        });
        window.addEventListener('scroll', () => {
            if (window.scrollY < 100) activeAnchor = '';
        });
     }"
     class="sticky top-0 z-50 px-6 py-4 transition-all duration-500">
    <div class="max-w-7xl mx-auto">
        <div class="bg-card/70 backdrop-blur-xl border border-white/20 shadow-[0_20px_50px_rgba(0,0,0,0.1)] rounded-[32px] px-8 h-20 flex items-center justify-between">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-4 group">
                <div class="w-12 h-12 rounded-2xl bg-primary flex items-center justify-center shadow-xl shadow-primary/30 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                    <svg class="w-7 h-7 text-primary-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                    </svg>
                </div>
                <div class="hidden sm:block">
                    <span class="text-2xl font-black text-foreground block leading-none tracking-tighter">SIPerpus</span>
                    <span class="text-[10px] text-muted-foreground uppercase font-black tracking-[0.25em] mt-1 block opacity-60 italic">SMA 4 PINRANG</span>
                </div>
            </a>

            <!-- Nav Links -->
            <div class="hidden lg:flex items-center gap-10">
                <a href="/" 
                   @click="activeAnchor = ''"
                   class="text-sm font-black transition-all relative group/link"
                   :class="(isLanding && activeAnchor === '') ? 'text-primary' : 'text-muted-foreground hover:text-foreground'">
                    Home
                    <span class="absolute -bottom-1 left-0 h-0.5 bg-primary transition-all group-hover/link:w-full"
                          :class="(isLanding && activeAnchor === '') ? 'w-full' : 'w-0'"></span>
                </a>
                
                @php
                    $isLanding = request()->path() == '/' || request()->routeIs('dashboard');
                    $katalogHref = auth()->check() ? route('katalog.index') : ($isLanding ? '#terbaru' : '/#terbaru');
                @endphp
                
                <a href="{{ $katalogHref }}" 
                   @click="if(!{{ auth()->check() ? 'true' : 'false' }}) activeAnchor = '#terbaru'"
                   class="text-sm font-black transition-all relative group/link"
                   :class="(activeAnchor === '#terbaru' || {{ request()->routeIs('katalog.*') ? 'true' : 'false' }}) ? 'text-primary' : 'text-muted-foreground hover:text-foreground'">
                    Katalog
                    <span class="absolute -bottom-1 left-0 h-0.5 bg-primary transition-all group-hover/link:w-full"
                          :class="(activeAnchor === '#terbaru' || {{ request()->routeIs('katalog.*') ? 'true' : 'false' }}) ? 'w-full' : 'w-0'"></span>
                </a>
                
                @php
                    $kategoriHref = auth()->check() 
                        ? route('kategori.index') 
                        : ($isLanding ? '#kategori' : '/#kategori');
                @endphp
                
                <a href="{{ $kategoriHref }}" 
                   @click="if(!{{ auth()->check() ? 'true' : 'false' }}) activeAnchor = '#kategori'"
                   class="text-sm font-black transition-all relative group/link"
                   :class="(activeAnchor === '#kategori' || {{ request()->routeIs('kategori.index') ? 'true' : 'false' }}) ? 'text-primary' : 'text-muted-foreground hover:text-foreground'">
                    Kategori
                    <span class="absolute -bottom-1 left-0 h-0.5 bg-primary transition-all group-hover/link:w-full"
                          :class="(activeAnchor === '#kategori' || {{ request()->routeIs('kategori.index') ? 'true' : 'false' }}) ? 'w-full' : 'w-0'"></span>
                </a>

                @auth
                    <a href="{{ route('koleksi') }}" class="text-sm font-black {{ request()->routeIs('koleksi') ? 'text-primary' : 'text-muted-foreground hover:text-foreground' }} transition-all relative group/link">
                        Koleksi
                        <span class="absolute -bottom-1 left-0 {{ request()->routeIs('koleksi') ? 'w-full' : 'w-0' }} h-0.5 bg-primary transition-all group-hover/link:w-full"></span>
                    </a>
                    <a href="{{ route('user.profile') }}" class="text-sm font-black {{ request()->routeIs('user.profile') ? 'text-primary' : 'text-muted-foreground hover:text-foreground' }} transition-all relative group/link">
                        Profil
                        <span class="absolute -bottom-1 left-0 {{ request()->routeIs('user.profile') ? 'w-full' : 'w-0' }} h-0.5 bg-primary transition-all group-hover/link:w-full"></span>
                    </a>
                @endauth
            </div>

            <!-- Auth Area -->
            <div class="flex items-center gap-4">
                @guest
                    <x-button variant="default" onclick="window.location.href='{{ route('login') }}'" class="rounded-2xl shadow-2xl shadow-primary/40 px-10 font-black uppercase tracking-widest text-[11px]">
                        Login
                    </x-button>
                @else
                    <div class="flex items-center gap-4 pl-6 border-l border-border">
                        <div class="hidden md:block text-right">
                            <p class="text-xs font-black text-foreground leading-none">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-muted-foreground uppercase font-black tracking-widest mt-1 opacity-60">{{ Auth::user()->role ?? 'Student' }}</p>
                        </div>
                        
                        {{-- Logout Button for premium feel --}}
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <button type="submit" class="w-10 h-10 rounded-xl bg-secondary flex items-center justify-center text-muted-foreground hover:text-destructive hover:bg-destructive/10 transition-all shadow-inner group">
                                <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            </button>
                        </form>

                        @if(auth()->user()->role == 'admin')
                            <x-button variant="default" onclick="window.location.href='{{ route('admin.dashboard') }}'" class="rounded-2xl shadow-xl shadow-primary/30 p-2 sm:px-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                            </x-button>
                        @endif
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>
