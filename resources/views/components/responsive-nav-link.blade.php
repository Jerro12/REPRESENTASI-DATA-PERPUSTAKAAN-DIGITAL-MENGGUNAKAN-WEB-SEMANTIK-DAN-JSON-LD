@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-[#1dc2fe] text-start text-base font-medium text-[#1dc2fe] bg-[#094054] focus:outline-none focus:text-[#1dc2fe] focus:bg-[#094054] focus:border-[#17acd8] transition duration-150 ease-in-out'
        : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-[#cbd5e1] hover:text-white hover:bg-[#0b556d] hover:border-[#1dc2fe] focus:outline-none focus:text-[#1dc2fe] focus:bg-[#094054] focus:border-[#1dc2fe] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>