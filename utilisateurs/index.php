<?php
require_once('../config/config.php');
include '../assets/menu.php'; // Inclure le menu
$required_role = 'admin';


// Récupérer tous les utilisateurs
$stmt = $pdo->query("SELECT * FROM utilisateurs");
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Lien vers le fichier CSS global -->
</head>
<body>
    
    <div class="container">
        <h2 class="section-title">Liste des utilisateurs</h2>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Pseudo</th>
                    <th>Rôle</th>
             <?php if ($_SESSION['role'] === 'admin'): ?>
                <th>Actions</th>
            <?php endif; ?>

                   
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateurs as $utilisateur): ?>
                    <tr>
                        <td><?= htmlspecialchars($utilisateur['id']) ?></td>
                        <td><?= htmlspecialchars($utilisateur['nom']) ?></td>
                        <td><?= htmlspecialchars($utilisateur['prenom']) ?></td>
                        <td><?= htmlspecialchars($utilisateur['pseudo']) ?></td>
                        <td><?= htmlspecialchars($utilisateur['role']) ?></td>
                        
                        
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                            <td>
                                    <a href="edit.php?id=<?= $utilisateur['id'] ?>" class="btn-primary">Modifier</a>
                                    <?php if ($utilisateur['role'] !== 'admin'): ?>
                                        <a href="delete.php?id=<?= $utilisateur['id'] ?>" class="btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">Supprimer</a>
                                    <?php endif; ?>
                            </td>
                  <?php endif; ?>

                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="add.php" class="btn-primary">Ajouter un utilisateur</a>
    </div>
    <?php include '../assets/footer.php'; ?>

    
</body>
</html>

<style>
body {
    font-family: 'Roboto', sans-serif;
    background: #F9E79F; 
    color: #6E4B3A;
    margin: 0;
    padding: 0;
}

.main-header {
    background-color: #6E4B3A;
    color: #fff;
    text-align: center;
    padding: 1.5rem 0;
}

.container {
    margin: 2rem auto;
    max-width: 900px;
    background-color: #fff;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.section-title {
    color: #6E4B3A;
    margin-bottom: 1rem;
    text-align: left;
}

.styled-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 1.5rem;
}

.styled-table th, .styled-table td {
    border: 1px solid #ddd;
    padding: 0.75rem;
    text-align: left;
}

.styled-table th {
    background-color: rgb(177, 145, 20);
    color: #fff;
}

.styled-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.styled-table tr:hover {
    background-color: #f1f1f1;
}

.btn-primary {
    display: inline-block;
    padding: 0.75rem 1.25rem;
    background-color: rgb(177, 145, 20);
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #6E4B3A;
}

.btn-danger {
    display: inline-block;
    padding: 0.5rem 1rem;
    background-color: #c0392b;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.btn-danger:hover {
    background-color: #a93226;
}
</style>

