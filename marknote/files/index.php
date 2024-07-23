<?php
	error_reporting(0);
	//ini_set('display_errors', '1');

	if( !file_exists('config.php') ){
		header("Location: include/install.php");
		exit();
	}

	require 'include/user.php';


	if(hasLogin()){
		// echo 'load '.$type.' page ---> ';
		require 'edit.php';
	}
	else{
		// echo 'load '.$type.' page ---> ';
		require 'login.php';
	}
