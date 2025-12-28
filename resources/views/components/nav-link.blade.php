@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#1dc2fe] text-sm font-medium leading-5 text-[#1dc2fe] focus:outline-none focus:border-[#17acd8] transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-[#cbd5e1] hover:text-white hover:border-[#1dc2fe] focus:outline-none focus:text-[#1dc2fe] focus:border-[#1dc2fe] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>