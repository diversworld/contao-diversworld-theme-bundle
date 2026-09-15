document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.ce_accordion .toggler').forEach((toggler) => {
        const panel = toggler.nextElementSibling;

        if (!panel || !panel.classList.contains('accordion')) {
            return;
        }

        toggler.setAttribute('role', 'button');
        toggler.setAttribute('tabindex', '0');
        toggler.setAttribute('aria-expanded', 'false');
        panel.hidden = true;

        const toggle = () => {
            const isOpen = toggler.classList.toggle('active');
            toggler.setAttribute('aria-expanded', String(isOpen));

            if (isOpen) {
                panel.hidden = false;
                panel.style.height = `${panel.scrollHeight}px`;
            } else {
                panel.style.height = `${panel.scrollHeight}px`;
                requestAnimationFrame(() => {
                    panel.style.height = '0px';
                });
            }
        };

        panel.addEventListener('transitionend', () => {
            if (!toggler.classList.contains('active')) {
                panel.hidden = true;
            } else {
                panel.style.height = 'auto';
            }
        });

        toggler.addEventListener('click', toggle);
        toggler.addEventListener('keydown', (event) => {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                toggle();
            }
        });
    });
});
