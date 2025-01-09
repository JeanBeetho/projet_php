<?php
require '../config/config.php';
include '../assets/menu.php'; // Inclure le menu

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $type = $_POST['type'];
    $phone = $_POST['phone'];

    // Mise à jour dans la base de données
    $query = $pdo->prepare("UPDATE clients SET nom = ?, type = ?, phone = ? WHERE id = ?");
    $query->execute([$nom, $type, $phone, $id]);

    // Redirection après modification
    header("Location: index.php");
} else {
    $id = $_GET['id'];
    $query = $pdo->prepare("SELECT * FROM clients WHERE id = ?");
    $query->execute([$id]);
    $client = $query->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un client</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="edit-container"> 
    <div class="edit-box">
                
                    <h2>Modifier un client</h2>
               

                <form method="POST">

                    <input type="hidden" name="id" value="<?php echo $client['id']; ?>">
                    <div class="form-group">
                        <label for="nom">Nom du client :</label>
                        <input type="text" id="nom" name="nom" value="<?php echo $client['nom']; ?>" required>
                    </div>
                    <div class="form-group">
                            <label for="type">Type de client :</label>
                            <select id="type" name="type" required>
                                <option value="Étudiant" <?php echo $client['type'] == 'Étudiant' ? 'selected' : ''; ?>>Étudiant</option>
                                <option value="Professeur" <?php echo $client['type'] == 'Professeur' ? 'selected' : ''; ?>>Professeur</option>
                                <option value="Personnel Admin" <?php echo $client['type'] == 'Personnel Admin' ? 'selected' : ''; ?>>Personnel Admin</option>
                                <option value="Invite" <?php echo $client['type'] == 'Invite' ? 'selected' : ''; ?>>Invite</option>
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="phone">Numéro de téléphone :</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo $client['phone']; ?>" required>
                    </div>
                <button type="submit">Modifier le client</button>
                </form>

                <a href="index.php">Retour à la liste des clients</a>
</div>


</body>
</html>
<?php include '../assets/footer.php'; ?>

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