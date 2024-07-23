<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif'];
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif']; // Explicitly allowed file extensions
    $upload_dir = "uploads/";
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $file_name = basename($_FILES["file"]["name"]);
        // Sanitize the file name to prevent directory traversal or other exploits
        $file_name = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", $file_name);
        $file_path = $upload_dir . $file_name;
        $file_type = $_FILES["file"]["type"];
        if ($_FILES["file"]["size"] > 5000000) {
            die("file is too large");
        }
        if (!in_array($file_type, $allowed_mimes)) {
            die("Only image files are allowed");
        }
        $fileExtension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowed_extensions)) {
            die($fileExtension . " files are not allowed!");
        }
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $file_path)) {
            echo "file " . $file_name . " has been saved to " . $file_path;
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
}
?>