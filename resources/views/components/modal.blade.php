@props(['id', 'title' => null, 'size' => 'md', 'showHeader' => true])

@php
$sizeClasses = [
    'sm' => 'max-w-md',
    'md' => 'max-w-xl',
    'lg' => 'max-w-3xl',
    'xl' => 'max-w-5xl',
    'full' => 'max-w-full mx-4',
];
@endphp

<!-- Backdrop -->
<div id="{{ $id }}-backdrop" 
     class="modal-backdrop hidden pointer-events-none"
     onclick="closeModal('{{ $id }}')"></div>

<!-- Modal Content -->
<div id="{{ $id }}" 
     class="modal-content hidden w-full {{ $sizeClasses[$size] ?? $sizeClasses['md'] }} pointer-events-none"
     role="dialog" 
     aria-modal="true" 
     aria-labelledby="{{ $id }}-title">
    
    <div class="bg-[var(--bg-card)] border border-[var(--border-color)] rounded-2xl shadow-2xl overflow-hidden pointer-events-auto flex flex-col max-h-full">
        <!-- Header -->
        @if($showHeader)
        <div class="grid grid-cols-[auto_1fr_auto] md:grid-cols-[80px_1fr_80px] items-center px-4 md:px-6 py-4 md:py-5 border-b border-[var(--border-color)] flex-shrink-0">
            <x-traffic-lights size="sm" class="flex-shrink-0" />
            
            @if($title)
                <h3 id="{{ $id }}-title" class="text-base md:text-lg font-bold text-[var(--text-primary)] text-center truncate px-2">{{ $title }}</h3>
            @else
                <span></span>
            @endif

            <div class="flex justify-end">
                <button onclick="closeModal('{{ $id }}')" class="flex-shrink-0 p-1.5 md:p-2 text-[var(--text-secondary)] hover:bg-[var(--bg-input)] rounded-lg transition-all">
                    <i class="bx bx-x text-xl md:text-2xl"></i>
                </button>
            </div>
        </div>
        @endif
        
        <!-- Body -->
        <div class="p-6 md:p-8 overflow-y-auto flex-1 custom-scrollbar">
            {{ $slot }}
        </div>
        
        <!-- Footer (optional) -->
        @if(isset($footer))
        <div class="px-6 py-5 bg-[var(--bg-secondary)]/50 border-t border-[var(--border-color)] flex justify-end gap-3 flex-shrink-0">
            {{ $footer }}
        </div>
        @endif
    </div>
</div>
