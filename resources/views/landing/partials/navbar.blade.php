<nav class="bg-[#FFFFFF] border-b border-[#F1F5F9] sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        {{-- Logo --}}
        <a href="#beranda" class="flex items-center gap-2">
            <x-application-logo class="w-8 h-8 text-[#1DC2FE]" />
            <span class="font-semibold text-lg text-[#1A202C]">Perpustakaan Digital</span>
        </a>

        {{-- Menu di tengah --}}
        <div class="hidden md:flex flex-1 justify-center items-center gap-8 text-sm text-[#718096]">
            <a href="#beranda" class="hover:text-[#1DC2FE] transition text-[#1DC2FE] border-b-2 border-[#1DC2FE] pb-1">Beranda</a>
            <a href="#koleksi" class="hover:text-[#1DC2FE] transition hover:border-b-2 hover:border-[#1DC2FE] pb-1 border-b-2 border-transparent">Koleksi</a>
            <a href="#kategori" class="hover:text-[#1DC2FE] transition hover:border-b-2 hover:border-[#1DC2FE] pb-1 border-b-2 border-transparent">Kategori</a>
            <a href="#footer" class="hover:text-[#1DC2FE] transition hover:border-b-2 hover:border-[#1DC2FE] pb-1 border-b-2 border-transparent">Kontak</a>
        </div>

        {{-- Action buttons di kanan --}}
        <div class="flex items-center gap-3">
            <x-primary-button class="bg-[#FFFFFF] hover:bg-[#F1F5F9] text-[#1A202C] shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] border border-[#F1F5F9]">
                <a href="{{ route('login') }}">Masuk</a>
            </x-primary-button>

            <x-primary-button class="bg-[#1DC2FE] hover:bg-[#1ab0e6] text-[#1A202C] shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)]">
                <a href="{{ route('register') }}">Daftar</a>
            </x-primary-button>
        </div>

    </div>
</nav>