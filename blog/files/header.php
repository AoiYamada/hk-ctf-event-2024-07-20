<?php include_once("common.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><Star></Star>Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="register.php">register</a>
                    </li>
                    <li>
                        <a href="login.php">login</a>
                    </li>
                    <li>
                        <?php
                            if(isset($_SESSION["userinfo"])) {
                                echo "<a href=\"logout.php\">logout</a></li>";
                                echo "<li><a href=\"changepass.php\">change pass</a></li>";
                                $userinfo = $_SESSION["userinfo"];
                                echo "<li><a href=\"user.php?id={$userinfo["id"]}\">". htmlspecialchars($userinfo["username"]) . "</a></li>";                             
                            } else {
                                echo "<a href=\"logout.php\">logout</a></li>";
                            }
                        ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</html>