


<!-- if file is in any folder use ../root.php -->
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title id="page-title"></title>
     <!-- including external links -->
     <?php //include($external_links_loc); ?>


 
     
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
    <script src="<?php echo base_url().'logout.js';?> "></script>









     <!-- stylesheet files -->
     <link rel="stylesheet" href="<?php echo base_url() . 'assets/css_js/style.css' ?>">
     <!-- <link rel="stylesheet" href="<?php echo base_url() . 'assets/css_js/style_new.css' ?>"> -->

     <link rel="stylesheet"
          href="<?php ////echo 'http://localhost\eaglebyte\hpcl_in_out\hpcl_in_out\assets\css_js\style.css'; ?>">

     <!-- including config file to use database -->
     <?php //include($config_loc); ?>
     <style>
          .alert-box {
               display: none;
          }
     </style>
</head>

<!-- filename -->

<body>

     <?php // include "maingatecontent.php"; ?>
      <!-- <div class="container-fluid"> -->
     <div class="container-fluid">
     <div class="bg-secondary d-flex justify-content-between mb-3 rounded">
          <div class="logo-div pt-2 pb-2 ps-2">
               <a href="">
                    <img src="https://manasvi.tech/demo/assest/img/logos/hpcl_logo.png" alt="" class="rounded img-fluid"
                         style="height: 40px; background-color: #bababa;">
               </a>
          </div>
          <div class="title-div">
               <p class="text-center align-center mt-4">
                    <span class="label label-default fs-4 bg-danger"><?php  echo"Assembly Gate"; ?></span>
               </p>
          </div>
          <div class="time-div">
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
                         if (i < 10) { i = "0" + i; }  // add zero in front of numbers < 10
                         return i;
                    }
                    startTime();
               </script>
          </div>
     </div>

     <!-- container-fluid -->
     <div class="row mb-2">
          <form action="" method="post" class="col-lg-12 mb-3">
               <input type="text" name="qr-field" id="qr-field" placeholder="Your QR code" class="form-control"
                    oninput="this.form.submit()"> <!-- checkqr(); -->
          </form>
          <!-- <button class="form-control btn btn-outline-dark p-0 ">Reset Count</button> -->
     </div>
     <div class="row">
          <div class="col-12">
               <div id="error-box" class="alert-box alert alert-danger alert-dismissible fade in">
                    <!-- <a href="<?php // //echo $filename; ?>"> -->
                         <button class="close" data-dismiss="alert" aria-label="close" onclick="window.location.replace('<?php //echo $filename; ?>')">&times;</button>
                    <!-- </a> -->
                    <strong id="stre"></strong> <span>
                         <?php //echo $error_message; ?>
                    </span>
               </div>
               <div id="success-box" class="alert-box alert alert-success alert-dismissible fade in">
                    <!-- <a href="<?php // //echo $filename; ?>"> -->
                         <button class="close" data-dismiss="alert" aria-label="close" onclick="window.location.replace('<?php //echo $filename; ?>')">&times;</button>
                    <!-- </a> -->
                    <strong id="strs"></strong> <span>
                         <?php //echo $error_message; ?>
                    </span>
               </div>
          </div>
     </div>

