<!-- name: uday anil patil || date: 08-05-2024 -->
<!-- this file only contains theme which can be used in every executing file -->
<!-- start copy file from here -->

<!-- including root file -->

<!-- if file is in any folder use ../root.php -->
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title id="page-title"></title>
     <!-- including external links -->

     <!-- bootstrap links -->
     <link rel="icon" href="<?php echo base_url() . 'assets/images/iocl.png'; ?>" type="image/gif" sizes="16x16">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

     <link rel="icon" href="<?php echo base_url() . 'assets/images/iocl.png'; ?>" type="image/gif" sizes="16x16">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

     <!-- javascript files -->
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

     <!-- SweetAlert library -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

     <!-- bootstrap files -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

     <!-- font awesome file -->
     <script src="https://kit.fontawesome.com/6ee00b2260.js" crossorigin="anonymous"></script>

     <!-- google fonts -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">

     <!-- <script src="http://localhost/hpcl_in_out_mahul/logout.js"></script> -->
     <script src="<?php echo base_url() . 'logout.js'; ?> "></script>

     <!-- stylesheet files -->
     <link rel="stylesheet" href="<?php echo base_url() . 'assets/css_js/style.css'; ?> ">
     <link rel="stylesheet"
          href="<?php //echo 'http://localhost\eaglebyte\hpcl_in_out\hpcl_in_out\assets\css_js\style.css'; 
                    ?>">

     <!-- including config file to use database -->
     <?php // include($config_loc); 
     ?>

     <style>
          .success-alert {
               display: none;
          }

          .danger-alert {
               display: none;
          }

          @media screen and (max-width: 576px) {
               .card-container {
                    flex-direction: row;
               }
          }
     </style>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/powerbi-client/2.19.0/powerbi.js"></script>

</head>

