
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

const reducedMotion = window.matchMedia(
    '(prefers-reduced-motion: reduce)'
).matches;

if (!reducedMotion) {
    gsap.utils.toArray('.reveal').forEach((element) => {
        gsap.from(element, {
            opacity: 0,
            y: 35,
            duration: 0.85,
            ease: 'power2.out',
            clearProps: 'all',
            scrollTrigger: {
                trigger: element,
                start: 'top 92%',
                once: true
            }
        });
    });

    gsap.utils.toArray('.project-card').forEach((card) => {
        gsap.from(card, {
            opacity: 0,
            y: 45,
            duration: 0.85,
            ease: 'power2.out',
            clearProps: 'all',
            scrollTrigger: {
                trigger: card,
                start: 'top 92%',
                once: true
            }
        });
    });
}
