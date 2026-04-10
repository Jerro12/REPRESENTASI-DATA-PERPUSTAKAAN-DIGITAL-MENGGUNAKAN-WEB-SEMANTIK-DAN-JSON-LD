@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-[#1DC2FE] text-start text-base font-medium text-[#1DC2FE] bg-[#F1F5F9] focus:outline-none focus:text-[#1DC2FE] focus:bg-[#F1F5F9] focus:border-[#17acd8] transition duration-150 ease-in-out'
        : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-[#718096] hover:text-[#1A202C] hover:bg-[#F1F5F9] hover:border-[#1DC2FE] focus:outline-none focus:text-[#1A202C] focus:bg-[#F1F5F9] focus:border-[#1DC2FE] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>