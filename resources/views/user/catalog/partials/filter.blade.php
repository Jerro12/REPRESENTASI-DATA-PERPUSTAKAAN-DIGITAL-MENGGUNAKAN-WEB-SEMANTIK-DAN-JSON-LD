<div class="bg-white p-6 rounded-lg shadow-sm">
    <form method="GET" action="{{ route('katalog.index') }}">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

            <!-- Kategori -->
            <select name="kategori" class="rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('kategori') == $category->id ? 'selected' : '' }}>
                        {{ $category->nama }}
                    </option>
                @endforeach
            </select>

            <!-- Tahun -->
            <select name="tahun" class="rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                <option value="">Semua Tahun</option>
                @foreach($years as $year)
                    <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                @endforeach
            </select>

            <!-- Submit -->
            <button type="submit" class="px-4 py-2 bg-gray-100 rounded-md hover:bg-gray-200 transition">
                Terapkan Filter
            </button>

        </div>
    </form>
</div>