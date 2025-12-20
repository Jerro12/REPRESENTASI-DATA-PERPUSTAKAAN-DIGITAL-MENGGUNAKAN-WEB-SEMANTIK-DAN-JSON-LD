<nav class="bg-white border-b sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        {{-- Logo --}}
        <a href="#beranda" class="flex items-center gap-2">
            <x-application-logo class="w-8 h-8 text-blue-600" />
            <span class="font-semibold text-lg text-gray-800">
                Perpustakaan Digital
            </span>
        </a>

        {{-- Menu --}}
        <div class="hidden md:flex items-center gap-8 text-sm text-gray-600">
            <a href="#beranda" class="hover:text-blue-600">Beranda</a>
            <a href="#koleksi" class="hover:text-blue-600">Koleksi</a>
            <a href="#kategori" class="hover:text-blue-600">Kategori</a>
            <a href="#footer" class="hover:text-blue-600">Kontak</a> {{-- scroll ke footer --}}
        </div>

        {{-- Action --}}
        <x-primary-button>
            <a href="{{ route('login') }}">
                Masuk
            </a>
        </x-primary-button>
    </div>
</nav>