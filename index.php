<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <!-- CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Feuille de style CSS perso -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header de la page -->
    <header>
        <a href="index.html"><img src="images/usv.jpeg" alt="Logo USV" width="120px" height="120px"></a>
        <ul>
            <li><a href="">Stats</a></li>
            <li><a href="">À propos</a></li>
            <li><a href="">Évènements</a></li>
            <li><a href="">Inscription</a></li>
            <li><a href="">Avis</a></li>
        </ul>
        <a href="login.php"><img src="images/icon.jpg" alt="Se connecter" width="120px" height="120px"></a>
    </header>
    <!-- Contenu de la page -->
    <main>
        <section>
            <img src="images/loic/velos.jpg" alt="Salle de vélos" width="500" height="auto">
            <h1>USV</h1>
            <h3>Union Sportive du Velay</h3>
            <Button>INSCRIS-TOI !</Button>
        </section>
        <div>
            <div>
                <img src="images/book_icon.jpg" alt="Icon nombre d'inscrits" width="80px" height="auto">
                <h3>Nombre d'inscrits</h3>
            </div>
            <p>183</p>
        </div>
        <section>
            <H2>À propos</H2>
            <img src="images/loic/interieur_bois.jpg" alt="Intérieur de la salle de sport" width="500" height="auto">
            <p>
                Bienvenue à l’Union Sportive du Velay (USV), votre salle de sport située au cœur du Puy-en-Velay ! 
                Plus qu’un simple espace d’entraînement, l’USV est un lieu dédié à la santé, au bien-être et à la performance, 
                où chacun peut trouver sa place, quels que soient son niveau ou ses objectifs. 
                Nous proposons un large éventail d’équipements modernes, des cours collectifs animés par des coachs passionnés, ainsi qu’un accompagnement personnalisé pour vous aider à donner le meilleur de vous-même. 
                Que vous soyez à la recherche de performance, de remise en forme ou simplement d’un moment pour vous, notre équipe est là pour vous guider. 
                Rejoignez la communauté USV et découvrez un cadre chaleureux où dépassement de soi et convivialité vont de pair !
            </p>
        </section>
        <section>
            <H2>Évènements</H2>
            <div id="carouselExampleCaptions" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images/loic/sauna1.jpg" class="d-block w-100" alt="Sauna">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Sauna !</h5>
                            <p>Sauna première classe, dernière génération.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/loic/tapis.jpg" class="d-block w-100" alt="Salle de force avec tapis">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Salle de force avec tapis</h5>
                            <p>Tous à quatre pattes.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            
        </section>
        <section>
            <h2>Inscris-toi !</h2>
            Nom : <input type="text" placeholder="Nom" name="surname">
            Prénom : <input type="text" placeholder="Prénom" name="name">
            Sexe : <input type="text" placeholder="Sexe" name="sexe">
            Âge : <input type="text" placeholder="Âge" name="age">
            Poids : <input type="text" placeholder="Poids" name="poids">
            Taille : <input type="text" placeholder="Taille" name="taille">
            Durée : <select name="duree" id="duree">
                <option value="1">1 mois</option>
                <option value="3">3 mois</option>
                <option value="6">6 mois</option>
                <option value="12">12 mois</option>
            </select>
            <br>
            <button>Inscription</button>
        </section>
        <section>
            <h2>Avis</h2>
            AVIS GOOGLE ?
        </section>
    </main>
    <!-- Footer de la page -->
    <footer>
        <a href="https://www.facebook.com/unionsportiveduvelay/?locale=fr_FR"><img src="images/Icône Facebook.jpg" alt="Page Facebook" width="100px" height="auto"></a>
        <ul>
            <li>Navigation</li>
            <li>Statistiques</li>
            <li>À propos</li>
            <li>Évènements</li>
            <li>Inscription</li>
        </ul>
        <a href="index.html"><img src="images/usv.jpeg" alt="Logo USV" width="120px" height="120px"></a>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
