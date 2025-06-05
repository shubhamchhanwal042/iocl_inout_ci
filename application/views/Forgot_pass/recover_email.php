<?php
// Include the PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Database connection (Ensure this file exists and is correctly configured)
include 'partials/dbconnect.php';

$msg = ''; // Initialize message variable

if (isset($_REQUEST['pwdrst'])) {
    $email = $_REQUEST['email'];

    // Check if the email exists in the database
    $check_email = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");
    $res = mysqli_num_rows($check_email);

    if ($res > 0) {
        $message = '<div>
            <p><b>Hello!</b></p>
            <p>You are receiving this email because we received a password reset request for your account.</p>
            <br>
            <p><button class="btn btn-primary"><a href="http://localhost/loginsystem/passwordreset.php?secret=' . base64_encode($email) . '">Reset Password</a></button></p>
            <br>
            <p>If you did not request a password reset, no further action is required.</p>
        </div>';

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // SMTP credentials
            $mail->Username   = 'htcnishavarade@gmail.com'; // Enter your SMTP username
            $mail->Password   = 'yeyj vupk unha tnsg';    // Enter your SMTP password or App Password

            // Email settings
            $mail->setFrom('htcnishavarade@gmail.com', 'Nisha Varade');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Reset Password';
            $mail->Body    = $message;

            // Enable verbose debug output
          //  $mail->SMTPDebug = 2; // 1 = errors and messages, 2 = messages only

            // Send the email
            $mail->send();
            $msg = 'We have e-mailed your password reset link!Check your mail inbox/spam';
        } catch (Exception $e) {
            $msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $msg = "We can't find a user with that email address";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>SignUp</title>
    <style>
        body {
            font-family:  montserrat;
            /* background-color: #E5F1FB; */
            display: flex;
            align-items: center;
            justify-content: center;
         
        }
        .card-body {
            background-color: #f9f9f9;
            /* padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); */
        }
        .login-header {
            margin-bottom: 20px;
        }
        /* .btn-primary {
            width: 100%;
        } */
        .btn {
            color: black;
            background-color: #30aecf;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card justify-content-center h-75 w-50 mx-auto">
        <div class="card-body">
            <h1 class="login-header text-center text-dark">Recover Your Email</h1>
            <form method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" placeholder="abc@gmail.com" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="pwdrst" value="Send Password Reset Link" class="btn btn-primary w-50"/>
                </div>
                <p class="error"><?php echo $msg; ?></p>
            </form>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
