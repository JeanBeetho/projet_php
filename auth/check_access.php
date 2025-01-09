<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: ./utilisateurs/login.php');
    exit();
}

// Vérifie si le rôle requis est défini
if (isset($required_role) && $_SESSION['user']['role'] !== $required_role) {
    die("Accès refusé : vous n'avez pas les droits nécessaires.");
}
?>
