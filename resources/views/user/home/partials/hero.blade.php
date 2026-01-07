<div class=" bg-[#094054] text-[#cbd5e1] py-16 px-6 sm:px-12 -mx-4 sm:-mx-6 lg:-mx-8 shadow-lg">
    <div class="text-center mx-auto max-w-7xl">
        <!-- Judul -->
        <h1 class="text-4xl sm:text-5xl font-bold mb-4 text-white">
            Perpustakaan Digital SMAN 4 Pinrang
        </h1>

        <!-- Tagline -->
        <p class="text-lg sm:text-xl mb-8">
            Menampilkan informasi dan deskripsi buku berbasis web semantik & JSON-LD
        </p>

        <!-- Search Bar -->
        <form action="{{ route('katalog.index') }}" method="GET"
            class="max-w-xl mx-auto flex flex-col sm:flex-row gap-3">

            <!-- Judul -->
            <x-text-input name="judul" placeholder="Cari judul buku..." class="flex-1" />

            <!-- Penulis -->
            <x-text-input name="penulis" placeholder="Cari penulis..." class="flex-1" />

            <!-- Kategori -->
            <select name="kategori"
                class="px-4 py-2 rounded-md bg-[#081e26] text-[#cbd5e1] border border-[#1dc2fe] focus:ring-[#1dc2fe] focus:border-[#1dc2fe] shadow-sm">
                <option value="">Semua Kategori</option>
                @foreach(App\Models\Category::where('is_active', true)->get() as $category)
                    <option value="{{ $category->id }}">{{ $category->nama }}</option>
                @endforeach
            </select>

            <!-- Submit Button -->
            <x-primary-button type="submit">
                Cari
            </x-primary-button>
        </form>

        <!-- CTA Button -->
        <div class="mt-8">
            <x-primary-button :href="route('katalog.index')">
                Lihat Katalog Lengkap
            </x-primary-button>
        </div>
    </div>
</div>