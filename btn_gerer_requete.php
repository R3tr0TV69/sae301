<?php
require_once 'config/config.php';

$action = $_GET['action'];
$id = intval($_GET['id']);

if ($action === 'accept') {
    $stmt = $pdo->prepare("INSERT INTO adherents (nom, prenom, sexe, age, poids, taille, date_inscription, date_expiration)
        SELECT nom, prenom, sexe, age, poids, taille, CURDATE(), DATE_ADD(CURDATE(), INTERVAL duree MONTH)
        FROM demande_inscription WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $stmt = $pdo->prepare("DELETE FROM demande_inscription WHERE id = :id");
    $stmt->execute(['id' => $id]);
    header('Location: admin_adherent.php');
    exit();
}