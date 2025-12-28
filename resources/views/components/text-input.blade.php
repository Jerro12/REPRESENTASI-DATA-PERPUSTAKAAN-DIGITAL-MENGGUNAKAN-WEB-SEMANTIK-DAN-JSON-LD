@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge([
    'class' => '
            w-full
            rounded-md
            shadow-sm

            bg-[#094054]
            border border-[#0b556d]

            text-white
            placeholder-[#cbd5e1]

            focus:border-[#1dc2fe]
            focus:ring-2
            focus:ring-[#1dc2fe]

            disabled:opacity-50
            disabled:cursor-not-allowed

            transition duration-150 ease-in-out
        '
]) }}>