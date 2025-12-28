<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1dc2fe] leading-tight">
            Koleksi Buku Favorit
        </h2>
    </x-slot>

    <div class="py-12 w-full -mx-4 sm:-mx-6 lg:-mx-8">
        <div class="text-center w-full px-6 sm:px-12 space-y-6">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($books as $book)
                    @include('user.catalog.partials.book-card', ['book' => $book, 'showDescription' => true])
                @empty
                    <div class="col-span-full text-center text-[#cbd5e1]">
                        Kamu belum menyimpan buku apapun.
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            {{ $books->links() }}
        </div>
    </div>
</x-app-layout>