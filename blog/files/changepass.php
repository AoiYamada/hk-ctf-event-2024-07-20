<?php
include_once("header.php");
if(!isset($_SESSION["userinfo"])) {
    header("Location: login.php");
}
?>
    <div class="container" style="max-width:500px;">
        <form method="post" action="do_changepass.php">
            <div class="form-group">
                <label for="old-password">old-password</label>
                <input type="password" name="old_pass" id="old-password" class="form-control" placeholder="old-password" />
            </div>
            <div class="form-group">
                <label for="new-password">new-password</label>
                <input type="password" name="new_pass" id="new-password" class="form-control" placeholder="new-password" />
            </div>
            <button class="btn btn-primary btn-block">change</button>
        </form>
    <!-- container -->
<?php include_once("footer.php"); ?>