<script>
const themes = ['light', 'dark', 'solarized'];

function toggleDropdown(button) {
    const dropdown = button.nextElementSibling;
    const isShow = dropdown.classList.contains('show');
    closeAllDropdowns();
    if (!isShow) {
        dropdown.classList.remove('hidden');
        setTimeout(() => dropdown.classList.add('show'), 10);
    }
}

function closeAllDropdowns() {
    document.querySelectorAll('.dropdown-container > div').forEach(el => {
        el.classList.remove('show');
        setTimeout(() => el.classList.add('hidden'), 200);
    });
}

document.addEventListener('click', (event) => {
    if (!event.target.closest('.dropdown-container')) closeAllDropdowns();
});

function setTheme(theme) {
    themes.forEach(item => document.documentElement.classList.remove(item));
    if (theme === 'auto') {
        localStorage.removeItem('theme');
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) document.documentElement.classList.add('dark');
    } else {
        if (theme !== 'light') document.documentElement.classList.add(theme);
        localStorage.setItem('theme', theme);
    }
    updateThemeChecks(theme);
    closeAllDropdowns();
}

function updateThemeChecks(currentTheme) {
    document.querySelectorAll('.theme-active-tag').forEach(tag => {
        tag.classList.toggle('hidden', tag.dataset.theme !== currentTheme);
    });
}

function setLanguage(language) {
    const url = new URL(window.location.href);
    url.searchParams.set('lang', language);
    window.location.href = url.toString();
}

document.addEventListener('DOMContentLoaded', () => {
    const theme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'auto');
    updateThemeChecks(theme);
});
</script>
