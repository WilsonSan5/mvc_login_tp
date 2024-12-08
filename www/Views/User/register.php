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
    <h2>Inscription</h2>
    <form id="loginForm" method="POST" action="/sinscrire" class="login-form">
      <div class="form-group">
        <label for="email">Adresse email</label>
        <input id="email" name="email" type="email" required placeholder="Entrez votre email" />
      </div>
      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input id="password" name="password" type="password" required placeholder="Entrez votre mot de passe" />
      </div>
      <button type="submit" class="submit-btn">S'inscrire</button>
    </form>
  </div>
</div>