document.addEventListener('DOMContentLoaded', () => {
    const mobileQuery = window.matchMedia('(max-width: 1024px)');

    const setupNavigation = (navigation) => {
        const submenus = navigation.querySelectorAll('li.submenu');

        submenus.forEach((item, index) => {
            const submenu = Array.from(item.children).find((child) => child.tagName === 'UL');
            const trigger = Array.from(item.children).find(
                (child) => child.tagName === 'A' || child.tagName === 'STRONG'
            );

            if (!submenu || !trigger) {
                return;
            }

            if (!submenu.id) {
                submenu.id = `${navigation.id || 'navigation'}-submenu-${index + 1}`;
            }

            let toggle = item.querySelector(':scope > .submenu-toggle');

            if (!toggle) {
                toggle = document.createElement('button');
                toggle.type = 'button';
                toggle.className = 'submenu-toggle';
                toggle.setAttribute('aria-label', 'Untermenü öffnen');
                toggle.setAttribute('aria-controls', submenu.id);
                item.insertBefore(toggle, submenu);
            }

            const closeSubmenu = () => {
                item.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
                toggle.setAttribute('aria-label', 'Untermenü öffnen');
            };

            const openSubmenu = () => {
                item.classList.add('is-open');
                toggle.setAttribute('aria-expanded', 'true');
                toggle.setAttribute('aria-label', 'Untermenü schließen');
            };

            toggle.addEventListener('click', () => {
                if (!mobileQuery.matches) {
                    return;
                }

                const isOpen = item.classList.contains('is-open');

                item.parentElement
                    .querySelectorAll(':scope > li.submenu.is-open')
                    .forEach((openItem) => {
                        if (openItem !== item) {
                            openItem.classList.remove('is-open');
                            const openToggle = openItem.querySelector(':scope > .submenu-toggle');
                            if (openToggle) {
                                openToggle.setAttribute('aria-expanded', 'false');
                                openToggle.setAttribute('aria-label', 'Untermenü öffnen');
                            }
                        }
                    });

                if (isOpen) {
                    closeSubmenu();
                } else {
                    openSubmenu();
                }
            });

            if (item.classList.contains('active') || item.classList.contains('trail')) {
                toggle.setAttribute('aria-expanded', mobileQuery.matches ? 'true' : 'false');
                if (mobileQuery.matches) {
                    item.classList.add('is-open');
                }
            } else {
                toggle.setAttribute('aria-expanded', 'false');
            }
        });

        const resetForViewport = () => {
            submenus.forEach((item) => {
                const toggle = item.querySelector(':scope > .submenu-toggle');

                if (!toggle) {
                    return;
                }

                if (mobileQuery.matches) {
                    if (item.classList.contains('active') || item.classList.contains('trail')) {
                        item.classList.add('is-open');
                        toggle.setAttribute('aria-expanded', 'true');
                    }
                } else {
                    item.classList.remove('is-open');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            });
        };

        mobileQuery.addEventListener('change', resetForViewport);
        resetForViewport();
    };

    document.querySelectorAll('.mod_navigation .navigation, nav.navigation').forEach(setupNavigation);
});
