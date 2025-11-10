// Инициализация Three.js сцены
let scene, camera, renderer, particles, mouse, raycaster;
let animationId;

// Позиция мыши
mouse = {
    x: 0,
    y: 0
};

// Инициализация сцены
function init() {
    scene = new THREE.Scene();
    
    // Камера
    camera = new THREE.PerspectiveCamera(
        75,
        window.innerWidth / window.innerHeight,
        0.1,
        1000
    );
    camera.position.z = 5;
    
    // Рендерер
    const canvas = document.getElementById('canvas');
    renderer = new THREE.WebGLRenderer({ 
        canvas: canvas,
        alpha: true,
        antialias: true
    });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(window.devicePixelRatio);
    
    // Создание частиц
    createParticles();
    
    // Обработка событий мыши
    document.addEventListener('mousemove', onMouseMove);
    window.addEventListener('resize', onWindowResize);
    
    // Анимация
    animate();
}

// Создание системы частиц
function createParticles() {
    const particlesGeometry = new THREE.BufferGeometry();
    const particlesCount = 2000;
    const posArray = new Float32Array(particlesCount * 3);
    
    for (let i = 0; i < particlesCount * 3; i++) {
        posArray[i] = (Math.random() - 0.5) * 20;
    }
    
    particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
    
    const particlesMaterial = new THREE.PointsMaterial({
        size: 0.05,
        color: 0x4facfe,
        transparent: true,
        opacity: 0.8
    });
    
    particles = new THREE.Points(particlesGeometry, particlesMaterial);
    scene.add(particles);
    
    // Добавление 3D объектов
    const geometry = new THREE.TorusGeometry(1, 0.3, 16, 100);
    const material = new THREE.MeshStandardMaterial({
        color: 0x4facfe,
        metalness: 0.7,
        roughness: 0.3,
        transparent: true,
        opacity: 0.8
    });
    
    const torus = new THREE.Mesh(geometry, material);
    scene.add(torus);
    
    // Добавление света
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
    scene.add(ambientLight);
    
    const pointLight = new THREE.PointLight(0x4facfe, 1);
    pointLight.position.set(5, 5, 5);
    scene.add(pointLight);
    
    // Анимация тора
    gsap.to(torus.rotation, {
        x: Math.PI * 2,
        y: Math.PI * 2,
        duration: 10,
        repeat: -1,
        ease: 'none'
    });
}

// Обработка движения мыши
function onMouseMove(event) {
    mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
    mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;
    
    // Плавное движение камеры за мышью
    gsap.to(camera.position, {
        x: mouse.x * 0.5,
        y: mouse.y * 0.5,
        duration: 1,
        ease: 'power2.out'
    });
}

// Обработка изменения размера окна
function onWindowResize() {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
}

// Анимация
function animate() {
    animationId = requestAnimationFrame(animate);
    
    // Вращение частиц
    if (particles) {
        particles.rotation.y += 0.001;
        particles.rotation.x += 0.0005;
    }
    
    // Обновление камеры
    camera.lookAt(scene.position);
    
    renderer.render(scene, camera);
}

// Инициализация GSAP анимаций
gsap.registerPlugin(ScrollTrigger);

// Анимация заголовка
gsap.utils.toArray('.hero-title .word').forEach((word, index) => {
    gsap.to(word, {
        opacity: 1,
        y: 0,
        duration: 1,
        delay: index * 0.2,
        ease: 'power3.out'
    });
});

gsap.to('.hero-subtitle', {
    opacity: 1,
    y: 0,
    delay: 0.8,
    duration: 1,
    ease: 'power3.out'
});

gsap.to('.explore-btn', {
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

// Анимация текста о нас
gsap.to('.about-text', {
    opacity: 1,
    x: 0,
    scrollTrigger: {
        trigger: '.about',
        start: 'top 80%',
        toggleActions: 'play none none none'
    }
});

// Анимация особенностей
gsap.utils.toArray('.feature').forEach((feature, index) => {
    gsap.to(feature, {
        opacity: 1,
        x: 0,
        delay: index * 0.2,
        scrollTrigger: {
            trigger: feature,
            start: 'top 85%',
            toggleActions: 'play none none none'
        }
    });
});

// Анимация карточек проектов
gsap.utils.toArray('.project-card').forEach((card, index) => {
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

// Запуск инициализации
init();

// Параллакс эффект для 3D сцены (после инициализации)
setTimeout(() => {
    if (camera) {
        gsap.to(camera.position, {
            z: 10,
            scrollTrigger: {
                trigger: '.hero',
                start: 'top top',
                end: 'bottom top',
                scrub: true
            }
        });
    }
}, 100);

