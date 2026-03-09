(() => {
    const storageKey = 'ui-theme';

    const getPreferredTheme = () => {
        const savedTheme = localStorage.getItem(storageKey);
        if (savedTheme === 'light' || savedTheme === 'dark') {
            return savedTheme;
        }

        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    };

    const getToggleMeta = (theme) => {
        if (theme === 'dark') {
            return { label: '☀️ Modo claro', aria: 'Cambiar a modo claro' };
        }

        return { label: '🌙 Modo oscuro', aria: 'Cambiar a modo oscuro' };
    };

    const applyTheme = (theme) => {
        document.body.setAttribute('data-theme', theme);
        localStorage.setItem(storageKey, theme);

        const toggle = document.querySelector('[data-theme-toggle]');
        if (toggle) {
            const meta = getToggleMeta(theme);
            toggle.textContent = meta.label;
            toggle.setAttribute('aria-label', meta.aria);
            toggle.setAttribute('title', meta.aria);
        }
        
        window.dispatchEvent(new CustomEvent('themechange', { detail: { theme } }));
    };

    document.addEventListener('DOMContentLoaded', () => {
        applyTheme(getPreferredTheme());

        const toggle = document.querySelector('[data-theme-toggle]');
        if (!toggle) {
            return;
        }

        toggle.addEventListener('click', () => {
            const currentTheme = document.body.getAttribute('data-theme') || 'light';
            const nextTheme = currentTheme === 'dark' ? 'light' : 'dark';
            applyTheme(nextTheme);
        });

        // Menú de usuario
        const userMenuBtn = document.getElementById('user-menu-toggle');
        const userMenu = document.getElementById('user-menu');

        if (userMenuBtn && userMenu) {
            // Abrir/cerrar menú al hacer click en el botón
            userMenuBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                userMenu.classList.toggle('active');
            });

            const menuItems = userMenu.querySelectorAll('.sidebar-user-menu-item');
            menuItems.forEach(item => {
                item.addEventListener('click', () => {
                    userMenu.classList.remove('active');
                });
            });

            document.addEventListener('click', () => {
                userMenu.classList.remove('active');
            });
        }
    });
})();
