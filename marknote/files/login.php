<?php
  error_reporting(0);
	require_once 'include/user.php';

    session_start();
    $captcha_pass=false;
	if(isset($_POST['type'])){

		if( $_POST['type'] == 'login' ){
				login($_POST['username'], $_POST['passwd']);
				
		}
		if( $_POST['type'] == 'register' ){
				register($_POST['username'], $_POST['passwd'], $_POST['nickname']);
				echo 'register succsefull';
		}

		if( $_POST['type'] == 'logout' ){
			logout();
		}
	}

	if(hasLogin()){
		header("location: ./"); 
	}else{
		if(!(isset($_GET['t']) && $_GET['t'] == 'register') ){

		?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta charset="utf-8" />
				<title>MarkNote</title>
				<meta http-equiv="X-UA-Compatible" content="IE=edge" />
				<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

				<link rel="stylesheet" type="text/css" href="include/css/login.css">
			</head>
			<body>
				<h1 class="title">Log In to MarkNote</h1>

				<form method="POST" action="login.php">
					Enter username
					<input class="input-text"	type="text"		name="username" autofocus="autofocus" />
					Enter password
					<input class="input-text"	type="password"	name="passwd" />
                                  
					<input class="input-btn"	type="submit"	name="submit"	value="LOGIN" />
					<input type="hidden"		name="type"		value="login" />

				</form>

				<p style="text-align: center;"><a href="login.php?t=register">No account? Register here.</a></p>

			</body>
			</html>
		<?php }else{ 
        
        ?>
				<!DOCTYPE html>
				<html>
				<head>
					<meta charset="utf-8" />
					<title>MarkNote</title>
					<meta http-equiv="X-UA-Compatible" content="IE=edge" />
					<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

					<link rel="stylesheet" type="text/css" href="include/css/login.css">
				</head>
				<body>
					<h1 class="title">Register to MarkNote</h1>

					<form method="POST" action="login.php">
						Enter username(4-32 chars):
						<input class="input-text"	type="text"		name="username" autofocus="autofocus"/>
						Enter nickname:
						<input class="input-text"	type="text"		name="nickname" />
						Enter password(6-32 chars):
						<input class="input-text"	type="password"	name="passwd" />

						<input class="input-btn"	type="submit"	name="submit" value="REGISTER" />

						<input type="hidden"	name="type"		value="register">
					</form>

					<p style="text-align: center;"><a href="./">Have account? Login here.</a></p>

				</body>
				</html>
		<?php } ?>
	<?php }