@props(['href' => null])

@php
    $classes = 'inline-flex items-center
            px-4 py-2
            bg-[#1dc2fe]
            border border-transparent
            rounded-md
            font-semibold text-xs
            text-white uppercase tracking-widest
            hover:bg-[#17acd8]
            focus:bg-[#17acd8]
            active:bg-[#1396bd]
            focus:outline-none
            focus:ring-2
            focus:ring-[#1dc2fe]
            focus:ring-offset-2
            focus:ring-offset-[#081e26]
            transition ease-in-out duration-150';
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif