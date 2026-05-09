@extends('layouts.auth')

@section('title', __('Reset Password'))

@section('content')
<div class="rounded-3xl p-8 sm:p-12 shadow-2xl border transition-all" style="background-color: var(--bg-card); border-color: var(--border-color);">
    <div class="mb-10 text-center lg:text-left">
        <h2 class="text-3xl font-black mb-2 tracking-tight" style="color: var(--text-primary);">{{ __('New Password') }}</h2>
        <p class="text-sm font-medium opacity-60" style="color: var(--text-secondary);">{{ __('Create a strong password to secure your account.') }}</p>
    </div>

    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="space-y-1.5">
            <label for="email" class="block text-xs font-black uppercase tracking-widest ml-1" style="color: var(--text-secondary);">{{ __('Email Address') }}</label>
            <div class="relative group">
                <i class="bx bx-envelope absolute left-4 top-1/2 -translate-y-1/2 text-xl opacity-40 group-focus-within:opacity-100 transition-opacity" style="color: var(--text-primary);"></i>
                <input type="email" name="email" id="email" value="{{ old('email', $request->email) }}" required readonly class="w-full pl-12 pr-4 py-4 rounded-2xl border focus:ring-2 focus:ring-[var(--accent-color)]/20 transition-all outline-none opacity-60 cursor-not-allowed" style="background-color: var(--bg-input); border-color: var(--border-color); color: var(--text-primary);">
            </div>
            @error('email')
                <p class="text-xs text-red-500 mt-1 ml-1 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1.5" x-data="{ show: false }">
            <label for="password" class="block text-xs font-black uppercase tracking-widest ml-1" style="color: var(--text-secondary);">{{ __('New Password') }}</label>
            <div class="relative group">
                <i class="bx bx-lock-alt absolute left-4 top-1/2 -translate-y-1/2 text-xl opacity-40 group-focus-within:opacity-100 transition-opacity" style="color: var(--text-primary);"></i>
                <input :type="show ? 'text' : 'password'" name="password" id="password" required autofocus class="w-full pl-12 pr-12 py-4 rounded-2xl border focus:ring-2 focus:ring-[var(--accent-color)]/20 transition-all outline-none" style="background-color: var(--bg-input); border-color: var(--border-color); color: var(--text-primary);" placeholder="••••••••">
                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-xl opacity-40 hover:opacity-100 transition-opacity" style="color: var(--text-primary);">
                    <i class="bx" :class="show ? 'bx-hide' : 'bx-show'"></i>
                </button>
            </div>
            @error('password')
                <p class="text-xs text-red-500 mt-1 ml-1 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1.5" x-data="{ show: false }">
            <label for="password_confirmation" class="block text-xs font-black uppercase tracking-widest ml-1" style="color: var(--text-secondary);">{{ __('Confirm Password') }}</label>
            <div class="relative group">
                <i class="bx bx-check-shield absolute left-4 top-1/2 -translate-y-1/2 text-xl opacity-40 group-focus-within:opacity-100 transition-opacity" style="color: var(--text-primary);"></i>
                <input :type="show ? 'text' : 'password'" name="password_confirmation" id="password_confirmation" required class="w-full pl-12 pr-12 py-4 rounded-2xl border focus:ring-2 focus:ring-[var(--accent-color)]/20 transition-all outline-none" style="background-color: var(--bg-input); border-color: var(--border-color); color: var(--text-primary);" placeholder="••••••••">
                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-xl opacity-40 hover:opacity-100 transition-opacity" style="color: var(--text-primary);">
                    <i class="bx" :class="show ? 'bx-hide' : 'bx-show'"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="w-full py-4 rounded-2xl font-black uppercase tracking-widest btn-primary shadow-xl shadow-[var(--accent-color)]/20 transition-all hover:-translate-y-0.5 active:scale-[0.98]">
            {{ __('Reset Password') }}
        </button>
    </form>
</div>
@endsection
