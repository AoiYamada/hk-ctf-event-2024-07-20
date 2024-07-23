<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image storage website</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h1 class="neon-text">Image storage website</h1>
    <form id="uploadForm" enctype="multipart/form-data" class="upload-form">
        <label for="upload" class="neon-text">Upload an image:</label>
        <input type="file" id="upload" name="upload" accept="image/*" class="input-field">
        <button type="submit" class="neon-button">Upload</button>
    </form>
    <form action="download.php" method="get" class="download-form">
        <label for="file" class="neon-text">Enter the file name to download:</label>
        <input type="text" id="file" name="file" class="input-field">
        <button type="submit" class="neon-button">Download</button>
    </form>

    <div id="imagePreview" class="image-preview">
    </div>
</div>

<script src="script.js"></script>
</body>
</html>
