<?php
// Connexion à la base de donnée hébergé sur Hostinger
$host = 'srv935.hstgr.io';
$port = '3306';
$dbname = 'u737121608_usv';
$username = 'u737121608_usvidentifiant';
$password = 'V[T2xX>e^l4o';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion");
}
?>
