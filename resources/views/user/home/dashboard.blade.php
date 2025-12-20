<x-app-layout>
    <x-slot name="header">
        Beranda
    </x-slot>

    @include('user.home.partials.hero')
    @include('user.home.partials.highlight-books')
    @include('user.home.partials.popular-categories')
    @include('user.home.partials.cta')
</x-app-layout>