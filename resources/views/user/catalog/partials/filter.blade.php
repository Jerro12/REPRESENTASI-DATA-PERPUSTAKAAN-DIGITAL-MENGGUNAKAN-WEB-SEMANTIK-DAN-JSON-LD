<div class="bg-[#FFFFFF] border border-[#F1F5F9] shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] p-6 rounded-lg shadow-sm">
    <form method="GET" action="{{ route('katalog.index') }}">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

            <!-- Kategori -->
            <div>
                <x-input-label for="kategori" :value="__('Kategori')" class="mb-1" />
                <select id="kategori" name="kategori" class="w-full rounded-md shadow-sm
                               bg-[#FFFFFF]
                               border border-[#F1F5F9]
                               text-[#1A202C] placeholder-[#718096]
                               focus:border-[#1DC2FE] focus:ring-2 focus:ring-[#1DC2FE]
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
                <x-input-label for="tahun" :value="__('Tahun')" class="mb-1" />
                <select id="tahun" name="tahun" class="w-full rounded-md shadow-sm
                               bg-[#FFFFFF]
                               border border-[#F1F5F9]
                               text-[#1A202C] placeholder-[#718096]
                               focus:border-[#1DC2FE] focus:ring-2 focus:ring-[#1DC2FE]
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