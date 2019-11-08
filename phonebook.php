<?php
include 'init.php';
if (isset($_POST['login']) && isset($_POST['password'])) {
    $flag = login($dbh, $_POST['login'], $_POST['password']);
} else {
    $error = '<div class="ui warning message">
                   <i class="close icon"></i>
                       <div class="header">
                           Введите логин и пароль!
                       </div>
              </div>';
}

if ($flag==false) {
    $error = '<div class="ui warning message">
                   <i class="close icon"></i>
                         <div class="header">
                              Неправельный логин или пароль.
                         </div>
              </div>';
}else{
    $user=getUser($dbh);
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body class="ui inverted segment">
    <header>
        <div class="logo"><a href="phonebook.php">Phonebook</a></div>
        <div><a class="right" href="logout.php">Logout</a></div>
    </header>
    <br>
    <br>
    <br>
<div class="inner">
    <div class="ui inverted pointing menu">
        <a class="item" id="clickmain">
            Public phonebook
        </a>
        <a class="item" id="clicklogin">
            Login
        </a>
    </div>

    <div class="ui segment">
        <div id="mainmenu">
            <div class="ui relaxed divided list">
                <?php
                $data = showusers($dbh);
                foreach ($data as $key => $value) {
                    $output .=
                        '<div class="item">
                            <div class="content">
                               <p>' . $value["name"] . ' ' . $value["lastname"] . '<a class="right">show</a></p>
                            </div>
                         </div>';}
                echo $output; ?>
            </div>
        </div>

        <div id="login" hidden="true">
            <form class="ui form" method="post" action="phonebook.php">
                <div class="field">
                    <label>Username</label>
                    <input type="text" name="login">
                </div>
                <div class="field">
                    <label>Password</label>
                    <input type="text" name="password">
                </div>
                <button class="ui inverted yellow button" type="submit" id="buttonlogin">Login</button>
            </form>


            <div hidden="<?php echo $flag;?>">
                <?php echo $error; ?>
            </div>
        </div>
    </div>

</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#clicklogin").click(function () {
                $("#login").show(400);
                $("#mainmenu").hide();
            });
            $("#clickmain").click(function () {
                $("#mainmenu").show(400);
                $("#login").hide();
            });
        })
    </script>
</body>
</html>