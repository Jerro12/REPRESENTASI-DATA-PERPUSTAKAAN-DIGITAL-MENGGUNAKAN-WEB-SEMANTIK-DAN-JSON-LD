@props(['disabled' => false])

<textarea @disabled($disabled) {{ $attributes->merge([
    'class' => 'a
            w-full
            rounded-md
            shadow-sm

            bg-[#FFFFFF]
            border border-[#F1F5F9]

            text-[#1A202C]
            placeholder-[#718096]

            focus:border-[#1dc2fe]
            focus:ring-2
            focus:ring-[#1dc2fe]

            disabled:opacity-50
            disabled:cursor-not-allowed

            transition duration-150 ease-in-out
        '
]) }}>{{ $slot ?? '' }}</textarea>