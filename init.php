<?php
session_start();

$user = 'root';              //конект к БД
$pass = '';
try {
    $dbh = new PDO('mysql:host=localhost;dbname=countries;', $user, $pass);
} catch (PDOException $e) {
    echo $e->getMessage();
}

function showusers($dbh)
{
    $sql = "SELECT * FROM users";
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchALL();
    } catch (PDOException $e) {
        print $e->getMessage();
    }
    return $data;
}

function showcountries($dbh)
{
    $sql = "SELECT * FROM countries";
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchALL();
    } catch (PDOException $e) {
        print $e->getMessage();
    }
    return $data;
}

function showuserphone($dbh, $id)
{
    $sql = "SELECT phone FROM phone WHERE id=? AND flag=1";
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchALL();
    } catch (PDOException $e) {
        print $e->getMessage();
    }
    return $data;
}

function showuseremail($dbh, $id)
{
    $sql = "SELECT email FROM email WHERE id=? AND flag=1";
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchALL();
    } catch (PDOException $e) {
        print $e->getMessage();
    }
    return $data;
}

function login($dbh, $login, $password)
{
    $sql = "SELECT * FROM users WHERE login=? AND password=?";
    $flag = false;
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(1, $login, PDO::PARAM_STR);
        $stmt->bindParam(2, $password, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchALL();
    } catch (PDOException $e) {
        print $e->getMessage();
    }
    if (!empty($data)) {
        $_SESSION['userid'] = $data[0]['id'];
        $flag = true;
    }
    return $flag;
}

function getUser($dbh)
{
    require_once 'User.php';
    if (empty($_SESSION['userid'])) {
        return null;
    }
    require_once 'User.php';
    $sql = "SELECT * FROM users WHERE id=?";
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(1, $_SESSION['userid'], PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchALL();
    } catch (PDOException $e) {
        print $e->getMessage();
    }
    $user = new User();
    $user->login = $data[0]['login'];
    $user->password = $data[0]['password'];
    $user->name = $data[0]['name'];
    $user->lastname = $data[0]['lastname'];
    $user->id = $data[0]['id'];
    $user->city = $data[0]['city'];
    $user->street = $data[0]['street'];
    $user->country = $data[0]['country'];
    return $user;
}


function myphone($dbh)
{
    if (empty($_SESSION['userid'])) {
        return null;
    }
    $sql = "SELECT phone,flag FROM phone WHERE id=?";
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(1, $_SESSION['userid'], PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchALL();
    } catch (PDOException $e) {
        print $e->getMessage();
    }

    foreach ($data as $key => $value) {
        $output[] = $value;
    }
    return $output;
}

function myemail($dbh)
{
    if (empty($_SESSION['userid'])) {
        return null;
    }
    $sql = "SELECT email,flag FROM email WHERE id=?";
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(1, $_SESSION['userid'], PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchALL();
    } catch (PDOException $e) {
        print $e->getMessage();
    }

    foreach ($data as $key => $value) {
        $output[] = $value;
    }
    return $output;
}

function updateuserdata($dbh, $postdata)
{
    if (empty($_SESSION['userid'])) {
        return null;
    }
    $sql = "UPDATE users SET name=?,lastname=?,street=?,city=?,country=? WHERE id=?";
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(1, $postdata['name'], PDO::PARAM_STR);
        $stmt->bindParam(2, $postdata['lastname'], PDO::PARAM_STR);
        $stmt->bindParam(3, $postdata['street'], PDO::PARAM_STR);
        $stmt->bindParam(4, $postdata['city'], PDO::PARAM_STR);
        $stmt->bindParam(5, $postdata['country'], PDO::PARAM_STR);
        $stmt->bindParam(6, $_SESSION['userid'], PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        print $e->getMessage();
    }
    return;
}


function insertphone($dbh, $postdata)
{
    if (empty($_SESSION['userid'])) {
        return null;
    }
    $dsql = "DELETE FROM phone WHERE id=?";
    try {
        $stmt = $dbh->prepare($dsql);
        $stmt->bindParam(1, $_SESSION['userid'], PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        print $e->getMessage();
    }
    $i = 0;
    foreach ($postdata['phone'] as $out) {
        $outdata[$i]['phone'] = $out;
        $outdata[$i]['flagp'] = $postdata['flagp'][$i];
        $i++;
    }


    foreach ($outdata as $key => $value) {
        if ($value['phone'] != '') {
            $sql = "INSERT INTO phone(id,phone,flag) VALUES (?,?,?)";
            $outphone = $value['phone'];
            $outflag = $value['flagp'];
            try {
                $stmt = $dbh->prepare($sql);
                $stmt->bindParam(1, $_SESSION['userid'], PDO::PARAM_INT);
                $stmt->bindParam(2, $outphone, PDO::PARAM_STR);
                $stmt->bindParam(3, $outflag, PDO::PARAM_INT);
                $stmt->execute();
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
    }
    return;
}

function insertemail($dbh, $postdata)
{
    if (empty($_SESSION['userid'])) {
        return null;
    }
    $dsql = "DELETE FROM email WHERE id=?";
    try {
        $stmt = $dbh->prepare($dsql);
        $stmt->bindParam(1, $_SESSION['userid'], PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        print $e->getMessage();
    }
    $i = 0;
    foreach ($postdata['email'] as $out) {
        $outdata[$i]['email'] = $out;
        $outdata[$i]['flage'] = $postdata['flage'][$i];
        $i++;
    }

    foreach ($outdata as $key => $value) {
        if ($value['email'] != '') {
            $sql = "INSERT INTO email(id,email,flag) VALUES (?,?,?)";
            $outemail = $value['email'];
            $outflag = $value['flage'];
            try {
                $stmt = $dbh->prepare($sql);
                $stmt->bindParam(1, $_SESSION['userid'], PDO::PARAM_INT);
                $stmt->bindParam(2, $outemail, PDO::PARAM_STR);
                $stmt->bindParam(3, $outflag, PDO::PARAM_INT);
                $stmt->execute();
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
    }
    return;
}

