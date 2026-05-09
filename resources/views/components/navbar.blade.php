<header class="sticky top-0 z-30 backdrop-blur-md border-b" style="background-color: color-mix(in srgb, var(--bg-primary) 90%, transparent); border-color: var(--border-color);">
    <div class="flex items-center justify-between h-16 px-4 lg:px-6">
        <div class="flex items-center gap-4">
            <button onclick="toggleSidebar()" class="lg:hidden" style="color: var(--text-secondary);" aria-label="Toggle menu">
                <i class="bx bx-menu text-2xl"></i>
            </button>
            <div>
                <p class="text-sm" style="color: var(--text-secondary);">{{ auth()->check() ? __('Welcome back') : __('Admin Panel') }}</p>
                <h1 class="font-semibold leading-tight" style="color: var(--text-primary);">{{ auth()->check() ? auth()->user()->name : 'Laravel Base Risuncode' }}</h1>
            </div>
        </div>

        <div class="flex items-center gap-1">
            <x-theme-dropdown />
            <x-language-dropdown />

            @auth
                <div class="w-px h-6 mx-1" style="background-color: var(--border-color);"></div>

                <div class="relative dropdown-container">
                    <button onclick="toggleDropdown(this)" class="flex items-center gap-2 py-1.5 px-2 hover:bg-[var(--bg-input)] rounded-xl transition-colors">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-white font-semibold text-sm ring-2" style="background-color: var(--accent-color); --tw-ring-color: var(--border-color);">
                            {{ auth()->user()->initials }}
                        </div>
                        <div class="hidden md:block text-left">
                            <p class="text-sm font-medium leading-tight" style="color: var(--text-primary);">{{ auth()->user()->name }}</p>
                            <p class="text-xs leading-tight" style="color: var(--text-secondary);">{{ auth()->user()->email }}</p>
                        </div>
                        <i class="bx bx-chevron-down" style="color: var(--text-secondary);"></i>
                    </button>

                    <div class="dropdown-menu hidden absolute right-0 mt-2 w-56 rounded-xl shadow-xl overflow-hidden border" style="background-color: var(--bg-card); border-color: var(--border-color);">
                        <div class="px-4 py-3 border-b" style="border-color: var(--border-color);">
                            <p class="text-sm font-medium" style="color: var(--text-primary);">{{ auth()->user()->name }}</p>
                            <p class="text-xs" style="color: var(--text-secondary);">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-4 py-2 text-sm hover:bg-[var(--bg-input)] transition-colors" style="color: var(--text-primary);">
                                <i class="bx bx-user text-lg" style="color: var(--text-secondary);"></i>
                                {{ __('Profile') }}
                            </a>
                        </div>
                        <div class="py-1 border-t" style="border-color: var(--border-color);">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center gap-3 w-full px-4 py-2 text-sm text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                    <i class="bx bx-log-out text-lg"></i>
                                    {{ __('Logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl text-sm font-medium text-white transition-colors" style="background-color: var(--accent-color);">{{ __('Login') }}</a>
            @endauth
        </div>
    </div>
</header>

<x-dropdown-scripts />
