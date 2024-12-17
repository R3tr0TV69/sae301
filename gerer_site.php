<?php
require_once 'config/config.php';
require_once 'config/verifier_session.php';

$stmt = $pdo->query("SELECT * FROM gestion_site LIMIT 1");
$site = $stmt->fetch(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $horaires = $_POST['horaires'];

    $stmt = $pdo->prepare("UPDATE gestion_site SET nom = :nom, horaires = :horaires WHERE id = :id");
    $stmt->execute([
        'nom' => $nom,
        'horaires' => $horaires,
        'id' => $site['id']
    ]);
    echo "<script>alert('Informations mises à jour avec succès');</script>";
}
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
    <h1>Gérer le Site</h1>

    <form method="POST">
        <label for="nom">Nom du site :</label>
        <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($site['nom']) ?>" required><br>

        <label for="horaires">Horaires :</label>
        <textarea name="horaires" id="horaires" rows="4" required><?= htmlspecialchars($site['horaires']) ?></textarea><br>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>

