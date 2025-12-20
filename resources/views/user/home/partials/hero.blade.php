<div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white py-16 px-6 sm:px-12 rounded-lg shadow-lg">
    <div class="max-w-7xl mx-auto text-center">
        <!-- Judul -->
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">
            Perpustakaan Digital SMAN 4 Pinrang
        </h1>

        <!-- Tagline -->
        <p class="text-lg sm:text-xl mb-8">
            Menampilkan informasi dan deskripsi buku berbasis web semantik & JSON-LD
        </p>

        <!-- Search Bar -->
        <form action="{{ route('katalog.index') }}" method="GET"
            class="max-w-xl mx-auto flex flex-col sm:flex-row gap-3">
            <input type="text" name="judul" placeholder="Cari judul buku..."
                class="flex-1 px-4 py-2 rounded-md text-gray-900" />
            <input type="text" name="penulis" placeholder="Cari penulis..."
                class="flex-1 px-4 py-2 rounded-md text-gray-900" />
            <select name="kategori" class="px-4 py-2 rounded-md text-gray-900">
                <option value="">Semua Kategori</option>
                @foreach(App\Models\Category::where('is_active', true)->get() as $category)
                    <option value="{{ $category->id }}">{{ $category->nama }}</option>
                @endforeach
            </select>
            <button type="submit"
                class="bg-white text-blue-700 font-semibold px-4 py-2 rounded-md hover:bg-gray-100 transition">
                Cari
            </button>
        </form>

        <!-- CTA Button -->
        <div class="mt-8">
            <a href="{{ route('katalog.index') }}"
                class="bg-white text-blue-700 font-bold px-6 py-3 rounded-lg shadow hover:bg-gray-100 transition">
                Lihat Katalog Lengkap
            </a>
        </div>
    </div>
</div>