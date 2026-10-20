
import Alpine from 'alpinejs';
import './animations';

window.Alpine = Alpine;
Alpine.start();

/* ========================================= */
/* INTERACTIVE LIQUID ORBITAL ARTWORK */
/* ========================================= */

function initializeOrbitalArt() {
    const art = document.getElementById('orbital-art');
    const core = document.getElementById('orbital-core');

    const innerLayer = document.getElementById(
        'orbital-ripple-layer'
    );

    const outerLayer = document.getElementById(
        'orbital-impact-layer'
    );

    if (!art || !core || !innerLayer || !outerLayer) {
        return;
    }

    const swatches = [
        ...document.querySelectorAll(
            '.orbital-swatch[data-orbit-color]'
        )
    ];

    const themes = new Set(
        swatches.map(button => button.dataset.orbitColor)
    );

    const reducedMotion = window.matchMedia(
        '(prefers-reduced-motion: reduce)'
    );

    /* ===================================== */
    /* COLOR PALETTE */
    /* ===================================== */

    function selectColor(color) {
        if (!themes.has(color)) return;

        art.dataset.theme = color;

        swatches.forEach(button => {
            const selected =
                button.dataset.orbitColor === color;

            button.setAttribute(
                'aria-pressed',
                String(selected)
            );
        });

        // Remember the chosen color.
        try {
            localStorage.setItem(
                'portfolio-orbit-color',
                color
            );
        } catch (error) {
            // The palette still works if storage is blocked.
        }
    }

    swatches.forEach(button => {
        button.addEventListener('click', () => {
            selectColor(button.dataset.orbitColor);
        });
    });

    // Restore the previously selected color.
    try {
        const saved = localStorage.getItem(
            'portfolio-orbit-color'
        );

        if (saved && themes.has(saved)) {
            selectColor(saved);
        }
    } catch (error) {
        // Use the default terracotta color.
    }

    /* ===================================== */
    /* LIGHT FOLLOWS THE MOUSE */
    /* ===================================== */

    art.addEventListener('pointermove', event => {
        if (reducedMotion.matches) return;

        if (event.pointerType === 'touch') return;

        const rect = art.getBoundingClientRect();

        const x = Math.max(
            0,
            Math.min(
                100,
                ((event.clientX - rect.left) / rect.width) * 100
            )
        );

        const y = Math.max(
            0,
            Math.min(
                100,
                ((event.clientY - rect.top) / rect.height) * 100
            )
        );

        art.style.setProperty('--light-x', `${x}%`);
        art.style.setProperty('--light-y', `${y}%`);
    });

    art.addEventListener('pointerleave', () => {
        art.style.setProperty('--light-x', '30%');
        art.style.setProperty('--light-y', '25%');
    });

    /* ===================================== */
    /* CREATE ONE ANIMATED WAVE */
    /* ===================================== */

    function createWave(layer, className, x, y, delay) {
        const wave = document.createElement('span');

        wave.className = className;

        wave.style.left = `${x}px`;
        wave.style.top = `${y}px`;
        wave.style.animationDelay = `${delay}ms`;

        layer.appendChild(wave);

        // Remove the finished wave from the DOM.
        wave.addEventListener(
            'animationend',
            () => wave.remove(),
            { once: true }
        );
    }

    /* ===================================== */
    /* WATER SPLASH EFFECT */
    /* ===================================== */

    function splash(event = null) {
        if (reducedMotion.matches) return;

        const rect = core.getBoundingClientRect();

        // Keyboard activation uses the center.
        const x = event
            ? event.clientX - rect.left
            : rect.width / 2;

        const y = event
            ? event.clientY - rect.top
            : rect.height / 2;

        const wrapRect =
            core.parentElement.getBoundingClientRect();

        const outsideX = event
            ? event.clientX - wrapRect.left
            : wrapRect.width / 2;

        const outsideY = event
            ? event.clientY - wrapRect.top
            : wrapRect.height / 2;

        // Create several staggered ripples.
        for (let i = 0; i < 3; i++) {
            createWave(
                innerLayer,
                'orbital-ripple',
                x,
                y,
                i * 110
            );
        }

        // Two larger waves extend beyond the sphere.
        for (let i = 0; i < 2; i++) {
            createWave(
                outerLayer,
                'orbital-impact',
                outsideX,
                outsideY,
                i * 150
            );
        }

        // Restart the liquid wobble.
        core.classList.remove('is-splashing');

        void core.offsetWidth;

        core.classList.add('is-splashing');
    }

    /* ===================================== */
    /* MOUSE AND TOUCH */
    /* ===================================== */

    core.addEventListener('pointerdown', event => {
        if (event.button !== 0) return;

        // Fires for mouse, touch, and pen.
        splash(event);
    });

    /* ===================================== */
    /* KEYBOARD ACCESSIBILITY */
    /* ===================================== */

    core.addEventListener('click', event => {
        // Keyboard-generated clicks have detail = 0.
        // Avoid duplicating normal pointer effects.
        if (event.detail === 0) {
            splash();
        }
    });

    /* ===================================== */
    /* RETURN TO NORMAL LIQUID ANIMATION */
    /* ===================================== */

    core.addEventListener('animationend', event => {
        if (
            event.target === core &&
            event.animationName === 'liquid-hit'
        ) {
            core.classList.remove('is-splashing');
        }
    });
}

/* ========================================= */
/* INITIALIZE WHEN DOCUMENT IS READY */
/* ========================================= */

if (document.readyState === 'loading') {
    document.addEventListener(
        'DOMContentLoaded',
        initializeOrbitalArt,
        { once: true }
    );
} else {
    initializeOrbitalArt();
}
