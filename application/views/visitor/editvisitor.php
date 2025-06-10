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
                <div id="error-box" class="alert alert-danger" style="display: none;">Aadhar no already exist</div>

                <div class="card border-0 shadow mt-4">
                    <div class="card-body m-4">

                        <form method="post" id="visitorForm" action="<?php echo base_url().'Visitor/UpdateVisitor'; ?>"
                            enctype="multipart/form-data">
                            <div class="row mt-2">
                                <div class="col-md-12 mb-2">
                                    <input type="hidden" name="id" value="<?php echo $visitor['id']; ?> "
                                        class="form-control">

                                    <label for="token_no">Token Number:</label>
                                    <input type="text" name="token_no" value="<?php  echo $visitor['id'];; ?> "
                                        class="form-control" placeholder="Token Number" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="aadhar_no">Aadhar Number:</label>
                                    <input type="text" name="aadhar_no" id="aadhar_no" class="form-control"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'');" size="12" minlength="12"
                                        maxlength="12" value="<?php echo $visitor['aadhar_no']; ?>"
                                        placeholder="Aadhar Number">
                                    <span id="aadharerror" style="color: red;"></span>
                                </div>
                            </div>
 
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="full_name">Full Name:</label>
                                    <input type="text" name="full_name" id="full_name" class="form-control"
                                        value="<?php echo $visitor['full_name']; ?>"
                                        oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'');ws(this.id)"
                                        placeholder="Full Name">
                                    <span id="nameerror" style="color: red;"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="mobile_no">Mobile Number:</label>
                                    <input type="text" name="mobile_no" class="form-control"
                                        value="<?php echo $visitor['mobile_no']; ?>" id="mobile_no"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'')" size="10" minlength="10"
                                        maxlength="10" placeholder="Mobile Number">
                                    <span id="contacterror" class="error text-danger"></span>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="address">Address:</label>
                                    <textarea name="address" id="address" class="form-control"
                                        oninput="this.value=this.value.replace(/[^a-z\sA-Z0-9,.-]/g,'');ws(this.id);"
                                        rows="3"><?php echo $visitor['address']; ?></textarea>
                                    <span id="addrerror" style="color: red;"></span>


                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="to_see_whom">To See Whom:</label>
                                     <select name="to_see_whom" id="to_see_whom" class="form-control"
                                        onchange="updateOfficerDetails()" required >
                                        <option value="">Select</option>
                                        <?php
                                             // Fetch officer data from the database
                                             foreach ($officers as $officer) {
                                                  if ($officer['full_name'] != null) {
                                                       // Check if the officer's name matches the stored value
                                                       $selected = ($officer['full_name'] == $visitor['to_see_whom']) ? 'selected' : '';
                                        ?>
                                        <option value="<?php echo $officer['full_name']; ?>"
                                            data-id="<?php echo $officer['id']; ?>" <?php echo $selected; ?>>
                                            <?php echo $officer['full_name']; ?>
                                        </option>
                                        <?php 
                                            } 
                                         } 
                                          ?>
                                        </select>
                                        <input type="hidden" name="to_see_whom_id" id="to_see_whom_id" />

                                     <small id="seewhomerror" class="error text-danger"></small>


                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="purpose_to_visit">Purpose To Visit:</label>
                                    <textarea name="purpose_to_visit" class="form-control"
                                        placeholder="Enter the Purpose To Visit" id="purpose_to_visit"
                                        oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'');ws(this.id);"><?php echo $visitor['purpose_to_visit'] ?></textarea>
                                    <span id="purposeerror" class="error text-danger"></span>

                                </div>
                                <div class="row mb-4 ps-4">
                                    <label for="photo" class="ps-4">Capture Photo:</label>
                                    <div class="col-md-6">
                                        <div id="camera-feed">
                                            <video id="video" width="320" height="240" autoplay></video>
                                            <small id="photoValidation" class="error text-danger"></small>

                                        </div>
                                        <button type="button" class="btn btn-primary" id="capture-btn"
                                            onclick="capturePhoto()">Capture</button>
                                        <input type="hidden" id="photo" name="photo"
                                            value="<?php echo $visitor['photo'] ?>">
                                        <input type="hidden" id="new_photo" name="new_photo" value="">

                                    </div>
                                    <div class="col-md-6">
                                        <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>
                                        <div id="pic">
                                            <img src="<?php echo base_url().$visitor['photo']; ?>" alt=""
                                                width="320" height="240">
                                        </div>
                                        <br><br>
                                    </div>
                                </div>

                                <!-- //capture id photo -->
                                <div class="row mb-4 ps-4">
                                    <label for="photo" class="ps-4">Capture ID Photo:</label>
                                    <div class="col-md-6">
                                        <div id="camera-feedid">
                                            <video id="videoid" width="320" height="240" autoplay></video>
                                            <small id="photoValidationid" class="error text-danger"></small>

                                        </div>
                                        <button type="button" class="btn btn-primary" id="capture-btnid"
                                            onclick="capturePhotoId()">Capture</button>
                                        <input type="hidden" id="photoid" name="idphoto"
                                            value="<?php echo $visitor['idphoto'] ?>">
                                        <input type="hidden" id="new_photoid" name="new_photoid" value="">

                                    </div>
                                    <div class="col-md-6">
                                        <canvas id="canvasid" width="320" height="240" style="display:none;"></canvas>
                                        <div id="picid">
                                            <?php // echo $visitor['idphoto']; ?>
                                            <img src="<?php echo base_url().$visitor['idphoto']; ?>" alt=""
                                                width="320" height="240">
                                        </div>
                                        <br><br>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check ms-3 mb-4">
                                            <input type="hidden" name="is_regular" value="0">
                                            <input class="form-check-input" type="checkbox" name="is_regular"
                                                id="is_regular" value="1"
                                                <?php echo  ($visitor['is_regular']=='1' ) ? "checked" : "" ;?>>
                                            <label class="form-check-label" for="is_regular">Is Regular
                                                ?</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="d-grid gap-2 d-sm-block">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i>
                                        Update</button>
                                   <a href="<?php // echo base_url().'GatePass/'.$visitor['id'];
                                    echo base_url().'OprId/'.$visitor['id'] . '/visitor'; ?>" 
                                   class="btn btn-success" id="idcard-btn" <?php // if ($visitor['visitor_status'] == 0) { echo 'disabled title="Gate pass cannot be generated"'; } ?>>
                                        <i class="fa-solid fa-ticket"></i> Generate Gate Pass
                                    </a> 


                                    <a href="<?php echo base_url() . 'Visitor' ?>" class="btn btn-danger"><i
                                            class="fa-solid fa-arrow-left"></i>Back</a>
                                    <div>
                                        <a class="btn btn-danger" onclick="confirmDelete(event);"><i
                                                class="fa-solid fa-user-xmark"></i>
                                            Drop</a>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>

            </div><!-- container-fluid ends -->
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
        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then(function(stream) {
                var video = document.getElementById('video');
                video.srcObject = stream;
                video.play();
            })
            .catch(function(err) {
                console.log("An error occurred: " + err);
            });

        function capturePhoto() {
            var video = document.getElementById('video');
            var canvas = document.getElementById('canvas');
            var context = canvas.getContext('2d');
            canvas.width = 320;
            canvas.height = 240;

            context.drawImage(video, 0, 0, 320, 240);
            var photo = canvas.toDataURL('image/png');

            // document.getElementById('photo').value = photo;
            document.getElementById('new_photo').value = photo; // Set flag indicating new photo captured
            document.getElementById('pic').style.display = "none";
            canvas.style.display = 'block';
            photoValidation.style.display = 'none'; // Hide the error message 

        }
        </script>

            <script>
            function updateOfficerDetails() {
                var select = document.getElementById('to_see_whom');
                var selectedOption = select.options[select.selectedIndex];
                var officerId = selectedOption.getAttribute('data-id') || '';
                document.getElementById('to_see_whom_id').value = officerId;
            }
            </script>
        <!-- ID capture photo -->
        <script>
        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then(function(stream) {
                var video = document.getElementById('videoid');
                video.srcObject = stream;
                video.play();
            })
            .catch(function(err) {
                console.log("An error occurred: " + err);
            });

        function capturePhotoId() {
            var video = document.getElementById('videoid');
            var canvas = document.getElementById('canvasid');
            var context = canvas.getContext('2d');
            canvas.width = 320;
            canvas.height = 240;

            context.drawImage(video, 0, 0, 320, 240);
            var photoid = canvas.toDataURL('image/png');

            // document.getElementById('photoid').value = photo;
            document.getElementById('new_photoid').value = photoid; // Set flag indicating new photo captured
            document.getElementById('picid').style.display = "none";
            canvas.style.display = 'block';
            photoValidation.style.display = 'none'; // Hide the error message 

        }
        </script>
        <!-- Bootstrap JS (optional, only needed if you use Bootstrap components that require JavaScript) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

        <!-- Font Awesome JS (optional, only needed if you use Font Awesome icons) -->
        <script src="https://kit.fontawesome.com/6ee00b2260.js" crossorigin="anonymous"></script>

        <!-- giving title to document and navbar -->
        <script>
        document.getElementById('page-title').innerHTML = "IOCL  INOUT | Visitor";
        document.getElementById('navbar-title').innerHTML = "Edit Visitor Form <i class='fa-solid fa-users'></i>";
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

        <!-- photo Validation -->
        <script>
        document.getElementById("visitorForm").addEventListener("submit", function(event) {
            var photoInput = document.getElementById("photo").value;
            var picInput = document.getElementById("pic").src;
            var photoValidation = document.getElementById("photoValidation");

            if (photoInput == "") {
                photoValidation.textContent = "Please capture the photo of the visitor.";
                photoValidation.style.display = 'block'; // Ensure the error message is visible
                event.preventDefault();
            } else {
                photoValidation.textContent = "";
                photoValidation.style.display = 'none'; // Hide the error message if no error
            }
        });
        </script>

        <script>
        function ws(name) {
            var name = document.getElementById(name);
            name.value = name.value.replace(/^\s+/, '');
        }




        var aadharnoField = document.getElementById("aadhar_no");
        var contactField = document.getElementById("mobile_no");
        var nameField = document.getElementById("full_name");
        var addrField = document.getElementById("address");
        var purposeField = document.getElementById("purpose_to_visit");
        var seewhomField = document.getElementById("to_see_whom");






        aadharnoField.addEventListener("input", validateAadharNo);
        contactField.addEventListener("input", validateContact);
        nameField.addEventListener("input", validateName);
        addrField.addEventListener("input", validateAddr);
        purposeField.addEventListener("input", validatePurpose);
        seewhomField.addEventListener("change", validateSeeWhom);






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

        // function validatePhoto() {
        //     var aadharno = aadharnoField.value;
        //     var errorElement = document.getElementById("aadharerror");

        //     var photoInput = document.getElementById("photo").value;
        //         var picInput = document.getElementById("pic").src;
        //         var photoValidation = document.getElementById("photoValidation");

        //         if (photoInput == "" ) {
        //             photoValidation.textContent = "Please capture the photo of the visitor.";
        //             photoValidation.style.display = 'block'; // Ensure the error message is visible
        //             event.preventDefault();  // Prevent form submission if the photo is not captured
        //         } else {
        //             photoValidation.textContent = "";
        //             photoValidation.style.display = 'none'; // Hide the error message if no error
        //         }

        // }



        function validateContact() {
            var contact = contactField.value;
            var errorElement = document.getElementById("contacterror");

            if (contact.length < 10) {
                errorElement.textContent = "Mobile Number should be at least 10 digits.";
                nameField.classList.add("invalid");
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

        function validatePurpose() {
            var purpose = purposeField.value;
            var errorElement = document.getElementById("purposeerror");

            if (purpose.trim() == "") {
                errorElement.textContent = "Fill Out This Field";
                purposeField.classList.add("invalid");
                return false;
            } else {
                errorElement.textContent = "";
                purposeField.classList.remove("invalid");
                return true;

            }
        }

        function validateSeeWhom() {
            var see = seewhomField.value;
            var errorElement = document.getElementById("seewhomerror");

            if (see == "") {
                errorElement.textContent = "Please Select The Person To Visit";
                seewhomField.classList.add("invalid");
                return false;
            } else {
                errorElement.textContent = "";
                seewhomField.classList.remove("invalid");
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
        const form = document.getElementById('visitorForm');
        //console.log("sahil");


        form.addEventListener('submit', (event) => {
            // handle the form data            event.preventDefault();
            // event.preventDefault();        
            if (!validateAadharNo() && !validateName() && !validateContact() && !validateAddr() && !
                validatePurpose() && !validateSeeWhom()) {
                event.preventDefault();
            } else if (!validateAadharNo() || !validateName() || !validateContact() || !validateAddr() || !
                validatePurpose() || !validateSeeWhom()) {
                event.preventDefault();
            }


        });
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

        <script>
        function confirmDelete(event) {
            if (confirm("Are you sure you want to delete?")) {
                // alert("Data Deleted Succesfully");

                window.location.href = "<?php echo base_url().'DropVisitor/'.$visitor['id'];?>";
            } else {

                event.preventDefault();
            }
        }
        </script>
</body>

</html>