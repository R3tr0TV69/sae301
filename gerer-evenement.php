<?php
    require_once 'config/config.php';
    require_once 'config/verifier_session.php';

    if (!isset($_GET['id'])) {
        die("ID de l'événement manquant.");
    }
    $id = intval($_GET['id']);
    $stmt = $pdo->prepare("SELECT * FROM evenements WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $event = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$event) {
        die('Évènement introuvable');
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['update'])) {
            $nom_evenement = $_POST['nom_evenement'];
            $description = $_POST['description'];
            $date_evenement = $_POST['date_evenement'];
            $heure_evenement = $_POST['heure_evenement'];
            $lieu = $_POST['lieu'];
            $capacite = intval($_POST['capacite']);
    
            
            $stmt = $pdo->prepare("UPDATE evenements SET nom_evenement = :nom_evenement, description = :description, date_evenement = :date_evenement, heure_evenement = :heure_evenement, lieu = :lieu, capacite = :capacite WHERE id = :id");
            $stmt->execute([
                'nom_evenement' => $nom_evenement,
                'description' => $description,
                'date_evenement' => $date_evenement,
                'heure_evenement' => $heure_evenement,
                'lieu' => $lieu,
                'capacite' => $capacite,
                'id' => $id
            ]);
            echo "<script>alert('Événement mis à jour avec succès.');</script>";
        } elseif (isset($_POST['delete'])) {
            $stmt = $pdo->prepare("DELETE FROM evenements WHERE id = :id");
            $stmt->execute(['id' => $id]);
            echo "<script>alert('Événement supprimé avec succès.'); window.location.href = 'admin_evenement.php';</script>";
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer l'Événement</title>
    <link rel="stylesheet" href="styles/styles-admin.css">
</head>
<body>
    <h1>Gérer l'Évènement</h1>

    <form method="POST">
        <label for="nom_evenement">Nom de l'événement :</label>
        <input type="text" name="nom_evenement" id="nom_evenement" value="<?= htmlspecialchars($event['nom_evenement']) ?>" required><br>

        <label for="description">Description :</label>
        <textarea name="description" id="description" rows="4"><?= htmlspecialchars($event['description']) ?></textarea><br>

        <label for="date_evenement">Date :</label>
        <input type="date" name="date_evenement" id="date_evenement" value="<?= htmlspecialchars($event['date_evenement']) ?>" required><br>

        <label for="heure_evenement">Heure :</label>
        <input type="time" name="heure_evenement" id="heure_evenement" value="<?= htmlspecialchars($event['heure_evenement']) ?>" required><br>

        <label for="lieu">Lieu :</label>
        <input type="text" name="lieu" id="lieu" value="<?= htmlspecialchars($event['lieu']) ?>" required><br>

        <label for="capacite">Capacité :</label>
        <input type="number" name="capacite" id="capacite" value="<?= htmlspecialchars($event['capacite']) ?>"><br>

        <button type="submit" name="update">Mettre à jour</button>
    </form>

    <form method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet événement ?');">
        <button type="submit" name="delete">Supprimer l'Événement</button>
    </form>
    
    <a href="admin_evenement.php">Retour à la liste des événements</a>
</body>
</html>
