<?php
require_once 'config/config.php';
require_once 'config/verifier_session.php';
require_once 'poo/classesInscription.php';

$members = $pdo->query("SELECT * FROM adherents")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin Adhérents</title>
    <link rel="stylesheet" href="styles/styles-admin.css">
</head>
<body>
    <?php include("includes/header_admin.php") ?>
    <main>
        <h1>Admin Adhérents</h1>
        <section>
            <h2>Requêtes d'adhésion</h2>
            <?php afficherRequetes::displayRequests($requests); ?>
        </section>
        
        <section>
        <h2>Liste des Adhérents</h2>

        <div>
            <input type="text" id="champRecherche" placeholder="Recherchez par nom ou prénom...">
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Sexe</th>
                        <th>Âge</th>
                        <th>Date d'inscription</th>
                        <th>Date d'expiration</th>
                        <th>Gérer</th>
                    </tr>
                </thead>
                <tbody id="listeAdherents">
                </tbody>
            </table>
        </div>
    </section>


    </main>
    <script src="js/scripts.js"></script>
</body>
</html>
