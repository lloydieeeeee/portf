
import Alpine from 'alpinejs';
import './animations';

window.Alpine = Alpine;
Alpine.start();

/* ========================================= */
/* INTERACTIVE ORBITAL SCULPTURE */
/* ========================================= */

function initializeOrbitalArt() {

    const root = document.documentElement;

    const art = document.getElementById('orbital-art');
    const track = document.getElementById(
        'orbital-control-track'
    );
    const handle = document.getElementById(
        'orbital-drag-handle'
    );
    const core = document.getElementById('orbital-core');
    const rippleLayer = document.getElementById(
        'orbital-ripple-layer'
    );

    const reducedMotion = window.matchMedia(
        '(prefers-reduced-motion: reduce)'
    );

    /* ===================================== */
    /* RESTRAINED COLOR GRADIENT */
    /* ===================================== */

    // RGB colors along the orbit.
    // The first and last color are the same,
    // so one full rotation blends smoothly.

    const colors = [
        {
            main: [184, 78, 43],
            light: [245, 195, 157],
            dark: [129, 56, 41]
        },
        {
            main: [40, 110, 164],
            light: [158, 217, 238],
            dark: [24, 65, 116]
        },
        {
            main: [35, 133, 109],
            light: [167, 232, 210],
            dark: [18, 79, 62]
        },
        {
            main: [119, 80, 165],
            light: [216, 187, 241],
            dark: [68, 46, 111]
        },
        {
            main: [181, 69, 106],
            light: [249, 182, 200],
            dark: [116, 42, 70]
        },
        {
            main: [151, 111, 43],
            light: [243, 215, 147],
            dark: [98, 70, 29]
        },
        {
            main: [184, 78, 43],
            light: [245, 195, 157],
            dark: [129, 56, 41]
        }
    ];

    function normalizeAngle(angle) {
        return ((angle % 360) + 360) % 360;
    }

    function blend(a, b, amount) {
        return a.map((value, index) => {
            return Math.round(
                value + (b[index] - value) * amount
            );
        });
    }

    function colorAtAngle(angle) {
        const normalized = normalizeAngle(angle);
        const position = (normalized / 360) *
            (colors.length - 1);

        const index = Math.min(
            Math.floor(position),
            colors.length - 2
        );

        const progress = position - index;

        return {
            main: blend(
                colors[index].main,
                colors[index + 1].main,
                progress
            ),
            light: blend(
                colors[index].light,
                colors[index + 1].light,
                progress
            ),
            dark: blend(
                colors[index].dark,
                colors[index + 1].dark,
                progress
            )
        };
    }

    function rgbToHex(rgb) {
        return '#' + rgb.map(value => {
            return value.toString(16).padStart(2, '0');
        }).join('');
    }

    /* ===================================== */
    /* APPLY COLOR TO ART AND WEBSITE */
    /* ===================================== */

    function applyColor(angle, save = true) {
        const color = colorAtAngle(angle);

        const main = rgbToHex(color.main);
        const light = rgbToHex(color.light);
        const dark = rgbToHex(color.dark);

        // Update orange accent throughout the website.
        // Black, gray and cream variables stay unchanged.
        root.style.setProperty('--color-accent', main);

        // Update the liquid and all orbital elements.
        if (art) {
            art.style.setProperty('--orb-main', main);
            art.style.setProperty('--orb-light', light);
            art.style.setProperty('--orb-dark', dark);
            art.style.setProperty(
                '--orb-rgb',
                color.main.join(' ')
            );
        }

        if (save) {
            try {
                localStorage.setItem(
                    'portfolio-orbit-angle',
                    String(normalizeAngle(angle))
                );
            } catch (error) {
                // Continue if browser storage is blocked.
            }
        }
    }

    /* ===================================== */
    /* RESTORE PREVIOUSLY CHOSEN COLOR */
    /* ===================================== */

    let savedAngle = 0;
    let hasSavedAngle = false;

    try {
        const saved = localStorage.getItem(
            'portfolio-orbit-angle'
        );

        if (saved !== null) {
            const parsed = Number(saved);

            if (Number.isFinite(parsed)) {
                savedAngle = normalizeAngle(parsed);
                hasSavedAngle = true;
            }
        }
    } catch (error) {
        // Default to terracotta.
    }

    // Apply on every page, including project details.
    if (hasSavedAngle) {
        applyColor(savedAngle, false);
    }

    // Other pages have no orbit.
    if (!art || !track || !handle ||
        !core || !rippleLayer) {
        return;
    }

    track.style.setProperty(
        '--orbit-start',
        `${savedAngle}deg`
    );

    /* ===================================== */
    /* DRAGGABLE ROTATING DOT */
    /* ===================================== */

    let currentAngle = savedAngle;
    let activePointer = null;
    let keyboardEditing = false;

    // Read the live angle before pausing the orbit.
    function freezeOrbit() {
        const transform = getComputedStyle(track).transform;

        if (transform !== 'none') {
            const matrix = new DOMMatrixReadOnly(transform);

            currentAngle = normalizeAngle(
                Math.atan2(matrix.b, matrix.a) *
                (180 / Math.PI)
            );
        }

        track.style.animation = 'none';
        track.style.transform =
            `rotate(${currentAngle}deg)`;
    }

    // Rotate the dot around the artwork center.
    function setAngle(angle) {
        currentAngle = normalizeAngle(angle);

        track.style.transform =
            `rotate(${currentAngle}deg)`;

        applyColor(currentAngle);
    }

    function angleFromPointer(event) {
        const rect = art.getBoundingClientRect();

        const centerX = rect.left + rect.width / 2;
        const centerY = rect.top + rect.height / 2;

        const deltaX = event.clientX - centerX;
        const deltaY = event.clientY - centerY;

        // Zero degrees is at the top of the orbit.
        return normalizeAngle(
            Math.atan2(deltaY, deltaX) *
            (180 / Math.PI) + 90
        );
    }

    function resumeOrbit() {
        track.style.setProperty(
            '--orbit-start',
            `${currentAngle}deg`
        );

        track.style.transform = '';

        // Restart the slow automatic orbit at the
        // position where the user released the dot.
        track.style.animation = '';
    }

    /* ===================================== */
    /* POINTER DOWN */
    /* ===================================== */

    handle.addEventListener('pointerdown', event => {
        if (event.button !== 0 ||
            activePointer !== null) {
            return;
        }

        event.preventDefault();

        freezeOrbit();

        activePointer = event.pointerId;

        handle.classList.add('is-dragging');

        handle.setPointerCapture(event.pointerId);
    });

    /* ===================================== */
    /* POINTER MOVEMENT */
    /* ===================================== */

    handle.addEventListener('pointermove', event => {
        if (event.pointerId !== activePointer) {
            return;
        }

        setAngle(angleFromPointer(event));
    });

    /* ===================================== */
    /* POINTER RELEASE */
    /* ===================================== */

    function stopDragging(event) {
        if (event.pointerId !== activePointer) {
            return;
        }

        activePointer = null;

        handle.classList.remove('is-dragging');

        resumeOrbit();
    }

    handle.addEventListener('pointerup', stopDragging);
    handle.addEventListener('pointercancel', stopDragging);

    handle.addEventListener('lostpointercapture', event => {
        if (activePointer === event.pointerId) {
            stopDragging(event);
        }
    });

    /* ===================================== */
    /* KEYBOARD ACCESSIBILITY */
    /* ===================================== */

    handle.addEventListener('keydown', event => {
        const increase = [
            'ArrowRight',
            'ArrowUp'
        ].includes(event.key);

        const decrease = [
            'ArrowLeft',
            'ArrowDown'
        ].includes(event.key);

        if (!increase && !decrease) {
            return;
        }

        event.preventDefault();

        if (!keyboardEditing) {
            freezeOrbit();
            keyboardEditing = true;
        }

        setAngle(
            currentAngle + (increase ? 15 : -15)
        );
    });

    handle.addEventListener('blur', () => {
        if (keyboardEditing) {
            keyboardEditing = false;
            resumeOrbit();
        }
    });

    /* ===================================== */
    /* SPHERE HIGHLIGHT FOLLOWS CURSOR */
    /* ===================================== */

    art.addEventListener('pointermove', event => {
        if (event.pointerType === 'touch' ||
            reducedMotion.matches) {
            return;
        }

        const rect = core.getBoundingClientRect();

        const x = Math.max(0, Math.min(
            100,
            ((event.clientX - rect.left) /
             rect.width) * 100
        ));

        const y = Math.max(0, Math.min(
            100,
            ((event.clientY - rect.top) /
             rect.height) * 100
        ));

        art.style.setProperty('--light-x', `${x}%`);
        art.style.setProperty('--light-y', `${y}%`);
    });

    art.addEventListener('pointerleave', () => {
        art.style.setProperty('--light-x', '30%');
        art.style.setProperty('--light-y', '25%');
    });

    /* ===================================== */
    /* ONE GENTLE WATER RIPPLE */
    /* ===================================== */

    core.addEventListener('click', event => {
        if (reducedMotion.matches) {
            return;
        }

        const rect = core.getBoundingClientRect();

        const keyboardClick = event.detail === 0;

        const x = keyboardClick
            ? rect.width / 2
            : event.clientX - rect.left;

        const y = keyboardClick
            ? rect.height / 2
            : event.clientY - rect.top;

        // Only one wave is visible at a time.
        rippleLayer.replaceChildren();

        const ripple = document.createElement('span');

        ripple.className = 'orbital-ripple';

        ripple.style.left = `${x}px`;
        ripple.style.top = `${y}px`;

        rippleLayer.appendChild(ripple);

        ripple.addEventListener(
            'animationend',
            () => ripple.remove(),
            { once: true }
        );

        // Restart a gentle wobble.
        core.classList.remove('is-splashing');

        void core.offsetWidth;

        core.classList.add('is-splashing');
    });

    core.addEventListener('animationend', event => {
        if (event.target === core &&
            event.animationName === 'gentle-wobble') {

            core.classList.remove('is-splashing');
        }
    });
}

/* ========================================= */
/* INITIALIZATION */
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
