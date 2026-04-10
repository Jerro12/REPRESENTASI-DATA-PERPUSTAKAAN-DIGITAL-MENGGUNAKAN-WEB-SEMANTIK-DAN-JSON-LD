<a {{ $attributes->merge([
    'class' => '
            block w-full px-4 py-2 text-start text-sm leading-5
            text-[#718096]
            bg-[#FFFFFF]

            hover:bg-[#F1F5F9]
            hover:text-[#1A202C]

            focus:outline-none
            focus:bg-[#F1F5F9]
            focus:text-[#1A202C]

            transition duration-150 ease-in-out
        '
]) }}>
    {{ $slot }}
</a>