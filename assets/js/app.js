document.addEventListener('DOMContentLoaded', () => {
    const toggleLinks = document.querySelectorAll('[data-toggle-target]');

    toggleLinks.forEach((link) => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            const targetId = link.getAttribute('data-toggle-target');
            document.querySelectorAll('.auth-form').forEach((form) => {
                form.classList.add('d-none');
            });
            document.getElementById(targetId)?.classList.remove('d-none');

            toggleLinks.forEach((lnk) => lnk.classList.remove('active'));
            link.classList.add('active');
        });
    });

    const whatsappButtons = document.querySelectorAll('[data-whatsapp-message]');

    whatsappButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const message = button.getAttribute('data-whatsapp-message');
            if (!message) {
                return;
            }
            const url = `https://wa.me/923232147444?text=${encodeURIComponent(message)}`;
            window.open(url, '_blank');
        });
    });
});


