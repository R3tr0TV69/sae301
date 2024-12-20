<?php
// Permet de rechercher facilement un adhérent
header('Content-Type: application/json');

require_once '../config/config.php';

$requete = $pdo->query("SELECT * FROM adherents ORDER BY nom ASC");
$adherents = $requete->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($adherents);
?>
