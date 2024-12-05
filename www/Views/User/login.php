<?php
use App\Core\Messages;
$messages = Messages::getMessages();
?>

<form method="POST">
    <input type="email" placeholder="email" name="email">
    <input placeholder="password" name="password" type="password">
    <input type="submit">
</form>