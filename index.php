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

$stmt = $pdo->query("SELECT COUNT(*) AS total FROM adherents");
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$nombreAdherents = $result['total'];

$stmtEvenements = $pdo->query("
    SELECT id, nom_evenement, description, DATE_FORMAT(date_evenement, '%d/%m/%Y') AS date_formattee 
    FROM evenements 
    WHERE date_evenement >= CURDATE() 
    ORDER BY date_evenement ASC
");
$evenements = $stmtEvenements->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="icon" href="images/logo_remake_favicon.png">
    <title>Bienvenue à l'USV au Puy-en-Velay !</title>
</head>
<body>
    <?php include("includes/header.php") ?>
    <!-- Contenu de la page -->
    <main>
        <section id="haut-de-page">
            <div id="txt-h-d-p">
                <h1><?= htmlspecialchars($site['nom']) ?></h1>
                <h3><strong>Horaires : </strong> <?= nl2br(htmlspecialchars($site['horaires'])) ?></h3>
                <a href="#inscription"><Button>INSCRIS-TOI !</Button></a>
            </div>
            <img src="images/loic/velos.jpg" alt="Salle de vélos">
        </section>
        <section id="statistiques">
            <div id="cadre">
                <div>
                    <img src="images/book_icon.png" alt="Icon nombre d'inscrits" width="50px" height="auto">
                    <h3>Nombre d'inscrits :</h3>
                </div>
                <p id="nombre-stat"><?= htmlspecialchars($nombreAdherents) ?></p>
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
            <H2>Événements</H2>
            <!-- Carrousel avec les événements à venir -->
            <div class="conteneur-carrousel">
                <?php if (!empty($evenements)): ?>
                    <div class="liste-diapos">
                        <?php foreach ($evenements as $evenement): ?>
                            <div class="diapo">
                                <h3><?= htmlspecialchars($evenement['nom_evenement']) ?></h3>
                                <p><?= nl2br(htmlspecialchars($evenement['description'])) ?></p>
                                <p><?= nl2br(htmlspecialchars($evenement['date_formattee'])) ?></p>
                                <a href="detail_evenement.php?id=<?= htmlspecialchars($evenement['id']); ?>">
                                    <button>En savoir plus</button>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="bouton-carrousel precedent">&#10094;</button>
                    <button class="bouton-carrousel suivant">&#10095;</button>
                <?php else: ?>
                    <p>Aucun événement à venir pour le moment. Revenez bientôt pour découvrir nos prochaines activités !</p>
                <?php endif; ?>
            </div>
            
        </section>
        <section id="inscription">
            <h2>Inscris-toi !</h2>
                <!-- Formulaire d'inscription à la salle -->
                <form method="POST">
                    <div class="ligne-formulaire">
                        <div class="element-formulaire">Nom : <input type="text" placeholder="Nom" name="nom" id="nom" required="required"></div>
                        <div class="element-formulaire">Prénom : <input type="text" placeholder="Prénom" name="prenom" id="prenom" required="required"></div>
                    </div>
                    <div class="ligne-formulaire">
                        <div class="element-formulaire">Sexe : <select id="sexe" name="sexe" required="required"><option value="M">Homme</option><option value="F">Femme</option></select></div>
                        <div class="element-formulaire">Âge : <input type="number" placeholder="Âge" name="age" min="1" required="required"></div>
                    </div>
                    <div class="ligne-formulaire">
                        <div class="element-formulaire">Poids (en kg) : <input type="number" placeholder="Poids (en kg)" name="poids" step="0.1" required="required"></div>
                        <div class="element-formulaire">Taille (en cm) : <input type="number" placeholder="Taille (en cm)" name="taille" step="0.1" required="required"></div>
                    </div>
                        <div class="element-formulaire-seul">Durée (en mois) : <select name="duree" id="duree" required="required">
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
            <!--  Quelques avis de la salle -->
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
    <?php include("includes/footer.php") ?>
    <script src="js/scripts.js"></script>
</body>
</html>
