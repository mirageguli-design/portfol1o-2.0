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

lenis.on('scroll', ScrollTrigger.update);

gsap.ticker.add((time) => {
    lenis.raf(time * 1000);
});

gsap.ticker.lagSmoothing(0);

gsap.registerPlugin(ScrollTrigger);

// Счетчик корзины
let cartCount = 0;
const cartCountElement = document.querySelector('.cart-count');

document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', () => {
        cartCount++;
        cartCountElement.textContent = cartCount;
        
        // Анимация кнопки
        gsap.to(button, {
            scale: 0.9,
            duration: 0.1,
            yoyo: true,
            repeat: 1
        });
        
        // Анимация счетчика
        gsap.to(cartCountElement, {
            scale: 1.3,
            duration: 0.2,
            yoyo: true,
            repeat: 1
        });
    });
});

// Анимация героя
gsap.to('.hero-content', {
    opacity: 1,
    x: 0,
    duration: 1,
    ease: 'power3.out'
});

gsap.utils.toArray('.floating-card').forEach((card, index) => {
    gsap.to(card, {
        opacity: 1,
        y: 0,
        x: 0,
        delay: index * 0.2,
        duration: 1,
        ease: 'power3.out'
    });
    
    // Плавающая анимация
    gsap.to(card, {
        y: -20,
        duration: 2 + index * 0.5,
        repeat: -1,
        yoyo: true,
        ease: 'sine.inOut',
        delay: index * 0.3
    });
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

// Анимация карточек товаров
gsap.utils.toArray('.product-card').forEach((card, index) => {
    gsap.to(card, {
        opacity: 1,
        y: 0,
        delay: index * 0.1,
        scrollTrigger: {
            trigger: card,
            start: 'top 85%',
            toggleActions: 'play none none none'
        }
    });
});

// Анимация особенностей
gsap.utils.toArray('.feature-item').forEach((item, index) => {
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

// Анимация текста о нас
gsap.to('.about-text h2', {
    opacity: 1,
    y: 0,
    scrollTrigger: {
        trigger: '.about',
        start: 'top 80%',
        toggleActions: 'play none none none'
    }
});

gsap.utils.toArray('.about-text p').forEach((p, index) => {
    gsap.to(p, {
        opacity: 1,
        y: 0,
        delay: index * 0.2,
        scrollTrigger: {
            trigger: p,
            start: 'top 85%',
            toggleActions: 'play none none none'
        }
    });
});

// Анимация статистики
gsap.utils.toArray('.stat').forEach((stat, index) => {
    gsap.to(stat, {
        opacity: 1,
        x: 0,
        delay: index * 0.15,
        scrollTrigger: {
            trigger: stat,
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

// Анимация формы
gsap.utils.toArray('.form-input, .form-textarea, .submit-btn').forEach((input, index) => {
    gsap.to(input, {
        opacity: 1,
        y: 0,
        delay: index * 0.1,
        scrollTrigger: {
            trigger: input,
            start: 'top 85%',
            toggleActions: 'play none none none'
        }
    });
});

// Параллакс эффект для карточек в герое
gsap.to('.card-1', {
    x: -50,
    y: -50,
    scrollTrigger: {
        trigger: '.hero',
        start: 'top top',
        end: 'bottom top',
        scrub: true
    }
});

gsap.to('.card-2', {
    x: 30,
    y: -30,
    scrollTrigger: {
        trigger: '.hero',
        start: 'top top',
        end: 'bottom top',
        scrub: true
    }
});

gsap.to('.card-3', {
    x: 50,
    y: 50,
    scrollTrigger: {
        trigger: '.hero',
        start: 'top top',
        end: 'bottom top',
        scrub: true
    }
});

