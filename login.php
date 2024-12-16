<?php
require_once 'config/config.php'; // Inclure la configuration pour utiliser $pdo

$message = ''; // Initialisation du message d'erreur

try {
    // Requête pour récupérer les identifiants admin
    $requete = 'SELECT identifiant, mot_de_passe FROM comptes_admin';
    $resultat = $pdo->query($requete); // Utilisation de la connexion $pdo définie dans config.php
    $data = $resultat->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $db_identifiant = $data['identifiant'];
        $db_mot_de_passe = $data['mot_de_passe'];
    } else {
        die('Erreur : Aucun compte administrateur trouvé dans la base de données.');
    }
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_identifiant = $_POST['username'] ?? '';
    $form_mot_de_passe = $_POST['password'] ?? '';

    // Vérification des identifiants fournis
    if ($form_identifiant === $db_identifiant && $form_mot_de_passe === $db_mot_de_passe) {
        header('Location: admin_adherent.php'); // Redirection en cas de succès
        exit;
    } else {
        $message = 'Identifiant ou mot de passe incorrect';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion admin</title>
</head>
<body>
    <h1>Connexion admin</h1>

    <form action="" method="POST">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Connexion</button>
    </form>

    <!-- Message d'erreur si les identifiants sont incorrects -->
    <?php if ($message): ?>
        <p style="color: red;"> <?= htmlspecialchars($message) ?> </p>
    <?php endif; ?>
</body>
</html>
