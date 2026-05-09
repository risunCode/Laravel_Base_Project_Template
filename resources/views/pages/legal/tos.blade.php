@extends('layouts.guest')

@section('title', 'Terms of Service - ' . config('app.name'))

@section('content')
    <!-- Page Header Hero -->
    <x-section background="secondary" class="!py-16 border-b" style="border-color: var(--border-color);">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-black text-[var(--text-primary)] mb-4">Terms of Service</h1>
            <p class="text-sm font-bold uppercase tracking-[0.3em] text-[var(--accent-color)]">Legal Documentation</p>
        </div>
    </x-section>

    <!-- Content -->
    <x-section background="primary">
        <div class="max-w-4xl mx-auto">
            <div class="mb-12">
                <p class="text-sm opacity-60 text-[var(--text-secondary)]">Last updated: {{ date('F d, Y') }}</p>
            </div>

            <div class="prose prose-slate max-w-none space-y-8 text-[var(--text-secondary)] leading-relaxed">
                <section class="space-y-4">
                    <h2 class="text-2xl font-bold text-[var(--text-primary)]">1. Acceptance of Terms</h2>
                    <p>By accessing and using the services provided by {{ config('app.name') }}, you agree to be bound by these Terms of Service. If you do not agree to these terms, please do not use our services.</p>
                </section>

                <section class="space-y-4">
                    <h2 class="text-2xl font-bold text-[var(--text-primary)]">2. Description of Service</h2>
                    <p>{{ config('app.name') }} provides a premium digital platform for engineering excellence and digital infrastructure management. We reserve the right to modify or discontinue the service at any time.</p>
                </section>

                <section class="space-y-4">
                    <h2 class="text-2xl font-bold text-[var(--text-primary)]">3. User Obligations</h2>
                    <p>You are responsible for maintaining the security of your account and for all activities that occur under your account. You must notify us immediately of any unauthorized use of your account.</p>
                </section>

                <section class="space-y-4">
                    <h2 class="text-2xl font-bold text-[var(--text-primary)]">4. Intellectual Property</h2>
                    <p>The content, organization, graphics, design, compilation, and other matters related to {{ config('app.name') }} are protected under applicable copyrights and trademarks.</p>
                </section>

                <section class="space-y-4">
                    <h2 class="text-2xl font-bold text-[var(--text-primary)]">5. Limitation of Liability</h2>
                    <p>{{ config('app.name') }} shall not be liable for any direct, indirect, incidental, special, or consequential damages resulting from the use or inability to use the service.</p>
                </section>
            </div>

            <div class="mt-16 pt-8 border-t border-[var(--border-color)]">
                <a href="{{ route('landing') }}" class="inline-flex items-center gap-2 font-black text-sm uppercase tracking-widest hover:text-[var(--accent-color)] transition-colors text-[var(--text-primary)]">
                    <i class="bx bx-left-arrow-alt text-xl"></i>
                    Back to Home
                </a>
            </div>
        </div>
    </x-section>
@endsection