</div>


     <div class="container-fluid ps-5 pe-5 pt-5"><!-- ps-5 pe-5 -->
     <!-- main gate section -->
      <div class="">
          <p class="text-center">
               <span class="h4">TOTAL <span class="fw-bolder">IN</span> COUNT</span>
               <span class="label label-default fs-4 bg-primary">Main Gate</span>
          </p>

          <!-- rows -->
          <div class="row row-cols-5">
               <div class="col mb-3">
                    <!-- col -->
                    <!-- col-sm-2 -->

                    <div class="card pe-2">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9 pe-0">
                                        <p class="card-title fs-4 fw-bolder text-danger">OPERATION</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo $maingate_operation_count; ?>
                                             </span></p>

                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-calendar-days"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-primary">DRIVER</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo $maingate_driver_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-truck"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-warning">PROJECT</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo $maingate_project_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2 pe-4">
                                        <span><i class="fa-solid fs-1 fa-id-card"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-muted">VISITOR</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo $maingate_visitor_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-users"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title text-danger fs-4 fw-bolder">TOTAL</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo ($maingate_operation_count + $maingate_driver_count + $maingate_project_count + $maingate_visitor_count); ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <!-- <span><i class="fa-solid fa-calendar-days"></i></span> -->
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <!-- main gate section ends here -->


     <div class="mt-4">
          <p class="text-center">
               <span class="h4">TOTAL <span class="fw-bolder">IN</span> COUNT</span>
               <span class="label label-default fs-4 bg-danger">License Area</span>
          </p>

          <!-- rows -->
          <div class="row row-cols-5">
               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-2">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9 pe-0">
                                        <p class="card-title fs-4 fw-bolder text-danger">OPERATION</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo $licensegate_operation_count; ?>
                                             </span></p>

                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-calendar-days"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-primary">DRIVER</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo $licensegate_driver_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-truck"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-warning">PROJECT</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo $licensegate_project_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2 pe-4">
                                        <span><i class="fa-solid fs-1 fa-id-card"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-muted">VISITOR</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo $licensegate_visitor_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-users"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title text-danger fs-4 fw-bolder">TOTAL</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo ($licensegate_operation_count + $licensegate_driver_count + $licensegate_project_count + $licensegate_visitor_count); ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <!-- <span><i class="fa-solid fa-calendar-days"></i></span> -->
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>


     <div class="mt-4">
          <p class="text-center">
               <span class="h4">TOTAL <span class="fw-bolder">IN</span> COUNT</span>
               <span class="label label-default fs-4 bg-warning">Driver Gate</span>
          </p>

          <!-- rows -->
          <div class="row row-cols-5">
               <div class="col mb-3">
                    <!-- col-sm-2 -->

                    <div class="card pe-2">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9 pe-0">
                                        <p class="card-title fs-4 fw-bolder text-danger">OPERATION</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo $drivergate_operation_count; ?>
                                             </span></p>

                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-calendar-days"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-primary">DRIVER</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo $drivergate_driver_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-truck"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-warning">PROJECT</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo $drivergate_project_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2 pe-4">
                                        <span><i class="fa-solid fs-1 fa-id-card"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-muted">VISITOR</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo $drivergate_visitor_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-users"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title text-danger fs-4 fw-bolder">TOTAL</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo ($drivergate_operation_count + $drivergate_driver_count + $drivergate_project_count + $drivergate_visitor_count); ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <!-- <span><i class="fa-solid fa-calendar-days"></i></span> -->
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <!-- Assembmly gate count displaying -->
     <div class="mt-4">
          <p class="text-center">
               <span class="h4">TOTAL <span class="fw-bolder">IN</span> COUNT</span>
               <span class="label label-default fs-4 bg-dark"> Assembly gate</span>
          </p>

          <!-- rows -->
          <div class="row row-cols-5">
               <div class="col mb-3">
                    <!-- col-sm-2 -->

                    <div class="card pe-2">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9 pe-0">
                                        <p class="card-title fs-4 fw-bolder text-danger">OPERATION</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo $assembly_operation_count; ?>
                                             </span></p>

                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-calendar-days"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-primary">DRIVER</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo $assembly_driver_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-truck"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-warning">PROJECT</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo $assembly_project_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2 pe-4">
                                        <span><i class="fa-solid fs-1 fa-id-card"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-muted">VISITOR</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo $assembly_visitor_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-users"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title text-danger fs-4 fw-bolder">TOTAL</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo ($assembly_operation_count + $assembly_driver_count + $assembly_project_count + $assembly_visitor_count); ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <!-- <span><i class="fa-solid fa-calendar-days"></i></span> -->
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <!-- rows -->
          </div>
     </div>
     <!-- </div> -->

     <div class="mt-4">
          <p class="text-center">
               <span class="h4">TOTAL <span class="fw-bolder">IN</span> COUNT</span>
               <span class="label label-default fs-4 bg-success">De-License Area</span>
          </p>

          <!-- rows -->
          <div class="row row-cols-5">
               <div class="col mb-3">
                    <!-- col-sm-2 -->

                    <div class="card pe-2">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9 pe-0">
                                        <p class="card-title fs-4 fw-bolder text-danger">OPERATION</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo $delicense_operation_count; ?>
                                             </span></p>

                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-calendar-days"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-primary">DRIVER</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo $delicense_driver_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-truck"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-warning">PROJECT</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo $delicense_project_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2 pe-4">
                                        <span><i class="fa-solid fs-1 fa-id-card"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-muted">VISITOR</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo $delicense_visitor_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-users"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title text-danger fs-4 fw-bolder">TOTAL</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php //echo ($delicense_operation_count + $delicense_driver_count + $delicense_project_count + $delicense_visitor_count); ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <!-- <span><i class="fa-solid fa-calendar-days"></i></span> -->
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <!-- rows -->
          </div>
     </div>
     <!-- </div> -->
     <!-- container-fluid -->
</div>

     <?php
     // if (isset($_GET['s'])) {
     //      // if ($_GET['s']) {
     //      $s = $_GET['s'];
     //      if ($s == 0) {
     //           //echo "<script>document.getElementById('success-box').style.display = 'block';document.getElementById('strs').innerHTML='Person exited Main gate';</script>";
     //      } else if ($s == 1) {
     //           //echo "<script>document.getElementById('success-box').style.display = 'block';document.getElementById('strs').innerHTML='Person entered Assembly gate';</script>";
     //      } else if ($s == 2) {
     //           //echo "<script>document.getElementById('error-box').style.display = 'block';document.getElementById('stre').innerHTML='First exit License area';</script>";
     //      } else if ($s == 3) {
     //           //echo "<script>document.getElementById('error-box').style.display = 'block';document.getElementById('stre').innerHTML='Person not in Plant';</script>";
     //      }
     //      // }
     // }
     ?>

     <!-- script for showing messages/ alert boxes -->
     <script>
          var success_msg = <?php //echo json_encode($success_msg); ?>; // Get the PHP message
          var error_msg = <?php //echo json_encode($error_msg); ?>; // Get the PHP message

          if (success_msg) {
               document.getElementById('success-box').style.display = 'block';
               document.getElementById('strs').innerHTML = success_msg;
          } else if (error_msg) {
               document.getElementById('error-box').style.display = 'block';
               document.getElementById('stre').innerHTML = error_msg;
          }
     </script>
     <!-- script for showing message ends -->


     <!-- script for adding record to database or removing from database -->
     <script>

          function checkqr() {

               const qr_code = document.getElementById('qr-field').value.trim();
               window.location.href = 'addassemblygate.php?qc=' + qr_code;
          }
     </script>
     <script>
          const myTimeout = setTimeout(myGreeting, 3000);

          function myGreeting() {
               if(document.getElementById("error-box").style.display == "block" || document.getElementById("success-box").style.display == "block"){
                    document.getElementById("error-box").style.display = "none";
                    document.getElementById("success-box").style.display = "none";
                    window.location.href = "assemblygate.php";
               }
          }
     </script>
     <script>
          document.getElementById('page-title').innerHTML = "Assembly Gate";
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
          document.getElementById('sidebar-toggle').addEventListener('click', function () {
               document.querySelector('.wrapper').classList.toggle('sidebar-open');
               document.querySelector('.wrapper').classList.toggle('sidebar-closed');
          });
     </script>
</body>

</html>