// Carrousel landing page
const listeDiapos = document.querySelector('.liste-diapos');
const diapos = document.querySelectorAll('.diapo');
const boutonPrecedent = document.querySelector('.precedent');
const boutonSuivant = document.querySelector('.suivant');
let indexActuel = 0;
const interval = 3000;
function changerDiapo(direction) {
    indexActuel += direction;
    if (indexActuel < 0) {
        indexActuel = diapos.length - 1;
    } else if (indexActuel >= diapos.length) {
        indexActuel = 0;
    }
    miseAJourCarrousel();
}
function miseAJourCarrousel() {
    const largeur = -100 * indexActuel;
    listeDiapos.style.transform = `translateX(${largeur}%)`;
}
boutonPrecedent.addEventListener('click', () => changerDiapo(-1));
boutonSuivant.addEventListener('click', () => changerDiapo(1));
setInterval(() => {
    changerDiapo(1);
}, interval);

// Header admin
document.addEventListener('DOMContentLoaded', () => {
    const burgerMenu = document.querySelector('.burger-menu');
    const menuMobile = document.querySelector('.menu-mobile');

    if (burgerMenu && menuMobile) {
        burgerMenu.addEventListener('click', () => {
            console.log("Burger cliqué"); // Test pour vérifier
            menuMobile.classList.toggle('show');
        });
    } else {
        console.error("Éléments non trouvés : burgerMenu ou menuMobile.");
    }
});
