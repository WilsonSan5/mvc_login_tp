<?= $alert ?>
<form class="form" action="/login" method="post">
    <div class="title">Welcome Back</div>
    <div class="subtitle">Let's Reconnect!</div>
<!--    <span class="message message---><?php //=$messageType?><!--">-->
<!--        --><?php //= $messageContent ?? '' ?>
<!--    </span>-->
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
    <button type="text" class="submit">Login</button>
</form>
