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

            <!-- <div class="container-fluid"> -->
            <!-- container-fluid -->
            <div class="row">
                <div class="col-sm-5">
                    <div class="success-alert alert alert-success" role="alert">
                        <span id="alert-msg-success"></span>
                    </div>
                    <div class="danger-alert alert alert-danger" role="alert">
                        <span id="alert-msg-danger"></span>
                    </div>

                </div>
                <div class="col-sm-7">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="row">
                        <div class="col-6">
                            <input type="password" name="reset-pass" placeholder="Reset Count" class="form-control">
                            <!-- <button class="form-control btn btn-outline-dark p-0 ">Reset Count</button> -->
                        </div>
                        <div class="col-6">
                            <button type="submit" name="reset-btn" class="form-control btn btn-success">
                                <i class="fa-solid fa-arrows-rotate"></i>&nbsp;<span>Reset</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="content mt-3">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card border border-primary py-2">
                            <p class="h4 text-primary text-center">Main Gate</p>
                            <p class="h1 text-black text-center" id="main_total1">
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card border border-danger py-2">
                            <p class="h4 text-danger text-center">License Gate</p>
                            <p class="h1 text-black text-center" id="lic_total1">
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card border border-success py-2">
                            <p class="h4 text-success text-center">De-License Gate</p>
                            <p class="h1 text-black text-center" id="del_total1">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-4">
                        <div class="row bg-primary mx-1 pb-2 rounded rounded-3">
                            <div class="col-lg-12">
                                <p class="h4 text-light text-primary text-center">Truck Main Gate</p>
                            </div>
                            <div class="col-lg-6">
                                <div class="card border border-primary py-2">
                                    <p class="h4 text-primary text-center">Driver</p>
                                    <p class="h1 text-black text-center" id="drvmain_drv"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card border border-primary py-2">
                                    <p class="h4 text-primary text-center">Truck</p>
                                    <p class="h1 text-black text-center" id="drvmain_truck"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="row bg-danger mx-1 pb-2 rounded rounded-3">
                            <div class="col-lg-12">
                                <p class="h4 text-light text-danger text-center">Truck License Gate</p>
                            </div>
                            <div class="col-lg-6">
                                <div class="card border border-danger py-2">
                                    <p class="h4 text-danger text-center">Driver</p>
                                    <p class="h1 text-black text-center" id="drvlic_drv"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card border border-danger py-2">
                                    <p class="h4 text-danger text-center">Truck</p>
                                    <p class="h1 text-black text-center" id="drvlic_truck">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="row bg-success mx-1 pb-2 rounded rounded-3">
                            <div class="col-lg-12">
                                <p class="h4 text-light text-success text-center">Parking</p>
                            </div>
                            <div class="col-lg-4">
                                <div class="card border border-success py-2">
                                    <p class="h4 text-success text-center mb-2">Empty Slots</p>
                                    <p class="h1 text-black text-center mt-2" id="parking_empty"></p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card border border-success py-2">
                                    <p class="h4 text-success text-center mb-2">Parked Slots</p>
                                    <p class="h1 text-black text-center mt-2" id="parking_filled">
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card border border-success py-2">
                                    <p class="h4 text-success text-center mb-2">Total<br>Slots</p>
                                    <p class="h1 text-black text-center mt-2" id="parking_total">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row bg-light mt-3 py-2">
                    <div class="col-lg-4">
                        <div class="table-1">
                            <div class="table-responsive border-top border-x border-1">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td colspan="3">
                                                <p class="h4 text-center text-Primary">Main Gate</p>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="text-primary">Operation</th>
                                            <td id="main_opr"></td>
                                            <td>
                                                <a class="btn btn-light border border-1" href="<?php echo base_url('Dashboard/Infomore/operation/maingate') ?>">View</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="text-danger">Driver</th>
                                            <td id="main_drv">
                                            </td>
                                            <td>
                                                <a class="btn btn-light border border-1" href="<?php echo base_url('Dashboard/Infomore/driver/maingate') ?>">View</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-warning">Project</th>
                                            <td id="main_prj"></td>
                                            <td>
                                                <a class="btn btn-light border border-1" href="<?php echo base_url('Dashboard/Infomore/project/maingate') ?>">View</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="text-secondary">Visitor</th>
                                            <td id="main_vis"></td>
                                            <td>
                                                <a class="btn btn-light border border-1" href="<?php echo base_url('Dashboard/Infomore/visitor/maingate') ?>">View</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="text-secondary">Total</th>
                                            <td id="main_total">
                                            </td>
                                            <td>
                                                <!-- <a class="btn btn-light border border-1" href="">View</a> -->
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                    <div class="col-lg-4">
                        <div class="table-1">
                            <div class="table-responsive border-top border-x border-1">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td colspan="3">
                                                <p class="h4 text-center text-danger">License Gate</p>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="text-primary">Operation</th>
                                            <td id="lic_opr"></td>
                                            <td>
                                                <a class="btn btn-light border border-1" href="<?php echo base_url('Dashboard/Infomore/operation/licensegate') ?>">View</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="text-danger">Driver</th>
                                            <td id="lic_drv">
                                            </td>
                                            <td>
                                                <a class="btn btn-light border border-1" href="<?php echo base_url('Dashboard/Infomore/driver/licensegate') ?>">View</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-warning">Project</th>
                                            <td id="lic_prj"></td>
                                            <td>
                                                <a class="btn btn-light border border-1" href="<?php echo base_url('Dashboard/Infomore/project/licensegate') ?>">View</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="text-secondary">Visitor</th>
                                            <td id="lic_vis"></td>
                                            <td>
                                                <a class="btn btn-light border border-1" href="<?php echo base_url('Dashboard/Infomore/visitor/licensegate') ?>">View</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="text-secondary">Total</th>
                                            <td id="lic_total">
                                            </td>
                                            <td>
                                                <!-- <a class="btn btn-light border border-1" href="">View</a> -->
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="table-responsive border-top border-x border-1">
                            <table class="table m-0 mb-3">
                                <thead>
                                    <tr>
                                        <td colspan="3">
                                            <p class="h4 text-center text-success">De-License Gate</p>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="text-primary">Operation</th>
                                        <td id="del_opr"></td>
                                        <td>
                                            <!-- <a class="btn btn-light border border-1" href="">View</a> -->
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-danger">Driver</th>
                                        <td id="del_drv"></td>
                                        <td>
                                            <!-- <a class="btn btn-light border border-1" href="">View</a> -->
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-warning">Project</th>
                                        <td id="del_prj"></td>
                                        <td>
                                            <!-- <a class="btn btn-light border border-1" href="">View</a> -->
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-secondary">Visitor</th>
                                        <td id="del_vis"></td>
                                        <td>
                                            <!-- <a class="btn btn-light border border-1" href="">View</a> -->
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-secondary">Total</th>
                                        <td id="del_total">
                                        </td>
                                        <td>
                                            <!-- <a class="btn btn-light border border-1" href="">View</a> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="border border-success bg-white d-flex justify-content-between py-1 px-1">
                            <p class="text-success text-center fs-4 m-0">Contractor Workman</p>
                            <a class="btn btn-success text-center" href="<?php echo base_url('Dashboard/breakconwlist') ?>">Break Count</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
            <!-- container-fluid -->

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
                document.getElementById('main_total1').textContent = data.mainGate.total_count;

                document.getElementById('lic_opr').textContent = data.licenseGate.Operation_count;
                document.getElementById('lic_drv').textContent = data.licenseGate.Driver_count;
                document.getElementById('lic_prj').textContent = data.licenseGate.Project_count;
                document.getElementById('lic_vis').textContent = data.licenseGate.Visitor_count;
                document.getElementById('lic_total').textContent = data.licenseGate.total_count;
                document.getElementById('lic_total1').textContent = data.licenseGate.total_count;

                document.getElementById('drvmain_truck').textContent = data.driverMainGate.Truck_count;
                document.getElementById('drvmain_drv').textContent = data.mainGate.Driver_count;

                document.getElementById('drvlic_truck').textContent = data.driverLicenseGate.Truck_count;
                document.getElementById('drvlic_drv').textContent = data.licenseGate.Driver_count;

                document.getElementById('del_opr').textContent = data.deLicenseArea.Operation_count;
                document.getElementById('del_drv').textContent = data.deLicenseArea.Driver_count;
                document.getElementById('del_prj').textContent = data.deLicenseArea.Project_count;
                document.getElementById('del_vis').textContent = data.deLicenseArea.Visitor_count;
                document.getElementById('del_total').textContent = data.deLicenseArea.total_count;
                document.getElementById('del_total1').textContent = data.deLicenseArea.total_count;

                // document.getElementById('staff_opr').textContent = data.operation;
                // document.getElementById('staff_drv').textContent = data.driver;
                // document.getElementById('staff_prj').textContent = data.project;
                // document.getElementById('staff_vis').textContent = data.visitor;

                document.getElementById('parking_filled').textContent = data.parkingcounts.filled != 0 ? data.parkingcounts.filled : 0;
                document.getElementById('parking_empty').textContent = data.parkingcounts.empty != 0 ? data.parkingcounts.empty : 0;
                document.getElementById('parking_total').textContent = data.parkingcounts.total != 0 ? data.parkingcounts.total : 0;

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