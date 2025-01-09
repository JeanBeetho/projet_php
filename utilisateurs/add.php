<?php
require_once('../config/config.php');
include '../assets/menu.php'; // Inclure le menu
$required_role = 'admin';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pseudo = $_POST['pseudo'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

        // Vérifier si ce pseudo/ existe a déjà 
        $checkQuery = $pdo->prepare("SELECT COUNT(*) FROM utilisateurs WHERE  pseudo = ? ");
        $checkQuery->execute([$pseudo]);
        $alreadyExists = $checkQuery->fetchColumn();

    if ($alreadyExists > 0) {
            // Message d'erreur si ce pseudo/ existe déjà
            $error = "Ce mot de passe ou Pseudo existe deja .";
    }else{

        $stmt = $pdo->prepare("
            INSERT INTO utilisateurs (nom, prenom, pseudo, mot_de_passe, role)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([$nom, $prenom, $pseudo, $mot_de_passe, $role]);

        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Utilisateur</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
</head>
<body>
    <div class="add-container">
        <h2>Ajouter un Utilisateur</h2>
        <?php if (!empty($error)): ?>
                <div class="error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" id="prenom" required>
            </div>
            <div class="form-group">
                <label for="pseudo">Pseudo :</label>
                <input type="text" name="pseudo" id="pseudo" required>
            </div>
            <div class="form-group">
                <label for="mot_de_passe">Mot de Passe :</label>
                <input type="password" name="mot_de_passe" id="mot_de_passe" required>
            </div>
            <div class="form-group">
                <label for="role">Rôle :</label>
                <select name="role" id="role">
                    <option value="user">Utilisateur</option>
                    <option value="admin">Administrateur</option>
                </select>
            </div>
            <button type="submit">Ajouter</button>
        </form>
        <a href="index.php" class="back-link">Retour à la liste des utilisateurs</a>
        
    </div>
    <?php include '../assets/footer.php'; ?>

</body>
</html>

<style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: #F9E79F; 
            color: #6E4B3A; 
            display:block;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .error{color:red;}
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
            background-color: #F39C12; 
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #6E4B3A;
        }
    </style>