
<?php
// Demarrer la session
session_start();

// Récuperer les informations de l'utilisateur connecté
$user_role = $_SESSION['role'] ?? '';
$user_pseudo = $_SESSION['pseudo'] ?? '';


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Cafétéria</title>
    <link rel="stylesheet" href="assets/css/style.css">
    
    </style>
</head>
<body>
    
<div class="container">
    <div class="header">
    <a href="../app/index.php" class="logo">
            <img src="../assets/images/logo_cafe.png" alt="Logo" class="navbar-logo">
        </a>
        <h1>Bienvenue sur le tableau de bord, <?php echo $_SESSION['pseudo'] ?? 'Utilisateur'; ?> !</h1>
    </div>

    <div class="nav">
        <a href="../plats/index.php" class="plats">Gestion des Plats</a>
        <a href="../clients/index.php" class="clients">Gestion des Clients</a>
        <a href="../ventes/index.php" class="ventes">Gestion des Ventes</a>
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="../utilisateurs/index.php" class="utilisateurs">Gestion des Utilisateurs</a>
        <?php endif; ?>
    </div>
</div>

<div class="footer">
    <p>&copy; <?php echo date('Y'); ?> Cafétéria - Tous droits réservés.</p>
    <a href="../auth/logout.php">Déconnexion</a>
</div>
</body>
</html>


<style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: url('../assets/images/cafe_view.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #ffffff;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
            /* padding: 20px; */
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            flex-grow: 1;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            display:flex;
           
        }

        
        .header h1 {
                font-size: 2.6rem;
                color: #000000; 
                text-shadow: 2px 2px 4px rgba(50, 50, 50, 0.3); 
                /* margin: 20px 0; */
                padding-left:150px;
                
        }
        .logo {
    flex-shrink: 0;
    border-color:black;
}

.navbar-logo {
    height: 50px; 
    width: auto;
    border-radius: 50% ; 
    
}
        .nav {
            display: flex;
            justify-content: center;
            gap: 50px;
            flex-wrap: wrap;
            
        }
        .nav a {
            display: inline-block;
            width: 200px;
            height: 300px;
            background-size: cover;
            background-position: center;
            color:#FFF5E1;
            text-decoration: none;
            font-weight: bold;
            border-radius: 15px;
            border-color:#000000;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size:20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 1);
            box-shadow: 0 4px 6px rgba(1, 0, 0, 0.66);
        }
        .nav a:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.4);
        }

        
        .nav a.plats {
            
            background: rgba(0, 0, 0, 0.3);
        }
        .nav a.clients {
            
            background: rgba(0, 0, 0, 0.6);
        }
        .nav a.ventes {
           
            background: rgba(0, 0, 0, 0.6);
        }
        .nav a.utilisateurs {
            
            background: rgba(0, 0, 0, 0.6);
        }

        .footer {
            text-align: center;
            padding: 15px;
            background: rgba(0, 0, 0, 0.8);
            color: #bbb;
            font-size: 0.9rem;
        }
        .footer a {
            color: #ffffff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }