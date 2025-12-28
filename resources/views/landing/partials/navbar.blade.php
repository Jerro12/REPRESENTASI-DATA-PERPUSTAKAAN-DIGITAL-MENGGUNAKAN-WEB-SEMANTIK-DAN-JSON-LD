<nav class="bg-[#081e26] border-b border-[#094054] sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        {{-- Logo --}}
        <a href="#beranda" class="flex items-center gap-2">
            <x-application-logo class="w-8 h-8 text-[#1dc2fe]" />
            <span class="font-semibold text-lg text-white">Perpustakaan Digital</span>
        </a>

        {{-- Menu di tengah --}}
        <div class="hidden md:flex flex-1 justify-center items-center gap-8 text-sm text-[#cbd5e1]">
            <a href="#beranda" class="hover:text-[#1dc2fe] transition">Beranda</a>
            <a href="#koleksi" class="hover:text-[#1dc2fe] transition">Koleksi</a>
            <a href="#kategori" class="hover:text-[#1dc2fe] transition">Kategori</a>
            <a href="#footer" class="hover:text-[#1dc2fe] transition">Kontak</a>
        </div>

        {{-- Action buttons di kanan --}}
        <div class="flex items-center gap-3">
            <x-primary-button class="bg-[#1dc2fe] hover:bg-[#0bb0e6] text-[#081e26]">
                <a href="{{ route('login') }}">Masuk</a>
            </x-primary-button>

            <x-primary-button class="bg-[#1dc2fe] hover:bg-[#0bb0e6] text-[#081e26]">
                <a href="{{ route('register') }}">Daftar</a>
            </x-primary-button>
        </div>

    </div>
</nav>