<aside class="fixed top-0 left-0 w-64 h-full bg-[#FFFFFF] shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] border-r border-[#F1F5F9] z-50">
    {{-- Header --}}
    <div
        class="flex items-center justify-center h-20 px-6 bg-[#FFFFFF] border-b border-[#F1F5F9]">
        <span class="text-xl font-bold text-[#1A202C]">Admin Panel</span>
    </div>

    {{-- Navigation --}}
    <nav class="mt-6 px-4 space-y-2">
        <!-- Dashboard -->
        <a href="{{ url('/admin/dashboard') }}"
            class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200
                {{ request()->is('admin/dashboard') ? 'bg-[#F1F5F9] text-[#1DC2FE]' : 'text-[#718096] hover:text-[#1DC2FE] hover:bg-[#F1F5F9]' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->is('admin/dashboard') ? 'text-[#1DC2FE]' : 'text-[#718096] group-hover:text-[#1DC2FE]' }}"
                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 12l2-2m0 0l7-7 7 7m-9 14v-6h4v6m5-10l2 2m-2-2v6a2 2 0 01-2 2h-4m-4 0H5a2 2 0 01-2-2v-6m2-2l2 2" />
            </svg>
            Dashboard
        </a>

        <!-- Master Data -->
        <div class="mt-4">
            <span class="text-[#718096] uppercase text-xs font-semibold px-4">Master Data</span>

            <a href="{{ route('admin.categories.index') }}"
                class="flex items-center px-4 py-2 mt-2 rounded hover:bg-[#F1F5F9] hover:text-[#1DC2FE] text-[#718096]">
                <svg class="w-5 h-5 mr-2 text-[#718096]" fill="currentColor"><!-- icon kategori --></svg>
                Kategori
            </a>

            <a href="{{ route('admin.books.index') }}"
                class="flex items-center px-4 py-2 mt-2 rounded hover:bg-[#F1F5F9] hover:text-[#1DC2FE] text-[#718096]">
                <svg class="w-5 h-5 mr-2 text-[#718096]" fill="currentColor"><!-- icon buku --></svg>
                Buku
            </a>
        </div>

        <!-- Divider -->
        <div class="pt-4 mt-6 border-t border-[#F1F5F9]">
            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="group flex items-center w-full px-4 py-3 text-sm font-medium rounded-lg text-[#718096] hover:bg-red-50 hover:text-red-600 transition-all duration-200">
                    <svg class="w-5 h-5 mr-3 text-[#718096] group-hover:text-red-600" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </nav>
</aside>