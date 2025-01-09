<?php
require_once('../config/config.php');

$required_role = 'admin';

$id = $_GET['id'];

// Vérifier si l'utilisateur est admin
$stmt = $pdo->prepare("SELECT * FROM clients WHERE id = ?");
$stmt->execute([$id]);
$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

if ($utilisateur && $utilisateur['role'] !== 'admin') {
    $stmt = $pdo->prepare("DELETE FROM clients WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit;
?>
