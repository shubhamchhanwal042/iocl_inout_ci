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
                    <div class="counter-div">

                        <div class="row">
                            <div class="col-sm-4">
                                <h2>Add Parking Slots</h2>
                                <form method="post" action="<?= base_url('ParkingController/AddParkingSlots') ?>"
                                    class="form-inline mb-4">
                                    <input type="number" name="slot_count" class="form-control mr-2"
                                        placeholder="Enter number of slots" required>
                                    <button type="submit" class="btn btn-primary">Add Slots</button>
                                </form>
                            </div>
                                <div class="col-sm-4">
                                    <a href="<?= base_url('ParkingController/ParkingList') ?>"
                                        style="text-decoration: none;">
                                        <div class="card text-white bg-primary h-100 shadow">
                                            <div
                                                class="card-body d-flex flex-column justify-content-center align-items-center">
                                                <h5 class="card-title mb-2"><i
                                                        class="fa-solid fa-car-side me-2"></i>Filled Slots</h5>
                                                <h2 class="card-text"><?= $counts['filled'] ?></h2>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            <div class="col-sm-4 mb-3">
                                <div class="card text-white bg-secondary h-100 shadow">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <h5 class="card-title mb-2"><i class="fa-regular fa-square me-2"></i>Empty Slots
                                        </h5>
                                        <h2 class="card-text"><?= $counts['empty'] ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <h3>Parking Slots</h3>
                        <div class="row">
                            <?php foreach ($slots as $slot): ?>
                            <?php
                              $isFilled = !empty($slot->full_name);
                              $cardStyle = $isFilled ? 'bg-primary text-white' : 'bg-light';
                               $modalId = 'slotModal' . $slot->id;
                            ?>
                            <div class="col-sm-6 col-md-4 col-lg-3 mb-4 d-flex justify-content-center">
                                <div class="card shadow-lg border-0 rounded-4 w-100 h-100 parking-slot-card <?= $cardStyle ?>" style="cursor: pointer; min-height: 180px; transition: transform 0.2s;" data-toggle="modal" data-target="#<?= $modalId ?>">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                                        <div class="mb-2">
                                            <span class="badge rounded-pill <?= $isFilled ? 'bg-success' : 'bg-secondary' ?> fs-6 px-3 py-2 mb-2">
                                                <?= $isFilled ? 'Occupied' : 'Available' ?>
                                            </span>
                                        </div>
                                        <h4 class="fw-bold mb-1">Slot #<?= $slot->parkingslots ?></h4>
                                        <?php if ($isFilled): ?>
                                            <i class="fa-solid fa-car-side fa-2x mb-2 text-white"></i>
                                            <div class="mb-1"><strong><?= $slot->full_name ?></strong></div>
                                            <div class="small">Vehicle: <span class="fw-semibold"><?= $slot->vechile_number ?></span></div>
                                        <?php else: ?>
                                            <i class="fa-regular fa-square fa-2x mb-2 text-secondary"></i>
                                            <div class="mb-1 text-muted">Empty</div>
                                            <div class="small text-muted">Vehicle: --</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <style>
                            .parking-slot-card:hover {
                                transform: scale(1.04);
                                box-shadow: 0 0 20px #007bff33;
                            }
                            </style>


                            <!-- Modal -->
                            <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <?php if ($isFilled): ?>
                                    <!-- Filled Slot: show Edit and Park Out -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Slot #<?= $slot->parkingslots ?> (Occupied)</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <p><strong>Full Name:</strong> <?= $slot->full_name ?></p>
                                            <p><strong>Aadhar:</strong> <?= $slot->aadhar_no ?></p>
                                            <p><strong>Vehicle:</strong> <?= $slot->vechile_type ?> -
                                                <?= $slot->vechile_number ?></p>
                                            <p><strong>Date:</strong> <?= $slot->parking_date ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <!-- Edit button -->
                                            <button class="btn btn-primary" data-toggle="collapse"
                                                data-target="#editForm<?= $slot->id ?>">Edit</button>

                                            <!-- Park Out form -->
                                            <form method="post" action="<?= base_url('ParkingController/ParkOut') ?>">
                                                <input type="hidden" name="parkingslots" value="<?= $slot->id ?>">
                                                <button type="submit" class="btn btn-danger">Park Out</button>
                                            </form>
                                        </div>

                                        <!-- Edit Form Collapsible -->
                                        <div class="collapse" id="editForm<?= $slot->id ?>">
                                            <form method="post"
                                                action="<?= base_url('ParkingController/update_slot') ?>" class="p-3">
                                                <input type="hidden" name="id" value="<?= $slot->id ?>">
                                                <div class="form-group">
                                                    <input type="text" name="full_name" class="form-control"
                                                        value="<?= $slot->full_name ?>" required>
                                                </div>
                                                <div class="form-group"><input type="text" name="aadhar_no"
                                                        class="form-control" value="<?= $slot->aadhar_no ?>" required>
                                                </div>
                                                <div class="form-group"><input type="text" name="vechile_type"
                                                        class="form-control" value="<?= $slot->vechile_type ?>"
                                                        required></div>
                                                <div class="form-group"><input type="text" name="vechile_number"
                                                        class="form-control" value="<?= $slot->vechile_number ?>"
                                                        required></div>
                                                <div class="form-group"><input type="date" name="parking_date"
                                                        class="form-control" value="<?= $slot->parking_date ?>"
                                                        required></div>
                                                <button type="submit" class="btn btn-success btn-block">Update</button>
                                            </form>
                                        </div>
                                    </div>

                                    <?php else: ?>
                                    <!-- Empty Slot: show add form -->
                                    <form method="post" action="<?= base_url('ParkingController/update_slot') ?>">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Fill Slot #<?= $slot->parkingslots ?></h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="<?= $slot->id ?>">
                                                <label for="full_name">Full Name:</label>
                                                <div class="form-group"><input type="text" name="full_name"
                                                        class="form-control" required></div>
                                                <label for="aadhar_no">Aadhar Number:</label>
                                                <div class="form-group">
                                                    <input type="text" name="aadhar_no"
                                                        class="form-control"
                                                        required
                                                        maxlength="12"
                                                        minlength="12"
                                                        pattern="\d{12}"
                                                        inputmode="numeric"
                                                        oninput="this.value = this.value.replace(/\D/g, '').slice(0,12);"
                                                        placeholder="Enter 12-digit Aadhar number">
                                                </div>
                                                <label for="vechile_type">Vehicle Type:</label>
                                                <div class="form-group"><input type="text" name="vechile_type"
                                                        class="form-control" required placeholder="Enter Vechile Type"></div>
                                                <label for="vechile_number">Vehicle Number:</label>
                                                <div class="form-group"><input type="text" name="vechile_number"
                                                        class="form-control" required placeholder="Enter Vechile"></div>
                                                <label for="parking_date">Parking Date:</label>
                                                <div class="form-group"><input type="date" name="parking_date"
                                                        class="form-control" value="<?= date('Y-m-d') ?>" required></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Save</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>


                    </div>
                    

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
<script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if ($this->session->flashdata('swal_type') && $this->session->flashdata('swal_message')): ?>
    Swal.fire({
        icon: '<?= $this->session->flashdata('swal_type'); ?>',
        title: '<?= $this->session->flashdata('swal_message'); ?>',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
    <?php endif; ?>
});
</script>




</body>

</html>