const form = document.getElementById('upload-form');
    const videoInput = document.getElementById('video-input');
    const status = document.getElementById('upload-status');
    const percentage = document.getElementById('upload-percentage');
    const uploadInfo = document.getElementById('upload-info');
    const browseLabel = document.getElementById('browse-label');
    const uploadError = document.getElementById('upload-error');

    videoInput.addEventListener('change', function() {
    const file = videoInput.files[0];

    if (file.size > maxFileSize) {
        uploadError.classList.remove('hidden');
        return;
    }

        const formData = new FormData(form);
        const xhr = new XMLHttpRequest();

        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                const percentComplete = (e.loaded / e.total) * 100;
                percentage.innerText = percentComplete.toFixed(2) + '%';
            }
        });

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    percentage.innerText = 'Finalizing...';
                    setTimeout(() => {
                        window.location.href = xhr.responseURL;
                    }, 1000);
                } else {
                    alert('Failed to upload video.');
                }
            }
        };

        xhr.open('POST', 'upload.php', true);
        xhr.send(formData);

        status.classList.remove('hidden');
        uploadInfo.classList.add('hidden');
        browseLabel.classList.add('hidden');
        uploadError.classList.add('hidden');
    });
    document.getElementById('menu-toggle').addEventListener('click', function() {
            var menu = document.getElementById('menu');
            if (menu.style.display === 'none' || menu.style.display === '') {
                menu.style.display = 'block';
            } else {
                menu.style.display = 'none';
            }
        });

        window.addEventListener('resize', function() {
            var menu = document.getElementById('menu');
            if (window.innerWidth >= 768) {
                menu.style.display = 'none';
            }
        });