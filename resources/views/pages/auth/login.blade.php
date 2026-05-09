@extends('layouts.auth')

@section('title', __('Login'))

@section('content')
<div class="rounded-3xl p-8 sm:p-12 shadow-2xl border transition-all" style="background-color: var(--bg-card); border-color: var(--border-color);">
    <div class="mb-10">
        <h2 class="text-3xl font-black mb-2 tracking-tight" style="color: var(--text-primary);">{{ __('Welcome Back') }}</h2>
        <p class="text-sm font-medium opacity-60" style="color: var(--text-secondary);">{{ __('Enter your credentials to access your console.') }}</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div class="space-y-1.5">
            <label for="login" class="block text-xs font-black uppercase tracking-widest ml-1" style="color: var(--text-secondary);">{{ __('Email or Username') }}</label>
            <div class="relative group">
                <i class="bx bx-user absolute left-4 top-1/2 -translate-y-1/2 text-xl opacity-40 group-focus-within:opacity-100 transition-opacity" style="color: var(--text-primary);"></i>
                <input type="text" name="login" id="login" value="{{ old('login') }}" required autofocus class="w-full pl-12 pr-4 py-4 rounded-2xl border focus:ring-2 focus:ring-[var(--accent-color)]/20 transition-all outline-none" style="background-color: var(--bg-input); border-color: var(--border-color); color: var(--text-primary);" placeholder="email or username">
            </div>
        </div>

        <div class="space-y-1.5" x-data="{ show: false }">
            <div class="flex justify-between items-center px-1">
                <label for="password" class="block text-xs font-black uppercase tracking-widest" style="color: var(--text-secondary);">{{ __('Password') }}</label>
                <a href="{{ route('password.request') }}" class="text-[10px] font-black uppercase tracking-wider hover:opacity-70" style="color: var(--accent-color);">{{ __('Forgot?') }}</a>
            </div>
            <div class="relative group">
                <i class="bx bx-lock-alt absolute left-4 top-1/2 -translate-y-1/2 text-xl opacity-40 group-focus-within:opacity-100 transition-opacity" style="color: var(--text-primary);"></i>
                <input :type="show ? 'text' : 'password'" name="password" id="password" required class="w-full pl-12 pr-12 py-4 rounded-2xl border focus:ring-2 focus:ring-[var(--accent-color)]/20 transition-all outline-none" style="background-color: var(--bg-input); border-color: var(--border-color); color: var(--text-primary);" placeholder="••••••••">
                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-xl opacity-40 hover:opacity-100 transition-opacity" style="color: var(--text-primary);">
                    <i class="bx" :class="show ? 'bx-hide' : 'bx-show'"></i>
                </button>
            </div>
        </div>

        <div class="flex items-center justify-between py-2">
            <label class="flex items-center gap-2 text-xs font-bold cursor-pointer select-none" style="color: var(--text-secondary);">
                <input type="checkbox" name="remember" class="w-4 h-4 rounded-lg border-gray-300 text-[var(--accent-color)] focus:ring-[var(--accent-color)]/20 transition-all">
                {{ __('Stay signed in') }}
            </label>
        </div>

        <button type="submit" class="w-full py-4 rounded-2xl font-black uppercase tracking-widest btn-primary shadow-xl shadow-[var(--accent-color)]/20 transition-all hover:-translate-y-0.5 active:scale-[0.98]">
            {{ __('Sign In') }}
        </button>
    </form>

    <div class="mt-10 pt-8 border-t text-center" style="border-color: var(--border-color);">
        <p class="text-sm font-medium" style="color: var(--text-secondary);">
            {{ __("Don't have an account yet?") }}
            <a href="{{ route('register') }}" class="font-black hover:opacity-70 transition-opacity ml-1" style="color: var(--accent-color);">{{ __('Join Now') }}</a>
        </p>
    </div>
</div>
@endsection
