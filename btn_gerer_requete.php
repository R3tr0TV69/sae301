<?php
require_once 'config/config.php';
require_once 'config/verifier_session.php';

if (!isset($_GET['action']) || !isset($_GET['id'])) {
    die('Action ou ID manquant');
}

$action = $_GET['action'];
$id = intval($_GET['id']);

// Traite en fonction de quel bouton est cliqué
if ($action === 'accept') {
    // Pour une demande acceptée
    $stmt = $pdo->prepare("INSERT INTO adherents (nom, prenom, sexe, age, poids, taille, date_inscription, date_expiration)
        SELECT nom, prenom, sexe, age, poids, taille, CURDATE(), DATE_ADD(CURDATE(), INTERVAL duree MONTH)
        FROM demande_inscription WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $stmt = $pdo->prepare("DELETE FROM demande_inscription WHERE id = :id");
    $stmt->execute(['id' => $id]);
    header('Location: admin_adherent.php');
    exit();
} elseif ($action === 'reject') {
    // Pour une demande refusée
    $stmt = $pdo->prepare("DELETE FROM demande_inscription WHERE id = :id");
    $stmt->execute(['id' => $id]);
    header('Location: admin_adherent.php');
    exit();
}