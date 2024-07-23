<?php
include_once("common.php");
$dbh = new PDO(DSN, DB_USER, DB_PASSWD);
$sql = "select * from user where username = :username and password = :password";
$sth = $dbh->prepare($sql);
$sth->execute(array(':username'=>$username, ':password'=>$password));
$res = $sth->fetch(PDO::FETCH_ASSOC);
if($res === false) {
    header("Location: error.php?msg=invalid%20password!");
    die();
}
$userinfo["id"] = $res["id"];
$userinfo["username"] = $username;
$userinfo["password"] = $password;
$userinfo["role"] = $res["role"];
$_SESSION["userinfo"] = $userinfo;
header("Location: index.php");
?>