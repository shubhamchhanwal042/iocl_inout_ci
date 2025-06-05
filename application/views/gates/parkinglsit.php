<!-- name: uday anil patil || date: 08-05-2024 -->
<!-- this file only contains theme which can be used in every executing file -->
<!-- start copy file from here -->

<!-- including root file -->

<!-- if file is in any folder use ../root.php -->
<?php //print_r($slots);die;?>
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
    <script src="<?php echo base_url().'logout.js';?> "></script>

    <!-- stylesheet files -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/css_js/style.css';?> ">
    <link rel="stylesheet"
        href="<?php //echo 'http://localhost\eaglebyte\hpcl_in_out\hpcl_in_out\assets\css_js\style.css'; ?>">

    <!-- including config file to use database -->
    <?php // include($config_loc); ?>

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
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if ($this->session->flashdata('swal_type') && $this->session->flashdata('swal_message')) { ?>
        Swal.fire({
            icon: '<?= $this->session->flashdata('swal_type'); ?>', // 'success' or 'error'
            title: '<?= $this->session->flashdata('swal_message'); ?>',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
        <?php } ?>
    });
    </script>
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
                <!-- container-fluid -->


                <!-- Page Content -->
                <div class="container-fluid">
                    <!-- container-fluid -->

                    <!-- counter div code starts here -->
                  <h3 class="mb-4">Filled Parking Slots</h3>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Slot #</th>
                <th>Full Name</th>
                <th>Aadhar No</th>
                <th>Vehicle Type</th>
                <th>Vehicle Number</th>
                <th>Parking Date</th>
                <th>Time In</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($filled_vehicles)): ?>
                <?php foreach ($filled_vehicles as $slot): ?>
                    <tr>
                        <td><?= $slot->parkingslots ?></td>
                        <td><?= $slot->full_name ?></td>
                        <td><?= $slot->aadhar_no ?></td>
                        <td><?= $slot->vechile_type ?></td>
                        <td><?= $slot->vechile_number ?></td>
                        <td><?= $slot->parking_date ?></td>
                        <td><?= $slot->time_in ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No vehicles currently parked.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="<?= base_url('ParkingController/GetParking') ?>" class="btn btn-secondary mt-3">Back</a>


                </div><!-- counter div code starts here -->

                <!-- cylinder div starts here -->
                <div class="cylender-div">
                    <!-- cylinder div starts here -->
                    <div class="cylender-div">
                        <div class="row mt-4" id="cardContainer">





                        </div>
                    </div><!-- cylinder div starts here -->
                </div><!-- cylinder div starts here -->



            </div><!-- cylinder div starts here -->


        </div> <!-- container-fluid ends -->
        <!-- </div> -->

    </div>
    <!-- refresh code -->



    <script>
    document.getElementById('page-title').innerHTML = "IOCL  INOUT | AMC";
    document.getElementById('navbar-title').innerHTML = "Parking <i class='fa-solid fa-truck'></i>";
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
    // document.getElementById('sidebar-toggle').addEventListener('click', function () {
    //      document.querySelector('.wrapper').classList.toggle('sidebar-open');
    //      document.querySelector('.wrapper').classList.toggle('sidebar-closed');
    // });
    document.getElementById('sidebar-toggle').addEventListener('click', function() {
        document.querySelector('.wrapper').classList.toggle('sidebar-open');
        document.querySelector('.wrapper').classList.toggle('sidebar-closed');
    });
    </script>

    <!-- input field for add token -->
    <script>
    document.getElementById('slotForm').addEventListener('submit', function(e) {
        var inputField = document.getElementById('parkinginput');
        if (!inputField.value.trim()) { // Check if the input field is empty
            e.preventDefault(); // Prevent the form from submitting
            //  alert('Please enter a value before submitting.'); // Show an alert message
        }
    });
    </script>
    <!-- Custom JavaScript -->




</body>

</html>