<?php
require_once 'config/config.php';
require_once 'config/verifier_session.php';

$stmt = $pdo->query("SELECT * FROM gestion_site LIMIT 1");
$site = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $horaires = $_POST['horaires'];

    $logoPath = $site['logo'];
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'images/upload/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $logoPath = $uploadDir . basename($_FILES['logo']['name']);

        if (!move_uploaded_file($_FILES['logo']['tmp_name'], $logoPath)) {
            die('Erreur lors du téléchargement du fichier.');
        }
    }

    $stmt = $pdo->prepare("UPDATE gestion_site SET nom = :nom, horaires = :horaires, logo = :logo WHERE id = :id");
    $stmt->execute([
        'nom' => $nom,
        'horaires' => $horaires,
        'logo' => $logoPath,
        'id' => $site['id']
    ]);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" href="images/logo_remake_favicon.png">
    <title>Gérer le Site</title>
    <link rel="stylesheet" href="styles/styles-admin.css">
</head>
<body>
    <?php include("includes/header_admin.php") ?>
    <main>
        <h1>Gérer le Site</h1>

        <form method="POST" enctype="multipart/form-data">
            <!-- Permet de gérer le nom du site -->
            <label for="nom">Nom du site :</label>
            <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($site['nom']) ?>" required><br>

            <!-- Permet de gérer les horaires du site -->
            <label for="horaires">Horaires :</label>
            <textarea name="horaires" id="horaires" rows="4" required><?= htmlspecialchars($site['horaires']) ?></textarea><br>

            <!-- Permet de gérer le logo du site -->
            <label for="logo">Logo :</label>
            <input type="file" name="logo" id="logo"><br>
            <?php if (!empty($site['logo'])): ?>
                <strong>Logo actuel :</strong>
                <img src="<?= htmlspecialchars($site['logo']) ?>" alt="Logo actuel" style="max-width: 200px;"><br>
            <?php endif; ?>

            <button type="submit">Mettre à jour</button>
        </form>
    </main>
</body>
</html>

