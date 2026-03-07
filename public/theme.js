(() => {
    const storageKey = 'ui-theme';

    const getPreferredTheme = () => {
        const savedTheme = localStorage.getItem(storageKey);
        if (savedTheme === 'light' || savedTheme === 'dark') {
            return savedTheme;
        }

        return window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
    };

    const getToggleMeta = (theme) => {
        if (theme === 'dark') {
            return { label: '☀️ Modo claro', aria: 'Cambiar a modo claro' };
        }

        return { label: '🌙 Modo oscuro', aria: 'Cambiar a modo oscuro' };
    };

    const applyTheme = (theme) => {
        document.body.setAttribute('data-theme', theme);

        const toggle = document.querySelector('[data-theme-toggle]');
        if (toggle) {
            const meta = getToggleMeta(theme);
            toggle.textContent = meta.label;
            toggle.setAttribute('aria-label', meta.aria);
        }
    };

    document.addEventListener('DOMContentLoaded', () => {
        applyTheme(getPreferredTheme());

        const toggle = document.querySelector('[data-theme-toggle]');
        if (!toggle) {
            return;
        }

        toggle.addEventListener('click', () => {
            const currentTheme = document.body.getAttribute('data-theme') || 'dark';
            const nextTheme = currentTheme === 'dark' ? 'light' : 'dark';
            localStorage.setItem(storageKey, nextTheme);
            applyTheme(nextTheme);
        });

        // Menú de usuario
        const userMenuBtn = document.getElementById('user-menu-toggle');
        const userMenu = document.getElementById('user-menu');

        if (userMenuBtn && userMenu) {
            // Abrir/cerrar menú al hacer click en el botón
            userMenuBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                userMenu.classList.toggle('open');
                userMenuBtn.classList.toggle('active');
            });

            // Cerrar menú cuando se hace click en una opción
            const menuItems = userMenu.querySelectorAll('.sidebar-user-menu-item');
            menuItems.forEach(item => {
                item.addEventListener('click', () => {
                    userMenu.classList.remove('open');
                    userMenuBtn.classList.remove('active');
                });
            });

            // Cerrar menú al hacer click fuera
            document.addEventListener('click', (e) => {
                if (!userMenuBtn.contains(e.target) && !userMenu.contains(e.target)) {
                    userMenu.classList.remove('open');
                    userMenuBtn.classList.remove('active');
                }
            });
        }
    });
})();
