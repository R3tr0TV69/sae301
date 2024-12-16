<?php
require_once 'config/config.php';

$id = intval($_GET['id']);

$stmt = $pdo->prepare("SELECT * FROM adherents WHERE id = :id");
$stmt->execute(['id' => $id]);
$member = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer l'Adhérent</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Gérer l'Adhérent</h1>
    <p><strong>Nom :</strong> <?= htmlspecialchars($member['nom']) ?></p>
    <p><strong>Prénom :</strong> <?= htmlspecialchars($member['prenom']) ?></p>
    <p><strong>Sexe :</strong> <?= htmlspecialchars($member['sexe']) ?></p>
    <p><strong>Âge :</strong> <?= htmlspecialchars($member['age']) ?></p>
    <p><strong>Date d'expiration :</strong> <?= htmlspecialchars($member['date_expiration']) ?></p>
    <a href="admin_adherent.php">Retour à la liste des adhérents</a>
</body>
</html>