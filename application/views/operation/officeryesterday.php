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
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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
                <!-- container-fluid -->
                <!-- including content for dashboard -->






                <!-- ++++++++++++++++++++++++++++++++DASHBOARD CONTENT START HERE ++++++++++++++++++++++++++++++-->


                <!-- <div class="container-fluid"> -->
                <!-- container-fluid -->
                <!-- <h1> HELLO THIS IS THE THEME</h1> -->





<!-- Page Content -->
<div class="container-fluid">
    <form action="#" id="officerForm" >
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

        <div id="officerForm" class="row">
            <div class="col-lg-5">
                <input type="text" name="addtoken" id="officerInput" class="form-control" placeholder="Enter Number of Officers" min="1" required>
            </div>
            <div class="col-lg-7">
                <button type="button" id="submit" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    <span>Add Officers</span>
                </button>
            </div>
        </div>
    </form>

    <div class="row mt-4" id="cardContainer">
        <!-- Dynamic Cards will be inserted here -->
    </div>
</div>

<script>
document.getElementById('submit').addEventListener('click', function() {
    const officerCount = document.getElementById('officerInput').value;

    if (officerCount > 0) {
        fetch('<?php echo base_url("Operation/add_officers"); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ officerCount }) // Send officer count as JSON
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadOfficers(data.ids);  // Use returned IDs to load officer cards
            } else {
                alert('Error adding officers');
            }
        })
        .catch(error => console.error('Error:', error));  // Handle fetch errors
    } else {
        alert('Please enter a valid number');
    }
});

function loadOfficers(ids) {
    const cardContainer = document.getElementById('cardContainer');
    cardContainer.innerHTML = ''; // Clear previous cards

    ids.forEach(id => {
        const card = `
        <div class="col-sm-6 col-md-3 col-lg-2 mb-5">
            <div class="card text-center" id="card-${id}">
                <div class="error-box w-100 d-block text-start">
                    <p class="align-center mb-0 ps-1 pe-1 fs-5 text-center">&nbsp;
                        <span class="bg-danger text-light"></span>
                    </p>
                </div>
                <div style="position: relative;">
                    <p class="h4" style="color:white;position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1;">${id}</p>
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQrAfNAjMWDejP0YqvXWZLsIBWWwKn0IJv1AgXVEa7bw&s" class="card-img-top" alt="...">
                </div>
                <div class="card-body">
                    <h5 class="card-title" style="height: 30px; overflow: hidden;">Officer #${id}</h5>
                    <a href="<?php echo base_url('Operation/editofficer/'); ?>${id}" class="btn btn-primary form-control"><i class="fa-solid fa-edit"></i>Edit</a>
                </div>
            </div>
        </div>`;
        cardContainer.innerHTML += card;
    });
}
</script>

 <!-- container-fluid ends here -->
            <!-- End Page Content -->
            <!-- </div> -->
            <!-- container-fluid -->


            <script>
// Fetch and Display Existing Officers Cards on Page Load
$(document).ready(function () {
    fetchOfficers();

    // Handle Officer Addition
    $('#officerForm').submit(function (e) {
        e.preventDefault();  // Prevent default form submission
        
        var count = $('#officerInput').val(); // Get count from input
        
        if (count && count > 0) {
            $.ajax({
                url: "<?php echo base_url('Operation/add_officer'); ?>",
                method: "POST",
                data: { addtoken: count },
                success: function (response) {
                    var officers = JSON.parse(response);
                    addOfficerCards(officers);
                    $('#officerInput').val(''); // Clear input after submission
                }
            });
        }
    });
});

// Function to fetch existing officers and display them as cards
function fetchOfficers() {
    $.ajax({
        url: "<?php echo base_url('Operation/getAllOfficer'); ?>",
        method: "GET",
        success: function (response) {
            var officers = JSON.parse(response);
            addOfficerCards(officers);
        }
    });
}

// Function to add officer cards dynamically
function addOfficerCards(officers) {
    var cardContainer = $('#cardContainer');
    cardContainer.empty();  // Clear existing cards

    officers.forEach(function (officer) {
        var cardHTML = `
            <div class="col-sm-6 col-md-3 col-lg-2 mb-5">
                <div class="card text-center" id="card-${officer.token_no}">
                    <div class="error-box w-100 d-block text-start">
                        <p class="align-center mb-0 ps-1 pe-1 fs-5 text-center">&nbsp;
                            <span class="bg-danger text-light"></span>
                        </p>
                    </div>
                    <div style="position: relative;">
                        <p class="h4" style="color:white;position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1;">
                            ${officer.token_no}
                        </p>
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQrAfNAjMWDejP0YqvXWZLsIBWWwKn0IJv1AgXVEa7bw&s" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title" style="height: 30px; overflow: hidden;">${officer.full_name}</h5>
                        <a href="editofficer.php?token=${officer.token_no}" class="btn btn-primary form-control"><i class="fa-solid fa-edit"></i>Edit</a>
                    </div>
                </div>
            </div>
        `;
        cardContainer.append(cardHTML); // Append new card to container
    });
}
</script>




            <!-- ++++++++++++++++++++++++++++++++++++++++++++++DASHBOARD CONTENT END HERE+++++++++++++++++++++++++++++++++++ -->






            <!--  container-fluid ends here -->
        </div> <!-- container-fluid ends -->
        <!-- </div> -->

    </div>
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
        const tokenResponse = await axios.post(`https://login.microsoftonline.com/${tenantId}/oauth2/v2.0/token`, qs
            .stringify({
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
</script> -->



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