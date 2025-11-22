document.addEventListener('DOMContentLoaded', () => {
    // 1. Inject CSS Styles
    const style = document.createElement('style');
    style.innerHTML = `
        body {
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }
        body.fade-in {
            opacity: 1;
        }
        body.fade-out {
            opacity: 0;
        }
    `;
    document.head.appendChild(style);

    // 2. Trigger Fade In
    requestAnimationFrame(() => {
        document.body.classList.add('fade-in');
    });

    // 3. Intercept Navigation
    const handleTransition = (e, targetUrl) => {
        e.preventDefault();
        document.body.classList.remove('fade-in');
        document.body.classList.add('fade-out');

        setTimeout(() => {
            window.location.href = targetUrl;
        }, 1000); // Match transition duration
    };

    // Links
    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', (e) => {
            const href = link.getAttribute('href');
            if (href && href !== '#' && !href.startsWith('javascript:')) {
                handleTransition(e, href);
            }
        });
    });

    // Forms
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            document.body.classList.remove('fade-in');
            document.body.classList.add('fade-out');

            setTimeout(() => {
                form.submit();
            }, 1000);
        });
    });
});
