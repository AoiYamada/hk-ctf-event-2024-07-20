<?php
include_once("header.php");
if(!isset($_SESSION['userinfo'])) {
    header("Location: login.php");
    die();
}
$userinfo = $_SESSION["userinfo"];
$id = isset($id) ? $id : $userinfo['id'];

?>
<div class="container">
<?php
$dbh = new PDO(DSN, DB_USER, DB_PASSWD);
$sql = "select * from user where id = :id";
$sth = $dbh->prepare($sql);
$sth->execute(array(':id'=>$id));
$res = $sth->fetch(PDO::FETCH_ASSOC);
if($res === false) {
    echo "<h3>wooops, 404 found!</h3>";
} else {
    echo "<h3>" . $res['username'] . ", role: " . ($res['role'] ? "user" : "admin") . "</h3>";
}
if($userinfo["username"] === 'admin') {
    echo "<h3>flag{xxxxxx}</flag>";
}
?>
</div>
<?php include_once("footer.php"); ?>