<?php
require_once('config/config.php'); // Inclure la configuration pour la connexion à la base de données

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);
    $role = 'user'; // Rôle par défaut



     // Vérifier si tous les champs sont remplis
    if (!empty($nom) && !empty($prenom) && !empty($pseudo) && !empty($_POST['mot_de_passe'])) {
        try {
            // Vérifier si le pseudo existe déjà
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM utilisateurs WHERE pseudo = ?");
            $stmt->execute([$pseudo]);
            if ($stmt->fetchColumn() > 0) {
                $error = "Ce pseudo est déjà utilisé.";
            } else {
                // Insérer l'utilisateur dans la base de données
                $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, pseudo, mot_de_passe, role) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$nom, $prenom, $pseudo, $mot_de_passe, $role]);
                $success = "Compte créé avec succès ! Vous pouvez maintenant vous connecter.";
                header("Location: utilisateurs/login.php");
            }
        } catch (PDOException $e) {
            $error = "Erreur lors de la création du compte : " . $e->getMessage();
        }
    } else {
        $error = "Tous les champs sont obligatoires.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Créer un compte</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?= $error; ?></p>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <p class="success"><?= $success; ?></p>
        <?php endif; ?>
        <form action="register.php" method="POST">
            <div>
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div>
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div>
                <label for="pseudo">Pseudo :</label>
                <input type="text" id="pseudo" name="pseudo" required>
            </div>
            <div>
                <label for="mot_de_passe">Mot de passe :</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
            </div>
            <button type="submit">Créer un compte</button>
        </form>
        <p>Déjà un compte ? <a href="utilisateurs/login.php">Connectez-vous</a></p>
    </div>
</body>
</html>




<style>

body {
    font-family: Arial, sans-serif;
    background-color: #F9F4EF;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* Conteneur principal */
.container {
    background-color: #FFF5E1;
    padding: 20px 30px;
    border: 1px solid #E5C29F;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 90%;
}

/* Titre de la page */
.container h2 {
    text-align: center;
    font-size: 1.8rem;
    color: #6E4B3A;
    margin-bottom: 20px;
}

/* Champs du formulaire */
.container form div {
    margin-bottom: 15px;
}

.container label {
    display: block;
    font-weight: bold;
    color: #6E4B3A;
    margin-bottom: 5px;
}

.container input[type="text"],
.container input[type="password"],
.container input[type="email"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #D6B392;
    border-radius: 5px;
    background-color: #FFF;
    font-size: 1rem;
    color: #6E4B3A;
}

/* Bouton de soumission */
.container button {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    background-color: #6E4B3A;
    color: #FFF5E1;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.container button:hover {
    background-color: #4E3526;
}

/* Lien pour se connecter */
.container p {
    text-align: center;
    font-size: 0.9rem;
    color: #6E4B3A;
}

.container a {
    color: #FFCC00;
    text-decoration: none;
    font-weight: bold;
}

.container a:hover {
    text-decoration: underline;
}

/* Messages d'erreur et de succès */
.error {
    color: #D9534F;
    background-color: #F2DEDE;
    padding: 10px;
    border: 1px solid #E4B8B6;
    border-radius: 5px;
    text-align: center;
    margin-bottom: 15px;
}

.success {
    color: #5CB85C;
    background-color: #DFF0D8;
    padding: 10px;
    border: 1px solid #B6D7B8;
    border-radius: 5px;
    text-align: center;
    margin-bottom: 15px;
}
</style>