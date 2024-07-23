<?php
define("DB_NAME", "ctf");
define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASSWD", "");
define("DSN", "mysql:host=".DB_HOST.";dbname=".DB_NAME);
ini_set("display_errors", "On");
error_reporting(0);

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

session_start();
