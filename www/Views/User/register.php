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
            <?php if (!empty($messageContent)) : ?>
                <div class="alert alert-<?= $messageType; ?>">
                    <?= $messageContent; ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="firstname">Votre prénom</label>
                <input id="firstname" name="firstname" type="text" placeholder="Entrez votre prénom"/>
            </div>
            <div class="form-group">
                <label for="lastname">Votre nom de famille</label>
                <input id="lastname" name="lastname" type="text" placeholder="Entrez votre nom de famille"/>
            </div>
            <div class="form-group">
                <label for="email">Adresse email</label>
                <input id="email" name="email" type="email"  placeholder="Entrez votre email"/>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input id="password" name="password" type="password" placeholder="Entrez votre mot de passe"/>
            </div>
            <div class="form-group">
                <label for="password">Confirmez votre mot de passe</label>
                <input id="password" name="confirm_password" type="password" placeholder="Confirmez votre mot de passe"/>
            </div>
            <button type="submit" class="submit-btn">S'inscrire</button>
        </form>
    </div>
</div>
