<?php
require_once 'config/config.php';

try {
    $stmt = $pdo->query("SELECT 1");
    if ($stmt) {
        echo "Oui";
    } else {
        echo "Non";
    }
} catch (PDOException $e) {
    echo "Raison : " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USV</title>
</head>
<body>
    
</body>
</html>