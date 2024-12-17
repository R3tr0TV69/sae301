<?php
require_once 'config/config.php';
session_start();

$requete = 'SELECT identifiant, mot_de_passe FROM comptes_admin';
$resultat = $pdo->query($requete);
$data = $resultat->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    die('Erreur : Aucun compte administrateur trouvé.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_identifiant = $_POST['username'] ?? '';
    $form_mot_de_passe = $_POST['password'] ?? '';

    if ($form_identifiant === $data['identifiant'] && hash('sha256', $form_mot_de_passe) === $data['mot_de_passe']) {
        $_SESSION['admin'] = true;
        header('Location: admin_adherent.php');
        exit;
    } else {
        die('Identifiant ou mot de passe incorrect.');
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Connexion Admin</title>
    <link rel="stylesheet" href="styles/styles-admin.css">
</head>
<body class="login">
    <h1>Connexion Admin</h1>
    <form action="" method="POST">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
