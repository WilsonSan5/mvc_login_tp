<?php
use App\Core\Messages;

$messages = Messages::getMessages();
if (!empty($messages)) {
  $messageType = '';
  $messageContent = '';
  foreach ($messages as $message) {
    $messageType = $message['type'];
    $messageContent = $message['message'];
  }
}
?>
<div class="container">
  <div class="login-card">
    <h2>Connexion</h2>
    <form id="loginForm" method="POST" action="/login" class="login-form">
        <?php if (!empty($messages)) : ?>
            <div class="alert alert-<?php echo $messageType; ?>">
            <?php echo $messageContent; ?>
            </div>
        <?php endif; ?>
      <div class="form-group">
        <label for="email">Adresse email</label>
        <input id="email" name="email" type="email" placeholder="Entrez votre email" />
      </div>

      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input id="password" name="password" type="password" placeholder="Entrez votre mot de passe" />
      </div>
      <button type="submit" name="submit" class="submit-btn">Se connecter</button>
    </form>
  </div>
</div>
