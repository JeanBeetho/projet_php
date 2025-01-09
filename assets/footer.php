<footer class="main-footer">
    <div class="footer-container">
        <div class="footer-logo">
            <img src="../assets/images/logo_cafe_.jpg" alt="Logo" class="footer-logo-img">
        </div>
        <div class="footer-text">
            <p>&copy; <?= date('Y'); ?> Cafétéria du Campus Henry Christophe de Limonade</p>
            <p>Développé avec ❤️ pour une gestion efficace</p>
        </div>
        <div class="footer-link">
            <a href="../auth/logout.php" class="logout-link">Déconnexion</a>
        </div>
    </div>
</footer>

<style>

/* Footer principal */
.main-footer {
    background-color: #6E4B3A; 
    color: #FFF5E1; 
    padding: 1rem 0;
    font-size: 0.9rem;
    border-top: 4px solid #FFCC00; 
}

.footer-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
    text-align: center;
    flex-wrap: wrap; 
}

.footer-logo {
    flex: 1;
    text-align: left;
}

.footer-logo-img {
    height: 50px;
    width: auto;
    border-radius: 50%; 
}

.footer-text {
    flex: 2;
    text-align: center;
}

.footer-text p {
    margin: 5px 0;
}

.footer-link {
    flex: 1;
    text-align: right;
}

.logout-link {
    color: #FFF5E1;
    text-decoration: none;
    font-weight: bold;
    background-color: #F39C12; 
    padding: 0.5rem 1rem;
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.logout-link:hover {
    background-color: #FFCC00; 
    color: #6E4B3A; 
}
</style>
