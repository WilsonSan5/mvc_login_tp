<?php

use App\Core\Messages;
$messages = Messages::getMessages();
$messageContent = '';
$messageType = '';
foreach ($messages as $message) {
	$messageContent = $message['message'];
	$messageType = $message['type'];
}
$user = $_SESSION['user'] ?? null;
?>
<div class="container">
    <div class="login-card">
        <h2>Modifier votre profil</h2>
        <form id="loginForm" method="POST" action="/edit?id=<?=$user->id?>" class="login-form">
            <?php if (!empty($messageContent)) : ?>
                <div class="alert alert-<?= $messageType; ?>">
                    <?= $messageContent; ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="firstname">Votre prénom</label>
                <input
					id="firstname"
					name="firstname"
					type="text"
					placeholder="Entrez votre prénom"
					value="<?=$user->firstname ?>"
				/>
            </div>
            <div class="form-group">
                <label for="lastname">Votre nom de famille</label>
                <input
					id="lastname"
					name="lastname"
					type="text"
					placeholder="Entrez votre nom de famille"
					value="<?=$user->lastname?>"
				/>
            </div>
            <div class="form-group">
                <label for="email">Adresse email</label>
                <input
					id="email"
					name="email"
					type="email"
					placeholder="Entrez votre email"
					value="<?=$user->email?>"
				/>
            </div>
            <button type="submit" class="submit-btn">Modifier</button>
        </form>
    </div>
</div>
