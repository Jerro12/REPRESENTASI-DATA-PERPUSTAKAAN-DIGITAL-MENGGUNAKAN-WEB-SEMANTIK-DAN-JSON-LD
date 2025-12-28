<section id="beranda" class="py-20 px-6 sm:px-12 bg-gradient-to-r from-[#094054] to-[#1dc2fe] text-white">
    <div class="max-w-7xl mx-auto text-center">

        <!-- Judul Utama -->
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">
            Perpustakaan Digital SMAN 4 Pinrang
        </h1>

        <!-- Subjudul / Deskripsi -->
        <p class="text-lg sm:text-xl mb-8 max-w-3xl mx-auto">
            Menampilkan informasi dan deskripsi buku berbasis web semantik & JSON-LD
        </p>

        <!-- Tombol CTA -->
        <div class="flex justify-center gap-4 mt-8">
            <!-- Masuk -->
            <a href="{{ route('login') }}"
                class="px-6 py-3 bg-white text-[#094054] font-bold rounded-lg shadow hover:bg-gray-100 transition">
                Masuk
            </a>

            <!-- Jelajahi Buku -->
            <a href="{{ route('katalog.index') }}"
                class="px-6 py-3 bg-[#1dc2fe] border border-white rounded-lg hover:bg-[#0bb0e6] transition">
                Jelajahi Buku
            </a>
        </div>

    </div>
</section>