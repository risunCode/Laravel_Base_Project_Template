@props(['type' => 'info', 'title' => null, 'dismissible' => true])

@php
$types = [
    'success' => [
        'bg' => 'bg-emerald-500/10',
        'border' => 'border-emerald-500/20',
        'text' => 'text-emerald-600 dark:text-emerald-400',
        'icon' => 'bx-check-circle'
    ],
    'error' => [
        'bg' => 'bg-red-500/10',
        'border' => 'border-red-500/20',
        'text' => 'text-red-600 dark:text-red-400',
        'icon' => 'bx-error-circle'
    ],
    'danger' => [
        'bg' => 'bg-red-500/10',
        'border' => 'border-red-500/20',
        'text' => 'text-red-600 dark:text-red-400',
        'icon' => 'bx-error-circle'
    ],
    'warning' => [
        'bg' => 'bg-amber-500/10',
        'border' => 'border-amber-500/20',
        'text' => 'text-amber-600 dark:text-amber-400',
        'icon' => 'bx-error'
    ],
    'info' => [
        'bg' => 'bg-blue-500/10',
        'border' => 'border-blue-500/20',
        'text' => 'text-blue-600 dark:text-blue-400',
        'icon' => 'bx-info-circle'
    ],
];

$style = $types[$type] ?? $types['info'];
@endphp

<div x-data="{ show: true }" x-show="show" x-transition.opacity
    class="flex items-start gap-4 p-4 rounded-xl border {{ $style['bg'] }} {{ $style['border'] }} {{ $style['text'] }} relative"
    role="alert">
    <div class="flex-shrink-0 mt-0.5">
        <i class="bx {{ $style['icon'] }} text-xl"></i>
    </div>
    <div class="flex-1 min-w-0">
        @if($title)
            <h4 class="font-bold mb-1 leading-tight">{{ $title }}</h4>
        @endif
        <div class="text-sm opacity-90 leading-relaxed">
            {{ $slot }}
        </div>
    </div>
    @if($dismissible)
        <button @click="show = false" class="flex-shrink-0 ml-auto opacity-50 hover:opacity-100 transition-opacity" aria-label="Close">
            <i class="bx bx-x text-xl"></i>
        </button>
    @endif
</div>
