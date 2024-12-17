<?php
require_once 'config/config.php';
require_once 'config/verifier_session.php';

$requests = $pdo->query("SELECT * FROM demande_inscription")->fetchAll(PDO::FETCH_ASSOC);
$members = $pdo->query("SELECT * FROM adherents")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Adhérents</title>
    <link rel="stylesheet" href="styles/styles-admin.css">
</head>
<body>
    <?php include("includes/header_admin.php") ?>
    <main>
        <h1>Admin Adhérents</h1>
        <section>
            <h2>Requêtes d'adhésion</h2>
            <?php if (empty($requests)): ?>
                <p>Aucune nouvelle requête d'adhésion pour le moment.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Sexe</th>
                                <th>Âge</th>
                                <th>Durée (mois)</th>
                                <th>Actions</th>
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
                                    <td>
                                        <button class="action-btn" data-id="<?= $request['id'] ?>" data-action="accept">Accepter</button>
                                        <button class="action-btn" data-id="<?= $request['id'] ?>" data-action="reject">Refuser</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
            <?php endif; ?>
                </div>
        </section>

        <section>
            <h2>Liste des adhérents</h2>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Sexe</th>
                            <th>Âge</th>
                            <th>Date d'inscription</th>
                            <th>Date d'expiration</th>
                            <th>Gérer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($members as $member): ?>
                            <tr>
                                <td><?= htmlspecialchars($member['nom']) ?></td>
                                <td><?= htmlspecialchars($member['prenom']) ?></td>
                                <td><?= htmlspecialchars($member['sexe']) ?></td>
                                <td><?= htmlspecialchars($member['age']) ?></td>
                                <td><?= htmlspecialchars($member['date_inscription']) ?></td>
                                <td><?= htmlspecialchars($member['date_expiration']) ?></td>
                                <td><a href="gerer_adherent.php?id=<?= $member['id'] ?>">Gérer</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <script src="js/scripts.js"></script>
</body>
</html>
