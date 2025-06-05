<!-- if file is in any folder use ../root.php -->
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title id="page-title"></title>
     <!-- including external links -->
     <?php //include($external_links_loc); 
     ?>

     <!-- stylesheet files -->
     <link rel="stylesheet" href="<?php //echo base_url()  . 'assets/css_js/style.css'; 
                                   ?>">
     <link rel="stylesheet"
          href="<?php ////echo 'http://localhost\eaglebyte\hpcl_in_out\hpcl_in_out\assets\css_js\style.css'; 
                    ?>">


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
     <link rel="stylesheet" href="<?php echo base_url() . 'assets/css_js/style.css'; ?> ">
     <style>
          .alert-box {
               display: none;
          }
     </style>
</head>


<!-- filename -->
<?php
//$filename = "drivergate.php";
?>

<body>

     <?php // include "maingatecontent.php"; 
     ?>
     <div class="container-fluid">
          <div class="bg-secondary d-flex flex-lg-row flex-md-row flex-column justify-content-between rounded px-3 mb-3  mx-4">
               <div class="logo-div pt-2 pb-2 d-flex justify-content-center">
                         <img src="<?php echo base_url() . 'assets/images/iocllogo.png'; ?>" alt="" class="rounded img-fluid"
                              style="height: 40px; background-color: #bababa;">
               </div>
               <div class="title-div">
                    <p class="text-center align-center mt-4">
                         <span class="label label-default fs-4 bg-primary">
                              Truck Main Gate
                         </span>
                    </p>
               </div>
               <div class="time-div" style="width: 300px; z-index: 1">
                    <p class="text-light text-center mt-3 me-3 fs-2 ">&nbsp;<span id="digiclock"
                              class="fs-3 fw-normal bg-primary label label-default"></span></p>
                    <!-- including clock script -->
                    <script>
                         function startTime() {
                              var today = new Date();
                              var now = new Date();
                              var h = today.getHours();
                              var m = today.getMinutes();
                              var s = today.getSeconds();

                              var month = String(now.getMonth() + 1).padStart(2, '0');
                              var day = String(now.getDate()).padStart(2, '0');
                              var year = now.getFullYear();
                              var dateString = `${day}/${month}/${year}`;

                              // var date = today.getDate();
                              // var month = today.getMonth();
                              // var year = today.getFullYear();
                              m = checkTime(m);
                              s = checkTime(s);
                              document.getElementById('digiclock').innerHTML =
                                   "NOW: " + dateString + " " + "@" + " " + h + ":" + m + ":" + s;
                              var t = setTimeout(startTime, 500);
                         }

                         function checkTime(i) {
                              if (i < 10) {
                                   i = "0" + i;
                              } // add zero in front of numbers < 10
                              return i;
                         }
                         startTime();
                    </script>
               </div>
          </div>

          <!-- container-fluid -->
          <div class="mb-2 mx-4">
               <form action="" method="post" class="mb-3" id="myForm">
                    <input type="text" name="qr-field" id="qr-field" placeholder="Your QR code" class="form-control" required>
                    <p id="message" class="fs-3"></p> <!-- Message will be displayed here -->
               </form>
          </div>

          <!-- Error boxes here -->
          <div class="row">
               <div class="col-12">
                    <div id="error-box" class="alert-box alert alert-danger alert-dismissible fade in">
                         <!-- <a href="<?php // //echo $filename; 
                                        ?>"> -->
                         <button class="close" data-dismiss="alert" aria-label="close"
                              onclick="window.location.replace('')">&times;</button><?php //echo $filename; 
                                                                                     ?>
                         <!-- </a> -->
                         <strong id="stre"></strong> <span>
                              <?php //echo $error_message; 
                              ?>
                         </span>
                    </div>
                    <div id="success-box" class="alert-box alert alert-success alert-dismissible fade in">
                         <!-- <a href="<?php // //echo $filename; 
                                        ?>"> -->
                         <button class="close" data-dismiss="alert" aria-label="close"
                              onclick="window.location.replace('')">&times;</button><?php //echo $filename; 
                                                                                     ?>
                         <!-- </a> -->
                         <strong id="strs"></strong> <span>
                              <?php //echo $error_message; 
                              ?>
                         </span>
                    </div>
               </div>
          </div>
     </div>
     <div class="container-fluid"><!--  ps-5 pe-5 pt-5 -->
          <!-- main gate section -->
          <!-- container-fluid ends here -->

          <?php $this->load->view('gates/drivergatecontent'); ?>
     </div>
     <script>
          function checkqr() {
               const qr_code = document.getElementById('qr-field').value.trim();
               window.location.href = 'adddrivergate.php?qc=' + qr_code;
          }
     </script>
     <script>
          document.getElementById('page-title').innerHTML = "Truck Main Gate";
     </script>



     <script>
          document.getElementById('qr-field').addEventListener('input', function(event) {
               const uniqueValue = event.target.value; // Get the input value

               // Show a loading message while fetching
               document.getElementById('message').textContent = "Checking...";

               // Create a timeout to show an error message if the request takes longer than 2 seconds
               const timeout = setTimeout(() => {
                    document.getElementById('message').textContent = "Record not found or request took too long.";
               }, 2000); // 2 seconds

               // Fetch request to check if the record exists
               fetch('<?php echo base_url('DriverMainGate/GetExistRecord'); ?>?unique_value=' + uniqueValue, {
                         method: 'GET',
                         headers: {
                              'Content-Type': 'application/json',
                         }
                    })
                    .then(response => response.json()) // Parse the JSON response
                    .then(data => {
                         // Clear the timeout if the request completes in time
                         clearTimeout(timeout);

                         console.log(data);

                         // Display the appropriate message
                         document.getElementById('message').textContent = data.message; // Show the message from the response

                         // Clear the input field value after submission
                         document.getElementById('qr-field').value = '';
                         setTimeout(() => {
                              document.getElementById('message').textContent = '';
                         }, 2000);
                    })
                    .catch(error => {
                         // Clear the timeout in case of an error
                         clearTimeout(timeout);

                         console.error('Error:', error);
                         document.getElementById('message').textContent = "Invalid Qr.";

                         // Clear the input field value after error
                         document.getElementById('qr-field').value = '';
                         setTimeout(() => {
                              document.getElementById('message').textContent = '';
                         }, 2000);
                    });
          });
     </script>

     <script>
          const myTimeout = setTimeout(myGreeting, 3000);

          function myGreeting() {
               if (document.getElementById("error-box").style.display == "block" || document.getElementById("success-box").style.display == "block") {
                    document.getElementById("error-box").style.display = "none";
                    document.getElementById("success-box").style.display = "none";
                    window.location.href = "drivergate.php";
               }
          }
     </script>

     <!-- Bootstrap JS (optional, only needed if you use Bootstrap components that require JavaScript) -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
          crossorigin="anonymous"></script>

     <!-- Font Awesome JS (optional, only needed if you use Font Awesome icons) -->
     <script src="https://kit.fontawesome.com/6ee00b2260.js" crossorigin="anonymous"></script>

     <!-- Custom JavaScript -->
     <script>
          // JavaScript to toggle sidebar
          document.getElementById('sidebar-toggle').addEventListener('click', function() {
               document.querySelector('.wrapper').classList.toggle('sidebar-open');
               document.querySelector('.wrapper').classList.toggle('sidebar-closed');
          });
     </script>
</body>

</html>