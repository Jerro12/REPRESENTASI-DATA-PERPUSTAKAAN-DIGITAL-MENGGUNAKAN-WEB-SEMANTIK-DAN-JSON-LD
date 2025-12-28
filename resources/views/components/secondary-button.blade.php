<button {{ $attributes->merge([
    'type' => 'button',
    'class' => '
            inline-flex items-center
            px-4 py-2

            bg-transparent
            border border-[#1dc2fe]
            rounded-md

            font-semibold text-xs
            text-[#1dc2fe]
            uppercase tracking-widest

            hover:bg-[#094054]
            hover:text-white

            focus:outline-none
            focus:ring-2
            focus:ring-[#1dc2fe]
            focus:ring-offset-2
            focus:ring-offset-[#081e26]

            disabled:opacity-25
            transition ease-in-out duration-150
        '
]) }}>
    {{ $slot }}
</button>