<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1dc2fe] leading-tight">
            {{ __('Katalog Buku') }}
        </h2>
    </x-slot>

    <div class="py-12 w-full -mx-4 sm:-mx-6 lg:-mx-8">
        <div class="w-full px-6 sm:px-12 space-y-6">

            {{-- Search --}}
            @include('user.catalog.partials.search')

            {{-- Filter --}}
            @include('user.catalog.partials.filter')

            {{-- List Buku --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($books ?? [] as $book)
                    @include('user.catalog.partials.book-card', ['book' => $book])
                @empty
                    <div class="col-span-full text-center text-[#cbd5e1]">
                        Belum ada buku tersedia.
                    </div>
                @endforelse
            </div>

            {{-- Pagination (nanti) --}}
            {{-- {{ $books->links() }} --}}
        </div>
    </div>
</x-app-layout>