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
                    <div class="card border-0 shadow mt-4">
                         <!-- <div class="card-body">
                              <h1 class="text" style="text-align: center; color:black; font-family: Arial, Helvetica, sans-serif;">
                                   <strong>Gat Form </strong><i class="fa-solid fa-users"></i></h1>
                         </div> -->
                    </div>

                    <div id="error-box" class="alert alert-danger" style="display: none;">Aadhar no already exist</div>

                    <div class="card border-0 shadow mt-4">
                         <div class="card-body">
                              <form method="post" id="myform" action="<?php echo base_url().'Operation/InsertFeg'?>" enctype="multipart/form-data">
                              <input type="hidden" name="id" id="id" value="<?php echo $id;?>" hidden>

                                   <div class="row mt-2">
                                        <div class="col-md-12 mb-2">
                                             <div class="form-group">
                                                  <label for="token_no">Token Number :</label>
                                                  <input type="text" name="token_no" id="token_no" class="form-control"
                                                          placeholder="Enter Token Number" value="<?php echo $id;?>" readonly>
                                             </div>
                                        </div>
                                   </div>

                                   <div class="row">
                                        <div class="col-md-12 mb-2">
                                             <div class="form-group">
                                                  <label for="aadhar_no">Aadhar Number :</label>
                                                  <input type="text" name="aadhar_no" id="aadhar_no" oninput="this.value=this.value.replace(/[^0-9]/g,'');" size="12" minlength="12" maxlength="12" class="form-control"
                                                          placeholder="Enter Aadhar Number" required>
                                                  <span id="aadharerror" style="color: red;"></span>
                                             </div>
                                        </div>
                                   </div>

                                   <div class="row">
                                        <div class="col-md-12 mb-2">
                                             <div class="form-group">
                                                  <label for="full_name">Full Name :</label>
                                                  <input type="text" name="full_name" id="full_name" class="form-control" oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'');ws(this.id);"
                                                          placeholder="Enter Full Name" required>
                                                  <span id="nameerror" style="color: red;"></span>
                                             </div>
                                        </div>
                                   </div>

                                   <div class="row">
                                        <div class="col-md-12 mb-2">
                                             <div class="form-group">
                                                  <label for="mobile_no"><b>Mobile Number :</b></label>
                                                  <input type="text" name="mobile_no" id="mobile_no" class="form-control" oninput="this.value=this.value.replace(/[^0-9]/g,'')" size="10" minlength="10" maxlength="10"
                                                          placeholder="Enter Mobile Number" required>
                                                  <span id="contacterror" style="color: red;"></span>
                                             </div>
                                        </div>
                                   </div>

                                   <div class="row">
                                        <div class="col-md-12 mb-2">
                                             <div class="form-group">
                                                  <label for="address">Address :</label>
                                                  <textarea name="address" id="address" class="form-control" rows="3" oninput="this.value=this.value.replace(/[^a-z\sA-Z0-9,.-]/g,'');ws(this.id);"
                                                              placeholder="Enter Address" required></textarea>
                                                  <span id="addrerror" style="color: red;"></span>
                                             </div>
                                        </div>
                                   </div>
                                   <div>
                                        <button class="btn btn-primary" name="submit"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                                        <!-- <button class="btn btn-secondary" name="submit"><i class="fa-solid fa-id-card"></i> Id Card</button> -->
                                        <a href="<?php echo base_url() . 'Feg' ?>" class="btn btn-danger"><i class="fa-solid fa-arrow-left"></i> Back</a>
                                   </div>
                              </form>
                         </div> 
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
document.getElementById('aadhar_no').addEventListener('input', function () {
    const aadharNo = this.value; // Get the Aadhaar number from the input field

    if (aadharNo.length === 12) { // Check if Aadhaar number has 12 digits
        fetch(`<?= base_url("Common/checkAadhar") ?>?aadhar_no=${aadharNo}`, {
            method: 'GET', // Use GET method
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                console.log(data);
                // If Aadhaar exists, autofill the form fields
                document.getElementById('full_name').value = data.data.full_name;
                document.getElementById('mobile_no').value = data.data.mobile_no;
                document.getElementById('address').value = data.data.address;
            } else {
                // If Aadhaar does not exist, clear the fields and show a message
                document.getElementById('full_name').value = '';
                document.getElementById('mobile_no').value = '';
                document.getElementById('address').value = '';
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});
</script>



        
        <!-- Custom JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
               integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
               crossorigin="anonymous"></script>

     <!-- Font Awesome JS (optional, only needed if you use Font Awesome icons) -->
     <script src="https://kit.fontawesome.com/6ee00b2260.js" crossorigin="anonymous"></script>
     <!-- giving title to document and navbar -->
     <script>
          document.getElementById('page-title').innerHTML = "IOCL  INOUT | FEG";
          document.getElementById("navbar-title").innerHTML = "Add Feg Form";
     </script>

     <!-- script for autofill -->
     <script>
          function ws(name) { 
               var name = document.getElementById(name);
               name.value = name.value.replace(/^\s+/, '');
          }

          const token = document.getElementById('token_no').value.trim();

          function checkadhar() {
               const aadhar_no = document.getElementById('aadhar_no').value.trim();
               fetch('../autofill.php?aadhar_no=' + aadhar_no)
                    .then(response => {
                         console.log(response);
                         if (!response.ok) {
                              throw new Error('Network response was not ok');
                         }
                         return response.json();
                    })
                    .then(data => {
                         if (data.message == "data found") {
                              document.getElementById('token_no').value = data.token_no;
                              document.getElementById('full_name').value = data.full_name;
                              document.getElementById('mobile_no').value = data.mobile_no;
                              document.getElementById('address').value = data.address;

                              document.getElementById('aadhar_no').setAttribute('readonly', true);
                              document.getElementById('full_name').setAttribute('readonly', true);
                              document.getElementById('mobile_no').setAttribute('readonly', true);
                              document.getElementById('address').setAttribute('readonly', true);
                         } else {
                              document.getElementById('aadhar_no').removeAttribute('readonly');
                              document.getElementById('full_name').removeAttribute('readonly');
                              document.getElementById('mobile_no').removeAttribute('readonly');
                              document.getElementById('address').removeAttribute('readonly');

                              document.getElementById('token_no').value = token;
                         }
                    })
                    .catch(error => {
                         console.error('There was a problem with the fetch operation:', error);
                    });
          }
     </script>

     <!-- Custom JavaScript -->
     <script>
          document.getElementById('sidebar-toggle').addEventListener('click', function () {
               document.querySelector('.wrapper').classList.toggle('sidebar-open');
               document.querySelector('.wrapper').classList.toggle('sidebar-closed');
          });

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
</body>

</html>
