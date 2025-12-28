<div class="mt-20 mb-16 w-full -mx-4 sm:-mx-6 lg:-mx-8">
    <div class="text-center w-full">
        <div class="bg-gradient-to-r from-[#1dc2fe] to-[#094054] rounded-xl shadow-lg p-10 text-white">

            <!-- CTA Title -->
            <h2 class="text-2xl sm:text-3xl font-bold mb-4">
                Jelajahi Seluruh Koleksi Perpustakaan
            </h2>

            <!-- CTA Description -->
            <p class="text-lg text-blue-100 max-w-2xl mx-auto mb-8">
                Telusuri informasi dan deskripsi buku yang tersedia dalam
                Perpustakaan Digital SMAN 4 Pinrang melalui sistem berbasis
                web semantik dan JSON-LD.
            </p>

            <!-- CTA Button -->
            <div class="flex justify-center">
                <x-primary-button :href="route('katalog.index')" class="px-8 py-3">
                    Lihat Katalog Buku
                </x-primary-button>
            </div>

        </div>
    </div>
</div>