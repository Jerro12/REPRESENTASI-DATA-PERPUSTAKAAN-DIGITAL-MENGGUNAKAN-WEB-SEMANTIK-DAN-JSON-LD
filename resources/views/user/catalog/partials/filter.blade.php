<div class="bg-[#0e2938] p-6 rounded-lg shadow-sm">
    <form method="GET" action="{{ route('katalog.index') }}">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

            <!-- Kategori -->
            <div>
                <x-input-label for="kategori" :value="__('Kategori')" class="mb-1 text-[#cbd5e1]" />
                <select id="kategori" name="kategori" class="w-full rounded-md shadow-sm
                               bg-[#094054]
                               border border-[#0b556d]
                               text-white placeholder-[#cbd5e1]
                               focus:border-[#1dc2fe] focus:ring-2 focus:ring-[#1dc2fe]
                               transition duration-150 ease-in-out">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('kategori') == $category->id ? 'selected' : '' }}>
                            {{ $category->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tahun -->
            <div>
                <x-input-label for="tahun" :value="__('Tahun')" class="mb-1 text-[#cbd5e1]" />
                <select id="tahun" name="tahun" class="w-full rounded-md shadow-sm
                               bg-[#094054]
                               border border-[#0b556d]
                               text-white placeholder-[#cbd5e1]
                               focus:border-[#1dc2fe] focus:ring-2 focus:ring-[#1dc2fe]
                               transition duration-150 ease-in-out">
                    <option value="">Semua Tahun</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit -->
            <div class="flex items-end">
                <x-primary-button class="w-full sm:w-auto">
                    Terapkan Filter
                </x-primary-button>
            </div>

        </div>
    </form>
</div>