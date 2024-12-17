<?php
require_once 'config/config.php';

$site = $pdo->query("SELECT * FROM gestion_site LIMIT 1")->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("
        INSERT INTO demande_inscription (nom, prenom, sexe, age, poids, taille, duree)
        VALUES (:nom, :prenom, :sexe, :age, :poids, :taille, :duree)
    ");
    $stmt->execute([
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'sexe' => $_POST['sexe'],
        'age' => intval($_POST['age']),
        'poids' => floatval($_POST['poids']),
        'taille' => floatval($_POST['taille']),
        'duree' => intval($_POST['duree']),
    ]);
    echo "<script>alert('Votre demande a été envoyée !');</script>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <!-- Header de la page -->
    <header>
        <a href="index.php"><img src="<?= htmlspecialchars($site['logo']) ?>" alt="Logo USV" width="200px"></a>
        <ul>
            <li><a href="#statistiques">Stats</a></li>
            <li><a href="#a-propos">À propos</a></li>
            <li><a href="#evenements">Évènements</a></li>
            <li><a href="#inscription">Inscription</a></li>
            <li><a href="#avis">Avis</a></li>
        </ul>
        <a href="login.php"><img src="images/icon.png" alt="Se connecter" width="120px" height="120px" id="profil-icon"></a>
    </header>
    <!-- Contenu de la page -->
    <main>
        <section id="haut-de-page">
            <div id="txt-h-d-p">
                <h1><?= htmlspecialchars($site['nom']) ?></h1>
                <h3><strong>Horaires : </strong> <?= nl2br(htmlspecialchars($site['horaires'])) ?></h3>
                <Button>INSCRIS-TOI !</Button>
            </div>
            <img src="images/loic/velos.jpg" alt="Salle de vélos">
        </section>
        <section id="statistiques">
            <div id="cadre">
                <div>
                    <img src="images/book_icon.png" alt="Icon nombre d'inscrits" width="50px" height="auto">
                    <h3>Nombre d'inscrits :</h3>
                </div>
                <p id="nombre-stat">183</p>
            </div>
        </section>
        <section id="a-propos">
            <img src="images/loic/interieur_bois.jpg" alt="Intérieur de la salle de sport">
            <div>
                <H2>À propos</H2>
                <p>
                    Bienvenue à l’Union Sportive du Velay (USV), votre salle de sport située au cœur du Puy-en-Velay ! 
                    Plus qu’un simple espace d’entraînement, l’USV est un lieu dédié à la santé, au bien-être et à la performance, 
                    où chacun peut trouver sa place, quels que soient son niveau ou ses objectifs. 
                    Nous proposons un large éventail d’équipements modernes, des cours collectifs animés par des coachs passionnés, ainsi qu’un accompagnement personnalisé pour vous aider à donner le meilleur de vous-même. 
                    Que vous soyez à la recherche de performance, de remise en forme ou simplement d’un moment pour vous, notre équipe est là pour vous guider. 
                    Rejoignez la communauté USV et découvrez un cadre chaleureux où dépassement de soi et convivialité vont de pair !
                </p>
            </div>
        </section>
        <section id="evenements">
            <H2>Évènements</H2>
            <div class="conteneur-carrousel">
                <div class="liste-diapos">
                    <div class="diapo">
                        <h3>Sauna !</h3>
                        <p>Nous avons une grande nouveauté à vous annoncer à l’Union Sportive du Velay : l’arrivée de notre tout nouveau sauna dernière génération ! Cet espace bien-être vient enrichir vos séances en vous offrant un moment de relaxation et de récupération optimal. Après l’effort, détendez vos muscles, éliminez les toxines et profitez des nombreux bienfaits de la chaleur. Accessible à tous nos membres, le sauna est l’occasion idéale de prendre soin de vous, tout en boostant vos performances. N’attendez plus pour venir l’essayer et découvrir cette nouvelle expérience qui allie sport et bien-être au sein de votre salle USV !</p>
                        <button>En savoir plus</button>
                    </div>
                    <div class="diapo">
                        <h3>Tapis !</h3>
                        <p>L’Union Sportive du Velay continue de se moderniser pour vous offrir le meilleur ! Nous sommes ravis de vous annoncer l’arrivée de nouveaux tapis de course dernière génération. Avec leurs fonctionnalités innovantes, comme des programmes d’entraînement personnalisés, des écrans interactifs, et un amorti renforcé pour protéger vos articulations, ces tapis sont parfaits pour repousser vos limites tout en prenant soin de votre corps. Que vous soyez adepte de la course, de la marche rapide ou des entraînements fractionnés, ces équipements s’adaptent à vos objectifs. Venez les découvrir dès aujourd’hui et profitez d’une expérience cardio unique dans votre salle USV !</p>
                        <button>En savoir plus</button>
                    </div>
                    <div class="diapo">
                        <h3>Troisième diapo</h3>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque maiores tempore atque libero, adipisci ullam aut nisi itaque. Officiis reprehenderit provident molestias repudiandae in earum autem, error debitis illo nam.</p>
                        <button>En savoir plus</button>
                    </div>
                </div>
                <button class="bouton-carrousel precedent">&#10094;</button>
                <button class="bouton-carrousel suivant">&#10095;</button>
            </div>
            
        </section>
        <section id="inscription">
            <h2>Inscris-toi !</h2>
                <form method="POST">
                    <div class="ligne-formulaire">
                        <div class="element-formulaire">Nom : <input type="text" placeholder="Nom" name="nom" id="nom"></div>
                        <div class="element-formulaire">Prénom : <input type="text" placeholder="Prénom" name="prenom" id="prenom"></div>
                    </div>
                    <div class="ligne-formulaire">
                        <div class="element-formulaire">Sexe : <select id="sexe" name="sexe"><option value="M">Homme</option><option value="F">Femme</option></select></div>
                        <div class="element-formulaire">Âge : <input type="number" placeholder="Âge" name="age" min="1"></div>
                    </div>
                    <div class="ligne-formulaire">
                        <div class="element-formulaire">Poids (en kg) : <input type="number" placeholder="Poids (en kg)" name="poids" step="0.1"></div>
                        <div class="element-formulaire">Taille (en cm) : <input type="number" placeholder="Taille (en cm)" name="taille" step="0.1"></div>
                    </div>
                        <div class="element-formulaire-seul">Durée (en mois) : <select name="duree" id="duree">
                            <option value="1">1 mois</option>
                            <option value="3">3 mois</option>
                            <option value="6">6 mois</option>
                            <option value="12">12 mois</option>
                        </select></div>
                    <br>
                    <div class="button-container">
                        <button type="submit">Inscription</button>
                    </div>
                </form>
        </section>
        <section id="avis">
            <h2>Avis</h2>
            <div class="google-note-container">
                <img src="images/google_icon.svg" alt="google icone">
        
                <span class="google-note">4,8</span>
        
                <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22l1.18-7.86-5-4.87 6.91-1.01L12 2z"/>
                </svg>
            </div>
            <div class="flex-avis">
                <div class="avis-item">
                    <div class="avis-container">
                        <p class="avis-pseudo">Enzo Teyssonneyre</p>
                        <p class="avis-commentaire">Très bonne salle de sport, très bon sauna, ambiance familiale, musique possible dans la salle, multitude de machines.</p>
                        <div class="avis-stars">
                            <svg class="star" viewBox="0 0 24 24"><path fill="#1C274C" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="star" viewBox="0 0 24 24"><path fill="#1C274C" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="star" viewBox="0 0 24 24"><path fill="#1C274C" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="star" viewBox="0 0 24 24"><path fill="#1C274C" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="star" viewBox="0 0 24 24"><path fill="#1C274C" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="avis-item">
                    <div class="avis-container">
                        <p class="avis-pseudo">Maximilien Jobert-Beraud</p>
                        <p class="avis-commentaire">Cela fait presque 5 mois que vais à l'USV et je trouve cette salle de sport super, très bonne ambiance et il y a tout le matériel nécessaire et toujours en bon état.</p>
                        <div class="avis-stars">
                            <svg class="star" viewBox="0 0 24 24"><path fill="#1C274C" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="star" viewBox="0 0 24 24"><path fill="#1C274C" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="star" viewBox="0 0 24 24"><path fill="#1C274C" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="star" viewBox="0 0 24 24"><path fill="#1C274C" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="star" viewBox="0 0 24 24"><path fill="#1C274C" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="avis-item">
                    <div class="avis-container">
                        <p class="avis-pseudo">Christophe Martinat</p>
                        <p class="avis-commentaire">Salle super bien équipée, amplitude d’ouverture au max, ambiance chaleureuse et conviviale.</p>
                        <div class="avis-stars">
                            <svg class="star" viewBox="0 0 24 24"><path fill="#1C274C" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="star" viewBox="0 0 24 24"><path fill="#1C274C" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="star" viewBox="0 0 24 24"><path fill="#1C274C" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="star" viewBox="0 0 24 24"><path fill="#1C274C" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="star" viewBox="0 0 24 24"><path fill="#D9D9D9" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Footer de la page -->
    <footer>
        <div>
            <a href="https://www.facebook.com/unionsportiveduvelay/?locale=fr_FR"><img src="images/Icone_Facebook.png" alt="Page Facebook" id="facebook"></a>
            <ul>
                <li>Navigation</li>
                <li><a href="#statistiques">Statistiques</a></li>
                <li><a href="#a-propos">À propos</a></li>
                <li><a href="#evenements">Évènements</a></li>
                <li><a href="#inscription">Inscription</a></li>
                <li><a href="#avis">Avis</a></li>
            </ul>
        </div>
        <a href="index.php"><img src="images/logo_remake_white.svg" alt="Logo USV" id="logo-footer"></a>
    </footer>
    <script src="js/scripts.js"></script>
</body>
</html>
