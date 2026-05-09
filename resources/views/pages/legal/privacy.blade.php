@extends('layouts.guest')

@section('title', 'Privacy Policy - ' . config('app.name'))

@section('content')
    <!-- Page Header Hero -->
    <x-section background="secondary" class="!py-16 border-b" style="border-color: var(--border-color);">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-black text-[var(--text-primary)] mb-4">Privacy Policy</h1>
            <p class="text-sm font-bold uppercase tracking-[0.3em] text-[var(--accent-color)]">Data Protection</p>
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
                    <h2 class="text-2xl font-bold text-[var(--text-primary)]">1. Information We Collect</h2>
                    <p>We collect information you provide directly to us, such as when you create an account, update your profile, or communicate with us. This includes your name, email address, and username.</p>
                </section>

                <section class="space-y-4">
                    <h2 class="text-2xl font-bold text-[var(--text-primary)]">2. How We Use Information</h2>
                    <p>We use the information we collect to provide, maintain, and improve our services, to process transactions, and to communicate with you about your account and our services.</p>
                </section>

                <section class="space-y-4">
                    <h2 class="text-2xl font-bold text-[var(--text-primary)]">3. Data Security</h2>
                    <p>We take reasonable measures to help protect information about you from loss, theft, misuse, and unauthorized access, disclosure, alteration, and destruction.</p>
                </section>

                <section class="space-y-4">
                    <h2 class="text-2xl font-bold text-[var(--text-primary)]">4. Data Retention</h2>
                    <p>We store the information we collect about you for as long as is necessary for the purposes for which we originally collected it, or for other legitimate business purposes.</p>
                </section>

                <section class="space-y-4">
                    <h2 class="text-2xl font-bold text-[var(--text-primary)]">5. Your Choices</h2>
                    <p>You may update your account information at any time by logging into your account and visiting your profile page. You may also request deletion of your data by contacting us.</p>
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
