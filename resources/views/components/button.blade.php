@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'icon' => null,
    'iconRight' => null,
    'loading' => false
])

@php
$baseClasses = "inline-flex items-center justify-center gap-2 font-semibold rounded-lg transition-all duration-200 active:scale-[0.98] disabled:opacity-50 disabled:pointer-events-none";

$variantClasses = [
    'primary' => 'btn-primary shadow-sm hover:shadow-lg',
    'secondary' => 'bg-[var(--bg-input)] text-[var(--text-primary)] border border-[var(--border-color)] hover:bg-[var(--border-color)]',
    'outline' => 'bg-transparent text-[var(--text-primary)] border border-[var(--border-color)] hover:border-[var(--accent-color)] hover:text-[var(--accent-color)]',
    'ghost' => 'bg-transparent text-[var(--text-primary)] hover:bg-[var(--bg-input)]',
    'danger' => 'bg-red-500 text-white hover:bg-red-600 shadow-sm hover:shadow-red-500/20',
    'success' => 'bg-emerald-500 text-white hover:bg-emerald-600 shadow-sm hover:shadow-emerald-500/20',
];

$sizeClasses = [
    'xs' => 'px-2.5 py-1.5 text-xs',
    'sm' => 'px-3.5 py-2 text-sm',
    'md' => 'px-5 py-2.5 text-sm',
    'lg' => 'px-6 py-3 text-base',
];

$classes = "{$baseClasses} {$variantClasses[$variant]} {$sizeClasses[$size]}";
@endphp

<button {{ $attributes->merge(['type' => $type, 'class' => $classes]) }} @if($loading) disabled @endif>
    @if($loading)
        <i class="bx bx-loader-alt animate-spin text-lg"></i>
    @elseif($icon)
        <i class="bx {{ $icon }} text-lg"></i>
    @endif

    {{ $slot }}

    @if($iconRight && !$loading)
        <i class="bx {{ $iconRight }} text-lg"></i>
    @endif
</button>
