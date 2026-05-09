@props(['type' => 'text', 'rows' => 1])

@php
$baseClasses = "bg-[var(--bg-input)] animate-pulse rounded-lg";
$typeClasses = [
    'text' => 'h-4 w-full',
    'title' => 'h-8 w-2/3',
    'avatar' => 'w-12 h-12 rounded-full',
    'image' => 'w-full h-48',
    'button' => 'w-24 h-10',
];

$classes = "{$baseClasses} " . ($typeClasses[$type] ?? $typeClasses['text']);
@endphp

@if($type === 'text' && $rows > 1)
    <div class="space-y-3 w-full">
        @foreach(range(1, $rows) as $i)
            <div class="{{ $classes }} {{ $loop->last ? 'w-4/5' : '' }}"></div>
        @endforeach
    </div>
@else
    <div {{ $attributes->merge(['class' => $classes]) }}></div>
@endif
