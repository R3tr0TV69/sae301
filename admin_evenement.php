<?php
require_once 'config/config.php';

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
    <h1>Liste des Événements</h1>

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
