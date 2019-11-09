<form class="ui form" method="post" action="phonebook.php">
    <div class="box">
        <div class="field">
            <label>Username</label>
            <input type="text" name="login">
        </div>
        <div class="field">
            <label>Password</label>
            <input class="login" type="text" name="password">
        </div>

        <button class="ui inverted yellow button" type="submit" id="buttonlogin">Login</button>
    </div>
</form>
<div hidden="<?php echo $flag; ?>">
    <?php echo $error; ?>
</div>