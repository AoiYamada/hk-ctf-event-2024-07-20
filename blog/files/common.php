<?php
define("DB_NAME", "ctf");
define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASSWD", "");
define("DSN", "mysql:host=".DB_HOST.";dbname=".DB_NAME);
ini_set("display_errors", "On");
error_reporting(0);
foreach (array('_COOKIE','_POST','_GET') as $_request)  
{
    foreach ($$_request as $_key=>$_value)  
    {
        $$_key=  $_value;
    }
}
session_start();
?>
