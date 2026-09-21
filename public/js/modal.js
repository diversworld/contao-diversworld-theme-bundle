// Opens/closes native <dialog>-based modals used by the "dw_modal" frontend module.
// Replaces the Bootstrap/jQuery modal previously provided by the Theme Helper module.
document.addEventListener('click', (event) => {
    const opener = event.target.closest('[data-dw-modal-open]');

    if (opener) {
        const dialog = document.getElementById(opener.getAttribute('data-dw-modal-open'));

        if (dialog && typeof dialog.showModal === 'function') {
            dialog.showModal();
        }

        return;
    }

    const closer = event.target.closest('[data-dw-modal-close]');

    if (closer) {
        const dialog = closer.closest('dialog');

        if (dialog) {
            dialog.close();
        }
    }
});

// Close the dialog when clicking on the backdrop (outside the dialog box).
document.addEventListener('click', (event) => {
    if (event.target.matches('dialog.dw-modal') && event.target.open) {
        const rect = event.target.getBoundingClientRect();
        const insideDialog =
            rect.top <= event.clientY &&
            event.clientY <= rect.top + rect.height &&
            rect.left <= event.clientX &&
            event.clientX <= rect.left + rect.width;

        if (!insideDialog) {
            event.target.close();
        }
    }
});
