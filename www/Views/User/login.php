<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/Views/css/reset.css">
    <link rel="stylesheet" href="/Views/css/variables.css">
    <link rel="stylesheet" href="/Views/css/main.css">
    <link rel="stylesheet" href="/Views/css/login.css">
  </head>
  <body>
    <div class="container">
      <div class="login-card">
        <h2>Connexion</h2>
        <form id="loginForm" method="POST" action="/login" class="login-form">
          <div class="form-group">
            <label for="email">Adresse email</label>
            <input
              id="email"
              name="email"
              type="email"
              required
              placeholder="Entrez votre email"
            />
          </div>

          <div class="form-group">
            <label for="password">Mot de passe</label>
            <input
              id="password"
              name="password"
              type="password"
              required
              placeholder="Entrez votre mot de passe"
            />
          </div>


          <button type="submit" class="submit-btn">Se connecter</button>
        </form>
      </div>
    </div>
    <script type="module" src="/src/main.js"></script>
  </body>
</html>