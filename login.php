<?php
require_once 'config/config.php';

try {
    
    $bdd = new PDO('mysql:host=' . $hote . ';port=' . $port . ';dbname=' . $nom_bd, $identifiant, $mot_de_passe, $options);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}


$requete = 'SELECT identifiant, mot_de_passe FROM comptes_admin';
$resultat = $bdd->query($requete);
$data = $resultat->fetch(PDO::FETCH_ASSOC);
$db_identifiant = $data['identifiant'];
$db_mot_de_passe = $data['mot_de_passe'];
$resultat->closeCursor();


$message = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_identifiant = $_POST['username'] ?? '';
    $form_mot_de_passe = $_POST['password'] ?? '';

    if ($form_identifiant === $db_identifiant && $form_mot_de_passe === $db_mot_de_passe) {
        
        header('Location: admin_adherent.php');
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

    <!-- Message d'erreur si pas bon -->
    <?php if ($message): ?>
        <p style="color: red;"> <?= htmlspecialchars($message) ?> </p>
    <?php endif; ?>
</body>
</html>