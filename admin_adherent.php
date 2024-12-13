<?php
require_once 'config/config.php';

$requests = $pdo->query("SELECT * FROM demande_inscription")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Adhérents</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <h1>Admin Adhérents</h1>
    <section>
        <h2>Requêtes d'adhésion</h2>
        <?php if (empty($requests)): ?>
            <p>Aucune nouvelle requête.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Sexe</th>
                        <th>Âge</th>
                        <th>Durée (mois)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $request): ?>
                        <tr>
                            <td><?= htmlspecialchars($request['nom']) ?></td>
                            <td><?= htmlspecialchars($request['prenom']) ?></td>
                            <td><?= htmlspecialchars($request['sexe']) ?></td>
                            <td><?= htmlspecialchars($request['age']) ?></td>
                            <td><?= htmlspecialchars($request['duree']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>
</body>
</html>
