@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-[#34D399]']) }}>
        {{ $status }}
    </div>
@endif