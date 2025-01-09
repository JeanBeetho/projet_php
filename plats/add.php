<?php
require '../config/config.php';

include '../assets/menu.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $cuisson = $_POST['cuisson'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];

    // Insertion dans la base de données
    $query = $pdo->prepare("INSERT INTO plats (nom, cuisson, prix, quantite) VALUES (?, ?, ?, ?)");
    $query->execute([$nom, $cuisson, $prix, $quantite]);

    // Redirection après ajout
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Ajouter un plat</title> -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
</head>
<body>
    <div class="add-container">
        <div class="add-box">
            <h2>Ajouter un plat</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="nom">Nom du plat :</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div class="form-group">
                    <label for="cuisson">Cuisson :</label>
                    <select id="cuisson" name="cuisson" required>
                        <option value="Cru">Cru</option>
                        <option value="Cuit">Cuit</option>
                        <option value="Grillé">Grillé</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="prix">Prix (HTG) :</label>
                    <input type="number" id="prix" name="prix" required>
                </div>
                <div class="form-group">
                    <label for="quantite">Quantité :</label>
                    <input type="number" id="quantite" name="quantite" required>
                </div>
                <button type="submit">Ajouter le plat</button>
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
            margin:0px;
            padding: 0;
            background: #F9E79F; 
            color: #6E4B3A;
            
            align-items: center;
           display: block;
            
            
            height: 100vh;
            
        }

        .add-container {
            width: 400px;
            padding: 30px;
            margin-left:400px;
            justify-content: center;
            background-color: #FFF5E1; 
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            
        }

        .add-container h2 {
            margin-bottom: 20px;
            color: #6E4B3A; 
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
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

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #6E4B3A;
        }
    </style>