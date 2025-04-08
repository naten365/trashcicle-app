
const profileImage = document.getElementById('profileImage');
const storedImage = localStorage.getItem('profileImage');
if (storedImage) {
    profileImage.src = storedImage;
}

document.addEventListener('DOMContentLoaded', function () {
    const classesMenu = document.getElementById('classes-menu');
    const classesSubmenu = document.getElementById('classes-submenu');
    const dropdownIcon = classesMenu.querySelector('.dropdown-icon');

    classesMenu.addEventListener('click', function (e) {
        e.preventDefault();
        classesSubmenu.classList.toggle('active');
        dropdownIcon.textContent = classesSubmenu.classList.contains('active') ? '▲' : '▼';
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const params = new URLSearchParams(window.location.search);
    const userName = params.get("usuario");

    if (userName) {
        const welcomeHeader = document.querySelector("#welcomeCard h2");
        welcomeHeader.textContent = `¡Bienvenido ${userName}! 👋`;
    }
});


// Tutorial Content
const tutorialContent = [
    {
        title: "👋¡Bienvenido a TrashCicle Admin Panel!👋",
        welcomeText: "Estamos felices de verte.",
        tutorialText: "Si necesitas una guía sobre el uso de este programa, pasa a la siguiente diapositiva."
    },
    {
        title: "📊Explorar el Panel de Control📊",
        welcomeText: "Comienza tu viaje en TrashCicle Admin Panel.",
        tutorialText: "En el Panel de Control encontrarás las acciones que puedes realizar"
    },
    {
        title: "👤Gestionar Usuarios👤",
        welcomeText: "Mantén un registro de los usuarios del sistema",
        tutorialText: "En la sección de gestionar usuarios podrás ver y administrar las cuentas de los usuarios del sistema."
    },
    {
        title: "🤖Gestionar los zafacones🤖",
        welcomeText: "Todo en un solo lugar.",
        tutorialText: "Accede a tus zafacones desde el menú de acciones y gestiona los detalles de cada una."
    },
    {
        title: "¿Necesitas Ayuda?",
        welcomeText: "Estamos aquí para apoyarte.",
        tutorialText: "Si tienes alguna duda, no dudes en visitar nuestra sección de Ayuda o contactar al soporte."
    }
];


let currentSlide = 0;

const welcomeCard = document.getElementById('welcomeCard');
const title = welcomeCard.querySelector('h2');
const welcomeText = document.getElementById('welcomeText');
const tutorialText = document.getElementById('tutorialText');
const prevButton = document.getElementById('prevSlideButton');
const nextButton = document.getElementById('nextSlideButton');
const dots = document.querySelectorAll('.dot');

function updateSlide() {
    const slide = tutorialContent[currentSlide];
    title.textContent = slide.title;
    welcomeText.textContent = slide.welcomeText;
    tutorialText.textContent = slide.tutorialText;

    // Actualizar los dots
    dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentSlide);
    });


    prevButton.disabled = currentSlide === 0;
    nextButton.disabled = currentSlide === tutorialContent.length - 1;
}

prevButton.addEventListener('click', () => {
    if (currentSlide > 0) {
        currentSlide--;
        updateSlide();
    }
});

nextButton.addEventListener('click', () => {
    if (currentSlide < tutorialContent.length - 1) {
        currentSlide++;
        updateSlide();
    }
});

// Inicializar el slide
updateSlide();


