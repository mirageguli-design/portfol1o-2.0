// Инициализация Lenis
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

// Синхронизация GSAP с Lenis
lenis.on('scroll', ScrollTrigger.update);

gsap.ticker.add((time) => {
    lenis.raf(time * 1000);
});

gsap.ticker.lagSmoothing(0);

gsap.registerPlugin(ScrollTrigger);

// Кастомный курсор
const cursor = document.querySelector('.cursor');
let mouseX = 0;
let mouseY = 0;
let cursorX = 0;
let cursorY = 0;

document.addEventListener('mousemove', (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
});

function animateCursor() {
    cursorX += (mouseX - cursorX) * 0.1;
    cursorY += (mouseY - cursorY) * 0.1;
    cursor.style.left = cursorX + 'px';
    cursor.style.top = cursorY + 'px';
    requestAnimationFrame(animateCursor);
}
animateCursor();

// Анимация заголовка героя
gsap.utils.toArray('.hero-title .line').forEach((line, index) => {
    gsap.to(line, {
        opacity: 1,
        y: 0,
        duration: 1,
        delay: index * 0.2,
        ease: 'power3.out'
    });
});

gsap.to('.hero-description', {
    opacity: 1,
    y: 0,
    delay: 0.8,
    duration: 1,
    ease: 'power3.out'
});

gsap.to('.scroll-indicator', {
    opacity: 1,
    y: 0,
    delay: 1.2,
    duration: 1,
    ease: 'power3.out'
});

// Анимация секций
gsap.utils.toArray('.section-title').forEach(title => {
    gsap.to(title, {
        opacity: 1,
        y: 0,
        scrollTrigger: {
            trigger: title,
            start: 'top 80%',
            toggleActions: 'play none none none'
        }
    });
});

// Анимация карточек особенностей
gsap.utils.toArray('.feature-card').forEach((card, index) => {
    gsap.to(card, {
        opacity: 1,
        y: 0,
        delay: index * 0.15,
        scrollTrigger: {
            trigger: card,
            start: 'top 85%',
            toggleActions: 'play none none none'
        }
    });
});

// Анимация галереи
gsap.utils.toArray('.gallery-item').forEach((item, index) => {
    gsap.to(item, {
        opacity: 1,
        scale: 1,
        delay: index * 0.1,
        scrollTrigger: {
            trigger: item,
            start: 'top 85%',
            toggleActions: 'play none none none'
        }
    });
});

// Анимация статистики
gsap.utils.toArray('.stat-item').forEach((item, index) => {
    gsap.to(item, {
        opacity: 1,
        y: 0,
        delay: index * 0.1,
        scrollTrigger: {
            trigger: item,
            start: 'top 85%',
            toggleActions: 'play none none none'
        }
    });
});

// Анимация чисел статистики
function animateCounter(element) {
    const target = parseInt(element.getAttribute('data-target'));
    const duration = 2000;
    const increment = target / (duration / 16);
    let current = 0;
    
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current);
        }
    }, 16);
}

gsap.utils.toArray('.stat-number').forEach(stat => {
    ScrollTrigger.create({
        trigger: stat,
        start: 'top 80%',
        onEnter: () => animateCounter(stat)
    });
});

// Анимация CTA секции
gsap.to('.cta-title', {
    opacity: 1,
    y: 0,
    scrollTrigger: {
        trigger: '.cta-section',
        start: 'top 80%',
        toggleActions: 'play none none none'
    }
});

gsap.to('.cta-text', {
    opacity: 1,
    y: 0,
    delay: 0.2,
    scrollTrigger: {
        trigger: '.cta-section',
        start: 'top 80%',
        toggleActions: 'play none none none'
    }
});

gsap.to('.cta-button', {
    opacity: 1,
    y: 0,
    delay: 0.4,
    scrollTrigger: {
        trigger: '.cta-section',
        start: 'top 80%',
        toggleActions: 'play none none none'
    }
});

// Параллакс эффект для героя
gsap.to('.hero-content', {
    y: -100,
    opacity: 0.5,
    scrollTrigger: {
        trigger: '.hero-section',
        start: 'top top',
        end: 'bottom top',
        scrub: true
    }
});

