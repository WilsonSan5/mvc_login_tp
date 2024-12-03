
<?php
use App\Core\Messages;

$messages = Messages::getMessages();

if (!empty($messages)) {
    foreach ($messages as $message) {
        echo "<h1 class='message " . $message['type'] . "'>" . $message['message'] . "</h1>";
    }
}
?>

<form action="/sinscrire" method="post">
	<input type="email" placeholder="email" name="email">
	<input type="password" placeholder="password" name="password">
	<input type="submit" name="submit" value="Submit">
</form>
