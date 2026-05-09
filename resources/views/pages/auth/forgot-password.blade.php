@extends('layouts.auth')

@section('title', __('Forgot Password'))

@section('content')
<div class="rounded-3xl p-8 sm:p-12 shadow-2xl border transition-all" style="background-color: var(--bg-card); border-color: var(--border-color);">
    <div class="mb-10 text-center lg:text-left">
        <h2 class="text-3xl font-black mb-2 tracking-tight" style="color: var(--text-primary);">{{ __('Reset Password') }}</h2>
        <p class="text-sm font-medium opacity-60" style="color: var(--text-secondary);">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}</p>
    </div>

    @if (session('status'))
        <div class="mb-6 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 text-sm font-bold">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <div class="space-y-1.5">
            <label for="email" class="block text-xs font-black uppercase tracking-widest ml-1" style="color: var(--text-secondary);">{{ __('Email Address') }}</label>
            <div class="relative group">
                <i class="bx bx-envelope absolute left-4 top-1/2 -translate-y-1/2 text-xl opacity-40 group-focus-within:opacity-100 transition-opacity" style="color: var(--text-primary);"></i>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus class="w-full pl-12 pr-4 py-4 rounded-2xl border focus:ring-2 focus:ring-[var(--accent-color)]/20 transition-all outline-none" style="background-color: var(--bg-input); border-color: var(--border-color); color: var(--text-primary);" placeholder="name@company.com">
            </div>
            @error('email')
                <p class="text-xs text-red-500 mt-1 ml-1 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full py-4 rounded-2xl font-black uppercase tracking-widest btn-primary shadow-xl shadow-[var(--accent-color)]/20 transition-all hover:-translate-y-0.5 active:scale-[0.98]">
            {{ __('Send Reset Link') }}
        </button>
    </form>

    <div class="mt-10 pt-8 border-t text-center" style="border-color: var(--border-color);">
        <p class="text-sm font-medium" style="color: var(--text-secondary);">
            {{ __('Remember your password?') }}
            <a href="{{ route('login') }}" class="font-black hover:opacity-70 transition-opacity ml-1" style="color: var(--accent-color);">{{ __('Sign In') }}</a>
        </p>
    </div>
</div>
@endsection
