<?php
    require_once 'config/config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $stmt = $pdo->prepare("
            INSERT INTO evenements (nom_evenement, description, date_evenement, heure_evenement, lieu, capacite)
            VALUES (:nom_evenement, :description, :date_evenement, :heure_evenement, :lieu, :capacite)
        ");
        $stmt->execute([
            'nom_evenement' => $_POST['nom_evenement'],
            'description' => $_POST['description'],
            'date_evenement' => $_POST['date_evenement'],
            'heure_evenement' => $_POST['heure_evenement'],
            'lieu' => $_POST['lieu'],
            'capacite' => intval($_POST['capacite'])
        ]);

        header("Location: admin_evenement.php");
        exit();
    }

    $events = $pdo->query("SELECT * FROM evenements")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les Événements</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <h1>Gérer les Événements</h1>

    <h2>Ajouter un Événement</h2>
    <form method="POST">
        <label>Nom :</label>
        <input type="text" name="nom_evenement" required><br>

        <label>Description :</label>
        <textarea name="description"></textarea><br>

        <label>Date :</label>
        <input type="date" name="date_evenement" required><br>

        <label>Heure :</label>
        <input type="time" name="heure_evenement" required><br>

        <label>Lieu :</label>
        <input type="text" name="lieu" required><br>

        <label>Capacité :</label>
        <input type="number" name="capacite"><br>

        <button type="submit">Ajouter</button>
    </form>

    <h2>Événements disponibles</h2>
    <?php if (empty($events)): ?>
        <p>Aucun événement disponible.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Lieu</th>
                    <th>Capacité</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event): ?>
                <tr>
                    <td><?= htmlspecialchars($event['nom_evenement']) ?></td>
                    <td><?= htmlspecialchars($event['description']) ?></td>
                    <td><?= htmlspecialchars($event['date_evenement']) ?></td>
                    <td><?= htmlspecialchars($event['heure_evenement']) ?></td>
                    <td><?= htmlspecialchars($event['lieu']) ?></td>
                    <td><?= htmlspecialchars($event['capacite']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
