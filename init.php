<?php
session_start();

$user = 'root';
$pass = '';
try {
    $dbh = new PDO('mysql:host=localhost;dbname=countries;', $user, $pass);
} catch (PDOException $e) {
    echo $e->getMessage();
}

function showusers($dbh){
    $sql = "SELECT * FROM users ";
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchALL();
    } catch (PDOException $e) {
        print $e->getMessage();
    }
    return $data;
}

function login($dbh,$login,$password){
    $sql = "SELECT * FROM users WHERE login=? AND password=?";
    $flag=false;
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(1, $login, PDO::PARAM_STR);
        $stmt->bindParam(2, $password, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchALL();
    } catch (PDOException $e) {
        print $e->getMessage();
    }
if(!empty($data)){
    $_SESSION['userid']=$data[0]['id'];
    $flag=true;
}

    return $flag;
}

function getUser($dbh){
    require_once 'User.php';
if(!empty($_SESSION['userid'])){
    $sql = "SELECT * FROM users WHERE id=?";
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(1, $_SESSION['userid'], PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchALL();
    } catch (PDOException $e) {
        print $e->getMessage();
    }

    $user=new User();
    $user->login=$data[0]['login'];
    $user->password=$data[0]['password'];
    $user->name=$data[0]['name'];
    $user->lastname=$data[0]['lastname'];
    $user->id=$data[0]['id'];
    $user->city=$data[0]['city'];
    $user->street=$data[0]['street'];
    $user->country=$data[0]['country'];
}else{
    return null;
}


return $user;
}