<?php
// download.php

$filename = basename($_GET['file']);

$filepath = __DIR__ . '/uploads/' . $filename;

if (file_exists($filepath)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $filepath . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filepath));
    
    ob_clean();
    flush();
    
    readfile($filepath);
    exit;
} else {
    echo "File not found.";
}
?>
