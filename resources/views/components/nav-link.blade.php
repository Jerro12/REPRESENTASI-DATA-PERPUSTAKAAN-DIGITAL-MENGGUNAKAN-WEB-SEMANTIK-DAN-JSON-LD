@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#1DC2FE] text-sm font-medium leading-5 text-[#1A202C] focus:outline-none focus:border-[#17acd8] transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-[#718096] hover:text-[#1A202C] hover:border-[#1DC2FE] focus:outline-none focus:text-[#1A202C] focus:border-[#1DC2FE] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>