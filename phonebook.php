<?php
session_start();
include 'index.php';
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
    </header>
    <br>
    <br>
    <br>
<div class="inner">
    <div class="ui inverted pointing menu">
        <a class="item" id="click">
            Public phonebook
        </a>
        <a class="item" id="click1">
            Login
        </a>
    </div>
    <div class="ui segment" id="block">
        <?php include 'ajaxpublic.php';
      $login=login();
      if(!empty($login)){
          logincheck($login);
      }
        ?>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#click').click(function () {
                $('#block').html('')
                $.ajax({
                    url:"ajaxpublic.php",
                    success: function(data) {
                        $('#block').html(data);
                    }
                })
            })
            $('#click1').click(function () {
                $('#block').html('')
                $.ajax({
                    url:"ajaxlogin.html",
                    success: function(data) {
                        $('#block').html(data);
                    }
                })
            })
        })
    </script>
</body>
</html>