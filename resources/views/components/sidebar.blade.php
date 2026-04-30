<aside class="fixed left-0 top-0 h-screen bg-sidebar-background flex flex-col z-50 transition-all duration-300 border-r border-sidebar-border shadow-xl overflow-hidden group/sidebar"
       :class="sidebarOpen ? 'w-64' : 'w-20'">
    {{-- Brand --}}
    <div class="px-5 py-6 border-b border-sidebar-border shrink-0">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-sidebar-primary flex items-center justify-center text-lg shadow-lg shadow-sidebar-primary/20 shrink-0">
                <svg class="w-6 h-6 text-sidebar-primary-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                </svg>
            </div>
            <div class="transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 w-0'">
                <h2 class="font-bold text-sidebar-foreground leading-tight truncate">SIPerpus</h2>
                <p class="text-[10px] text-sidebar-foreground/60 uppercase tracking-widest font-bold truncate">Library Admin</p>
            </div>
        </div>
    </div>

    {{-- Menu --}}
    <nav class="flex-1 py-6 overflow-y-auto custom-scrollbar">
        <div class="flex flex-col gap-6">
            {{-- Group 1 --}}
            <div class="space-y-1.5 px-3">
                <p class="px-3 text-[10px] font-black uppercase tracking-[0.2em] text-sidebar-foreground/40 mb-3 transition-opacity duration-300"
                   :class="sidebarOpen ? 'opacity-100' : 'opacity-0'">Main Menu</p>
                
                @php
                    $menuItems = [
                        ['label' => 'Dashboard', 'route' => 'admin/dashboard', 'active' => request()->is('admin/dashboard'), 'icon' => 'grid'],
                        ['label' => 'Data Buku', 'href' => route('admin.books.index'), 'active' => request()->routeIs('admin.books.*'), 'icon' => 'book'],
                        ['label' => 'Kategori', 'href' => route('admin.categories.index'), 'active' => request()->routeIs('admin.categories.*'), 'icon' => 'tags'],
                    ];
                @endphp

                @foreach ($menuItems as $item)
                    <a href="{{ $item['href'] ?? url($item['route']) }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all relative group {{ $item['active'] ? 'bg-sidebar-primary text-sidebar-primary-foreground shadow-lg shadow-sidebar-primary/20 font-bold' : 'text-sidebar-foreground/70 hover:bg-sidebar-accent hover:text-sidebar-accent-foreground' }}"
                        :title="!sidebarOpen ? '{{ $item['label'] }}' : ''">
                        
                        <div class="shrink-0 group-hover:scale-110 transition-transform">
                            @if($item['icon'] == 'grid')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                            @elseif($item['icon'] == 'book')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z" /></svg>
                            @elseif($item['icon'] == 'tags')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82zM7 7h.01" /></svg>
                            @endif
                        </div>

                        <span class="transition-all duration-300 whitespace-nowrap" :class="sidebarOpen ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-4 w-0 overflow-hidden'">
                            {{ $item['label'] }}
                        </span>

                        @if($item['active'])
                            <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1 h-5 bg-white rounded-l-full"></div>
                        @endif
                    </a>
                @endforeach
            </div>

            {{-- Group 2 --}}
            <div class="space-y-1.5 px-3">
                <p class="px-3 text-[10px] font-black uppercase tracking-[0.2em] text-sidebar-foreground/40 mb-3 transition-opacity duration-300"
                   :class="sidebarOpen ? 'opacity-100' : 'opacity-0'">System</p>

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full gap-3 px-3 py-2.5 rounded-xl text-sm text-sidebar-foreground/70 hover:bg-destructive/20 hover:text-destructive transition-all">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/></svg>
                        <span class="transition-all duration-300 text-left whitespace-nowrap" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 w-0 overflow-hidden'">
                            Sign Out
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- User Profile Card --}}
    <div class="p-4 border-t border-sidebar-border shrink-0">
        <div class="bg-sidebar-accent/50 rounded-2xl p-3 flex items-center transition-all duration-300 overflow-hidden"
             :class="sidebarOpen ? 'gap-3' : 'justify-center p-2'">
            <div class="w-8 h-8 rounded-lg bg-sidebar-primary flex items-center justify-center text-xs font-bold text-sidebar-primary-foreground border border-white/10 shrink-0 shadow-md">
                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0 transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 w-0'">
                <p class="text-xs font-bold text-sidebar-foreground truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                <p class="text-[9px] text-sidebar-foreground/50 uppercase tracking-tighter truncate">{{ Auth::user()->role ?? 'Administrator' }}</p>
            </div>
        </div>
    </div>
</aside>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: hsl(var(--sidebar-border)); border-radius: 10px; }
</style>
