const navbarToggle = document.getElementById('menu-toggle');
const mainNav = document.getElementById('js-menu');

navbarToggle.addEventListener('click', function () {
    mainNav.style.display = mainNav.style.display === 'block' ? 'none' : 'block';
});