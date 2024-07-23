<?php
include_once("header.php");
?>
    <div class="container" style="max-width:500px;">
        <form method="post" action="do_register.php">
            <div class="form-group">
                <label for="username">username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="username" />
            </div>
            <div class="form-group">
                <label for="password">password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="password" />
            </div>
            <button class="btn btn-primary btn-block">register</button>
        </form>
    <!-- container -->
<?php include_once("footer.php"); ?>