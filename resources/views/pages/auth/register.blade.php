@extends('layouts.auth')

@section('title', __('Register'))

@section('content')
<div class="rounded-3xl p-8 sm:p-12 shadow-2xl border transition-all" style="background-color: var(--bg-card); border-color: var(--border-color);">
    <div class="mb-10">
        <h2 class="text-3xl font-black mb-2 tracking-tight" style="color: var(--text-primary);">{{ __('Create Account') }}</h2>
        <p class="text-sm font-medium opacity-60" style="color: var(--text-secondary);">{{ __('Join Risuncode Technologies and start building.') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div class="space-y-1.5">
            <label for="name" class="block text-xs font-black uppercase tracking-widest ml-1" style="color: var(--text-secondary);">{{ __('Full Name') }}</label>
            <div class="relative group">
                <i class="bx bx-user absolute left-4 top-1/2 -translate-y-1/2 text-xl opacity-40 group-focus-within:opacity-100 transition-opacity" style="color: var(--text-primary);"></i>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus class="w-full pl-12 pr-4 py-4 rounded-2xl border focus:ring-2 focus:ring-[var(--accent-color)]/20 transition-all outline-none" style="background-color: var(--bg-input); border-color: var(--border-color); color: var(--text-primary);" placeholder="John Doe">
            </div>
        </div>

        <div class="space-y-1.5">
            <label for="username" class="block text-xs font-black uppercase tracking-widest ml-1" style="color: var(--text-secondary);">{{ __('Username') }}</label>
            <div class="relative group">
                <i class="bx bx-at absolute left-4 top-1/2 -translate-y-1/2 text-xl opacity-40 group-focus-within:opacity-100 transition-opacity" style="color: var(--text-primary);"></i>
                <input type="text" name="username" id="username" value="{{ old('username') }}" required class="w-full pl-12 pr-4 py-4 rounded-2xl border focus:ring-2 focus:ring-[var(--accent-color)]/20 transition-all outline-none" style="background-color: var(--bg-input); border-color: var(--border-color); color: var(--text-primary);" placeholder="johndoe">
            </div>
        </div>

        <div class="space-y-1.5">
            <label for="email" class="block text-xs font-black uppercase tracking-widest ml-1" style="color: var(--text-secondary);">{{ __('Email Address') }}</label>
            <div class="relative group">
                <i class="bx bx-envelope absolute left-4 top-1/2 -translate-y-1/2 text-xl opacity-40 group-focus-within:opacity-100 transition-opacity" style="color: var(--text-primary);"></i>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full pl-12 pr-4 py-4 rounded-2xl border focus:ring-2 focus:ring-[var(--accent-color)]/20 transition-all outline-none" style="background-color: var(--bg-input); border-color: var(--border-color); color: var(--text-primary);" placeholder="name@company.com">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1.5" x-data="{ show: false }">
                <label for="password" class="block text-xs font-black uppercase tracking-widest ml-1" style="color: var(--text-secondary);">{{ __('Password') }}</label>
                <div class="relative group">
                    <i class="bx bx-lock-alt absolute left-4 top-1/2 -translate-y-1/2 text-xl opacity-40 group-focus-within:opacity-100 transition-opacity" style="color: var(--text-primary);"></i>
                    <input :type="show ? 'text' : 'password'" name="password" id="password" required class="w-full pl-12 pr-12 py-4 rounded-2xl border focus:ring-2 focus:ring-[var(--accent-color)]/20 transition-all outline-none" style="background-color: var(--bg-input); border-color: var(--border-color); color: var(--text-primary);" placeholder="••••••••">
                    <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-xl opacity-40 hover:opacity-100 transition-opacity" style="color: var(--text-primary);">
                        <i class="bx" :class="show ? 'bx-hide' : 'bx-show'"></i>
                    </button>
                </div>
            </div>

            <div class="space-y-1.5" x-data="{ show: false }">
                <label for="password_confirmation" class="block text-xs font-black uppercase tracking-widest ml-1" style="color: var(--text-secondary);">{{ __('Confirm') }}</label>
                <div class="relative group">
                    <i class="bx bx-check-shield absolute left-4 top-1/2 -translate-y-1/2 text-xl opacity-40 group-focus-within:opacity-100 transition-opacity" style="color: var(--text-primary);"></i>
                    <input :type="show ? 'text' : 'password'" name="password_confirmation" id="password_confirmation" required class="w-full pl-12 pr-12 py-4 rounded-2xl border focus:ring-2 focus:ring-[var(--accent-color)]/20 transition-all outline-none" style="background-color: var(--bg-input); border-color: var(--border-color); color: var(--text-primary);" placeholder="••••••••">
                    <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-xl opacity-40 hover:opacity-100 transition-opacity" style="color: var(--text-primary);">
                        <i class="bx" :class="show ? 'bx-hide' : 'bx-show'"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="py-2">
            <p class="text-[10px] text-center opacity-60 leading-relaxed" style="color: var(--text-secondary);">
                By creating an account, you agree to our <a href="{{ route('terms') }}" class="underline">Terms of Service</a> and <a href="{{ route('privacy') }}" class="underline">Privacy Policy</a>.
            </p>
        </div>

        <button type="submit" class="w-full py-4 rounded-2xl font-black uppercase tracking-widest btn-primary shadow-xl shadow-[var(--accent-color)]/20 transition-all hover:-translate-y-0.5 active:scale-[0.98]">
            {{ __('Create Account') }}
        </button>
    </form>

    <div class="mt-10 pt-8 border-t text-center" style="border-color: var(--border-color);">
        <p class="text-sm font-medium" style="color: var(--text-secondary);">
            {{ __('Already have an account?') }}
            <a href="{{ route('login') }}" class="font-black hover:opacity-70 transition-opacity ml-1" style="color: var(--accent-color);">{{ __('Sign In') }}</a>
        </p>
    </div>
</div>
@endsection
