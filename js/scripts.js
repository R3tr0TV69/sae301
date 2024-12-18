// Carrousel landing page
const listeDiapos = document.querySelector('.liste-diapos');
const diapos = document.querySelectorAll('.diapo');
const boutonPrecedent = document.querySelector('.precedent');
const boutonSuivant = document.querySelector('.suivant');
let indexActuel = 0;
const interval = 5000;

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
    if (listeDiapos) {
        const largeur = -100 * indexActuel;
        listeDiapos.style.transform = `translateX(${largeur}%)`;
    }
}

if (boutonPrecedent) {
    boutonPrecedent.addEventListener('click', () => changerDiapo(-1));
}
if (boutonSuivant) {
    boutonSuivant.addEventListener('click', () => changerDiapo(1));
}

if (listeDiapos) {
    setInterval(() => {
        changerDiapo(1);
    }, interval);
}


// Header
document.addEventListener('DOMContentLoaded', () => {
    const burgerMenu = document.querySelector('.burger-menu');
    const menuMobile = document.querySelector('.menu-mobile');

    burgerMenu.addEventListener('click', () => {
        console.log("Burger cliqué");
        menuMobile.classList.toggle('show');
        burgerMenu.classList.toggle('active');
    });
});

// Boutons gérer requetes
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.action-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const action = this.dataset.action;
            if (action === 'reject' && !confirm('Voulez-vous vraiment refuser cette demande ?')) return;
            window.location.href = `btn_gerer_requete.php?action=${action}&id=${id}`;
        });
    });
});






let listeAdherents = []; 

function chargerAdherents() {
    fetch("API/apiRecherche.php") 
        .then(response => {
            return response.json(); 
        })
        .then(data => {
            listeAdherents = data; 
            afficherAdherents(listeAdherents); 
        })
        .catch(erreur => {
            console.error(erreur);
            document.getElementById("listeAdherents").innerHTML = "<tr><td colspan='7'>Erreur de chargement.</td></tr>";
        });
}

function afficherAdherents(liste) {
    const tableau = document.getElementById("listeAdherents");
    tableau.innerHTML = "";

    if (liste.length === 0) {
        tableau.innerHTML = "<tr><td colspan='7'>Aucun adhérent trouvé.</td></tr>";
        return;
    }

    liste.forEach(adherent => {
        tableau.innerHTML += `
            <tr>
                <td>${adherent.nom}</td>
                <td>${adherent.prenom}</td>
                <td>${adherent.sexe}</td>
                <td>${adherent.age}</td>
                <td>${adherent.date_inscription}</td>
                <td>${adherent.date_expiration}</td>
                <td><a href="gerer_adherent.php?id=${adherent.id}">Gérer</a></td>
            </tr>
        `;
    });
}

function filtrerAdherents() {
    const recherche = document.getElementById("champRecherche").value.toLowerCase().trim();

    const resultatsFiltres = listeAdherents.filter(adherent =>
        adherent.nom.toLowerCase().includes(recherche) ||
        adherent.prenom.toLowerCase().includes(recherche)
    );

    afficherAdherents(resultatsFiltres);
}

document.addEventListener("DOMContentLoaded", () => {
    chargerAdherents(); 
    document.getElementById("champRecherche").addEventListener("input", filtrerAdherents);
});

document.addEventListener('DOMContentLoaded', chargerAdherents);