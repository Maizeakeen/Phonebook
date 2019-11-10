<form class="ui form" method="post" action="phonebook.php">
    <div class="box">
        <div class="field">
            <label>Username</label>
            <input type="text" name="rlogin">
        </div>
        <div class="field">
            <label>Password</label>
            <input class="login" type="text" name="rpassword">
        </div>

        <button class="ui inverted yellow button" type="submit" id="buttonregistr">Registration</button>
    </div>
</form>
<div hidden="<?php echo $flag; ?>">
    <?php echo $error; ?>
</div>