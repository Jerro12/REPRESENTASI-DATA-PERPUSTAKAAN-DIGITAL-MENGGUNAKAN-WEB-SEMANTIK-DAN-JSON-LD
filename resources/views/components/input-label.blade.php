@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-[#cbd5e1]']) }}>
    {{ $value ?? $slot }}
</label>