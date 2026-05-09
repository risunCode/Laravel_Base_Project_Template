@props(['variant' => 'solid', 'hover' => false, 'padding' => 'p-6'])

@php
$baseClasses = "rounded-xl transition-all duration-300";
$variantClasses = [
    'solid' => 'bg-[var(--bg-card)] border border-[var(--border-color)] shadow-sm',
    'secondary' => 'bg-[var(--bg-input)] border border-[var(--border-color)] shadow-sm',
    'glass' => 'glass border border-[var(--border-color)]',
    'ghost' => 'bg-transparent border border-transparent',
];

$hoverClasses = $hover ? 'hover:translate-y-[-4px] hover:shadow-xl hover:border-[var(--accent-color)]/30' : '';
$classes = "{$baseClasses} {$variantClasses[$variant]} {$hoverClasses} {$padding}";
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
