<section id="beranda" class="py-20 px-6 sm:px-12 bg-[#FFFFFF]">
    <div class="max-w-7xl mx-auto text-center">

        <!-- Judul Utama -->
        <h1 class="text-4xl sm:text-5xl font-bold mb-4 text-[#1A202C]">
            Perpustakaan Digital SMAN 4 Pinrang
        </h1>

        <!-- Subjudul / Deskripsi -->
        <p class="text-lg sm:text-xl mb-8 max-w-3xl mx-auto text-[#718096]">
            Menampilkan informasi dan deskripsi buku berbasis web semantik & JSON-LD
        </p>

        <!-- Tombol CTA -->
        <div class="flex justify-center gap-4 mt-8">
            <!-- Masuk -->
            <a href="{{ route('login') }}"
                class="px-6 py-3 bg-[#FFFFFF] text-[#1A202C] border border-[#F1F5F9] font-bold rounded-lg shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] hover:bg-[#F1F5F9] transition">
                Masuk
            </a>

            <!-- Jelajahi Buku -->
            <a href="{{ route('katalog.index') }}"
                class="px-6 py-3 bg-[#1DC2FE] text-[#FFFFFF] font-bold rounded-lg shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] hover:bg-[#1ab0e6] transition">
                Jelajahi Buku
            </a>
        </div>

    </div>
</section>