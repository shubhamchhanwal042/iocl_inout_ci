<?php
include 'partials/dbconnect.php';

$msg = ''; // Initialize message variable
$success = '';

if (isset($_REQUEST['pwdrst'])) {
    $email = $_REQUEST['email'];
    $pwd = $_REQUEST['pwd'];
    $cpwd = $_REQUEST['cpwd'];

    // Ensure passwords match
    if ($pwd === $cpwd) {
        // Update the user's password in plain text
        $escaped_pwd = mysqli_real_escape_string($conn, $pwd); // Escape for SQL
        $reset_pwd = mysqli_query($conn, "UPDATE users SET password='$escaped_pwd' WHERE email='$email'");

        if ($reset_pwd) {
            $success = 'Your password has been updated successfully. You will be redirected shortly.';
        } else {
            $msg = "Error while updating password.";
        }
    } else {
        $msg = "Password and Confirm Password do not match";
    }
}

if (isset($_GET['secret'])) {
    $email = base64_decode($_GET['secret']);
    $check_details = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");
    $res = mysqli_num_rows($check_details);

    if ($res > 0) {
        // Display the password reset form
        ?>
<!DOCTYPE html>
<html>  
<head>  
    <title>Password Reset</title>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
</head>
<style>
     body {
        font-family: montserrat;
     }
 .box {
  width:100%;
  max-width:600px;
  background-color:#f9f9f9;
  border:1px solid #ccc;
  border-radius:5px;
  padding:16px;
  margin:0 auto;
 }
 input.parsley-success,
 select.parsley-success,
 textarea.parsley-success {
   color: #468847;
   background-color: #DFF0D8;
   border: 1px solid #D6E9C6;
 }

 input.parsley-error,
 select.parsley-error,
 textarea.parsley-error {
   color: #B94A48;
   background-color: #F2DEDE;
   border: 1px solid #EED3D7;
 }

 .parsley-errors-list {
   margin: 2px 0 3px;
   padding: 0;
   list-style-type: none;
   font-size: 0.9em;
   line-height: 0.9em;
   opacity: 0;

   transition: all .3s ease-in;
   -o-transition: all .3s ease-in;
   -moz-transition: all .3s ease-in;
   -webkit-transition: all .3s ease-in;
 }

 .parsley-errors-list.filled {
   opacity: 1;
 }
 
 .parsley-type, .parsley-required, .parsley-equalto {
  color:#ff0000;
 }
.error {
  color: red;
  font-weight: 700;
} 
.success {
  color: green;
  font-weight: 700;
} 
</style>
<body>
<div class="container">  
    <div class="table-responsive">  
    <h3 align="center">Reset Password</h3><br/>
    <div class="box">
     <form id="validate_form" method="post" >  
      <input type="hidden" name="email" value="<?php echo $email; ?>"/>
      <div class="form-group">
       <label for="pwd">Password</label>
       <input type="password" name="pwd" id="pwd" placeholder="Enter Password" required class="form-control"/>
      </div>
      <div class="form-group">
       <label for="cpwd">Confirm Password</label>
       <input type="password" name="cpwd" id="cpwd" placeholder="Enter Confirm Password" required class="form-control"/>
      </div>
      <div class="form-group">
       <input type="submit" id="login" name="pwdrst" value="Reset Password" class="btn btn-success" />
       </div>
       
       <p class="error"><?php if (!empty($msg)) { echo $msg; } ?></p>
       <p class="success" id="success-msg"><?php if (!empty($success)) { echo $success; } ?></p>
     </form>
     </div>
   </div>  
  </div>

  <?php if (!empty($success)) { ?>
  <script>
      setTimeout(function() {
          window.location.href = 'login.php';
      }, 3000); // Redirect after 2 seconds
  </script>
  <?php } ?>
</body>
</html>
<?php 
    }
} 
?>
