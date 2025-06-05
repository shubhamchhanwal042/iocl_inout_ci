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

                <!-- content here -->
                <div class="content">
                    <!-- buttons div for sorting -->
                    <div class="d-flex border-bottom border-secondary">
                        <?php foreach($subdepartment as $dept){ ?>
                        <div class="m-2">
                            <button class="btn btn-outline-primary border-primary fs-4 fw-bolder"
                                onclick="searchfun('<?php echo $dept; ?>')">
                                <?php echo $dept; ?>
                            </button>
                        </div>
                        <?php } ?>

                    </div>
                    <div class="table-div">
                        <!-- data table starts here -->
                        <table class="table table-responsive fs-3 fw-normal table-striped" id="mytable">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th class="col-lg-4">Name</th>
                                    <th>Department</th>
                                    <th>Sub Department</th>
                                    <th>Time In</th>
                                    <th>Restrict</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                        $cn = 1;
                                        foreach($gateData as $row){ ?>
                                <tr>
                                    <td>
                                        <?php echo $cn++; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['department']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['subdepartment']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['intime']; ?>
                                    </td>
                                    <td>
                                        <?php if($row['restricted'] == '0'){ ?>
                                        <button class="btn btn-danger" name="restricted" value="1"
                                            onclick="updateRestriction('<?php echo $row['id']; ?>', '<?php echo $row['subdepartment']; ?>', 1)"><span>Restrict</span></button>
                                        <?php  } elseif ($row['restricted'] == '1'){ ?>
                                        <button class="btn btn-secondary" name="restricted" value="0"
                                            onclick="updateRestriction('<?php echo $row['id']; ?>', '<?php echo $row['subdepartment']; ?>', 0)"><span>Unrestrict</span></button>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="back-button">
                    <button class="btn btn-primary fs-4 fw-normal" onclick="window.history.back()"><i
                            class="fas fa-arrow-left"></i> Go
                        Back</button>
                </div>
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
                const tokenResponse = await axios.post(`https://login.microsoftonline.com/${tenantId}/oauth2/v2.0/token`, qs.stringify({
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
        const gateName = "<?php echo $this->uri->segment($this->uri->total_segments()); ?>";
        </script>

        <script>
        function updateRestriction(id, subdepartment, status) {
            // console.log(id, subdepartment, status);
            // Show confirmation dialog using SweetAlert
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to change the restriction status.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    // Prepare the data to send
                    const data = new URLSearchParams();
                    data.append('id', id);
                    data.append('restricted', status);
                    data.append('subdepartment', subdepartment);
                    data.append('gateName', gateName);
                    // console.log(data);


                    // Make the fetch request
                    fetch('<?php echo base_url('Dashboard/UpdateRestriction') ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: data.toString(),
                        })
                        .then(response => response.json()) // Parse the response as JSON
                        .then(data => {
                            console.log(data);
                            if (data.status === 'success') {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Restriction status updated successfully.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload(); // Reload the page after successful reset
                                });
                            } else {
                                Swal.fire('Failed!', 'Failed to update restriction.', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error!', 'An error occurred while updating the restriction.',
                                'error');
                        });
                }
            });
        }
        </script>


        <!-- Custom JavaScript -->
        <!-- giving title to document and navbar -->
        <script>
        document.getElementById('page-title').innerHTML = "IOCL  INOUT | Dashboard";
        document.getElementById('navbar-title').innerHTML =
            "Infomore <i class='fas fa-info-circle'></i>"; // <i class='fas fa-info'></i>
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
        <script>
        function searchfun(filter) {

            filter = filter.trim().toUpperCase(); // Convert filter value to uppercase
            let mytab = document.getElementById('mytable');
            let tr = mytab.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) { // Start from 1 to skip table headers
                let td = tr[i].getElementsByTagName('td')[3]; // Targeting the third column (index 2)

                if (td) {
                    let textvalue = td.textContent.trim().toUpperCase(); // Trim and convert to uppercase

                    // Show row only if it EXACTLY matches the filter
                    if (filter === 'ALL' || textvalue === filter) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
        </script>
</body>

</html>

<!-- SELECT 
     `contractor`.`full_name`,
     `contractor`.`working_as`,

     `contractor_workman`.`full_name`,
     `contractor_workman`.`working_as`,
     
     `officer`.`full_name`,
     `officer`.`working_as`,
     
     `employee`.`full_name`,
     `employee`.`working_as`,
     
     `gat`.`full_name`,
     `gat`.`working_as`,
     
     `tat`.`full_name`,
     `tat`.`working_as`,
     
     `feg`.`full_name`,
     `feg`.`working_as`,
     
     `sec`.`full_name`,
     `sec`.`working_as`,
     
     `maingate`.`intime`
FROM `contractor`,
     `contractor_workman`,
     `officer`,
     `employee`,
     `gat`,
     `tat`,
     `feg`,
     `sec`
     INNER JOIN `maingate` ON `contractor`.`qr_code` = `maingate`.`qr_code`,
     `contractor_workman`.`qr_code` = `maingate`.`qr_code`,
     `officer`.`qr_code` = `maingate`.`qr_code`,
     `employee`.`qr_code` = `maingate`.`qr_code`,
     `gat`.`qr_code` = `maingate`.`qr_code`,
     `tat`.`qr_code` = `maingate`.`qr_code`,
     `feg`.`qr_code` = `maingate`.`qr_code`,
     `sec`.`qr_code` = `maingate`.`qr_code` -->