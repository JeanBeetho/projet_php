<?php
require '../config/config.php';
include '../assets/menu.php'; // Inclure le menu
// Demarrer la session


// Récupérer tous les clients
$query = $pdo->query("SELECT * FROM clients");
$clients = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des clients</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    
    <div class="container">
        <h2 class="section-title">Liste des clients</h2>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Téléphone</th>

                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <th>Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?php echo $client['id']; ?></td>
                        <td><?php echo $client['nom']; ?></td>
                        <td><?php echo $client['type']; ?></td>
                        <td><?php echo $client['phone']; ?></td>
                        
                     <?php if ($_SESSION['role'] === 'admin'): ?>
                            <td>
                            <a href="edit.php?id=<?php echo $client['id']; ?>" class="btn-primary">Modifier</a>
                            <a href="delete.php?id=<?php echo $client['id']; ?>" class="btn-danger"onclick="return confirmDelete()">Supprimer</a>
                        </td>
                    <?php endif; ?>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="add.php" class="btn-primary">Ajouter un client</a>
    </div>

    <script src="../assets/js/script.js"></script>
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
    background-color:rgb(177, 145, 20);
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
    background-color:rgb(177, 145, 20);
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
