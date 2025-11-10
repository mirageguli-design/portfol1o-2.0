gsap.registerPlugin(ScrollTrigger);

// Анимация навбара
gsap.to('.navbar', {
    opacity: 1,
    duration: 1,
    ease: 'power2.out'
});

// Анимация героя
gsap.to('.hero-title', {
    opacity: 1,
    y: 0,
    duration: 1,
    duration: 0.8,
    ease: 'power3.out'
});

gsap.to('.hero-subtitle', {
    opacity: 1,
    y: 0,
    delay: 0.3,
    duration: 0.8,
    ease: 'power3.out'
});

gsap.to('.cta-button', {
    opacity: 1,
    y: 0,
    delay: 0.6,
    duration: 0.8,
    ease: 'power3.out'
});

// Анимация фигур
gsap.to('.shape-1', {
    x: 100,
    y: 100,
    duration: 3,
    repeat: -1,
    yoyo: true,
    ease: 'sine.inOut'
});

gsap.to('.shape-2', {
    x: -80,
    y: -80,
    duration: 4,
    repeat: -1,
    yoyo: true,
    ease: 'sine.inOut'
});

gsap.to('.shape-3', {
    scale: 1.2,
    duration: 2.5,
    repeat: -1,
    yoyo: true,
    ease: 'sine.inOut'
});

// Анимация секций при скролле
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

// Анимация карточек
gsap.utils.toArray('.about-card').forEach((card, index) => {
    gsap.to(card, {
        opacity: 1,
        y: 0,
        delay: index * 0.2,
        scrollTrigger: {
            trigger: card,
            start: 'top 80%',
            toggleActions: 'play none none none'
        }
    });
});

// Анимация элементов услуг
gsap.utils.toArray('.service-item').forEach((item, index) => {
    gsap.from(item, {
        opacity: 0,
        x: index % 2 === 0 ? -100 : 100,
        duration: 1,
        scrollTrigger: {
            trigger: item,
            start: 'top 80%',
            toggleActions: 'play none none none'
        }
    });
});

// Анимация формы
gsap.utils.toArray('.form-input, .form-textarea, .submit-button').forEach((input, index) => {
    gsap.to(input, {
        opacity: 1,
        y: 0,
        delay: index * 0.1,
        scrollTrigger: {
            trigger: input,
            start: 'top 80%',
            toggleActions: 'play none none none'
        }
    });
});

// Параллакс эффект для фигур
gsap.to('.shape-1', {
    y: -100,
    scrollTrigger: {
        trigger: '.hero',
        start: 'top top',
        end: 'bottom top',
        scrub: true
    }
});

gsap.to('.shape-2', {
    y: 100,
    scrollTrigger: {
        trigger: '.hero',
        start: 'top top',
        end: 'bottom top',
        scrub: true
    }
});