<body>

     <div class="wrapper d-flex overall-body">

          <!-- including sidebar -->
          <?php $this->load->view('include/sidebar'); ?>

          <!-- <div class="main-content"> -->
          <div class="container-fluid">
               <!-- container-fluid -->

               <!-- including navbar -->
               <?php $this->load->view('include/navbar'); ?>

               <!-- Page Content -->
               <div class="container-fluid">
                    <div id="error-box" class="alert alert-danger" style="display: none;">Aadhar no already exist</div>

                    <div class="card border-0 shadow mt-4">
                         <div class="card-body">

                              <form method="post" id="myform"
                                   action="<?php echo base_url() . 'Driver/UpdateTransporter'; ?>"
                                   enctype="multipart/form-data">
                                   <?php if ($transporter) { ?>

                                        <input type="hidden" name="id" value="<?php echo $transporter['id']; ?> "
                                             class="form-control">

                                        <div class="row mt-2">
                                             <div class="col-md-12 mb-4">


                                                  <label for="token_no">Token Number :</label>
                                                  <input type="text" name="token_no" value="<?php echo $transporter['id']; ?>"
                                                       class="form-control" placeholder="Token Number" readonly>
                                             </div>
                                        </div>

                                        <div class="row">
                                             <div class="col-md-12 mb-4">
                                                  <label for="aadhar_no">Aadhar Number :</label>
                                                  <input type="text" name="aadhar_no" class="form-control" id="aadhar_no" oninput="this.value=this.value.replace(/[^0-9]/g,'');" size="12" minlength="12" maxlength="12" value="<?php echo $transporter['aadhar_no']; ?>" placeholder="Enter Aadhar Number">
                                                  <span id="aadharerror" style="color: red;"></span>
                                             </div>

                                        </div>

                                        <div class="row">
                                             <div class="col-md-12 mb-4">
                                                  <label for="full_name">Full Name :</label>
                                                  <input type="text" name="full_name" class="form-control" id="full_name"
                                                       oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'');ws(this.id);"

                                                       value="<?php echo $transporter['full_name']; ?>" placeholder="Enter Full Name">
                                                  <span id="nameerror" style="color: red;"></span>

                                             </div>
                                        </div>

                                        <div class="row">
                                             <div class="col-md-12 mb-4">
                                                  <label for="mobile_no">Mobile Number :</label>
                                                  <input type="text" name="mobile_no" id="mobile_no"
                                                       oninput="this.value=this.value.replace(/[^0-9]/g,'')" size="10"
                                                       minlength="10" maxlength="10" class="form-control"
                                                       value="<?php echo $transporter['mobile_no']; ?>" placeholder="Enter Mobile Number">
                                                  <span id="contacterror" style="color: red;"></span>
                                             </div>
                                        </div>


                                        <div class="row">
                                             <div class="col-md-12 mb-4">
                                                  <label for="address">Address :</label>
                                                  <textarea name="address" class="form-control" rows="3" id="address" oninput="this.value=this.value.replace(/[^a-z\sA-Z0-9,.-]/g,'');ws(this.id);"
                                                       placeholder="Enter Address" required><?php echo $transporter['address']; ?></textarea>
                                                  <span id="addrerror" style="color: red;"></span>


                                             </div>
                                             <div class="col-md-12 mb-4">
                                                  <label for="firm_name">Firm Name :</label>
                                                  <input type="text" name="firm_name" class="form-control"
                                                       oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'')"
                                                       value="<?php echo $transporter['firm_name']; ?>" placeholder="Enter Firm Name" required>
                                                  <span id="firmerror" style="color: red;"></span>

                                             </div>
                                             <div class="col-md-12 mb-4">
                                                  <label for="truck_no">Truck No :</label>
                                                  <input type="text" name="truck_no" id="truck_no"
                                                       oninput="this.value=this.value.replace(/[^a-zA-Z0-9\s]/g, '');ws(this.id);"
                                                       class="form-control" value="<?php echo $transporter['truck_no']; ?>" placeholder="Enter Truck No" required>
                                                  <span id="truckerror" style="color: red;"></span>

                                             </div>

                                             <div class="row mb-4 ps-4">
                                                  <label for="photo" class="ps-4">Capture Photo:</label>
                                                  <div class="col-md-6">
                                                       <div id="camera-feed">
                                                            <video id="video" width="320" height="240" autoplay></video>
                                                            <small id="photoValidation" class="error text-danger"></small>

                                                       </div>
                                                       <button type="button" class="btn btn-primary" id="capture-btn"
                                                            onclick="capturePhoto()">Capture</button>
                                                       <input type="hidden" id="photo" name="photo"
                                                            value="<?php echo $transporter['photo'] ?>">
                                                       <input type="hidden" id="new_photo" name="new_photo" value="">

                                                  </div>
                                                  <div class="col-md-6">
                                                       <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>
                                                       <div id="pic">
                                                            <img src="<?php echo base_url() . $transporter['photo']; ?>" alt=""
                                                                 width="320" height="240">
                                                       </div>
                                                       <br><br>
                                                  </div>
                                             </div>

                                             <!-- //capture id photo -->
                                             <div class="row mb-4 ps-4">
                                                  <label for="photo" class="ps-4">Capture ID Photo:</label>
                                                  <div class="col-md-6">
                                                       <div id="camera-feedid">
                                                            <video id="videoid" width="320" height="240" autoplay></video>
                                                            <small id="photoValidationid" class="error text-danger"></small>

                                                       </div>
                                                       <button type="button" class="btn btn-primary" id="capture-btnid"
                                                            onclick="capturePhotoId()">Capture</button>
                                                       <input type="hidden" id="photoid" name="id_proof"
                                                            value="<?php echo $transporter['id_proof'] ?>">
                                                       <input type="hidden" id="new_photoid" name="new_photoid" value="">

                                                  </div>
                                                  <div class="col-md-6">
                                                       <canvas id="canvasid" width="320" height="240" style="display:none;"></canvas>
                                                       <div id="picid">
                                                            <img src="<?php echo base_url() . $transporter['id_proof']; ?>" alt=""
                                                                 width="320" height="240">
                                                       </div>
                                                       <br><br>
                                                  </div>
                                             </div>

                                        </div>
                                        <div class="d-grid gap-2 d-sm-block">
                                             <div>
                                                  <button type="submit" class="btn btn-primary" id="submit">
                                                       <i class="fa-solid fa-floppy-disk"></i>
                                                       Update
                                                  </button>
                                                  <a class="btn btn-secondary" href="<?php echo base_url() . 'OprId/' . $transporter['id'] . '/transporter'; ?>">
                                                       <i class="fa-solid fa-id-card"></i>
                                                       Id Card
                                                  </a>
                                                  <a href="<?php echo base_url() . 'Transporter' ?>" class="btn btn-danger">
                                                       <i class="fa-solid fa-arrow-left"></i>
                                                       Back
                                                  </a>
                                                  <button class="btn btn-danger" name="drop" onclick="confirmDelete(event);">
                                                       <i class="fa-solid fa-user-xmark"></i>
                                                       Drop
                                                  </button>
                                             </div>
                                        </div>

                                   <?php } ?>

                              </form>
                         </div>
                    </div>

               </div> <!-- container-fluid ends -->
               <!-- </div> -->

          </div>
          <!-- refresh code -->

          <!-- Custom JavaScript -->

          <!-- Custom JavaScript -->
          <script>
               navigator.mediaDevices.getUserMedia({
                         video: true
                    })
                    .then(function(stream) {
                         var video = document.getElementById('video');
                         video.srcObject = stream;
                         video.play();
                    })
                    .catch(function(err) {
                         console.log("An error occurred: " + err);
                    });

               function capturePhoto() {
                    var video = document.getElementById('video');
                    var canvas = document.getElementById('canvas');
                    var context = canvas.getContext('2d');
                    canvas.width = 320;
                    canvas.height = 240;

                    context.drawImage(video, 0, 0, 320, 240);
                    var photo = canvas.toDataURL('image/png');

                    // document.getElementById('photo').value = photo;
                    document.getElementById('new_photo').value = photo; // Set flag indicating new photo captured
                    document.getElementById('pic').style.display = "none";
                    canvas.style.display = 'block';
                    photoValidation.style.display = 'none'; // Hide the error message 

               }
          </script>


          <!-- ID capture photo -->
          <script>
               navigator.mediaDevices.getUserMedia({
                         video: true
                    })
                    .then(function(stream) {
                         var video = document.getElementById('videoid');
                         video.srcObject = stream;
                         video.play();
                    })
                    .catch(function(err) {
                         console.log("An error occurred: " + err);
                    });

               function capturePhotoId() {
                    var video = document.getElementById('videoid');
                    var canvas = document.getElementById('canvasid');
                    var context = canvas.getContext('2d');
                    canvas.width = 320;
                    canvas.height = 240;

                    context.drawImage(video, 0, 0, 320, 240);
                    var photoid = canvas.toDataURL('image/png');

                    // document.getElementById('photoid').value = photo;
                    document.getElementById('new_photoid').value = photoid; // Set flag indicating new photo captured
                    document.getElementById('picid').style.display = "none";
                    canvas.style.display = 'block';
                    photoValidation.style.display = 'none'; // Hide the error message 

               }
          </script>

          <!-- script for idcard generation button ends -->
          <!-- Bootstrap JS (optional, only needed if you use Bootstrap components that require JavaScript) -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
               integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
               crossorigin="anonymous"></script>

          <!-- Font Awesome JS (optional, only needed if you use Font Awesome icons) -->
          <script src="https://kit.fontawesome.com/6ee00b2260.js" crossorigin="anonymous"></script>

          <!-- giving title to document and navbar -->
          <script>
               document.getElementById('page-title').innerHTML = "IOCL  INOUT | Transporter";
               document.getElementById('navbar-title').innerHTML = "Edit Transporter Form <i class='fa-solid fa-users'></i>";
          </script>

          <!-- Custom JavaScript -->
          <script>
               // JavaScript to toggle sidebar
               // document.getElementById('sidebar-toggle').addEventListener('click', function () {
               //      document.querySelector('.wrapper').classList.toggle('sidebar-open');
               //      document.querySelector('.wrapper').classList.toggle('sidebar-closed');
               // });
               document.getElementById('sidebar-toggle').addEventListener('click', function() {
                    document.querySelector('.wrapper').classList.toggle('sidebar-open');
                    document.querySelector('.wrapper').classList.toggle('sidebar-closed');
               });
          </script>

          <script>
               //validation by sonal 25/06/2024

               // Validation functions
               function ws(name) {
                    var name = document.getElementById(name);
                    name.value = name.value.replace(/^\s+/, '');
               }

               function validateAadharNo() {
                    var aadharnoField = document.getElementById("aadhar_no");
                    var errorElement = document.getElementById("aadharerror");
                    if (aadharnoField.value.length < 12) {
                         errorElement.textContent = "Aadhar number should be 12 digits.";
                         return false;
                    } else {
                         errorElement.textContent = "";
                         return true;
                    }
               }

               function validateContact() {
                    var contactField = document.getElementById("mobile_no");
                    var errorElement = document.getElementById("contacterror");
                    if (contactField.value.length < 10) {
                         errorElement.textContent = "Mobile Number should be at least 10 digits.";
                         return false;
                    } else {
                         errorElement.textContent = "";
                         return true;
                    }
               }

               function validateName() {
                    var nameField = document.getElementById("full_name");
                    var errorElement = document.getElementById("nameerror");
                    if (nameField.value.trim() === "") {
                         errorElement.textContent = "Fill Out This Field";
                         return false;
                    } else {
                         errorElement.textContent = "";
                         return true;
                    }
               }

               function validateAddr() {
                    var addrField = document.getElementById("address");
                    var errorElement = document.getElementById("addrerror");
                    if (addrField.value.trim() === "") {
                         errorElement.textContent = "Fill Out This Field";
                         return false;
                    } else {
                         errorElement.textContent = "";
                         return true;
                    }
               }

               function validateFirm() {
                    var firmField = document.getElementById("firm_name");
                    var errorElement = document.getElementById("firmerror");
                    if (firmField.value.trim() === "") {
                         errorElement.textContent = "Fill Out This Field";
                         return false;
                    } else {
                         errorElement.textContent = "";
                         return true;
                    }
               }

               function validateTruck() {
                    var truckField = document.getElementById("truck_no");
                    var errorElement = document.getElementById("truckerror");

                    if (truck.trim() == "") {
                         errorElement.textContent = "Fill Out This Field";
                         return false;
                    } else {
                         errorElement.textContent = "";
                         return true;

                    }
               }

               // Form submission validation
               const form = document.getElementById('myform');
               form.addEventListener('submit', (event) => {
                         if (!validateAadharNo() || !validateContact() || !validateName() || !validateAddr() || !validateFirm() || !validateTruck()) {
                              event.preventDefault();
                         }
                    // event.preventDefault();
                    // window.location.href = "<?php echo base_url() . 'TransporterIdCard'; ?>";
               });
          </script>



          <!-- JS for delete confirmation -->
          <script>
               function confirmDelete(event) {
                    event.preventDefault(); // Prevent default button action

                    Swal.fire({
                         title: 'Are you sure?',
                         text: "You won't be able to revert this!",
                         icon: 'warning',
                         showCancelButton: true,
                         confirmButtonColor: '#d33',
                         cancelButtonColor: '#3085d6',
                         confirmButtonText: 'Yes, delete it!',
                         cancelButtonText: 'Cancel'
                    }).then((result) => {
                         if (result.isConfirmed) {
                              // Proceed with redirection or deletion
                              window.location.href = "<?php echo base_url() . 'DropTransporter/' . $transporter['id']; ?>"; // Replace with your delete action or URL
                         } else {
                              // Optionally, handle cancel logic here if needed
                         }
                    });
               }
          </script>

          <!-- <-----------Aadhar exist Timeout msg-------------->
          <script>
               const myTimeout = setTimeout(myGreeting, 3000);

               function myGreeting() {
                    document.getElementById("error-box").style.display = "none";
                    // document.getElementById("success-box").style.display = "none";
                    // window.location.href = "mainGate.php";
               }
          </script>
</body>

</html>