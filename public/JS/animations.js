// Gestion du curseur personnalisé
document.addEventListener('DOMContentLoaded', () => {
    const cursor = document.createElement('div');
    cursor.className = 'custom-cursor';
    document.body.appendChild(cursor);

    // Variables pour le suivi fluide du curseur
    let currentX = 0, currentY = 0;
    let targetX = 0, targetY = 0;

    // Animation fluide du curseur
    function animateCursor() {
        const ease = 0.15;
        currentX += (targetX - currentX) * ease;
        currentY += (targetY - currentY) * ease;
        cursor.style.transform = `translate(${currentX}px, ${currentY}px)`;
        requestAnimationFrame(animateCursor);
    }

    // Mise à jour de la position du curseur
    document.addEventListener('mousemove', (e) => {
        targetX = e.clientX - cursor.offsetWidth / 2;
        targetY = e.clientY - cursor.offsetHeight / 2;
    });

    // Gestion des éléments interactifs
    const interactiveElements = document.querySelectorAll('a, button, .btn, .game-card, input, textarea, select');
    interactiveElements.forEach(el => {
        el.addEventListener('mouseenter', () => {
            cursor.classList.add('hover');
        });
        el.addEventListener('mouseleave', () => {
            cursor.classList.remove('hover');
        });
    });

    // Démarrage de l'animation du curseur
    animateCursor();

    // Cache le curseur quand la souris quitte la fenêtre
    document.addEventListener('mouseleave', () => {
        cursor.style.opacity = '0';
    });

    document.addEventListener('mouseenter', () => {
        cursor.style.opacity = '1';
    });
});


// Initialisation de AOS avec animations réversibles
document.addEventListener('DOMContentLoaded', () => {
    // Ajout d'une classe pour les animations de chargement initial
    document.body.classList.add('content-loaded');

    // Animation initiale de la page
    const mainContent = document.querySelector('main');
    if (mainContent) {
        mainContent.style.opacity = '0';
        mainContent.style.transform = 'translateY(20px)';
        setTimeout(() => {
            mainContent.style.transition = 'opacity 0.8s ease-out, transform 0.8s ease-out';
            mainContent.style.opacity = '1';
            mainContent.style.transform = 'translateY(0)';
        }, 100);
    }
    // Configuration des animations au défilement
    const gameCards = document.querySelectorAll('.game-card');
    gameCards.forEach((card, index) => {
        card.setAttribute('data-aos', index % 2 === 0 ? 'fade-right' : 'fade-left');
        card.setAttribute('data-aos-delay', (index * 100).toString());
    });

    // Animation des sections principales
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        heroSection.setAttribute('data-aos', 'fade-up');
    }

    // Animation des éléments de navigation
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach((item, index) => {
        item.setAttribute('data-aos', 'fade-up');
        item.setAttribute('data-aos-delay', (index * 50).toString());
    });

    // Animation des iframes Steam
    const steamWidgets = document.querySelectorAll('#steam');
    steamWidgets.forEach((widget, index) => {
        widget.setAttribute('data-aos', 'zoom-in');
        widget.setAttribute('data-aos-delay', (index * 150).toString());
    });

    // Animation des sections de contact
    const contactForm = document.querySelector('.contact-form');
    if (contactForm) {
        contactForm.setAttribute('data-aos', 'fade-up');
    }

    // Animation des sections de réalisations
    const realisationItems = document.querySelectorAll('.realisation-item');
    realisationItems.forEach((item, index) => {
        item.setAttribute('data-aos', index % 2 === 0 ? 'fade-right' : 'fade-left');
        item.setAttribute('data-aos-delay', (index * 100).toString());
    });

    // Animation des sections de services
    const serviceCards = document.querySelectorAll('.service-card');
    serviceCards.forEach((card, index) => {
        card.setAttribute('data-aos', 'zoom-in');
        card.setAttribute('data-aos-delay', (index * 150).toString());
    });

    // Animation des titres de section
    const sectionTitles = document.querySelectorAll('.section-title');
    sectionTitles.forEach((title) => {
        title.setAttribute('data-aos', 'fade-up');
    });

    // Animation des images
    const images = document.querySelectorAll('.animated-image');
    images.forEach((image, index) => {
        image.setAttribute('data-aos', 'zoom-in');
        image.setAttribute('data-aos-delay', (index * 100).toString());
    });

    // Initialisation de AOS avec des options personnalisées
    AOS.init({
        duration: 800,
        easing: 'cubic-bezier(0.4, 0, 0.2, 1)',
        once: false, // Permet de répéter les animations
        mirror: true, // Active les animations inversées au défilement vers le haut
        offset: 50,
        delay: 200 // Délai initial pour laisser le temps à l'animation de chargement de se terminer
    });
});

// Animation du titre principal
const heroTitle = document.querySelector('#animation');
if (heroTitle) {
    heroTitle.classList.add('hero-title');
}

const cursor = document.querySelector('.cursor');
const trail = document.querySelector('.cursor-trail');

let mouseX = 0;
let mouseY = 0;
let trailX = 0;
let trailY = 0;

document.addEventListener('mousemove', (e) => {
  mouseX = e.clientX;
  mouseY = e.clientY;
  
  cursor.style.transform = `translate(${mouseX}px, ${mouseY}px)`;
});

function animate() {
  trailX += (mouseX - trailX) * 0.1;
  trailY += (mouseY - trailY) * 0.1;

  trail.style.transform = `translate(${trailX}px, ${trailY}px)`;

  requestAnimationFrame(animate);
}

animate();

// Fonction pour créer une particule de code
function createCodeParticle() {
    const particle = document.createElement('div');
    particle.className = 'code-particle';
    
    // Liste de symboles de code
    const codeSymbols = ['<>', '/>', '{;}', '()', '[]', '// ', '/*', '*/', '+=', '=>'];
    
    // Position aléatoire sur l'axe X
    const x = Math.random() * window.innerWidth;
    
    // Définir le symbole et la position
    particle.setAttribute('data-code', codeSymbols[Math.floor(Math.random() * codeSymbols.length)]);
    particle.style.left = `${x}px`;
    particle.style.bottom = '-20px';
    
    // Animation
    const duration = 3000 + Math.random() * 5000; // Entre 3 et 8 secondes
    particle.style.animation = `float ${duration}ms linear`;
    
    // Ajouter au body
    document.body.appendChild(particle);
    
    // Supprimer après l'animation
    setTimeout(() => {
        particle.remove();
    }, duration);
}

// Créer des particules périodiquement
function startParticleAnimation() {
    setInterval(createCodeParticle, 300); // Crée une nouvelle particule toutes les 300ms
}

// Démarrer l'animation quand la page est chargée
document.addEventListener('DOMContentLoaded', startParticleAnimation);

document.body.classList.add('content-loaded');