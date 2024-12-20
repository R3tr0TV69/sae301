<?php
// Vérifie si l'utilisateur est connecté
    session_start();
    if (!isset($_SESSION['admin'])) {
        header('Location: login.php');
        exit;
    }
?>
