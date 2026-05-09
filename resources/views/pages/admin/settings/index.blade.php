@extends('layouts.app')

@section('title', __('System Settings'))

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    <div>
        <h1 class="text-3xl font-black tracking-tight" style="color: var(--text-primary);">{{ __('System Settings') }}</h1>
        <p class="text-sm font-medium opacity-60" style="color: var(--text-secondary);">{{ __('Global application configuration and administrative preferences.') }}</p>
    </div>

    <x-card variant="solid">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <h3 class="text-lg font-bold border-b pb-2" style="border-color: var(--border-color); color: var(--text-primary);">{{ __('General Configuration') }}</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label class="text-xs font-black uppercase tracking-widest ml-1" style="color: var(--text-secondary);">{{ __('Application Name') }}</label>
                        <input type="text" name="app_name" value="{{ config('app.name') }}" 
                               class="w-full px-4 py-3 rounded-2xl border bg-[var(--bg-input)] focus:ring-2 focus:ring-[var(--accent-color)]/20 transition-all outline-none" 
                               style="border-color: var(--border-color); color: var(--text-primary);">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-black uppercase tracking-widest ml-1" style="color: var(--text-secondary);">{{ __('Maintenance Mode') }}</label>
                        <select name="maintenance_mode" class="w-full px-4 py-3 rounded-2xl border bg-[var(--bg-input)] focus:ring-2 focus:ring-[var(--accent-color)]/20 transition-all outline-none" 
                                style="border-color: var(--border-color); color: var(--text-primary);">
                            <option value="off">Off (Live)</option>
                            <option value="on">On (Maintenance)</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="space-y-6 pt-4">
                <h3 class="text-lg font-bold border-b pb-2" style="border-color: var(--border-color); color: var(--text-primary);">{{ __('Security & Access') }}</h3>
                
                <div class="space-y-4">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative flex items-center">
                            <input type="checkbox" name="allow_registration" checked class="w-5 h-5 rounded-lg border-gray-300 text-[var(--accent-color)] focus:ring-[var(--accent-color)]/20 transition-all">
                        </div>
                        <div>
                            <p class="text-sm font-bold" style="color: var(--text-primary);">Allow New Registrations</p>
                            <p class="text-xs opacity-60" style="color: var(--text-secondary);">If disabled, only existing users can access the platform.</p>
                        </div>
                    </label>

                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative flex items-center">
                            <input type="checkbox" name="email_verification" class="w-5 h-5 rounded-lg border-gray-300 text-[var(--accent-color)] focus:ring-[var(--accent-color)]/20 transition-all">
                        </div>
                        <div>
                            <p class="text-sm font-bold" style="color: var(--text-primary);">Enforce Email Verification</p>
                            <p class="text-xs opacity-60" style="color: var(--text-secondary);">Require users to verify their email before accessing the dashboard.</p>
                        </div>
                    </label>
                </div>
            </div>

            <div class="flex justify-end pt-6">
                <x-button type="submit" variant="primary" class="!rounded-2xl px-10 py-4 font-black uppercase tracking-widest shadow-xl shadow-[var(--accent-color)]/20">
                    {{ __('Save Configuration') }}
                </x-button>
            </div>
        </form>
    </x-card>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <x-card variant="solid" class="border-amber-500/20">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-amber-500/10 flex items-center justify-center">
                    <i class="bx bx-trash text-2xl text-amber-600"></i>
                </div>
                <h3 class="text-lg font-bold text-amber-600">{{ __('Cache Management') }}</h3>
            </div>
            <p class="text-sm opacity-70 mb-6" style="color: var(--text-secondary);">Clear system application cache, routes, and compiled views.</p>
            <x-button variant="outline" class="w-full !border-amber-500/30 text-amber-600 hover:bg-amber-500/5">{{ __('Clear System Cache') }}</x-button>
        </x-card>

        <x-card variant="solid" class="border-red-500/20">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-red-500/10 flex items-center justify-center">
                    <i class="bx bx-reset text-2xl text-red-600"></i>
                </div>
                <h3 class="text-lg font-bold text-red-600">{{ __('Factory Reset') }}</h3>
            </div>
            <p class="text-sm opacity-70 mb-6" style="color: var(--text-secondary);">Wipe all application data and reset to default state. This action is irreversible.</p>
            <x-button variant="danger" class="w-full">{{ __('System Reset') }}</x-button>
        </x-card>
    </div>
</div>
@endsection
