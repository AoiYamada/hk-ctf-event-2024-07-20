<?php
include_once("common.php");
if(!isset($_SESSION["userinfo"])) {
    header("Location: login.php");
    die();
}
$userinfo = $_SESSION["userinfo"];
if($old_pass = $userinfo['password']) {
	if($userinfo["username"] == "admin") {
		echo "flag{xxxxxx}";
		die();
	}
    $dbh = new PDO(DSN, DB_USER, DB_PASSWD);
    $sql = "update user set password = :password where id=:id";
    $sth = $dbh->prepare($sql);
    $res = $sth->execute((array(':password'=>$new_pass, ':id'=>$userinfo['id'])));
    if($res === false) {
        header("Location: error.php?msg=changepass%20error!");
        die();
    }
    $userinfo["password"] = $new_pass;
    $_SESSION['userinfo'] = $userinfo;
    header("Location: index.php");
} else {
    header("Location: error.php?msg=invalid%20old%20pass!");
    die();
}
?>