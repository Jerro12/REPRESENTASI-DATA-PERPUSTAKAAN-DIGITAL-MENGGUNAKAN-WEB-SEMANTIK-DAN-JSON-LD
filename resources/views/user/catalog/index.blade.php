<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Katalog Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Search --}}
            @include('user.catalog.partials.search')

            {{-- Filter --}}
            @include('user.catalog.partials.filter')

            {{-- List Buku --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($books ?? [] as $book)
                    @include('user.catalog.partials.book-card', ['book' => $book])
                @empty
                    @include('user.catalog.partials.empty-state')
                @endforelse
            </div>

            {{-- Pagination (nanti) --}}
            {{-- {{ $books->links() }} --}}

        </div>
    </div>
</x-app-layout>