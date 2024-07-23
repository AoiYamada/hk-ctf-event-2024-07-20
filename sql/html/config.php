<?php
$hostname = "127.0.0.1";
$dbuser = "root";
$dbpass = "root";
$database = "ctf";
$mysqli = new mysqli($hostname, $dbuser, $dbpass, $database);
if ($mysqli->connect_error) {
    die("连接失败，错误:" . $mysqli->connect_error);
}

