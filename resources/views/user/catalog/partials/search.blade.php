<div class="bg-[#FFFFFF] border border-[#F1F5F9] shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] p-6 rounded-lg shadow-sm">
    <form method="GET">
        <div class="flex flex-col sm:flex-row gap-4">

            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul buku, penulis, atau kategori..." class="w-full rounded-md shadow-sm
                       bg-[#FFFFFF]
                       border border-[#F1F5F9]
                       text-[#1A202C] placeholder-[#718096]
                       focus:border-[#1DC2FE] focus:ring-2 focus:ring-[#1DC2FE]
                       transition duration-150 ease-in-out">

            <x-primary-button class="w-full sm:w-auto">
                Cari
            </x-primary-button>

        </div>
    </form>
</div>