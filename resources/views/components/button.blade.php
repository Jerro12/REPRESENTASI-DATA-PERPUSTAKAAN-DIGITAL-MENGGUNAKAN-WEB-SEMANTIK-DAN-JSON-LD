@props([
    'variant' => 'default',
    'size' => 'default',
])

@php
    $baseStyles = "inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl text-sm font-semibold ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 active:scale-95 duration-200";

    $variants = [
        'default' => 'bg-primary text-primary-foreground hover:bg-primary/90 shadow-lg shadow-primary/20',
        'destructive' => 'bg-destructive text-destructive-foreground hover:bg-destructive/90 shadow-lg shadow-destructive/20',
        'outline' => 'border border-input bg-background hover:bg-accent hover:text-accent-foreground',
        'secondary' => 'bg-secondary text-secondary-foreground hover:bg-secondary/80',
        'ghost' => 'hover:bg-accent hover:text-accent-foreground',
        'link' => 'text-primary underline-offset-4 hover:underline px-0 py-0 h-auto',
        'success' => 'bg-success text-success-foreground hover:bg-success/90 shadow-lg shadow-success/20',
    ];

    $sizes = [
        'default' => 'h-11 px-6 py-2',
        'sm' => 'h-9 rounded-lg px-3 text-xs',
        'lg' => 'h-14 rounded-2xl px-10 text-base',
        'icon' => 'h-11 w-11 rounded-xl',
    ];

    $classes = "{$baseStyles} " . ($variants[$variant] ?? $variants['default']) . " " . ($sizes[$size] ?? $sizes['default']);
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
