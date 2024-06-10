document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const navItems = document.querySelector('.nav-items');
    menuToggle.addEventListener('click', function() {
        navItems.classList.toggle('active');
    });
    const navLinks = document.querySelectorAll('.nav-items ul li a');

    navLinks.forEach(function(navLink) {
        navLink.addEventListener('click', function() {
            navItems.classList.remove('active');
        });
    });
});
function toggleAnswer(id) {
    var respuesta = document.getElementById('respuesta' + id);
    if (respuesta.style.display === 'block') {
        respuesta.style.display = 'none';
    } else {
        respuesta.style.display = 'block';  
    }
}
// slider
let currentSlide = 0;
const slideInterval = 5000; // milisegundos

function showSlide(index) {
    const slides = document.querySelectorAll('.slide');
    if (index >= slides.length) {
        currentSlide = 0;
    } else if (index < 0) {
        currentSlide = slides.length - 1;
    } else {
        currentSlide = index;
    }
    const offset = -currentSlide * 100;
    document.querySelector('.slides').style.transform = `translateX(${offset}%)`;
}

function nextSlide() {
    showSlide(currentSlide + 1);
}

function prevSlide() {
    showSlide(currentSlide - 1);
}

// Inicializar el slider
showSlide(currentSlide);

// Cambiar diapositiva automáticamente
setInterval(() => {
    nextSlide();
}, slideInterval);



// formularios
function showForm(formId) {
    // Ocultar todos los formularios
    var forms = document.querySelectorAll('.formulario_contacto');
    forms.forEach(function(form) {
        form.classList.remove('active');
    });

    // Mostrar el formulario seleccionado
    var selectedForm = document.getElementById(formId);
    selectedForm.classList.add('active');
}