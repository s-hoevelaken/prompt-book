let lastScrollY = window.scrollY;

window.onscroll = () => {
    const navbar = document.querySelector('nav');
    if (window.scrollY > lastScrollY) {
        // Scrolling down
        navbar.classList.add('disappear');
    } else {
        // Scrolling up
        navbar.classList.remove('disappear');
    }
    lastScrollY = window.scrollY;
};