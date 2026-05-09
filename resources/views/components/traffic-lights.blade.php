@props(['size' => 'md'])

@php
$dotSize = match($size) {
    'sm' => 'w-3 h-3',
    'md' => 'w-3.5 h-3.5',
    'lg' => 'w-4 h-4',
    default => 'w-3.5 h-3.5'
};
$gap = match($size) {
    'sm' => 'gap-1.5',
    'md' => 'gap-2',
    'lg' => 'gap-2.5',
    default => 'gap-2'
};
@endphp

<div {{ $attributes->merge(['class' => "flex items-center {$gap}"]) }}>
    <div class="{{ $dotSize }} rounded-full bg-[#ff5f57] border border-black/5 shadow-inner"></div>
    <div class="{{ $dotSize }} rounded-full bg-[#febc2e] border border-black/5 shadow-inner"></div>
    <div class="{{ $dotSize }} rounded-full bg-[#28c840] border border-black/5 shadow-inner"></div>
</div>
