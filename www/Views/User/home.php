<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? "Titre de page" ?></title>
    <meta name="description" content="<?= $description ?? "ceci est la description de ma page" ?>">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/navbar.css">
</head>

<body>
    <?php include "../Views/partials/header.php"; ?>

    <!-- Main Content -->
    <?php if (isset($_SESSION['user'])): ?>
        <!-- Contenu lorsque l'utilisateur est connecté -->
        <main class="main-content">
            <div class="welcome-section">
                <h1>vous êtes connecté :) </h1>
                <div class="cta-container">
                </div>
            </div>
        </main>
    <?php else: ?>
        <!-- Contenu lorsque l'utilisateur n'est pas connecté -->
        <main class="main-content">
            <div class="welcome-section">
                <h1>Bienvenue sur mvc_login_tp</h1>
                <p>Tester la connexion et l'inscription</p>
                <div class="cta-container">
                    <a href="/sinscrire" class="cta-button">Commencer maintenant</a>
                </div>
            </div>
        </main>
    <?php endif; ?>

    <script type="module" src="/src/main.js"></script>
</body>
</html>
