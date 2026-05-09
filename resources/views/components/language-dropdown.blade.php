<div class="relative dropdown-container">
    <button onclick="toggleDropdown(this)" class="flex items-center gap-1 p-2.5 hover:bg-[var(--bg-input)] rounded-xl transition-colors" style="color: var(--text-secondary);" title="Change language" aria-label="Change language">
        <i class="bx bx-globe text-xl"></i>
        <span class="text-xs font-semibold" id="language-label">{{ strtoupper(app()->getLocale()) }}</span>
        <i class="bx bx-chevron-down text-base"></i>
    </button>
    <div class="dropdown-menu hidden absolute right-0 mt-2 w-52 rounded-xl shadow-xl overflow-hidden border" style="background-color: var(--bg-card); border-color: var(--border-color);">
        <div class="p-2 text-xs font-semibold uppercase tracking-wider border-b" style="color: var(--text-secondary); border-color: var(--border-color);">{{ __('Language') }}</div>
        <div class="p-1">
            <button onclick="setLanguage('en')" class="w-full flex items-center justify-between gap-3 px-3 py-2 rounded-lg text-sm hover:bg-[var(--bg-input)] transition-colors text-left" style="color: var(--text-primary);">
                <span>{{ __('English') }}</span>
                @if(app()->getLocale() == 'en') <span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-blue-500/10 text-blue-500 uppercase tracking-tight">Active</span> @endif
            </button>
            <button onclick="setLanguage('id')" class="w-full flex items-center justify-between gap-3 px-3 py-2 rounded-lg text-sm hover:bg-[var(--bg-input)] transition-colors text-left" style="color: var(--text-primary);">
                <span>{{ __('Bahasa Indonesia') }}</span>
                @if(app()->getLocale() == 'id') <span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-blue-500/10 text-blue-500 uppercase tracking-tight">Active</span> @endif
            </button>
        </div>
    </div>
</div>
