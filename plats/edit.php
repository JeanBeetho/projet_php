<?php
require '../config/config.php';
include '../assets/menu.php'; // Inclure le menu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $cuisson = $_POST['cuisson'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];

    // Mise à jour dans la base de données
    $query = $pdo->prepare("UPDATE plats SET nom = ?, cuisson = ?, prix = ?, quantite = ? WHERE id = ?");
    $query->execute([$nom, $cuisson, $prix, $quantite, $id]);

    // Redirection après modification
    header("Location: index.php");
} else {
    $id = $_GET['id'];
    $query = $pdo->prepare("SELECT * FROM plats WHERE id = ?");
    $query->execute([$id]);
    $plat = $query->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un plat</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
   
</head>
<body>
    <div class="edit-container">
        <div class="edit-box">
            <h2>Modifier un plat</h2>
            <form method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($plat['id']) ?>">

                <div class="form-group">
                    <label for="nom">Nom du plat :</label>
                    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($plat['nom']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="cuisson">Cuisson :</label>
                    <select id="cuisson" name="cuisson" required>
                        <option value="Cru" <?= $plat['cuisson'] === 'Cru' ? 'selected' : '' ?>>Cru</option>
                        <option value="Cuit" <?= $plat['cuisson'] === 'Cuit' ? 'selected' : '' ?>>Cuit</option>
                        <option value="Grillé" <?= $plat['cuisson'] === 'Grillé' ? 'selected' : '' ?>>Grillé</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="prix">Prix (HTG) :</label>
                    <input type="number" id="prix" name="prix" value="<?= htmlspecialchars($plat['prix']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="quantite">Quantité :</label>
                    <input type="number" id="quantite" name="quantite" value="<?= htmlspecialchars($plat['quantite']) ?>" required>
                </div>
                <button type="submit">Modifier le plat</button>
            </form>
            <a href="index.php" class="back-link">Retour à la liste des plats</a>
        </div>
    </div>
    <?php include '../assets/footer.php'; ?>

</body>
</html>

<style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: #f8e4a4;; 
            color: #fff;
            /* display: block; */
        }

        .edit-container {
            width: 100%;
            height: 100vh;
            display: block;
            justify-content: center;
            align-items: center;
        }

        .edit-box {
            background-color: #FFF5E1;; 
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            width: 600px;
            text-align: center;
            margin-left:400px;
            margin-top:10px;
            
        }

        .edit-box h2 {
            margin-bottom: 20px;
            color: #6E4B3A; 
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #6E4B3A;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #FFCC00; 
            outline: none;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            background-color: #FFCC00;
            color: #6E4B3A; 
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #F39C12; 
        }

        .back-link {
            margin-top: 15px;
            font-size: 14px;
            color: #6E4B3A;
            text-decoration: none;
            display: inline-block;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>