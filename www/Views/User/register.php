
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
<form class="form" action="/sinscrire" method="post">
    <div class="title">Welcome</div>
    <div class="subtitle">Let's create your account!</div>
    <span class="message message-<?=$messageType?>">
        <?= $messageContent ?? '' ?>
    </span>
    <div class="input-container ic2">
        <input id="email" class="input" name="email" type="text" placeholder=" " />
        <div class="cut cut-short"></div>
        <label for="email" class="placeholder">Email</>
    </div>
    <div class="input-container ic2">
        <input id="lastname" class="input" name="password" type="password" placeholder=" " />
        <div class="cut"></div>
        <label for="lastname" class="placeholder">Password</label>
    </div>
    <button type="text" class="submit">submit</button>
</form>
