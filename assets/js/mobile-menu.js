document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.navbar-toggler').forEach((button) => {
        const navigationId = button.getAttribute('aria-controls');
        const navigation = navigationId ? document.getElementById(navigationId) : null;

        if (!navigation) {
            return;
        }

        const closeNavigation = () => {
            button.setAttribute('aria-expanded', 'false');
            navigation.classList.remove('is-open');
            document.documentElement.classList.remove('navigation-open');
        };

        button.addEventListener('click', () => {
            const isOpen = button.getAttribute('aria-expanded') === 'true';
            button.setAttribute('aria-expanded', String(!isOpen));
            navigation.classList.toggle('is-open', !isOpen);
            document.documentElement.classList.toggle('navigation-open', !isOpen);
        });

        navigation.addEventListener('click', (event) => {
            if (event.target.closest('a')) {
                closeNavigation();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeNavigation();
                button.focus();
            }
        });

        window.addEventListener('resize', () => {
            if (window.matchMedia('(min-width: 1025px)').matches) {
                closeNavigation();
            }
        });
    });
});
