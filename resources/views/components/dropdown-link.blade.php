<a {{ $attributes->merge([
    'class' => '
            block w-full px-4 py-2 text-start text-sm leading-5
            text-[#cbd5e1]
            bg-[#094054]

            hover:bg-[#0b556d]
            hover:text-white

            focus:outline-none
            focus:bg-[#0b556d]
            focus:text-white

            transition duration-150 ease-in-out
        '
]) }}>
    {{ $slot }}
</a>