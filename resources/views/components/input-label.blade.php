@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-[#718096]']) }}>
    {{ $value ?? $slot }}
</label>