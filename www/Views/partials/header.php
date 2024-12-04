
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="/Views/css/reset.css">
    <link rel="stylesheet" href="/Views/css/variables.css">
    <link rel="stylesheet" href="/Views/css/main.css">
    <link rel="stylesheet" href="/Views/css/navbar.css">
  </head>

<header>
  
  
<nav class="navbar">
    <div class="nav-container">
        <a href="/" class="nav-logo">mvc_login_tp</a>
        <div class="nav-links">
            <?php if (isset($_SESSION['user'])): ?>
                <!-- Partie pour un utilisateur connecté -->
                <a href="/logout" class="nav-link">Déconnexion</a>
                <a href="/" class="nav-button">
                    <?php echo htmlspecialchars($_SESSION['user']->email ?? 'Utilisateur'); ?>
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
