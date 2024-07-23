// script.js

document.addEventListener('DOMContentLoaded', function() {
    const uploadForm = document.getElementById('uploadForm');
    const imagePreview = document.getElementById('imagePreview');

    uploadForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(uploadForm);

        fetch('upload.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                imagePreview.innerHTML = '';

                const message = document.createElement('p');
                message.textContent = data.message;
                message.classList.add('neon-text');
                imagePreview.appendChild(message);

                if (data.filePath && data.filename) {
                    const previewLink = document.createElement('a');
                    previewLink.href = data.filePath;
                    previewLink.target = "_blank";
                    const previewImg = document.createElement('img');
                    previewImg.src = data.filePath;
                    previewImg.alt = data.filename;
                    previewImg.classList.add('preview-img');
                    previewLink.appendChild(previewImg);
                    imagePreview.appendChild(previewLink);
                }
            })
            .catch(error => console.error('Error:', error));
    });
});
