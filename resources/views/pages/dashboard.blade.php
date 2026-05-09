@extends('layouts.app')

@section('title', __('Dashboard'))

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 gap-6">
        <x-card variant="solid" class="relative overflow-hidden group">
            <!-- Decorative Background Pattern -->
            <div class="absolute top-0 right-0 -mt-20 -mr-20 w-64 h-64 bg-[var(--accent-color)] opacity-[0.03] rounded-full blur-3xl transition-all duration-700 group-hover:scale-150"></div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-64 h-64 bg-blue-500 opacity-[0.03] rounded-full blur-3xl transition-all duration-700 group-hover:scale-150"></div>

            <div class="relative flex flex-col md:flex-row items-center gap-8 p-2">
                <div class="w-24 h-24 md:w-32 md:h-32 rounded-3xl flex items-center justify-center bg-gradient-to-br from-[var(--accent-color)] to-blue-600 text-white shadow-2xl shadow-[var(--accent-color)]/20 shrink-0">
                    <i class="bx bx-bolt-circle text-5xl md:text-6xl animate-pulse"></i>
                </div>
                
                <div class="flex-1 text-center md:text-left space-y-3">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 mb-2">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <span class="text-[10px] font-black uppercase tracking-widest text-emerald-600">{{ __('Live Engine Active') }}</span>
                    </div>
                    
                    <h2 class="text-3xl md:text-4xl font-black tracking-tight" style="color: var(--text-primary);">
                        {{ __('Welcome back') }}, <span class="text-[var(--accent-color)]">{{ auth()->user()->name }}</span>.
                    </h2>
                    
                    <p class="text-base md:text-lg font-medium opacity-60 leading-relaxed max-w-3xl" style="color: var(--text-secondary);">
                        {{ __('This project has been cleaned into a minimal Laravel starter. Build your next feature from this dashboard, reusable layout, and theme system.') }}
                    </p>

                    <div class="flex flex-wrap justify-center md:justify-start gap-4 pt-2">
                        <div class="flex items-center gap-2 px-4 py-2 rounded-xl bg-[var(--bg-input)] border border-[var(--border-color)] shadow-sm">
                            <i class="bx bx-git-branch text-[var(--accent-color)]"></i>
                            <span class="text-xs font-bold uppercase tracking-wider opacity-70">Main Branch</span>
                        </div>
                        <div class="flex items-center gap-2 px-4 py-2 rounded-xl bg-[var(--bg-input)] border border-[var(--border-color)] shadow-sm">
                            <i class="bx bx-server text-[var(--accent-color)]"></i>
                            <span class="text-xs font-bold uppercase tracking-wider opacity-70">v2.6.4-Stable</span>
                        </div>
                    </div>
                </div>
            </div>
        </x-card>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-card hover variant="solid" class="flex flex-col">
            <div class="w-12 h-12 rounded-lg flex items-center justify-center mb-5 bg-[var(--accent-color)]/10 text-[var(--accent-color)]">
                <i class="bx bx-shield-quarter text-2xl"></i>
            </div>
            <h2 class="text-lg font-bold">{{ __('Clean Auth') }}</h2>
            <p class="mt-2 text-sm opacity-70 leading-relaxed">{{ __('Login, register, logout, and protected pages are ready.') }}</p>
            <div class="mt-auto pt-6 flex gap-2">
                <x-button size="sm" variant="outline">{{ __('Learn More') }}</x-button>
            </div>
        </x-card>

        <x-card hover variant="solid" class="flex flex-col">
            <div class="w-12 h-12 rounded-lg flex items-center justify-center mb-5 bg-[var(--accent-color)]/10 text-[var(--accent-color)]">
                <i class="bx bx-palette text-2xl"></i>
            </div>
            <h2 class="text-lg font-bold">{{ __('Themes') }}</h2>
            <p class="mt-2 text-sm opacity-70 leading-relaxed">{{ __('Light, dark, solarized, and amoled themes are available from the navbar.') }}</p>
            <div class="mt-auto pt-6">
                <x-button size="sm" variant="primary" icon="bx-plus" onclick="openModal('demo-modal')">{{ __('Try Components') }}</x-button>
            </div>
        </x-card>

        <x-card hover variant="solid" class="flex flex-col">
            <div class="w-12 h-12 rounded-lg flex items-center justify-center mb-5 bg-[var(--accent-color)]/10 text-[var(--accent-color)]">
                <i class="bx bx-layout text-2xl"></i>
            </div>
            <h2 class="text-lg font-bold">{{ __('Reusable UI') }}</h2>
            <p class="mt-2 text-sm opacity-70 leading-relaxed">{{ __('Sidebar, navbar, footer, modal, pagination, and toast components remain.') }}</p>
            <div class="mt-auto pt-6 space-y-3">
                <x-skeleton type="text" />
                <x-skeleton type="text" />
            </div>
        </x-card>
    </div>
</div>

<x-modal id="demo-modal" :title="__('Component Showcase')">
    <div class="space-y-6">
        <x-alert type="success">
            {{ __('This is a success alert component.') }}
        </x-alert>
        
        <div class="space-y-3">
            <h4 class="text-sm font-bold opacity-60 uppercase tracking-widest">{{ __('Button Variants') }}</h4>
            <div class="flex flex-wrap gap-3">
                <x-button variant="primary">{{ __('Primary') }}</x-button>
                <x-button variant="secondary">{{ __('Secondary') }}</x-button>
                <x-button variant="outline">{{ __('Outline') }}</x-button>
                <x-button variant="danger">{{ __('Danger') }}</x-button>
                <x-button variant="success">{{ __('Success') }}</x-button>
                <x-button variant="ghost">{{ __('Ghost') }}</x-button>
            </div>
        </div>

        <div class="space-y-3">
            <h4 class="text-sm font-bold opacity-60 uppercase tracking-widest">{{ __('Loading States') }}</h4>
            <div class="grid grid-cols-2 gap-4">
                <x-card variant="solid" padding="p-4">
                    <x-skeleton type="title" class="mb-3" />
                    <x-skeleton type="text" rows="3" />
                </x-card>
                <div class="flex items-center gap-3">
                    <x-skeleton type="avatar" />
                    <div class="flex-1">
                        <x-skeleton type="text" class="mb-2 w-1/2" />
                        <x-skeleton type="text" class="w-full" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <x-slot name="footer">
        <x-button variant="secondary" onclick="closeModal('demo-modal')">{{ __('Close') }}</x-button>
        <x-button variant="primary" loading>{{ __('Processing') }}</x-button>
    </x-slot>
</x-modal>
@endsection
