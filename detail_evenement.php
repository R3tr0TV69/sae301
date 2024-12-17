<?php
require_once 'config/config.php';

$site = $pdo->query("SELECT * FROM gestion_site LIMIT 1")->fetch(PDO::FETCH_ASSOC);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('ID invalide');
}

$id = intval($_GET['id']);
$stmt = $pdo->prepare("SELECT * FROM evenements WHERE id = :id");
$stmt->execute(['id' => $id]);
$evenement = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$evenement) {
    die('Événement introuvable.');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title><?= htmlspecialchars($evenement['nom_evenement']) ?></title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <?php include("includes/header.php") ?>

    <section>
        <div class="box-evenement">
            <h1><?= htmlspecialchars($evenement['nom_evenement']) ?></h1>
            <p><strong>Description :</strong></p> <p><?= nl2br(htmlspecialchars($evenement['description'])) ?></p>
            <p><strong>Date :</strong></p> <p><?= htmlspecialchars($evenement['date_evenement']) ?></p>
            <p><strong>Heure :</strong></p> <p><?= htmlspecialchars($evenement['heure_evenement']) ?></p>
            <p><strong>Lieu :</strong></p> <p><?= htmlspecialchars($evenement['lieu']) ?></p>
            <p><strong>Capacité :</strong></p> <p><?= htmlspecialchars($evenement['capacite']) ?> personnes</p>
            <a href="index.php">Retour</a>
        </div>
    </section>
    
    <?php include("includes/footer.php") ?>
</body>
</html>