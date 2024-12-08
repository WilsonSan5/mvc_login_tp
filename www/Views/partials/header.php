<header>
    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="nav-logo">ProjetX</a>
            <div class="nav-links">
                <?php if (isset($_SESSION['user'])): ?>
                    <!-- Partie pour un utilisateur connecté -->
                    <a href="/logout" class="nav-link">Déconnexion</a>
                    <a href="/edit?id=<?=$_SESSION['user']->id?>" class="nav-button">
                        <?php echo htmlspecialchars(\App\Core\AuthMiddleware::getFullName()); ?>
                    </a>
                <?php else: ?>
                    <!-- Partie pour un utilisateur déconnecté -->
                    <a href="/login" class="nav-button">Connexion</a>
                    <a href="/sinscrire" class="nav-button">Inscription</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>
