<header>
    <nav>
        <ul>
            <li><a href="/">Accueil</a></li>
            <?php if (isset($_SESSION['user'])) : ?>
                <li><a href="/logout">Déconnexion</a></li>
            <?php else : ?>
                <li><a href="/login">Connexion</a></li>
                <li><a href="/sinscrire">Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
