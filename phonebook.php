<?php
include 'init.php';
if (isset($_POST['login']) && isset($_POST['password'])) {          //Проверка введёных данных и вход
    $flag = login($dbh, $_POST['login'], $_POST['password']);
}
if (isset($_POST['rlogin']) && isset($_POST['rpassword'])) {          //Проверка введёных данных и регистрация
    $flag = registr($dbh, $_POST['rlogin'], $_POST['rpassword']);
}
if (!empty($_POST['name'])) {             //Изменения данных пользователя
    updateuserdata($dbh, $_POST);
    insertphone($dbh, $_POST);
    insertemail($dbh, $_POST);
}
if (!empty($_SESSION['userid'])) {    //Получение данных залогиненого пользователя в класс User
    $user = getUser($dbh);
    $user->phone = myphone($dbh);
    $user->email = myemail($dbh);
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
    <?php if (!empty($_SESSION['userid'])) { ?>
        <div class="rightbutton"><a class="ui secondary button" href="logout.php">
                Logout
            </a></div>
    <?php } ?>
</header>
<br>
<br>
<br>
<div class="inner">
    <div class="ui inverted pointing menu">
        <!--Меню выбора разделов-->
        <?php include 'menu.php'; ?>
    </div>

    <div class="ui segment">
        <div id="mainmenu">
            <!--Главная страница с данными пользователей-->
            <?php include 'mainmenu.php'; ?>
        </div>

        <div id="login" hidden="true">
            <!--Страница логина-->
            <?php include 'login.php'; ?>
        </div>

        <div id="contact" hidden="true">
            <!--Страница с данными залогиненого пользователя-->
            <?php include 'tablecontact.php'; ?>
        </div>

        <div id="registr" hidden="true">
            <!--Страница с данными залогиненого пользователя-->
            <?php include 'registr.php'; ?>
        </div>

    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
<script>
    $(document).ready(function () {
        $("#clicklogin").click(function () {  //Переключение между пунктами меню
            $("#login").show(400);
            $("#mainmenu").hide();
            $("#registr").hide();
        });
        $("#clickmain").click(function () {
            $("#mainmenu").show(400);
            $("#login").hide();
            $("#contact").hide();
            $("#registr").hide();
        });
        $("#clickcontact").click(function () {
            $("#contact").show(400);
            $("#mainmenu").hide();
        });
        $("#clickregistr").click(function () {  //Переключение между пунктами меню
            $("#registr").show(400);
            $("#mainmenu").hide();
            $("#login").hide();
        });


    $('.item').each(function (index) {  // Всплывающие окна с расшириными данными пользователей
        $(".show" + index).click(function () {
            $("#userdata" + index).show(400);
            $(".show" + index).hide();
            $(".hide" + index).show(400);
        });
        $(".hide" + index).click(function () {
            $("#userdata" + index).hide(400);
            $(".show" + index).show(400);
            $(".hide" + index).hide();
        });
    });

        var countp=0;
        $('.countp').each(function () {
            countp++;
        });
        var counte=0;
        $('.counte').each(function () {
            counte++;
        });

    $("#addp").click(function () {     //Добавление полей для ввода телефонов и почты
        $("#phonetable").append(
            '<tr>'
            + '<td>'
            + '<div class="inline field">'
            + '<div class="ui toggle checkbox">'
            + '<input type="checkbox" name="flagp['+countp+']" tabindex="0" class="hidden" value="1">'
            + '<label>Publish field</label>'
            + '</div>'
            + '</div>'
            + '<input style="margin-top: 5px" name="phone['+countp+']" type="text">'
            + '</td>'
            + '</tr>'
        )
        countp++;
        $('.ui.checkbox')
            .checkbox();
    });
    $("#adde").click(function () {
        $("#emailtable").append(
            '<tr>'
            + '<td>'
            + '<div class="inline field">'
            + '<div class="ui toggle checkbox">'
            + '<input type="checkbox"  name="flage['+counte+']" tabindex="0" class="hidden" value="1">'
            + '<label>Publish field</label>'
            + '</div>'
            + '</div>'
            + '<input style="margin-top: 5px" type="text" name="email['+counte+']">'
            + '</td>'
            + '</tr>'
        )
        counte++;
        $('.ui.checkbox')
            .checkbox();
    });
    $('.ui.checkbox')
        .checkbox();
    })
</script>
</body>
</html>