<?php
require_once 'config/config.php';
$id = intval($_GET['id']);
$stmt = $pdo->prepare("SELECT * FROM evenements WHERE id = :id");
$stmt->execute(['id' => $id]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer l'Événement</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Gérer l'Évènement</h1>

    <p><strong>Nom :</strong> <?= htmlspecialchars($event['nom_evenement']) ?></p>
    <p><strong>Description :</strong> <?= htmlspecialchars($event['description']) ?></p>
    <p><strong>Date :</strong> <?= htmlspecialchars($event['date_evenement']) ?></p>
    <p><strong>Heure :</strong> <?= htmlspecialchars($event['heure_evenement']) ?></p>
    <p><strong>Lieu :</strong> <?= htmlspecialchars($event['lieu']) ?></p>
    <p><strong>Capacité :</strong> <?= htmlspecialchars($event['capacite']) ?></p>

    <a href="admin_evenement.php">Retour à la liste des événements</a>
</body>
</html>
