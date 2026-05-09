<div class="relative dropdown-container">
    <button onclick="toggleDropdown(this)" class="flex items-center gap-1 p-2.5 hover:bg-[var(--bg-input)] rounded-xl transition-colors" style="color: var(--text-secondary);" title="Change theme" aria-label="Change theme">
        <i class="bx bx-palette text-xl"></i>
        <i class="bx bx-chevron-down text-base"></i>
    </button>
    <div class="dropdown-menu hidden absolute right-0 mt-2 w-48 rounded-xl shadow-xl overflow-hidden border" style="background-color: var(--bg-card); border-color: var(--border-color);">
        <div class="p-2 text-xs font-semibold uppercase tracking-wider border-b" style="color: var(--text-secondary); border-color: var(--border-color);">{{ __('Theme') }}</div>
        <div class="p-1">
            <button onclick="setTheme('auto')" class="w-full flex items-center justify-between px-3 py-2 rounded-lg text-sm hover:bg-[var(--bg-input)] transition-colors text-left" style="color: var(--text-primary);">
                <div class="flex items-center gap-3">
                    <span class="w-5 h-5 rounded-full bg-gradient-to-br from-gray-200 to-gray-800 border-2 border-gray-400 flex items-center justify-center"></span>
                    <span>Auto</span>
                </div>
                <span class="theme-active-tag hidden text-[10px] font-bold px-1.5 py-0.5 rounded bg-blue-500/10 text-blue-500 uppercase tracking-tight" data-theme="auto">Active</span>
            </button>
            <button onclick="setTheme('light')" class="w-full flex items-center justify-between px-3 py-2 rounded-lg text-sm hover:bg-[var(--bg-input)] transition-colors text-left" style="color: var(--text-primary);">
                <div class="flex items-center gap-3">
                    <span class="w-5 h-5 rounded-full bg-white border-2 border-gray-300 flex items-center justify-center"></span>
                    <span>Light</span>
                </div>
                <span class="theme-active-tag hidden text-[10px] font-bold px-1.5 py-0.5 rounded bg-blue-500/10 text-blue-500 uppercase tracking-tight" data-theme="light">Active</span>
            </button>
            <button onclick="setTheme('solarized')" class="w-full flex items-center justify-between px-3 py-2 rounded-lg text-sm hover:bg-[var(--bg-input)] transition-colors text-left" style="color: var(--text-primary);">
                <div class="flex items-center gap-3">
                    <span class="w-5 h-5 rounded-full bg-[#fdf6e3] border-2 border-[#eee8d5] flex items-center justify-center"></span>
                    <span>Solarized</span>
                </div>
                <span class="theme-active-tag hidden text-[10px] font-bold px-1.5 py-0.5 rounded bg-blue-500/10 text-blue-500 uppercase tracking-tight" data-theme="solarized">Active</span>
            </button>
            
            <div class="my-1 border-t" style="border-color: var(--border-color);"></div>
            
            <button onclick="setTheme('dark')" class="w-full flex items-center justify-between px-3 py-2 rounded-lg text-sm hover:bg-[var(--bg-input)] transition-colors text-left" style="color: var(--text-primary);">
                <div class="flex items-center gap-3">
                    <span class="w-5 h-5 rounded-full bg-neutral-700 border-2 border-neutral-600 flex items-center justify-center"></span>
                    <span>Dark</span>
                </div>
                <span class="theme-active-tag hidden text-[10px] font-bold px-1.5 py-0.5 rounded bg-blue-500/10 text-blue-500 uppercase tracking-tight" data-theme="dark">Active</span>
            </button>
        </div>
    </div>
</div>
