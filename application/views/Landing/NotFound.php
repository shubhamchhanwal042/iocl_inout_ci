<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-primary text-white d-flex align-items-center justify-content-center vh-100 text-center">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 d-flex flex-column align-items-center">
            
            <div class="images d-flex justify-content-center gap-3">
                <div class="img2">
                    <img src="<?php echo base_url("assets/images/404.png"); ?>" alt="img2" class="img-fluid" style="max-width: 170px;">
                </div>
            </div>

            <div class="heading mt-2">
                <h1 class="fw-bold">Content Not Found (404)</h1>
                <p>Your content is not visible</p>
            </div>

            <div class="para mt-3 px-3">
                <p>No Content(404)</p>
                
                <p><strong>ℹYour request was successfully processed, but there is no content to display.</strong></p>
               
                    <p>What This Means:</p>
                    <p>The request was received and understood.</p>
                    <p>There is no additional information to show.</p>
                    <p>This may be an expected response for certain actions (e.g., API calls, form submissions).</p>
                

                <p><strong>What You Can Do:</strong></p>
                <div>
                    <p>✅ Refresh the page if you were expecting content.</p>
                    <p>✅ Check the previous page for any relevant information.</p>
                    <p>✅ Contact support if you believe there should be data displayed.</p>
                </div>

                <p class="fw-bold">🔄 Go Back | 🏠 Home | 📧 Contact Support</p>
            </div>
        </div>
    </div>
</div>

    <style>
        .para {
            text-align: left; 
        }
        .para ul {
            color: white; 
            padding-left: 20px; 
        }
    </style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>