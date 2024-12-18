<?php
header('Content-Type: application/json');

require_once '../config/config.php';



$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if ($query === '') {
    
    $stmt = $pdo->query("SELECT * FROM adherents ORDER BY nom ASC");
} else {
    
    $stmt = $pdo->prepare("SELECT * FROM adherents WHERE nom LIKE :query OR prenom LIKE :query ORDER BY nom ASC");
    $stmt->execute(['query' => "%$query%"]);
}

$members = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($members);
?>