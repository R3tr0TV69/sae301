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






// Fonction pour charger les adhérents
async function searchAdherents() {
    const query = document.getElementById('searchQuery').value; // Récupère la valeur de recherche

    try {
        // Appel à l'API PHP
        const response = await fetch(`API/apiRecherche.php?query=${encodeURIComponent(query)}`);
        const data = await response.json();

        // Sélection de la table
        const tableBody = document.getElementById('membersTable');
        tableBody.innerHTML = ''; // Vide le contenu actuel de la table

        if (data.length === 0) {
            // Aucun résultat
            tableBody.innerHTML = '<tr><td colspan="7">Aucun adhérent trouvé.</td></tr>';
            return;
        }

        // Insère chaque ligne dans la table
        data.forEach(member => {
            const row = `
                <tr>
                    <td>${member.nom}</td>
                    <td>${member.prenom}</td>
                    <td>${member.sexe}</td>
                    <td>${member.age}</td>
                    <td>${member.date_inscription}</td>
                    <td>${member.date_expiration}</td>
                    <td><a href="gerer_adherent.php?id=${member.id}">Gérer</a></td>
                </tr>
            `;
            tableBody.innerHTML += row;
        });
    } catch (error) {
        console.error('Erreur lors du chargement des adhérents :', error);
        document.getElementById('membersTable').innerHTML = '<tr><td colspan="7">Erreur de chargement.</td></tr>';
    }
}

// Charger tous les adhérents au démarrage
document.addEventListener('DOMContentLoaded', searchAdherents);
