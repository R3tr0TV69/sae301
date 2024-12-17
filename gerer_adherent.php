<?php
require_once 'config/config.php';
require_once 'config/verifier_session.php';

if (!isset($_GET['id'])) {
    die("ID de l'adhérent manquant");
}

$id = intval($_GET['id']);

$stmt = $pdo->prepare("SELECT * FROM adherents WHERE id = :id");
$stmt->execute(['id' => $id]);
$member = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$member) {
    die('Adhérent introuvable.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $sexe = $_POST['sexe'];
        $age = intval($_POST['age']);
        $poids = floatval($_POST['poids']);
        $taille = floatval($_POST['taille']);
        $date_expiration = $_POST['date_expiration'];

        $stmt = $pdo->prepare("UPDATE adherents SET nom = :nom, prenom = :prenom, sexe = :sexe, age = :age, poids = :poids, taille = :taille, date_expiration = :date_expiration WHERE id = :id");
        $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'sexe' => $sexe,
            'age' => $age,
            'poids' => $poids,
            'taille' => $taille,
            'date_expiration' => $date_expiration,
            'id' => $id
        ]);
        echo "<script>alert('Informations mises à jour avec succès.');</script>";
    } elseif (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM adherents WHERE id = :id");
        $stmt->execute(['id' => $id]);
        echo "<script>alert('Adhérent supprimé avec succès.'); window.location.href = 'admin_adherent.php';</script>";
        exit();
    } elseif (isset($_POST['extend'])) {
        $extension = intval($_POST['extension']);
        $stmt = $pdo->prepare("UPDATE adherents SET date_expiration = DATE_ADD(date_expiration, INTERVAL :extension MONTH) WHERE id = :id");
        $stmt->execute([
            'extension' => $extension,
            'id' => $id
        ]);
        echo "<script>alert('Durée prolongée avec succès.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer l'Adhérent</title>
    <link rel="stylesheet" href="styles/styles-admin.css">
</head>
<body>
    <?php include("includes/header_admin.php") ?>
    <h1>Gérer l'Adhérent</h1>

    <form method="POST">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($member['nom']) ?>" required><br>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($member['prenom']) ?>" required><br>

        <label for="sexe">Sexe :</label>
        <select name="sexe" id="sexe" required>
            <option value="M" <?= $member['sexe'] === 'M' ? 'selected' : '' ?>>M</option>
            <option value="F" <?= $member['sexe'] === 'F' ? 'selected' : '' ?>>F</option>
        </select><br>

        <label for="age">Âge :</label>
        <input type="number" name="age" id="age" value="<?= htmlspecialchars($member['age']) ?>" required><br>

        <label for="poids">Poids (kg) :</label>
        <input type="number" step="0.1" name="poids" id="poids" value="<?= htmlspecialchars($member['poids']) ?>"><br>

        <label for="taille">Taille (cm) :</label>
        <input type="number" step="0.1" name="taille" id="taille" value="<?= htmlspecialchars($member['taille']) ?>"><br>

        <label for="date_expiration">Date d'expiration :</label>
        <input type="date" name="date_expiration" id="date_expiration" value="<?= htmlspecialchars($member['date_expiration']) ?>" required><br>

        <button type="submit" name="update">Mettre à jour</button>
    </form>

    <form method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet adhérent ?');">
        <button type="submit" name="delete">Supprimer l'adhérent</button>
    </form>

    <form method="POST">
        <label for="extension">Prolonger la durée :</label>
        <select name="extension" id="extension" required>
            <option value="1">1 mois</option>
            <option value="3">3 mois</option>
            <option value="6">6 mois</option>
            <option value="12">12 mois</option>
        </select>
        <button type="submit" name="extend">Prolonger</button>
    </form>

    <a href="admin_adherent.php">Retour à la liste des adhérents</a>
</body>
</html>