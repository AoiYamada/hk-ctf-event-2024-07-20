<?php
include_once("common.php");
$dbh = new PDO(DSN, DB_USER, DB_PASSWD);
$sql = "select * from user where username = :username";
$sth = $dbh->prepare($sql);
$sth->execute(array(':username'=>$username));
$res = $sth->fetch(PDO::FETCH_ASSOC);
if($res !== false) {
    header("Location: error.php?msg=username%20has%20been%20used!");
    die();
}
$sql = "insert into user (username, password, role) values(:username, :password, 1)";
$sth = $dbh->prepare($sql);
$res = $sth->execute(array(':username'=>$username, ':password'=>$password));
if($res === false) {
    header("Location: error.php?msg=register%20error!");
    die();
}

$sql = "select * from user where username = :username and password = :password";
$sth = $dbh->prepare($sql);
$sth->execute(array(':username'=>$username, ':password' => $password));
$res = $sth->fetch(PDO::FETCH_ASSOC);
if($res === false) {
    header("Location: error.php?msg=register%20error!");
    die();
}
$userinfo["id"] = $res["id"];
$userinfo["username"] = $username;
$userinfo["password"] = $password;
$_SESSION["userinfo"] = $userinfo;
$userinfo["role"] = $res["role"];
header("Location: index.php");
?>