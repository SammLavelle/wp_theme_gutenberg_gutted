const burger = document.querySelector('.header__burger');
burger.addEventListener("click", openMenu)
function openMenu() {
    burger.classList.toggle('open');
    document.getElementById('menu-main-menu').classList.toggle('open');
}
