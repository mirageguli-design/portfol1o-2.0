// Инициализация Lenis для плавной прокрутки
const lenis = new Lenis({
    duration: 1.2,
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    orientation: 'vertical',
    gestureOrientation: 'vertical',
    smoothWheel: true,
    wheelMultiplier: 1,
    smoothTouch: false,
    touchMultiplier: 2,
    infinite: false,
});

function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
}

requestAnimationFrame(raf);

// GSAP анимации для портфолио
gsap.registerPlugin(ScrollTrigger);

// Анимация заголовка
gsap.to('.portfolio-header', {
    opacity: 1,
    duration: 1,
    ease: 'power2.out'
});

// Анимация карточек работ
gsap.utils.toArray('.work-card').forEach((card, index) => {
    gsap.to(card, {
        opacity: 1,
        y: 0,
        duration: 0.8,
        delay: index * 0.2,
        ease: 'power3.out',
        scrollTrigger: {
            trigger: card,
            start: 'top 80%',
            toggleActions: 'play none none none'
        }
    });
});

// Параллакс эффект для карточек
gsap.utils.toArray('.work-card').forEach(card => {
    gsap.to(card, {
        y: -30,
        scrollTrigger: {
            trigger: card,
            start: 'top bottom',
            end: 'bottom top',
            scrub: true
        }
    });
});

// Анимация при наведении на карточки
document.querySelectorAll('.work-card').forEach(card => {
    card.addEventListener('mouseenter', () => {
        gsap.to(card, {
            scale: 1.02,
            duration: 0.3,
            ease: 'power2.out'
        });
    });
    
    card.addEventListener('mouseleave', () => {
        gsap.to(card, {
            scale: 1,
            duration: 0.3,
            ease: 'power2.out'
        });
    });
});

