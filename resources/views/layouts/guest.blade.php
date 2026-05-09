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
    <title>@yield('title', config('app.name'))</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif !important; }
    </style>
</head>
<body class="min-h-screen transition-colors duration-300" style="background-color: var(--bg-secondary); color: var(--text-primary);" 
      x-data="{ mobileMenuOpen: false }">

    <!-- Reusable Public Header -->
    <nav class="sticky top-0 z-50 backdrop-blur-md border-b transition-all duration-300" 
         style="background-color: color-mix(in srgb, var(--bg-primary) 80%, transparent); border-color: var(--border-color);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <a href="{{ route('landing') }}" class="flex items-center gap-2 group">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-lg transition-transform group-hover:rotate-12" style="background-color: var(--accent-color);">
                        <i class="bx bx-bolt-circle text-2xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-black tracking-tight leading-none">Risuncode</span>
                        <span class="text-[10px] uppercase tracking-[0.2em] font-bold" style="color: var(--accent-color);">Technologies</span>
                    </div>
                </a>
                
                <div class="hidden lg:flex items-center gap-8">
                    <a href="{{ route('landing') }}#home" class="text-xs font-bold hover:text-[var(--accent-color)] transition-all uppercase tracking-[0.2em]" style="color: var(--text-secondary);">Home</a>
                    <a href="{{ route('landing') }}#services" class="text-xs font-bold hover:text-[var(--accent-color)] transition-all uppercase tracking-[0.2em]" style="color: var(--text-secondary);">Services</a>
                    <a href="{{ route('landing') }}#gallery" class="text-xs font-bold hover:text-[var(--accent-color)] transition-all uppercase tracking-[0.2em]" style="color: var(--text-secondary);">Gallery</a>
                </div>

                <div class="flex items-center gap-1">
                    <x-theme-dropdown />
                    <x-language-dropdown />

                    <div class="h-6 w-px mx-1 bg-[var(--border-color)] hidden sm:block"></div>

                    @auth
                        <a href="{{ route('dashboard') }}" class="hidden sm:flex px-6 py-2.5 rounded-xl text-xs font-black btn-primary shadow-lg uppercase tracking-widest transition-all">Console</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 sm:px-6 py-2.5 rounded-xl text-xs font-black btn-primary shadow-lg uppercase tracking-widest transition-all">Get Started</a>
                    @endauth

                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden w-10 h-10 rounded-xl border flex items-center justify-center shrink-0" style="border-color: var(--border-color);">
                        <i class="bx text-2xl" :class="mobileMenuOpen ? 'bx-x' : 'bx-menu-alt-right'"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Dropdown -->
    <div x-show="mobileMenuOpen" x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="lg:hidden sticky top-20 z-40 border-b shadow-lg"
         style="background-color: var(--bg-primary); border-color: var(--border-color);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 space-y-3">
            <a href="{{ route('landing') }}#home" @click="mobileMenuOpen = false" class="block px-4 py-3 rounded-xl text-sm font-bold hover:bg-[var(--bg-input)] transition-colors" style="color: var(--text-primary);">Home</a>
            <a href="{{ route('landing') }}#services" @click="mobileMenuOpen = false" class="block px-4 py-3 rounded-xl text-sm font-bold hover:bg-[var(--bg-input)] transition-colors" style="color: var(--text-primary);">Services</a>
            <a href="{{ route('landing') }}#gallery" @click="mobileMenuOpen = false" class="block px-4 py-3 rounded-xl text-sm font-bold hover:bg-[var(--bg-input)] transition-colors" style="color: var(--text-primary);">Gallery</a>
            <div class="pt-3 border-t" style="border-color: var(--border-color);">
                @auth
                    <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-xl text-sm font-black btn-primary text-center">Console</a>
                @else
                    <a href="{{ route('login') }}" class="block px-4 py-3 rounded-xl text-sm font-black btn-primary text-center">Get Started</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Content -->
    @yield('content')

    <!-- Reusable Public Footer -->
    <footer class="pt-20 pb-12 border-t" style="border-color: var(--border-color); background-color: var(--bg-card);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-16 mb-12">
                <div class="md:col-span-6">
                    <div class="flex items-center gap-2 mb-8">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-lg" style="background-color: var(--accent-color);">
                            <i class="bx bx-bolt-circle text-2xl"></i>
                        </div>
                        <div class="flex flex-col text-left">
                            <span class="text-xl font-black tracking-tight leading-none">Risuncode</span>
                            <span class="text-[10px] uppercase tracking-[0.2em] font-bold" style="color: var(--accent-color);">Technologies</span>
                        </div>
                    </div>
                    <p class="text-lg leading-relaxed mb-8 opacity-70 text-[var(--text-secondary)]">Architecting digital excellence through engineering, design, and strategic innovation.</p>
                </div>
                <div class="md:col-span-3">
                    <h5 class="text-xs font-black uppercase tracking-widest mb-8">Navigation</h5>
                    <ul class="space-y-4 text-[var(--text-secondary)]">
                        <li><a href="{{ route('landing') }}#home" class="text-sm font-bold opacity-70 hover:opacity-100">Home</a></li>
                        <li><a href="{{ route('landing') }}#services" class="text-sm font-bold opacity-70 hover:opacity-100">Services</a></li>
                        <li><a href="{{ route('landing') }}#gallery" class="text-sm font-bold opacity-70 hover:opacity-100">Gallery</a></li>
                    </ul>
                </div>
                <div class="md:col-span-3">
                    <h5 class="text-xs font-black uppercase tracking-widest mb-8">Legal</h5>
                    <ul class="space-y-4 text-[var(--text-secondary)]">
                        <li><a href="{{ route('terms') }}" class="text-sm font-bold opacity-70 hover:opacity-100">Terms of Service</a></li>
                        <li><a href="{{ route('privacy') }}" class="text-sm font-bold opacity-70 hover:opacity-100">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-12 border-t flex flex-col md:flex-row justify-between items-center gap-6" style="border-color: var(--border-color);">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-[var(--text-secondary)]">&copy; {{ date('Y') }} Risuncode Technologies.</p>
            </div>
        </div>
    </footer>

    <x-dropdown-scripts />

    <script>
        function openModal(id) {
            const backdrop = document.getElementById(`${id}-backdrop`);
            const modal = document.getElementById(id);
            backdrop?.classList.remove('hidden');
            modal?.classList.remove('hidden');
            setTimeout(() => {
                backdrop?.classList.add('active');
                modal?.classList.add('active');
            }, 10);
        }

        function closeModal(id) {
            const backdrop = document.getElementById(`${id}-backdrop`);
            const modal = document.getElementById(id);
            backdrop?.classList.remove('active');
            modal?.classList.remove('active');
            setTimeout(() => {
                backdrop?.classList.add('hidden');
                modal?.classList.add('hidden');
            }, 400);
        }
    </script>
</body>
</html>
