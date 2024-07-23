<?php
error_reporting(0);
require_once("config.php");
$username = $_POST['username'];
$password = $_POST['password'];
if(!isset($username)){
    die("username is empty.");
}
if(!isset($password)){
    die("password is empty.");
}
if(isset($username) and isset($password)){
    $username = preg_replace('/select|union|and|or|sleep|benchmark|\'| /im','',$username);
    $password = preg_replace('/select|union|and|or|sleep|benchmark|\'| /im','',$password);
    $sql = "SELECT * FROM users where username='$username' and password='$password'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_array();
    if($row){
        die("Login Success, Welcome Admin!");
    }else{
        die("Login Fail!");
    }
}
