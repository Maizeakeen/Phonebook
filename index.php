<?php
session_start();

$user = 'root';
$pass = '';
try {
    $dbh = new PDO('mysql:host=localhost;dbname=countries;', $user, $pass);
} catch (PDOException $e) {
    echo $e->getMessage();
}

function login(){
     if (!empty($_POST['login'])&&!empty($_POST['password'])) {
$login=["login"=>$_POST['login'],"password"=>$_POST['password']];
        }else {
         ?>
         <script>
             $('#block').html('')
         </script>
         <?php include 'ajaxlogin.html';

         ?>
         <div class="ui warning message">
             <i class="close icon"></i>
             <div class="header">
                 Введите логин и пароль!
             </div>
         </div><?php
         return;
     }
     return $login;
}

function logincheck($login){

}