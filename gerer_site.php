<?php
require_once 'config/config.php';

$stmt = $pdo->query("SELECT * FROM gestion_site LIMIT 1");
$site = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer le Site</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <h1>Informations du Site</h1>

    <p>Nom : <?= htmlspecialchars($site['nom']) ?></p>
    <p>Horaires : <?= nl2br(htmlspecialchars($site['horaires'])) ?></p>
    <?php if (!empty($site['logo'])): ?>
        <img src="<?= htmlspecialchars($site['logo']) ?>">
    <?php endif; ?>
</body>
</html>
