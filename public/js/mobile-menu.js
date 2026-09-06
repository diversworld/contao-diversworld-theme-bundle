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
		};

		button.addEventListener('click', () => {
			const isOpen = button.getAttribute('aria-expanded') === 'true';

			button.setAttribute('aria-expanded', String(!isOpen));
			navigation.classList.toggle('is-open', !isOpen);
		});

		document.addEventListener('keydown', (event) => {
			if (event.key === 'Escape') {
				closeNavigation();
			}
		});
	});
});
