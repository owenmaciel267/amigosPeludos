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