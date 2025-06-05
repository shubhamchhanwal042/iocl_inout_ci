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
                <!-- container-fluid -->

                <div id="error-box" class="alert alert-danger" style="display: none;">Aadhar no already exist</div>


                <div class="card border-0 shadow mt-4">
                    <div class="card-body">


                        <form method="post" id="myform"
                            action="<?php echo base_url() . 'Operation/UpdateContractorWorkman'; ?>"
                            enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $contractorworkman['id']; ?>">
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="token_no"><b>Token Number :</b></label>
                                        <input type="text" name="token_no" id="token_no" class="form-control"
                                            value="<?php echo $contractorworkman['token_no']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="oldaadhar" value="<?php echo $contractorworkman['aadhar_no']; ?>">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="aadhar_no"><b>Aadhar Number :</b></label>
                                        <input type="text" name="aadhar_no" class="form-control"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" size="12"
                                            minlength="12" maxlength="12" id="aadhar_no"
                                            value="<?php echo $contractorworkman['aadhar_no'] ?>"
                                            placeholder="Enter Aadhar Number" required>
                                        <span id="aadharerror" style="color: red;"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="full_name"><b>Full Name :</b></label>
                                        <input type="text" name="full_name" id="full_name" placeholder="Enter Full Name"
                                            oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'');ws(this.id);"
                                            class="form-control" value="<?php echo $contractorworkman['full_name'] ?>"
                                            placeholder="Enter Full Name">
                                        <span id="nameerror" style="color: red;"></span>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="mobile_no"></label><b>Mobile Number :</b></label>
                                        <input type="text" name="mobile_no" id="mobile_no"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" size="10"
                                            minlength="10" maxlength="10" class="form-control"
                                            value="<?php echo $contractorworkman['mobile_no'] ?>"
                                            placeholder="Enter Mobile Number">
                                        <span id="contacterror" style="color: red;"></span>

                                    </div>
                                </div>
                            </div>




                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address"><b>Address :</b></label>
                                        <input type="text" name="address" id="address" class="form-control"
                                            oninput="this.value=this.value.replace(/[^a-z\sA-Z0-9,.-]/g,'');ws(this.id);"
                                            placeholder="Enter Address"
                                            value="<?php echo $contractorworkman['address'] ?>">
                                        <span id="addrerror" style="color: red;"></span>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="firm_name"><b>Contractor :</b></label>
                                    <select name="contractor" id="" required class="form-control">
                                        <option value="" selected disabled>Select Contractor</option>
                                        <?php
                                        if (is_array($contractors) || is_object($contractors)) {
                                            foreach ($contractors as $contractor) {
                                        ?>
                                                <option value="<?php echo $contractor['id']; ?>" <?php echo $contractor['id'] == $contractorworkman['contractor'] ? 'selected' : ''; ?>><?php echo $contractor['full_name']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>

                                    <!-- <input type="text" name="firm_name" oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'');ws(this.id);" id="firm_name" class="form-control" placeholder="Enter Firm Name" required> -->
                                    <span id="firmerror" style="color: red;"></span>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="firm_name"><b>Firm Name :</b></label>
                                        <input type="text" name="firm_name" id="firm_name" class="form-control"
                                            oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'');ws(this.id);"
                                            placeholder="Enter Firm Name" 
                                            value="<?php echo $contractorworkman['firm_name'] ?>" required>
                                        <span id="firmerror" style="color: red;"></span>

                                    </div>
                                </div>
                            </div>


                            <div class="d-grid gap-2 d-sm-block">
                                <div>
                                    <button type="submit" class="btn btn-primary" id="update"><i
                                            class="fa-solid fa-user-pen"></i> Update</button>
                                    <a class="btn btn-secondary"
                                        href="<?php echo base_url() . 'OprId/' . $contractorworkman['id'] . '/contractor_workman'; ?>"><i
                                            class="fa-solid fa-id-card"></i> Id
                                        Card</a>
                                    <a href="<?php echo base_url() . 'ContractorWorkman' ?>" class="btn btn-danger"><i
                                            class="fa-solid fa-arrow-left"></i>
                                        Back</a>
                                    <!-- <button class="btn btn-danger" name="delete" id="delete" ><i class="fa-solid fa-user-xmark"></i>  Drop</button> -->
                                    <button class="btn btn-danger" name="drop" id="drop"
                                        onclick="confirmDelete(event);"><i class="fa-solid fa-user-xmark"></i>
                                        Drop</button>


                                </div>
                            </div>







                        </form>
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


            <!-- Custom JavaScript -->
            <script>
                document.getElementById('page-title').innerHTML = "IOCL  INOUT | Contractor Workman";
                document.getElementById("navbar-title").innerHTML =
                    " Edit Contractor Workman Form <i class='fa-solid fa-users'></i>";
            </script>

            <!-- Bootstrap JS (optional, only needed if you use Bootstrap components that require JavaScript) -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script>

            <!-- Font Awesome JS (optional, only needed if you use Font Awesome icons) -->
            <script src="https://kit.fontawesome.com/6ee00b2260.js" crossorigin="anonymous"></script>

            <script>
                function ws(name) {
                    var name = document.getElementById(name);
                    name.value = name.value.replace(/^\s+/, '');
                }

                var aadharnoField = document.getElementById("aadhar_no");
                var contactField = document.getElementById("mobile_no");
                var nameField = document.getElementById("full_name");
                var addrField = document.getElementById("address");

                aadharnoField.addEventListener("input", validateAadharNo);
                contactField.addEventListener("input", validateContact);
                nameField.addEventListener("input", validateName);
                addrField.addEventListener("input", validateAddr);

                function validateAadharNo() {
                    var aadharno = aadharnoField.value;
                    var errorElement = document.getElementById("aadharerror");

                    if (aadharno.length < 12) {
                        errorElement.textContent = "Aadhar number should be at least 12 digits.";
                        aadharnoField.classList.add("invalid");
                        return false;
                    } else {
                        errorElement.textContent = "";
                        aadharnoField.classList.remove("invalid");
                        return true;
                    }
                }

                function validateContact() {
                    var contact = contactField.value;
                    var errorElement = document.getElementById("contacterror");

                    if (contact.length < 10) {
                        errorElement.textContent = "Mobile Number should be at least 10 digits.";
                        contactField.classList.add("invalid");
                        return false;
                    } else {
                        errorElement.textContent = "";
                        contactField.classList.remove("invalid");
                        return true;
                    }
                }

                function validateName() {
                    var fullname = nameField.value;
                    var errorElement = document.getElementById("nameerror");

                    if (fullname.trim() == "") {
                        errorElement.textContent = "Fill Out This Field";
                        nameField.classList.add("invalid");
                        return false;
                    } else {
                        errorElement.textContent = "";
                        nameField.classList.remove("invalid");
                        return true;
                    }
                }

                function validateAddr() {
                    var address = addrField.value;
                    var errorElement = document.getElementById("addrerror");

                    if (address.trim() == "") {
                        errorElement.textContent = "Fill Out This Field";
                        addrField.classList.add("invalid");
                        return false;
                    } else {
                        errorElement.textContent = "";
                        addrField.classList.remove("invalid");
                        return true;
                    }
                }

                const form = document.getElementById('myform');
                form.addEventListener('submit', (event) => {
                    // Only prevent form submission if any validation fails
                    if (!validateContact() || !validateAadharNo() || !validateName() || !validateAddr()) {
                        event.preventDefault(); // Prevent form submission
                    }
                });
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

            <!-- JS for delete confirmation -->
            <script>
                // function confirmDelete(event) {
                //     if (confirm("Are you sure you want to delete?")) {

                //         window.location.href = "contractor.php";
                //     } else {

                //         event.preventDefault();
                //     }
                // }



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
                            window.location.href = "<?php echo base_url() . 'DropContractorWorkman/' . $contractorworkman['id']; ?>"; // Replace with your delete action or URL
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