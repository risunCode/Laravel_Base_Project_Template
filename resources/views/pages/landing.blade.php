@extends('layouts.guest')

@section('title', 'Welcome to ' . config('app.name'))

@section('content')
<div class="min-h-screen">
    <!-- Home / Hero Section -->
    <x-section id="home" background="primary" class="!pt-24 !pb-20">
        <div class="text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border mb-8 animate-fade-in" style="background-color: var(--bg-card); border-color: var(--border-color);">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75" style="background-color: var(--accent-color);"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2" style="background-color: var(--accent-color);"></span>
                </span>
                <span class="text-[10px] font-bold uppercase tracking-widest text-[var(--text-secondary)]">Available for New Projects</span>
            </div>

            <h1 class="text-5xl md:text-8xl font-black tracking-tighter mb-8 leading-[0.9] text-[var(--text-primary)]">
                Creative <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[var(--accent-color)] to-blue-400">Digital Solutions.</span>
            </h1>
            
            <p class="max-w-3xl mx-auto text-lg md:text-xl mb-12 font-medium leading-relaxed opacity-80 text-[var(--text-secondary)]">
                We craft high-quality digital experiences that combine innovative design with powerful technology to help your business grow.
            </p>

            <div class="flex flex-col sm:flex-row gap-5 justify-center items-center mb-24">
                <a href="#services" class="group px-10 py-5 rounded-2xl text-lg font-black btn-primary shadow-2xl shadow-[var(--accent-color)]/30 transition-all hover:scale-105">
                    Our Services
                    <i class="bx bx-right-arrow-alt ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="#gallery" class="px-10 py-5 rounded-2xl text-lg font-bold border border-[var(--border-color)] text-[var(--text-primary)] hover:bg-[var(--bg-card)] transition-all">
                    View Gallery
                </a>
            </div>
        </div>
        
        <!-- Background elements -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10 overflow-hidden text-left">
            <div class="absolute top-20 left-10 w-96 h-96 bg-[var(--accent-color)] rounded-full blur-[150px] opacity-10"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-500 rounded-full blur-[150px] opacity-10"></div>
        </div>
    </x-section>

    <!-- Services Section -->
    <x-section id="services" background="secondary">
        <div class="text-center mb-24">
            <h2 class="text-[10px] uppercase tracking-[0.4em] font-black mb-4" style="color: var(--accent-color);">Expertise</h2>
            <h3 class="text-4xl md:text-6xl font-black text-[var(--text-primary)]">What We Do</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-[var(--text-primary)]">
            <div class="bg-[var(--bg-card)] p-10 rounded-3xl border border-[var(--border-color)] space-y-6 transition-all hover:-translate-y-2">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-[var(--accent-color)]/20" style="background-color: var(--accent-color);">
                    <i class="bx bx-layout text-2xl"></i>
                </div>
                <h4 class="text-2xl font-black">Web Design</h4>
                <p class="leading-relaxed opacity-70 text-[var(--text-secondary)]">Creating beautiful, responsive, and user-centric designs that leave a lasting impression on your visitors.</p>
            </div>
            <div class="bg-[var(--bg-card)] p-10 rounded-3xl border border-[var(--border-color)] space-y-6 transition-all hover:-translate-y-2">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-[var(--accent-color)]/20" style="background-color: var(--accent-color);">
                    <i class="bx bx-code-alt text-2xl"></i>
                </div>
                <h4 class="text-2xl font-black">Development</h4>
                <p class="leading-relaxed opacity-70 text-[var(--text-secondary)]">Building robust and scalable applications using the latest technologies and best industry practices.</p>
            </div>
            <div class="bg-[var(--bg-card)] p-10 rounded-3xl border border-[var(--border-color)] space-y-6 transition-all hover:-translate-y-2">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-[var(--accent-color)]/20" style="background-color: var(--accent-color);">
                    <i class="bx bx-rocket text-2xl"></i>
                </div>
                <h4 class="text-2xl font-black">Digital Growth</h4>
                <p class="leading-relaxed opacity-70 text-[var(--text-secondary)]">Optimizing your digital presence to reach more customers and achieve your business goals effectively.</p>
            </div>
        </div>
    </x-section>

    <!-- Gallery Section -->
    <x-section id="gallery" background="primary">
        <div class="text-center mb-24">
            <h2 class="text-[10px] uppercase tracking-[0.4em] font-black mb-4" style="color: var(--accent-color);">Showcase</h2>
            <h3 class="text-4xl md:text-6xl font-black text-[var(--text-primary)]">Project Gallery</h3>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="group relative aspect-[4/5] rounded-3xl overflow-hidden cursor-pointer shadow-xl">
                <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Project 1">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-8">
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-[var(--accent-color)] mb-2">Development</p>
                        <h4 class="text-xl font-black text-white">E-Commerce Platform</h4>
                    </div>
                </div>
            </div>
            <div class="group relative aspect-[4/5] rounded-3xl overflow-hidden cursor-pointer shadow-xl">
                <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Project 2">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-8">
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-[var(--accent-color)] mb-2">UI Design</p>
                        <h4 class="text-xl font-black text-white">Mobile Application</h4>
                    </div>
                </div>
            </div>
            <div class="group relative aspect-[4/5] rounded-3xl overflow-hidden cursor-pointer shadow-xl">
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Project 3">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-8">
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-[var(--accent-color)] mb-2">Branding</p>
                        <h4 class="text-xl font-black text-white">Corporate Identity</h4>
                    </div>
                </div>
            </div>
            <div class="group relative aspect-[4/5] rounded-3xl overflow-hidden cursor-pointer shadow-xl">
                <img src="https://images.unsplash.com/photo-1558655146-d09347e92766?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Project 4">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-8">
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-[var(--accent-color)] mb-2">WebApp</p>
                        <h4 class="text-xl font-black text-white">SaaS Dashboard</h4>
                    </div>
                </div>
            </div>
            <div class="group relative aspect-[4/5] rounded-3xl overflow-hidden cursor-pointer shadow-xl">
                <img src="https://images.unsplash.com/photo-1522542550221-31fd19575a2d?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Project 5">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-8">
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-[var(--accent-color)] mb-2">Design</p>
                        <h4 class="text-xl font-black text-white">Creative Portfolio</h4>
                    </div>
                </div>
            </div>
            <div class="group relative aspect-[4/5] rounded-3xl overflow-hidden cursor-pointer shadow-xl">
                <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Project 6">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-8">
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-[var(--accent-color)] mb-2">Cloud</p>
                        <h4 class="text-xl font-black text-white">Infrastructure Setup</h4>
                    </div>
                </div>
            </div>
        </div>
    </x-section>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 1s ease-out forwards;
    }
</style>
@endsection
