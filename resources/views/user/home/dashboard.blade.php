<x-app-layout>
    {{-- Hero full width, di luar main --}}
    @include('user.home.partials.hero')

    {{-- Konten dashboard lain --}}
    <main class="flex-1 px-4 sm:px-6 lg:px-8">
        @include('user.home.partials.highlight-books')
        @include('user.home.partials.popular-categories')
        @include('user.home.partials.cta')
    </main>
</x-app-layout>