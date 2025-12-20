<section id="#kategori" class="bg-white py-16">
    <div class="max-w-5xl mx-auto px-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-8 text-center">
            Kategori Populer
        </h2>

        <div class="flex flex-wrap justify-center gap-4">
            @forelse ($categories as $category)
                <span class="px-5 py-2 bg-gray-100 rounded-full text-sm text-gray-700">
                    {{ $category->name }}
                </span>
            @empty
                <p class="text-gray-500">Belum ada kategori</p>
            @endforelse
        </div>
    </div>
</section>