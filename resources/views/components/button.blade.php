@props([
    'type' => null,
    'size' => 'md',
    'color' => 'indigo',
    'outline' => false,
    'href' => null,
    'icon' => null,
])

@php
    $baseClasses =
        'flex justify-center font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 transition';
    $sizes = [
        'xs' => 'px-2 py-1 text-xs',
        'sm' => 'px-2.5 py-1.5 text-sm',
        'md' => 'px-3 py-2 text-sm',
        'lg' => 'px-3.5 py-2.5 text-sm',
    ];
    $colorClasses = $outline
        ? "bg-white text-{$color}-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-{$color}-600"
        : "bg-{$color}-600 text-white hover:bg-{$color}-500 focus-visible:outline-{$color}-600";
    $roundedClasses = in_array($size, ['xs', 'sm']) ? 'rounded' : 'rounded-md';
    $sizeClasses = $sizes[$size] ?? $sizes['md'];
    $classes = "{$baseClasses} {$sizeClasses} {$colorClasses} {$roundedClasses}";

    if ($icon) {
        $classes = 'inline-flex items-center ' . $classes;
    }

    $iconSvg = '';

    if ($icon) {
        $iconPath = public_path('icons/' . $icon . '.svg');

        if (file_exists($iconPath)) {
            $iconSvg = file_get_contents($iconPath);
        }
    }

    $finalAttributes = $attributes->merge(['class' => $classes]);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $finalAttributes }}>
        @if ($iconSvg)
            <span class="shrink-0 flex items-center justify-center w-5 h-5 mr-1.5">{!! $iconSvg !!}</span>
        @endif
        {{ $slot }}
    </a>
@else
    <button {{ $type ? 'type=' . $type . ' ' : '' }}{{ $finalAttributes }}>
        @if ($iconSvg)
            <span class="shrink-0 flex items-center justify-center w-5 h-5 mr-1.5">{!! $iconSvg !!}</span>
        @endif
        {{ $slot }}
    </button>
@endif
