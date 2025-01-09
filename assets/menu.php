<?php
// Demarrer la session
session_start();

// Récuperer les informations de l'utilisateur connecté
$user_role = $_SESSION['role'] ?? '';
$user_pseudo = $_SESSION['pseudo'] ?? '';
// Obtenir le nom du script actuel
$currentPage = basename(dirname($_SERVER['SCRIPT_NAME']));
?>

<nav class="navbar">
    <div class="navbar-container">
        <a href="../app/index.php" class="logo">
            <img src="../assets/images/logo_cafe_.jpg" alt="Logo" class="navbar-logo">
        </a>
        <ul class="navbar-links">
            <li><a href="../plats/index.php" class="<?php if ($currentPage == 'plats') echo 'active'; ?>">Gestion des plats</a></li>
            <li><a href="../clients/index.php" class="<?php if ($currentPage == 'clients') echo 'active'; ?>">Gestion des clients</a></li>
            <li><a href="../ventes/index.php" class="<?php if ($currentPage == 'ventes') echo 'active'; ?>">Gestion des ventes</a></li>
            
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <li><a href="../utilisateurs/index.php" class="<?php if ($currentPage == 'utilisateurs') echo 'active'; ?>">Gestion des utilisateurs</a></li>
            <?php endif; ?>
            
            <li><a href="../rapports/index.php" class="<?php if ($currentPage == 'rapports') echo 'active'; ?>">Générer rapport</a></li>

        </ul>
    </div>
</nav>

<style>
/* Styles de la barre de navigation */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #6E4B3A; 
    padding: 0.5rem 1rem;
}

.navbar-container {
    display: flex;
    width: 100%;
    justify-content: space-between;
    align-items: center;
}

.logo {
    flex-shrink: 0;
}

.navbar-logo {
    height: 50px; 
    width: auto;
    border-radius: 50%; 
}

.navbar-links {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 1rem; 
}

.navbar-links li {
    margin: 0;
}

.navbar-links a {
    text-decoration: none;
    color: #FFF5E1; 
    font-weight: bold;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.navbar-links a:hover {
    background-color: #F39C12;
    color: #6E4B3A; 
}

.navbar-links .active {
    background-color: #F39C12; 
    color: #6E4B3A; 
}
</style>
