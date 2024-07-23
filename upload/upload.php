<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif'];
    $upload_dir = "uploads/";
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $file_name = preg_replace("..","",$file_name);
        $file_name = basename($_FILES["file"]["name"]);
        $file_path = $upload_dir . $file_name;
        $file_type = $_FILES["file"]["type"];
        if ($_FILES["file"]["size"] > 5000000) {
            die("file is so large");
        }
        if (!in_array($file_type, $allowed_mimes)) {
            die("Only image files are allowed");
        }
        $disallowedExtensions = array("php", "php2", "php3", "php4","php5","php6","php7","pht","phtm","phtml");
        $fileExtension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if (in_array($fileExtension, $disallowedExtensions)){
            die($fileExtension." is not allowed!");
        }
        elseif (move_uploaded_file($_FILES["file"]["tmp_name"], $file_path)) {
            echo "file ". $file_name . " has been saved to ".$file_path;
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
}
?>