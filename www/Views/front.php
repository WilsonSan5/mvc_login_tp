<!DOCTYPE html>
<html>

<?php
// Démarrer la session si nécessaire
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inclure le fichier d'en-tête

?>

<head>
    <meta charset="UTF-8">
    <title><?= $title ?? "Titre de page" ?></title>
    <meta name="description" content="<?= $description ?? "Ceci est la description de ma page" ?>">
    <link rel="stylesheet" href="/Public/assets/css/reset.css">
    <link rel="stylesheet" href="/Public/assets/css/variables.css">
    <link rel="stylesheet" href="/Public/assets/css/main.css">
    <link rel="stylesheet" href="/Public/assets/css/navbar.css">
    <link rel="stylesheet" href="/Public/assets/css/login.css">
</head>

<body>
    <?php
    include "../Views/partials/header.php";
    include $this->v; ?>

    <?php if (isset($_SESSION['user'])): ?>
        <!-- Affichage lorsque l'utilisateur est connecté -->
        <main class="main-content">
            <div class="welcome-section">
                <h1>Bienvenue le site</h1>
                <p>Vous êtes connecté</p>
            </div>
        </main>
    <?php else: ?>

    <?php endif; ?>

    <script type="module" src="/src/main.js"></script>
</body>

</html>