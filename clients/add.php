<?php
require '../config/config.php';
include '../assets/menu.php'; // Inclure le menu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $type = $_POST['type'];
    $phone = $_POST['phone'];

    // Insertion dans la base de données
    $query = $pdo->prepare("INSERT INTO clients (nom, type, phone) VALUES (?, ?, ?)");
    $query->execute([$nom, $type, $phone]);

    // Redirection après ajout
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un client</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="add-container"> 
        <div class="add-box"> 
               
                    <h2>Ajouter un client</h2>
                

                <form method="POST">

                <div class="form-group"> 
                    <label for="nom">Nom du client :</label>
                    <input type="text" id="nom" name="nom" required>
                </div> 
                <div class="form-group"> 
                    <label for="type">Type de client :</label>
                    <select id="type" name="type" required>
                        <option value="Étudiant">Étudiant</option>
                        <option value="Professeur">Professeur</option>
                        <option value="Personnel Admin">Personnel Admin</option>
                        <option value="Invite">Invite</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="phone">Numéro de téléphone :</label>
                    <input type="tel" id="phone" name="phone" required>
                </div> 
                <button type="submit">Ajouter le client</button>

                </form>

                <a href="index.php">Retour à la liste des clients</a>
         </div>
    </div>
    

</body>
</html>
<?php include '../assets/footer.php'; ?>


<style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: #F9E79F; 
            color: #6E4B3A; 
            display: flex;
            display: block;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .add-container {
            width: 600px;
            margin-left:400px;
            margin-top:10px;
            padding: 30px;
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
            background-color: #F39cC12; 
        }

       
    </style>