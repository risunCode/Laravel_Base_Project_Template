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
    <title>@yield('title', 'Dashboard') - {{ config('app.name') }}</title>
    <meta name="description" content="Clean Laravel base project template.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif !important; }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen transition-colors duration-300" style="background-color: var(--bg-secondary); color: var(--text-primary);">
    <div class="flex min-h-screen">
        @include('components.sidebar')

        <div class="flex-1 flex flex-col lg:ml-64 min-w-0 overflow-x-hidden">
            @include('components.navbar')

            <main class="flex-1 p-4 lg:p-6 min-w-0">
                @yield('content')
            </main>

            @include('components.footer')
        </div>
    </div>

    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 lg:hidden hidden" onclick="toggleSidebar()"></div>

    @include('components.toast-notifications')

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.toggle('hidden');
        }

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
    @stack('scripts')
</body>
</html>
