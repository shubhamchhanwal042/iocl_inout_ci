<!DOCTYPE html>
<html>
<head>
    <title>Face Entry System</title>
    <script defer src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
    <style>
        #video {
            width: 640px;
            height: 480px;
            border: 1px solid #333;
        }
    </style>
</head>
<body>
    <h1>qqq</h1>
    <video id="video" width="640" height="480" autoplay muted></video>
    <p id="status">Loading models...</p>

    <script>
        const video = document.getElementById('video');
        video.width = 640;
        video.height = 480;
        const status = document.getElementById('status');

        // Load face-api models
        Promise.all([
            faceapi.nets.tinyFaceDetector.loadFromUri('/assets/models'),
            faceapi.nets.faceRecognitionNet.loadFromUri('/assets/models'),
            faceapi.nets.faceLandmark68Net.loadFromUri('/assets/models')
        ]).then(startVideo);

        function startVideo() {
            navigator.mediaDevices.getUserMedia({ video: {} })
                .then(stream => {
                    video.srcObject = stream;
                    status.innerText = "Camera loaded.";
                })
                .catch(err => {
                    console.error(err);
                    status.innerText = "Failed to access webcam.";
                });
        video.addEventListener('play', async () => {
            const labeledDescriptors = await loadLabeledImages();
            const faceMatcher = new faceapi.FaceMatcher(labeledDescriptors, 0.6);

            const canvas = faceapi.createCanvasFromMedia(video);
            document.body.append(canvas);
            const displaySize = { width: video.width, height: video.height };
            faceapi.matchDimensions(canvas, displaySize);

            setInterval(async () => {
                const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
                    .withFaceLandmarks().withFaceDescriptors();
                const resizedDetections = faceapi.resizeResults(detections, displaySize);
                canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);

                if (resizedDetections && resizedDetections.length > 0) {
                    const results = resizedDetections.map(d =>
                        faceMatcher.findBestMatch(d.descriptor)
                    );

                    results.forEach((result, i) => {
                        const box = resizedDetections[i].detection.box;
                        const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() });
                        drawBox.draw(canvas);

                        if (result.label !== 'unknown') {
                            // Log entry only once
                            if (!window.logged) {
                                window.logged = true;
                                fetch('<?= base_url("entry/log_entry") ?>', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded',
                                    },
                                    body: 'name=' + encodeURIComponent(result.label)
                                }).then(res => res.json()).then(data => {
                                    alert('Access granted for ' + result.label);
                                });
                            }
                        }
                    });
                }
            }, 2000);
        function loadLabeledImages() {
            const labels = ['John Doe', 'Jane Smith']; // Your training subjects
            return Promise.all(
                labels.map(async label => {
                    const descriptions = [];
                    for (let i = 1; i <= 1; i++) {
                        const img = await faceapi.fetchImage(`/assets/labeled_images/${label}/${i}.jpg`);
                        const detection = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor();
                        if (detection && detection.descriptor) {
                            descriptions.push(detection.descriptor);
                        }
                    }
                    return new faceapi.LabeledFaceDescriptors(label, descriptions);
                })
            );
        }
                    return new faceapi.LabeledFaceDescriptors(label, descriptions);
                })
                
        }
    </script>
</body>
</html>
