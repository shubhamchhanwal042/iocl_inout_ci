<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .para {
            text-align: left; /* Align text to the left */
        }
        .para ul {
            color: white; /* Make bullet points white */
            padding-left: 20px; /* Proper alignment for bullet points */
        }
    </style>
</head>

<body class="bg-primary text-white d-flex align-items-center justify-content-center vh-100 text-center">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 d-flex flex-column align-items-center">

            <!-- Images -->
            <div class="images d-flex justify-content-center gap-3">
                <div class="img1">
                    <img src="<?php echo base_url("assets/images/restriction.png"); ?>" alt="img1" class="img-fluid" style="max-width: 170px;">
                </div>
            </div>

            <!-- Heading -->
            <div class="heading mt-4">
                <h1 class="fw-bold">Access Forbidden (403)</h1>
                <p>You can't access this page</p>
            </div>

            <!-- Paragraphs -->
            <div class="para mt-3 px-3">
                <p>🚫 You do not have permission to access this page.</p>

                <p><strong>Possible Reasons:</strong></p>
                <ul>
                    <li>You are not authorized to view this resource.</li>
                    <li>Your account does not have the required permissions.</li>
                    <li>The page may have been moved or restricted.</li>
                    <li>You may have attempted an unauthorized action.</li>
                </ul>

                <p><strong>What You Can Do:</strong></p>
                <ul class="list-unstyled">
                    <li>✅ Check if you are logged in. Try signing in with an authorized account.</li>
                    <li>✅ Contact the Administrator. If you believe this is a mistake, reach out for assistance.</li>
                    <li>✅ Return to the Homepage. Navigate back and try accessing a different section.</li>
                </ul>

                <p class="fw-bold">🔄 Go Back | 🏠 Home | 📧 Contact Support</p>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
