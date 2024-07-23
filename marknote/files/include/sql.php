<?php
	require dirname(__FILE__).'/../config.php';

	function checkUsername($theUsername){
		return preg_match("/^\\w{4,32}$/",$theUsername);
	}
  function checkPassword($theUsername){
		return preg_match("/^\\w{6,32}$/",$theUsername);
	}

	function checkID($theID){
		return preg_match("/^\\d{1,32}$/",$theID);
	}

	function checkTitle($theTitle){
		return preg_match("/^(?!_|\\s\\')[A-Za-z0-9_\\.\\-\\x80-\\xff\\s\\']{1,256}$/",$theTitle);
	}

	function checkEmail($theEmail){
		return preg_match("/^[\\w-]+(\\.[\\w-]+)*@[\\w-]+(\\.[\\w-]+)+$/",$theEmail);
	}

	function json_encode_fix($input){
		if(version_compare(PHP_VERSION, '5.4.0', '>=')){
			return json_encode($input, JSON_UNESCAPED_UNICODE);
		}else{
			$input = json_encode_fix_array($input);
			return urldecode(json_encode($input));
		}
	}

	function json_encode_fix_array($array){
		foreach($array as $key => $value) {
			if(is_string($value)){
				$array[$key] = urlencode($value);
			}
			if(is_array($value)){
				$array[$key] = json_encode_fix_array($value);
			}
		}
		return $array;
	}


	// $sql = new mysqli($sql_host, $sql_user, $sql_passwd, $sql_name);



    $conn = new PDO("mysql:host=$sql_host;dbname=$sql_name", $sql_user, $sql_passwd);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
