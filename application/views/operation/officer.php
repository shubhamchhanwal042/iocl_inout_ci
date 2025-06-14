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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                <form id="officerForm">
                    <div class="row">
                        <div class="col-lg-3">
                            <label class="fs-3">Officer Cylinder Count</label>
                        </div>
                        <div class="col-lg-9">
                            <div class="error-box w-100 d-block text-start">
                                <p class="align-center ps-1 pe-1 d-inline fs-4">&nbsp;
                                    <span class="bg-danger text-light"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-5">
                            <input type="text" name="addtoken" id="officerInput" class="form-control"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')" size="2" minlength="2"
                                maxlength="2">
                        </div>
                        <div class="col-lg-7">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i>
                                <span>Add Officer</span>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="row mt-4" id="cardContainer">
                    <!-- Officer cards will be dynamically inserted here -->
                </div>
            </div>
            <!-- End Page Content -->
        </div>


    </div>
    <!-- refresh code -->


    <script>
    document.getElementById('page-title').innerHTML = "IOCL  INOUT | Officer";
    document.getElementById('navbar-title').innerHTML = "Officer <i class='fas fa-users'></i>";
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






<script>
  
        // Fetch officer data and generate cards
        function fetchOfficers() {
        fetch("<?php echo base_url('Operation/FetchOfficers'); ?>")
            .then(response => response.json())
            .then(data => {
                let cardContainer = document.getElementById('cardContainer');
                cardContainer.innerHTML = ''; // Clear previous content

                data.forEach(result => {
                    let card = document.createElement('div');
                    card.classList.add('col-sm-6', 'col-md-3', 'col-lg-2', 'mb-5');
                    let uniqueCardId = `card-${result.token_no}`;


                    // Check if officer is already in the plant
                    let officerStatusMessage = "";
                    let buttonDisabled = "";
                    if ( result.mg_data !== null && result.mg_data.status === '1') { // Officer is already in plant
                        officerStatusMessage = "Already In Plant";
                        buttonDisabled = "disabled";
                    }

                    // Create the card dynamically
                    card.innerHTML = `
                        <div class="card text-center" id="${uniqueCardId}">
                            <div class="error-box w-100 d-block text-start">
                                <p class="align-center mb-0 ps-1 pe-1 fs-5 text-center">&nbsp;
                                    <span class="bg-danger text-light">${officerStatusMessage}</span> 
                                </p>
                            </div>
                            <div style="position: relative;">
                            <!-- style="color:white;position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1;" -->
                                <p class="fs-3 fw-bold border-bottom border-2">
                                    ${result.token_no}
                                </p>
                                <img src="<?php echo base_url().'assets/images/redcylinder.png';?>"
                                    class="card-img-top w-50" alt="..." >
                            </div>
                            <div class="card-body">
                                <h5 class="card-title" style="height: 30px; overflow: hidden;">${result.full_name || '<?php null; ?>'}</h5>
                                <a href="${result.full_name ? 'EditOfficer/' + result.id : 'AddOfficer/' + result.id}" class="btn btn-primary form-control ${buttonDisabled}">
                                    <i class="fa-solid fa-${result.full_name ? 'edit' : 'plus'}"></i>
                                    ${result.full_name ? 'Edit' : 'Add'}
                                </a>
                            </div>
                        </div> 
                    `;
                    cardContainer.appendChild(card);
                });
            });
    }

    // Handle form submission via Fetch API
    document.getElementById('officerForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let tokenValue = document.getElementById('officerInput').value;
        if (tokenValue.trim() === '') {
            alert('Please enter a valid token.');
            return;
        }

        fetch("<?php echo site_url('Operation/AddOfficersToken'); ?>", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'addtoken=' + tokenValue
            })
            .then(response => response.json())
            .then(data => {
                fetchOfficers(); // Re-fetch officers after adding
                
            });
    });
    
    // Initial fetch of officers on page load
    document.addEventListener('DOMContentLoaded', fetchOfficers);

</script>

<script>
  document.getElementById('officerForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent actual form submission for demo purposes

    // Handle form submission logic here
    console.log('Form submitted');

    // Reset the form
    this.reset();
  });
</script>


</body>

</html>