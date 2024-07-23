<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload'])) {
    $uploadFile = $_FILES['upload'];

    if ($uploadFile['error'] !== UPLOAD_ERR_OK) {
        die("Upload failed with error code " . $uploadFile['error']);
    }

    $uploadDir = __DIR__ . '/uploads/';

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $fileType = mime_content_type($uploadFile['tmp_name']);

    if (!in_array($fileType, $allowedTypes)) {
        die("Only JPG, PNG, and GIF files are allowed.");
    }

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $fileExtension = strtolower(pathinfo($uploadFile['name'], PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedExtensions)) {
        die("Only JPG, JPEG, PNG, and GIF files are allowed.");
    }

    $randomName = uniqid('img_') . '.' . $fileExtension;
    $uploadPath = $uploadDir . $randomName;

    if (move_uploaded_file($uploadFile['tmp_name'], $uploadPath)) {
        $relativePath = '/uploads/' . $randomName;

        $responseData = [
            'message' => "File uploaded successfully.",
            'filePath' => $relativePath,
            'filename' => $randomName
        ];

        header('Content-Type: application/json');
        echo json_encode($responseData);
        exit;
    } else {
        die("Failed to move uploaded file.");
    }
} else {
    die("No file uploaded.");
}
?>
