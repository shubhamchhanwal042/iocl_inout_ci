<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title id="page-title"></title>
     <!-- including external links -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


     <?php $this->load->view("include/CssIncludes"); ?>

     <style>
          .set-bg {
               background-color: #493cff;
          }
     </style>

</head>


<body>

     <!-- content for login page -->
     <section class="container-fluid set-bg">
          <p class="mt-1 h2 fw-bold text-center text-white"><span class="text-uppercase">IOCL INOUT SYSTEM</span></p>
     </section>

     <section class="container-fluid mt-5 ">
          <div class="d-flex justify-content-center row">
               <div class="login-form-div col-lg-5">
                    <form action="<?php echo base_url("Main/LoginValidationPost"); ?>" method="post"
                         class="set-bg d-block px-3 rounded">
                         <div class="label">
                              <p class="text-left h1 fw-bold"><span
                                        class="border-bottom border-light border-4 pb-2">Login&nbsp;&nbsp;</span></p>
                         </div>
                         <div class="d-none" id="error-box">
                              <div class="alert alert-danger">
                                   <strong>Error:</strong> <span id="error-msg">Password not matched</span>
                              </div>
                         </div>
                         <div class="fields mx-2 pb-5">
                              <div class="usernamefield">
                                   <p class="fs-4 fw-bold text-white"><label for="#user-field">Username</label></p>
                                   <input type="text" name="username" id="userfield" oninput="ws(this.id)" class="form-control bg-white">
                              </div>

                              <div class="passwordfield mt-3">
                                   <p class="fs-4 fw-bold text-white"><label for="#password">Password</label></p>
                                   <div class="d-flex">
                                        <input type="password" name="password" oninput="ws(this.id)" id="password"
                                             class="form-control bg-white">
                                        <span class="toggle-password mt-2 ms-3" id="togglePassword" height='30'
                                             width='30'>
                                             <i class="fa-solid fa-eye" style="color: white"></i>
                                        </span>
                                   </div>
                              </div>

                              <div class="login-btn mt-3">
                                   <button type="submit" onclick="validateForm()" id="submitbtn"
                                        class="btn btn-light">Login</button>
                                   <!-- <input type="submit" value="Login" name="login" onclick="validateForm()" id="submitbtn" class="btn btn-light"> -->
                              </div>
                         </div>
                    </form>
               </div>
          </div>
     </section>

     <script>

          // document.addEventListener("DOMContentLoaded", function () {
          const passwordField = document.getElementById("password");
          const togglePassword = document.getElementById("togglePassword");

          togglePassword.addEventListener("click", function () {
               // Toggle the type attribute
               const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
               passwordField.setAttribute("type", type);

               // Toggle the icon
               // this.textContent = type === "password" ? "<i class='fa-solid fa-eye-slash'></i>" : "<i class='fa-solid fa-eye' style='color: white'></i>";
          });
          // });

     </script>
     <script>
          document.getElementById('page-title').innerHTML = "IOCL  INOUT | Login";
     </script>


     <!-- Bootstrap JS (optional, only needed if you use Bootstrap components that require JavaScript) -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
          crossorigin="anonymous"></script>

<script>
     document.addEventListener('DOMContentLoaded', function() {
          <?php if ($this->session->flashdata('error')) { ?>
          Swal.fire({
               icon: 'error', // 'success' or 'error'
               title: '<?= $this->session->flashdata('error'); ?>',
               confirmButtonColor: '#3085d6',
               confirmButtonText: 'OK'
          });
          <?php } ?>
     });
</script>

<script>
     function ws(name) {
        var name = document.getElementById(name);
        name.value = name.value.replace(/^\s+/, '');

    }
</script>
</body>

</html>

