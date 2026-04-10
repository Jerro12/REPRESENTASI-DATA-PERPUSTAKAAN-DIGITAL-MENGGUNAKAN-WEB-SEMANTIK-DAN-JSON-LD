<button {{ $attributes->merge([
    'type' => 'button',
    'class' => '
            inline-flex items-center
            px-4 py-2

            bg-transparent
            border border-[#1DC2FE]
            rounded-md

            font-semibold text-xs
            text-[#1DC2FE]
            uppercase tracking-widest

            hover:bg-[#F1F5F9]
            hover:text-[#1A202C]

            focus:outline-none
            focus:ring-2
            focus:ring-[#1DC2FE]
            focus:ring-offset-2
            focus:ring-offset-[#FFFFFF]

            disabled:opacity-25
            transition ease-in-out duration-150
        '
]) }}>
    {{ $slot }}
</button>