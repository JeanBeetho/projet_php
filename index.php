<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Cafétéria</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="overlay"></div> 
    <div class="container">
        <div class="header">
            <h1>Bienvenue sur la Cafétéria du Campus</h1>
            <p>Gérez vos commandes, suivez vos ventes et profitez de nos services en ligne.</p>
        </div>
        <div class="buttons">
            <a href="utilisateurs/login.php">Se Connecter</a>
            <a href="register.php">Créer un Compte</a>
        </div>
       
    </div>
</body>
</html>



<style>
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background: url('assets/images/cafe_view.jpg') ;
    
    background-size: cover; 
    background-position: center; 
    background-attachment: fixed; 
}

.container {
    width: 100%;
    max-width: 500px;
    margin: 50px auto;
    padding: 30px;
    background-color: rgba(255, 255, 255, 0.7); 
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); 
    text-align: center;
}

.header h1 {
    font-size: 2.5rem;
    color: #4E3629; 
    margin-bottom: 10px;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5); 
}

.header p {
    font-size: 1rem;
    color: #333;
    margin-bottom: 30px;
    font-weight: 500;
}

.buttons a {
    display: inline-block;
    padding: 12px 25px;
    margin: 10px 0;
    background-color: #F2D04B; 
    color: white;
    text-decoration: none;
    border: 2px solid black;
    border-radius: 5px;
    
    font-weight: bold;
    text-transform: uppercase;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
    font-size: 1.1rem;
}

.buttons a:hover {
    background-color: #B59F7E; 
    transform: scale(1.05); 
}



</style>