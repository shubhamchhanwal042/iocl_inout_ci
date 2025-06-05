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

            <?php // if(!$notifications){ 
            //         $this->load->view('include/navbar');

            //    }else{
            // $this->load->view('include/navbar', ['notifications' => $this->getNotifications()]);
            $this->load->view('include/navbar', ['notifications' => $notifications]);

            //  $this->load->view('include/navbar', $notifications);

            // }
            ?>


            <!-- Page Content -->
            <div class="container-fluid">
                <!-- container-fluid -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="success-alert alert alert-success" role="alert">
                            <span id="alert-msg-success"></span>
                        </div>
                        <div class="danger-alert alert alert-danger" role="alert">
                            <span id="alert-msg-danger"></span>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <p>
                            <span class="h4">Generate Contractor Workman List: </span>
                            <a class="btn btn-success h4" href="<?php echo base_url('Dashboard/breakconwlist') ?>">Generate List</a>
                        </p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <form id="reset-form" class="row">
                            <div class="col-6">
                                <input type="password" id="reset-pass" name="reset-pass" placeholder="Reset Count" oninput="ws(this.id)" class="form-control" required>
                                <!-- <button class="form-control btn btn-outline-dark p-0 ">Reset Count</button> -->
                            </div>
                            <div class="col-6">
                                <button type="submit" name="reset-btn" class="form-control btn btn-success">
                                    <i class="fa-solid fa-arrows-rotate"></i>&nbsp;<span>Reset</span>
                                </button>
                            </div>
                        </form>

                        <script>
                            document.getElementById('reset-form').addEventListener('submit', async function(event) {
                                event.preventDefault();
                                const password = document.getElementById('reset-pass').value;
                                const form = new FormData();
                                form.append('reset-pass', password);

                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "You won't be able to revert this!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#d33',
                                    cancelButtonColor: '#3085d6',
                                    confirmButtonText: 'Yes, reset it!',
                                    cancelButtonText: 'Cancel'
                                }).then(async (result) => {
                                    if (result.isConfirmed) {
                                        try {
                                            const response = await fetch(
                                                '<?php echo base_url('Dashboard/ResetCount') ?>', {
                                                    method: 'POST',
                                                    body: form
                                                });

                                            if (response.ok) {
                                                const result = await response.json();
                                                if (result.status == 'success') {
                                                    Swal.fire({
                                                        title: 'Success!',
                                                        text: 'Dashboard count reset successfully.',
                                                        icon: 'success',
                                                        confirmButtonText: 'OK'
                                                    }).then(() => {
                                                        location
                                                            .reload(); // Reload the page after successful reset
                                                    });
                                                } else {
                                                    Swal.fire({
                                                        title: 'Error!',
                                                        text: result.message,
                                                        icon: 'error',
                                                        confirmButtonText: 'OK'
                                                    });
                                                    // Handle error (e.g., show an error message)
                                                }
                                            } else {
                                                console.error('Reset failed:', response.statusText);
                                                // Handle error (e.g., show an error message)
                                            }
                                        } catch (error) {
                                            console.error('Error:', error);
                                            // Handle error (e.g., show an error message)
                                        }
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>

                <!-- main gate section -->
                <div class="content mt-3">

                    <?php // print_r($notifications);die;
                    ?>
                    <p>
                        <span class="h4">TOTAL <span class="fw-bolder">IN </span>COUNT </span>
                        <span class="label label-default fs-4 bg-primary">Main Gate</span>
                    </p>

                    <div class="d-flex flex-lg-row flex-md-row flex-column justify-content-between gap-4">

                        <!-- <div class="col-lg-2 col-md-4 col-sm-6 mb-3"> -->
                            <div class="card pe-2 p-3 flex-fill">
                                <div class="card-body">
                                    <a href="<?php echo base_url('Dashboard/Infomore/operation/maingate') ?>"
                                        class="text-decoration-none text-dark">
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <p class="card-title fs-4 fw-bolder text-danger pe-3">OPERATION</p>
                                                <p>
                                                    <span class="h1 fw-bold text-dark" id="main_opr">
                                                        0
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <span><i class="fa-solid fs-1 fa-calendar-days"></i></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <!-- </div> -->

                        <!-- <div class="col-lg-2 col-md-4 col-sm-6 mb-3"> -->
                            <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <a href="<?php echo base_url('Dashboard/Infomore/driver/maingate') ?>"
                                        class="text-decoration-none text-dark">
                                        <div class="d-flex justify-content-between">
                                            <!-- row -->
                                            <div class="">
                                                <p class="card-title fs-4 fw-bolder text-primary">DRIVER</p>
                                                <p><span class="h1 fw-bold" id="main_drv">
                                                        0
                                                    </span></p>
                                            </div>
                                            <div class="pt-2">
                                                <span><i class="fa-solid fs-1 fa-truck"></i></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <!-- </div> -->

                        <!-- <div class="col-lg-2 col-md-4 col-sm-6 mb-3"> -->
                            <!-- col-sm-2 -->
                            <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <a href="<?php echo base_url('Dashboard/Infomore/project/maingate') ?>"
                                        class="text-decoration-none text-dark">

                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <p class="card-title fs-4 fw-bolder text-warning pe-3">PROJECT</p>
                                                <p><span class="h1 fw-bold" id="main_prj">
                                                        0
                                                    </span></p>
                                            </div>
                                            <div class="col-3 pt-2 pe-4">
                                                <span><i class="fa-solid fs-1 fa-id-card"></i></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <!-- </div> -->

                        <!-- <div class="col-lg-2 col-md-4 col-sm-6 mb-3"> -->
                            <!-- col-sm-2 -->
                            <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">

                                    <a href="<?php echo base_url('Dashboard/Infomore/visitor/maingate') ?>"
                                        class="text-decoration-none text-dark">
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <p class="card-title fs-4 fw-bolder text-muted">VISITOR</p>
                                                <p><span class="h1 fw-bold" id="main_vis">
                                                        0
                                                    </span></p>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <span><i class="fa-solid fs-1 fa-users"></i></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <!-- </div> -->

                        <!-- <div class="col-lg-2 col-md-4 col-sm-6 mb-3"> -->
                            <!-- col-sm-2 -->
                            <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <!-- <a href="infomore.php?type=total&gate=main" class="text-decoration-none text-dark"> -->
                                    <div class="row">
                                        <div class="col-9">
                                            <p class="card-title text-danger fs-4 fw-bolder">TOTAL</p>
                                            <p><span class="h1 fw-bold" id="main_total">
                                                    0
                                                </span></p>
                                        </div>
                                        <div class="col-3 pt-2">
                                            <!-- <span><i class="fa-solid fa-calendar-days"></i></span> -->
                                        </div>
                                    </div>
                                    <!-- </a> -->
                                </div>
                            </div>
                        <!-- </div> -->

                    </div>
                </div>

                <!-- main gate section ends here -->

                <div class="content mt-3">
                    <p>
                        <span class="h4">TOTAL <span class="fw-bolder">IN</span> COUNT</span>
                        <span class="label label-default fs-4 bg-danger">License Area</span>
                    </p>
                    <div class="d-flex flex-lg-row flex-md-row flex-column justify-content-between gap-4">
                        <!-- <div class="col-lg-2 col-md-4 col-sm-6 mb-3"> -->
                            <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <a href="<?php echo base_url('Dashboard/Infomore/operation/licensegate') ?>"
                                        class="text-decoration-none text-dark">
                                        <div class="d-flex justify-content-between">
                                            <div class="pe-0">
                                                <p class="card-title fs-4 fw-bolder text-danger pe-3">OPERATION</p>
                                                <p><span class="h1 fw-bold" id="lic_opr">
                                                        0
                                                    </span></p>

                                            </div>
                                            <div class="col-3 pt-2">
                                                <span><i class="fa-solid fs-1 fa-calendar-days"></i></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <!-- </div> -->

                        <!-- <div class="col-lg-2 col-md-4 col-sm-6 mb-3"> -->
                            <!-- col-sm-2 -->
                            <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <a href="<?php echo base_url('Dashboard/Infomore/driver/licensegate') ?>"
                                        class="text-decoration-none text-dark">
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <p class="card-title fs-4 fw-bolder text-primary">DRIVER</p>
                                                <p><span class="h1 fw-bold" id="lic_drv">
                                                        0
                                                    </span></p>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <span><i class="fa-solid fs-1 fa-truck"></i></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <!-- </div> -->

                        <!-- <div class="col-lg-2 col-md-4 col-sm-6 mb-3"> -->
                            <!-- col-sm-2 -->
                            <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <a href="<?php echo base_url('Dashboard/Infomore/project/licensegate') ?>"
                                        class="text-decoration-none text-dark">
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <p class="card-title fs-4 fw-bolder text-warning pe-3">PROJECT</p>
                                                <p><span class="h1 fw-bold" id="lic_prj">
                                                        0
                                                    </span></p>
                                            </div>
                                            <div class="col-3 pt-2 pe-4">
                                                <span><i class="fa-solid fs-1 fa-id-card"></i></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <!-- </div> -->

                        <!-- <div class="col-lg-2 col-md-4 col-sm-6 mb-3"> -->
                            <!-- col-sm-2 -->
                            <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <a href="<?php echo base_url('Dashboard/Infomore/visitor/licensegate') ?>"
                                        class="text-decoration-none text-dark">
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <p class="card-title fs-4 fw-bolder text-muted">VISITOR</p>
                                                <p><span class="h1 fw-bold" id="lic_vis">
                                                        0
                                                    </span></p>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <span><i class="fa-solid fs-1 fa-users"></i></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <!-- </div> -->

                        <!-- <div class="col-lg-2 col-md-4 col-sm-6 mb-3"> -->
                            <!-- col-sm-2 -->
                            <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <!-- <a href="infomore.php?type=total&gate=license" class="text-decoration-none text-dark"> -->
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            <p class="card-title text-danger fs-4 fw-bolder">TOTAL</p>
                                            <p><span class="h1 fw-bold" id="lic_total">
                                                    0
                                                </span></p>
                                        </div>
                                        <div class="col-3 pt-2">
                                            <!-- <span><i class="fa-solid fa-calendar-days"></i></span> -->
                                        </div>
                                    </div>
                                    <!-- </a> -->
                                </div>
                            </div>
                        <!-- </div> -->
                    </div>
                </div>


                <!-- de-license gate section -->
                <div class="content mt-3">
                    <p>
                        <span class="h4">TOTAL <span class="fw-bolder">IN</span> COUNT</span>
                        <span class="label label-default fs-4 bg-success">De-License Area</span>
                    </p>

                    <div class="d-flex flex-lg-row flex-md-row flex-column justify-content-between gap-4">
                        <!-- <div class="col-lg-2 col-md-4 col-sm-6 mb-3"> -->
                            <!-- col-sm-2 -->

                            <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <a href="<?php echo base_url('Dashboard/Infomore/operation/delicensearea') ?>"
                                        class="text-decoration-none text-dark">
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <p class="card-title fs-4 fw-bolder text-danger pe-3">OPERATION</p>
                                                <p><span class="h1 fw-bold" id="del_opr">
                                                        0
                                                    </span></p>

                                            </div>
                                            <div class="col-3 pt-2">
                                                <span><i class="fa-solid fs-1 fa-calendar-days"></i></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <!-- </div> -->

                        <!-- <div class="col-lg-2 col-md-4 col-sm-6 mb-3"> -->
                            <!-- col-sm-2 -->
                            <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <a href="<?php echo base_url('Dashboard/Infomore/driver/delicensearea') ?>"
                                        class="text-decoration-none text-dark">
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <p class="card-title fs-4 fw-bolder text-primary">DRIVER</p>
                                                <p><span class="h1 fw-bold" id="del_drv">
                                                        0
                                                    </span></p>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <span><i class="fa-solid fs-1 fa-truck"></i></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <!-- </div> -->

                        <!-- <div class="col-lg-2 col-md-4 col-sm-6 mb-3"> -->
                            <!-- col-sm-2 -->
                            <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <a href="<?php echo base_url('Dashboard/Infomore/project/delicensearea') ?>"
                                        class="text-decoration-none text-dark">
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <p class="card-title fs-4 fw-bolder text-warning pe-3">PROJECT</p>
                                                <p><span class="h1 fw-bold" id="del_prj">
                                                        0
                                                    </span></p>
                                            </div>
                                            <div class="col-3 pt-2 pe-4">
                                                <span><i class="fa-solid fs-1 fa-id-card"></i></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <!-- </div> -->

                        <!-- <div class="col-lg-2 col-md-4 col-sm-6 mb-3"> -->
                            <!-- col-sm-2 -->
                            <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <a href="<?php echo base_url('Dashboard/Infomore/visitor/delicensearea') ?>"
                                        class="text-decoration-none text-dark">
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <p class="card-title fs-4 fw-bolder text-muted ">VISITOR</p>
                                                <p><span class="h1 fw-bold" id="del_vis">
                                                        0
                                                    </span></p>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <span><i class="fa-solid fs-1 fa-users"></i></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <!-- </div> -->

                        <!-- <div class="col-lg-2 col-md-4 col-sm-6 mb-3"> -->
                            <!-- col-sm-2 -->
                            <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <!-- <a href="infomore.php?type=total&gate=delicense" class="text-decoration-none text-dark"> -->
                                    <div class="row">
                                        <div class="col-9">
                                            <p class="card-title text-danger fs-4 fw-bolder">TOTAL</p>
                                            <p><span class="h1 fw-bold" id="del_total">
                                                    0
                                                </span></p>
                                        </div>
                                        <div class="col-3 pt-2">
                                            <!-- <span><i class="fa-solid fa-calendar-days"></i></span> -->
                                        </div>
                                    </div>
                                    <!-- </a> -->
                                </div>
                            </div>
                        <!-- </div> -->
                    </div>
                </div>

                <!-- driver main gate section 'drivergate' -->
                <div class="content mt-3">
                    <p>
                        <span class="h4">TOTAL <span class="fw-bolder">IN</span> COUNT</span>
                        <span class="label label-default fs-4 bg-warning">Driver Main Gate</span>
                    </p>
                    <div class="d-flex flex-lg-row flex-md-row flex-column justify-content-between gap-4">

                        <!-- <div class="col-lg-5 col-md-4 col-sm-6 mb-3"> -->
                            <!-- col-sm-2 -->

                            <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <!-- <a href="infomore.php?type=operation&gate=driver" class="text-decoration-none text-dark"> -->
                                    <div class="d-flex justify-content-between">
                                        <div class="pe-0">
                                            <p class="card-title fs-4 fw-bolder text-danger pe-3">Truck</p>
                                            <p><span class="h1 fw-bold" id="drvmain_truck">
                                                    0
                                                </span></p>

                                        </div>
                                        <div class="col-3 pt-2">
                                            <span><i class="fa-solid fs-1 fa-truck"></i></span>
                                        </div>
                                    </div>
                                    <!-- </a> -->
                                </div>
                            </div>
                        <!-- </div> -->

                        <!-- <div class="col-lg-5 col-md-4 col-sm-6 mb-3"> -->
                            <!-- col-sm-2 -->
                            <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <a href="<?php echo base_url('Dashboard/Infomore/driver/drivermaingate') ?>"
                                        class="text-decoration-none text-dark">

                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <p class="card-title fs-4 fw-bolder text-primary">DRIVER</p>
                                                <p><span class="h1 fw-bold" id="drvmain_drv">
                                                        0
                                                    </span></p>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <span><i class="fa-solid fs-1 fa-truck"></i></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <!-- </div> -->

                        <!-- <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            <p class="card-title text-danger fs-4 fw-bolder">TOTAL</p>
                                            <p><span class="h1 fw-bold" id="drv_total">
                                                    0
                                                </span></p>
                                        </div>
                                        <div class="col-3 pt-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>



                <!-- ----------------------PARKING COUNT --------------------------------- -->
                 
                

                <!-- driver licence gate section 'drivergate' -->
                <div class="content mt-3">
                    <p>
                        <span class="h4">TOTAL <span class="fw-bolder">IN</span> COUNT</span>
                        <span class="label label-default fs-4 bg-danger">Driver Licence Gate</span>
                    </p>
                    <div class="d-flex flex-lg-row flex-md-row flex-column justify-content-between gap-4">

                        <!-- <div class="col-lg-5 col-md-4 col-sm-6 mb-3"> -->
                            <!-- col-sm-2 -->

                            <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <!-- <a href="infomore.php?type=operation&gate=driver" class="text-decoration-none text-dark"> -->
                                    <div class="d-flex justify-content-between">
                                        <div class="pe-0">
                                            <p class="card-title fs-4 fw-bolder text-danger pe-3">Truck</p>
                                            <p><span class="h1 fw-bold" id="drvlic_truck">
                                                    0
                                                </span></p>

                                        </div>
                                        <div class="col-3 pt-2">
                                            <span><i class="fa-solid fs-1 fa-truck"></i></span>
                                        </div>
                                    </div>
                                    <!-- </a> -->
                                </div>
                            </div>
                        <!-- </div> -->

                        <!-- <div class="col-lg-5 col-md-4 col-sm-6 mb-3"> -->
                            <!-- col-sm-2 -->
                            <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <a href="<?php echo base_url('Dashboard/Infomore/driver/driverlicensegate') ?>"
                                        class="text-decoration-none text-dark">

                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <p class="card-title fs-4 fw-bolder text-primary">DRIVER</p>
                                                <p><span class="h1 fw-bold" id="drvlic_drv">
                                                        0
                                                    </span></p>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <span><i class="fa-solid fs-1 fa-truck"></i></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <!-- </div> -->

                        <!-- <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            <p class="card-title text-danger fs-4 fw-bolder">TOTAL</p>
                                            <p><span class="h1 fw-bold" id="drv_total">
                                                    0
                                                </span></p>
                                        </div>
                                        <div class="col-3 pt-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                    <!-- driver main gate section 'drivergate' -->


                    <!-- ----------------------------PARKIGN SECION STARAT HERE-------------------- -->
                <!-- <div class="content mt-3">
                    <p>
                        <span class="h4">TOTAL <span class="fw-bolder">IN</span> COUNT</span>
                        <span class="label label-default fs-4 bg-secondary">Driver Parking Gate</span>
                    </p>
                    <div class="d-flex flex-lg-row flex-md-row flex-column justify-content-between gap-4">

                        <div class="card pe-3 p-3 flex-fill">
                            <div class="card-body">
                                <a href="<?php //echo base_url('ParkingController/GetParking') ?>" class="text-decoration-none text-dark">
                                    <div class="d-flex justify-content-between">
                                        <div class="pe-0">
                                            <p class="card-title fs-4 fw-bolder text-success pe-3">Vehicle Slots Available</p>
                                            <p><span class="h1 fw-bold" id="parking_empty">
                                                    0
                                                </span></p>
                                        </div>
                                        <div class="col-3 pt-2">
                                            <span><i class="fa-solid fs-1 fa-square-parking"></i></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="card pe-3 p-3 flex-fill">
                            <div class="card-body">
                                <a href="<?php //echo base_url('ParkingController/ParkingList') ?>"
                                    class="text-decoration-none text-dark">
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            <p class="card-title fs-4 fw-bolder text-primary">Slots Occupied</p>
                                            <p><span class="h1 fw-bold" id="parking_filled">
                                                    0
                                                </span></p>
                                        </div>
                                        <div class="col-3 pt-2">
                                            <span><i class="fa-solid fs-1 fa-car-on"></i></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="card pe-3 p-3 flex-fill">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        <p class="card-title fs-4 fw-bolder text-warning">Total Slots</p>
                                        <p>
                                            <span class="h1 fw-bold" id="parking_total">
                                                0
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-warehouse"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div> -->


                <!-- ---------------------------------PARKING SECTION ENDS HERE------------------------ -->

                <div class="content mt-3">
                    <p><span class="h4">TOTAL STAFF</span> <span class="label label-default fs-4 bg-info">Total
                            Staff</span></p>
                    <div class="d-flex flex-lg-row flex-md-row flex-column justify-content-between gap-4">
                        <!-- <div class="col-lg-3 col-md-6 col-sm-6 mb-3"> -->
                        <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <!-- <a href="infomore.php?type=operation" class="text-decoration-none text-dark"> -->
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            <p class="card-title fs-4 fw-bolder text-danger pe-3">OPERATION</p>
                                            <p><span class="h1 fw-bold" id="staff_opr">
                                                    0 &nbsp;
                                                </span></p>
                                        </div>
                                        <div class="col-3 pt-2">
                                            <span><i class="fa-solid fs-1 fa-calendar-days"></i></span>
                                        </div>
                                    </div>
                                    <!-- </a> -->
                                </div>
                            </div>
                        <!-- </div> -->
                        <!-- <div class="col-lg-3 col-md-6 col-sm-6 mb-3"> -->
                        <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <!-- <a href="infomore.php?type=operation" class="text-decoration-none text-dark"> -->
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            <p class="card-title fs-4 fw-bolder text-primary">DRIVER</p>
                                            <p><span class="h1 fw-bold" id="staff_drv">
                                                    0 &nbsp;
                                                </span></p>
                                        </div>
                                        <div class="col-3 pt-2">
                                            <span><i class="fa-solid fs-1 fa-truck"></i></span>
                                        </div>
                                    </div>
                                    <!-- </a> -->
                                </div>
                            </div>
                        <!-- </div> -->
                        <!-- <div class="col-lg-3 col-md-6 col-sm-6 mb-3"> -->
                        <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <!-- <a href="infomore.php?type=operation" class="text-decoration-none text-dark"> -->
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            <p class="card-title fs-4 fw-bolder text-warning pe-3">PROJECT</p>
                                            <p><span class="h1 fw-bold" id="staff_prj">
                                                    0 &nbsp;
                                                </span></p>
                                        </div>
                                        <div class="col-3 pt-2">
                                            <span><i class="fa-solid fs-1 fa-id-card"></i></span>
                                        </div>
                                    </div>
                                    <!-- </a> -->
                                </div>
                            </div>
                        <!-- </div> -->
                        <!-- <div class="col-lg-3 col-md-6 col-sm-6 mb-3"> -->
                        <div class="card pe-3 p-3 flex-fill">
                                <div class="card-body">
                                    <!-- <a href="infomore.php?type=operation" class="text-decoration-none text-dark"> -->
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            <p class="card-title fs-4 fw-bolder text-muted">VISITOR</p>
                                            <p><span class="h1 fw-bold" id="staff_vis">
                                                    0 &nbsp;
                                                </span></p>
                                        </div>
                                        <div class="col-3 pt-2">
                                            <span><i class="fa-solid fs-1 fa-users"></i></span>
                                        </div>
                                    </div>
                                    <!-- </a> -->
                                </div>
                            </div>
                        <!-- </div> -->
                    </div>
                </div>
                <!-- </div> -->
                <!--  container-fluid ends here -->
            </div> <!-- container-fluid ends -->
            <!-- </div> -->

        </div>
        <script>

        function ws(name) {
            var name = document.getElementById(name);
            name.value = name.value.replace(/^\s+/, '');

        }
            async function fetchDashboardCount() {
                try {
                    const response = await fetch('<?php echo base_url('Dashboard/GetDashboardCount') ?>');
                    if (response.ok) {
                        const result = await response.json();
                        if (result.status == 'success') {
                            // Update the UI with the fetched data
                            displayCountData(result.data);

                            // You can update the UI with the fetched data here
                        } else {
                            console.error('Error fetching dashboard count:', result.message);
                        }
                    } else {
                        console.error('Error fetching dashboard count:', response.statusText);
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            }

            // Call the function to fetch dashboard count
            fetchDashboardCount(); // Call first when the page loads
            setInterval(fetchDashboardCount, 5000); // Call every 5 seconds

            function displayCountData(data) {
                console.log(data);
                // Update the UI with the fetched data
                document.getElementById('main_opr').textContent = data.mainGate.Operation_count;
                document.getElementById('main_drv').textContent = data.mainGate.Driver_count;
                document.getElementById('main_prj').textContent = data.mainGate.Project_count;
                document.getElementById('main_vis').textContent = data.mainGate.Visitor_count;
                document.getElementById('main_total').textContent = data.mainGate.total_count;

                document.getElementById('lic_opr').textContent = data.licenseGate.Operation_count;
                document.getElementById('lic_drv').textContent = data.licenseGate.Driver_count;
                document.getElementById('lic_prj').textContent = data.licenseGate.Project_count;
                document.getElementById('lic_vis').textContent = data.licenseGate.Visitor_count;
                document.getElementById('lic_total').textContent = data.licenseGate.total_count;

                document.getElementById('drvmain_truck').textContent = data.driverMainGate.Truck_count;
                document.getElementById('drvmain_drv').textContent = data.mainGate.Driver_count;
                // document.getElementById('parking_filled').textContent = data.parkingcounts.filled;
                // document.getElementById('parking_empty').textContent = data.parkingcounts.empty;
                // document.getElementById('parking_total').textContent = data.parkingcounts.total;




                document.getElementById('drvlic_truck').textContent = data.driverLicenseGate.Truck_count;
                document.getElementById('drvlic_drv').textContent = data.licenseGate.Driver_count;

                document.getElementById('del_opr').textContent = data.deLicenseArea.Operation_count;
                document.getElementById('del_drv').textContent = data.deLicenseArea.Driver_count;
                document.getElementById('del_prj').textContent = data.deLicenseArea.Project_count;
                document.getElementById('del_vis').textContent = data.deLicenseArea.Visitor_count;
                document.getElementById('del_total').textContent = data.deLicenseArea.total_count;

                document.getElementById('staff_opr').textContent = data.operation;
                document.getElementById('staff_drv').textContent = data.driver;
                document.getElementById('staff_prj').textContent = data.project;
                document.getElementById('staff_vis').textContent = data.visitor;

            }
        </script>
        <!-- refresh code -->

        <!-- <script>
        const axios = require('axios');
        const qs = require('qs');

        // Azure AD and Power BI credentials
        const tenantId = 'YOUR_TENANT_ID';
        const clientId = 'YOUR_CLIENT_ID';
        const clientSecret = 'YOUR_CLIENT_SECRET';
        const datasetId = 'YOUR_DATASET_ID';

        async function getAccessToken() {
            const tokenResponse = await axios.post(
                `https://login.microsoftonline.com/${tenantId}/oauth2/v2.0/token`, qs.stringify({
                    grant_type: 'client_credentials',
                    client_id: clientId,
                    client_secret: clientSecret,
                    scope: 'https://analysis.windows.net/powerbi/api/.default'
                }), {
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                });

            return tokenResponse.data.access_token;
        }

        async function refreshDataset() {
            const accessToken = await getAccessToken();

            await axios.post(`https://api.powerbi.com/v1.0/myorg/datasets/${datasetId}/refreshes`, null, {
                headers: {
                    'Authorization': `Bearer ${accessToken}`
                }
            });

            console.log('Dataset refresh triggered successfully.');
        }

        // Trigger dataset refresh (you can call this function from an endpoint)
        refreshDataset().catch(console.error);
        </script>

 -->

        <script>
            document.getElementById('page-title').innerHTML = "IOCL  INOUT | Dashboard";
            document.getElementById('navbar-title').innerHTML = "Dashboard <i class='fas fa-home'></i>";
        </script>


        <!-- Bootstrap JS (optional, only needed if you use Bootstrap components that require JavaScript) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

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
        <!-- Custom JavaScript -->




</body>

</html>