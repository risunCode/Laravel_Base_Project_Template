@props(['container' => true, 'background' => 'primary', 'border' => true, 'id' => null])

@php
$bgClasses = [
    'primary' => 'bg-[var(--bg-primary)]',
    'secondary' => 'bg-[var(--bg-secondary)]',
    'card' => 'bg-[var(--bg-card)]',
    'none' => 'bg-transparent'
];

$classes = "relative py-24 md:py-32 overflow-hidden " . $bgClasses[$background];
if ($border) {
    $classes .= " border-b border-[var(--border-color)]";
}
@endphp

<section id="{{ $id }}" {{ $attributes->merge(['class' => $classes]) }}>
    @if($container)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            {{ $slot }}
        </div>
    @else
        {{ $slot }}
    @endif
</section>
