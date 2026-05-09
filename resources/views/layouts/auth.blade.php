<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script>
        (function () {
            const theme = localStorage.getItem('theme');
            if (theme) {
                if (theme !== 'light') document.documentElement.classList.add(theme);
            } else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Auth') - {{ config('app.name') }}</title>
    <meta name="description" content="Authentication page for {{ config('app.name') }}.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif !important; }
        .auth-split-bg {
            background-image: url('https://images.unsplash.com/photo-1550745165-9bc0b252726f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="min-h-screen transition-colors duration-300 overflow-x-hidden" style="background-color: var(--bg-secondary); color: var(--text-primary);">
    <div class="flex min-h-screen w-full">
        <!-- Left Side: Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-4 sm:p-8 md:p-12 relative z-10" style="background-color: var(--bg-primary);">
            <div class="w-full max-w-md mx-auto">
                <!-- Branding Mobile Only -->
                <div class="lg:hidden text-center mb-8">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl mb-3 text-white" style="background-color: var(--accent-color);">
                        <i class="bx bx-bolt-circle text-2xl"></i>
                    </div>
                    <h1 class="text-xl font-black tracking-tight" style="color: var(--text-primary);">Risuncode</h1>
                </div>

                @yield('content')
            </div>
        </div>

        <!-- Right Side: Slider/Content (Desktop Only) -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden auth-split-bg items-center justify-center p-12">
            <div class="absolute inset-0 bg-gradient-to-br from-[var(--accent-color)]/80 to-blue-900/90 mix-blend-multiply"></div>
            
            <div class="relative z-20 max-w-xl text-white" x-data="{ 
                activeSlide: 0,
                slides: [
                    { title: 'Advanced Infrastructure', desc: 'Enterprise-grade systems built with Laravel and optimized for massive scale.' },
                    { title: 'Secure by Design', desc: 'Military-grade encryption and advanced authentication protocols for your data.' },
                    { title: 'Global Performance', desc: 'Distributed cloud network ensuring sub-millisecond response times worldwide.' }
                ]
            }" x-init="setInterval(() => activeSlide = (activeSlide + 1) % slides.length, 5000)">
                <div class="mb-12">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center bg-white/10 backdrop-blur-md mb-6 border border-white/20">
                        <i class="bx bx-bolt-circle text-4xl"></i>
                    </div>
                    <h2 class="text-3xl font-black mb-2 tracking-tight">Risuncode Technologies</h2>
                    <p class="text-white/60 font-medium">Engineering Digital Excellence Since 2024</p>
                </div>

                <div class="h-48">
                    <template x-for="(slide, index) in slides" :key="index">
                        <div x-show="activeSlide === index" 
                             x-transition:enter="transition ease-out duration-500"
                             x-transition:enter-start="opacity-0 translate-x-8"
                             x-transition:enter-end="opacity-100 translate-x-0"
                             x-transition:leave="transition ease-in duration-300 absolute"
                             x-transition:leave-start="opacity-100 translate-x-0"
                             x-transition:leave-end="opacity-0 -translate-x-8"
                             class="space-y-4">
                            <h3 class="text-5xl font-black tracking-tighter" x-text="slide.title"></h3>
                            <p class="text-xl text-white/80 leading-relaxed font-medium" x-text="slide.desc"></p>
                        </div>
                    </template>
                </div>

                <div class="flex gap-2 mt-8">
                    <template x-for="(slide, index) in slides" :key="index">
                        <button @click="activeSlide = index" 
                                class="h-1.5 rounded-full transition-all duration-300"
                                :class="activeSlide === index ? 'w-8 bg-white' : 'w-2 bg-white/30'"></button>
                    </template>
                </div>
            </div>

            <!-- Animated Decorative Elements -->
            <div class="absolute top-0 right-0 p-12">
                <div class="flex gap-4">
                    <div class="w-2 h-2 rounded-full bg-white/20 animate-pulse"></div>
                    <div class="w-2 h-2 rounded-full bg-white/20 animate-pulse [animation-delay:200ms]"></div>
                    <div class="w-2 h-2 rounded-full bg-white/20 animate-pulse [animation-delay:400ms]"></div>
                </div>
            </div>
        </div>
    </div>

    @include('components.toast-notifications')
</body>
</html>
