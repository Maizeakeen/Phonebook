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
}

if(!empty($_POST['name'])){
    updateuserdata($dbh,$_POST);
    insertphone($dbh,$_POST);
    insertemail($dbh,$_POST);
}

if(!empty($_SESSION['userid']))
{
    $user=getUser($dbh);
    $user->phone=myphone($dbh);
    $user->email=myemail($dbh);
}


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stylep.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body class="ui inverted segment">
    <header>
        <div class="logo"><a href="phonebook.php">Phonebook</a></div>
        <?php if(!empty($_SESSION['userid'])){?>
        <div class="rightbutton"><a class="ui secondary button" href="logout.php">
                Logout
            </a></div>
        <?php }?>
    </header>
    <br>
    <br>
    <br>
<div class="inner">
    <div class="ui inverted pointing menu">
        <?php include 'menu.php';?>
    </div>

    <div class="ui segment">
        <div id="mainmenu">
        <?php include 'mainmenu.php';?>
        </div>

        <div id="login" hidden="true">
            <?php include 'login.php'; ?>
        </div>


        <div id="contact" hidden="true">
           <?php include 'tablecontact.php';?>
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
                $("#contact").hide();
            });
            $("#clickcontact").click(function () {
                $("#contact").show(400);
                $("#mainmenu").hide();
            });

                $(".show").click(function () {
                    $("#userdata").show(400);
                    $(".show").hide();
                    $(".hide").show(400);
                });
                $(".hide").click(function () {
                    $("#userdata").hide(400);
                    $(".show").show(400);
                    $(".hide").hide();
                });

            $("#addp").click(function () {
                $("#phonetable").append(
                    '<tr>'
                    +'<td>'
                    +'<div class="inline field">'
                    +'<div class="ui toggle checkbox">'
                    +'<input type="checkbox" name="flagp[]" tabindex="0" class="hidden">'
                    +'<label>Publish field</label>'
                    +'</div>'
                    +'</div>'
                    +'<input style="margin-top: 5px" name="phone[]" type="text">'
                    +'</td>'
                    +'</tr>'
                )
            });

            $("#adde").click(function () {
                $("#emailtable").append(
                    '<tr>'
                    +'<td>'
                    +'<div class="inline field">'
                    +'<div class="ui toggle checkbox">'
                    +'<input type="checkbox"  name="flage[]" tabindex="0" class="hidden">'
                    +'<label>Publish field</label>'
                    +'</div>'
                    +'</div>'
                    +'<input style="margin-top: 5px" name="email[]"  type="text">'
                    +'</td>'
                    +'</tr>'
                )
            });


            $('.ui.checkbox')
                .checkbox()
            ;
        })
    </script>
</body>
</html>