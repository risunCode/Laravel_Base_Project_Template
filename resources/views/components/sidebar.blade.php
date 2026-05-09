<aside id="sidebar" class="fixed top-0 left-0 z-50 w-64 h-screen transform -translate-x-full lg:translate-x-0 transition-transform duration-300" style="background: var(--bg-sidebar);">
    <div class="flex items-center justify-between h-16 px-4 border-b border-white/10">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-white/20 text-white">
                <i class="bx bx-layer text-xl"></i>
            </div>
            <div>
                <span class="font-bold text-white text-lg">{{ __('Admin Panel') }}</span>
            </div>
        </a>
        <button onclick="toggleSidebar()" class="lg:hidden text-white/70 hover:text-white" aria-label="{{ __('Close menu') }}">
            <i class="bx bx-x text-2xl"></i>
        </button>
    </div>

    <nav class="p-4 flex flex-col h-[calc(100vh-4rem)]">
        <div class="flex-1 space-y-6 overflow-y-auto">
            <!-- General Section -->
            <div class="space-y-1">
                <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-white/30 mb-2">{{ __('General') }}</p>
                @if(auth()->check() && auth()->user()->isAdmin())
                    <a href="{{ route('dashboard') }}" 
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                       style="color: var(--sidebar-text);">
                        <i class="bx bx-home-circle text-xl"></i>
                        <span class="font-bold">{{ __('Dashboard') }}</span>
                    </a>
                @endif
                
                <a href="{{ route('profile.show') }}" 
                   class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('profile.*') ? 'active' : '' }}"
                   style="color: var(--sidebar-text);">
                    <i class="bx bx-user-circle text-xl"></i>
                    <span class="font-bold">{{ __('Profile') }}</span>
                </a>
            </div>

            <!-- Management Section -->
            @if(auth()->check() && auth()->user()->isAdmin())
            <div class="space-y-1 pt-2">
                <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-white/30 mb-2">{{ __('Management') }}</p>
                <a href="{{ route('admin.users.index') }}" 
                   class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                   style="color: var(--sidebar-text);">
                    <i class="bx bx-group text-xl"></i>
                    <span class="font-bold">{{ __('Users') }}</span>
                </a>
                <a href="{{ route('admin.settings.index') }}" 
                   class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"
                   style="color: var(--sidebar-text);">
                    <i class="bx bx-cog text-xl"></i>
                    <span class="font-bold">{{ __('Settings') }}</span>
                </a>
            </div>
            @endif
        </div>

        @auth
        <div class="pt-4 mt-4 border-t border-white/10 relative" x-data="{ open: false }" @click.away="open = false">
            <!-- Expand-up menu -->
            <div x-show="open" x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                 class="absolute bottom-full left-0 right-0 mb-2 mx-2 rounded-xl border border-white/10 overflow-hidden shadow-xl"
                 style="background: color-mix(in srgb, var(--bg-sidebar) 95%, white 5%);">
                <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-white/70 hover:text-white hover:bg-white/10 transition-all">
                    <i class="bx bx-user text-lg"></i>
                    {{ __('Profile') }}
                </a>
                <a href="{{ route('landing') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-white/70 hover:text-white hover:bg-white/10 transition-all">
                    <i class="bx bx-world text-lg"></i>
                    {{ __('View Public Site') }}
                </a>
                <div class="border-t border-white/10">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 text-sm font-bold text-red-400 hover:bg-red-500/10 transition-all">
                            <i class="bx bx-log-out text-lg"></i>
                            {{ __('Logout') }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Profile card trigger -->
            <button @click="open = !open" class="w-full flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-white/10 transition-all cursor-pointer">
                <div class="w-9 h-9 rounded-full flex items-center justify-center text-white font-semibold text-sm shrink-0" style="background-color: var(--accent-color);">
                    {{ auth()->user()->initials }}
                </div>
                <div class="flex-1 text-left min-w-0">
                    <p class="text-sm font-bold text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[11px] text-white/40 truncate">{{ auth()->user()->email }}</p>
                </div>
                <i class="bx text-white/40 text-lg shrink-0 transition-transform duration-200" :class="open ? 'bx-chevron-down' : 'bx-chevron-up'"></i>
            </button>
        </div>
        @endauth
    </nav>
</aside>
