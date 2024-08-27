@props([
    'type' => 'button',
    'size' => 'md',
    'color' => 'indigo',
    'outline' => false,
])

@php
    $baseClasses = 'font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 transition';
    $sizes = [
        'xs' => 'px-2 py-1 text-xs',
        'sm' => 'px-2.5 py-1.5 text-sm',
        'md' => 'px-3 py-2 text-sm',
        'lg' => 'px-3.5 py-2.5 text-sm',
    ];

    $colorClasses = $outline
        ? "bg-white text-{$color}-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-{$color}-600"
        : "bg-{$color}-600 text-white hover:bg-{$color}-500 focus-visible:outline-{$color}-600";

    $roundedClasses = $size === 'xs' || $size === 'sm' ? 'rounded' : 'rounded-md';
    $sizeClasses = $sizes[$size] ?? $sizes['md'];
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => "{$baseClasses} {$sizeClasses} {$colorClasses} {$roundedClasses}"]) }}>
    {{ $slot }}
</button>