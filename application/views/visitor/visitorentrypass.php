<!-- name: uday anil patil || date: 08-05-2024 -->
<!-- name: Shubham Shinde || date: 22-05-2024  Backend-->
<!-- this file only contains theme which can be used in every executing file -->
<!-- start copy file from here -->

<!-- including root file -->
<?php 
// include("../root.php");
// if (!isset($_SESSION['username'])) {
//     header("Location: ../login.php");
//     exit();
// }
?>
<!-- if file is in any folder use ../root.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="page-title"></title>
    <link rel="icon" href="../../assest/img/logos/hp.png" type="image/gif" sizes="16x16">
    <!-- including external links -->
    <?php // include($external_links_loc); ?>




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
    <!-- <script src="https://kit.fontawesome.com/6ee00b2260.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- <script src="http://localhost/hpcl_in_out_mahul/logout.js"></script> -->
    <script src="<?php echo base_url().'logout.js';?> "></script>











    <!-- stylesheet files -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/css_js/style.css';?> ">
    <link rel="stylesheet" href="<?php //echo 'http://localhost\eaglebyte\hpcl_in_out\hpcl_in_out\assets\css_js\style.css'; 
                ?>">

    <!-- including config file to use database -->
    <?php // include($config_loc); ?>
    <style>
    #header-area .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid black;
        padding: 10px 0;
        text-align: center;
    }

    #header-area .header .logo {
        width: 100px;
        height: auto;
    }

    .header-content {
        text-align: center;
        flex-grow: 1;
    }

    #header-area .header h1 {
        font-size: 24px;
        margin: 5px;
    }

    #header-area .header h2 {
        font-size: 20px;
        margin: 5px;
    }

    .sub-header {
        text-align: center;
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .visitor-info {
        display: flex;
        justify-content: space-between;
        /* text-align: center; */
        /* border: 1px solid black;
       */
        /* padding: 5px;  */
        font-weight: bold;
    }

    .visitor-info div {
        /* flex: 1; */
        /* border-right: 2px solid black;
            padding: 2px; */
    }

    .visitor-info div:last-child {
        border-right: none;
    }

    .visitor-info input {
        border: none;
        width: 80%;
        /* text-align: center; */
        font-weight: bold;
        font-size: 12px;
        /* padding: 5px; */
    }



    #admin-area .section-header {
        background-color: green;
        color: white;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        padding: 8px;
        margin-bottom: 10px;
    }

    #admin-area .form-group {
        margin-bottom: 15px;
        font-size: 16px;
    }

    #admin-area .form-group label {
        font-weight: bold;
        display: block;
    }

    #admin-area .form-group input[type="text"] {
        width: 100%;
        border: none;
        border-bottom: 1px solid black;
        font-size: 16px;
        padding: 5px;
    }

    #admin-area .box-input {
        display: flex;
        gap: 5px;
    }

    #admin-area .box-input input {

        font-size: 18px;
        font-weight: bold;
    }

    #admin-area .signature-section {
        display: flex;
        /* justify-content: space-between; */
        /* margin-top: 4rem; */
        font-weight: bold;
        text-align: center;
    }

    #admin-area .signature-box {
        flex: 1;
        text-align: center;
        /* border-top: 1px solid black; */
        padding-top: 5px;
        /* margin: 0 10px; */
    }













    #licensed-entry-form {
        border: 1px solid black;
        padding: 15px;
        margin-top: 20px;
    }

    #licensed-entry-form .section-header {
        background-color: red;
        color: white;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        padding: 4px;
        margin-bottom: 10px;
    }

    #licensed-entry-form .form-section {
        /* margin-bottom: 15px; */
        font-size: 12px;
    }

    #licensed-entry-form .form-section label {
        font-weight: bold;
        /* display: inline-block; */
        font-size: 12px;

        /* min-width: 120px; */
    }

    #licensed-entry-form .form-section input[type="text"] {
        border: none;
        border-bottom: 1px solid black;
        font-size: 12px;
        /* padding: 5px; */
        width: 100%;
    }

    #licensed-entry-form .box-input {
        display: flex;
        gap: 5px;
    }

    #licensed-entry-form .box-input input {
        width: 6rem;
        height: 2rem;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
    }

    #licensed-entry-form .signature-section {
        display: flex;
        justify-content: space-between;
        margin-top: 2rem;
        font-weight: bold;
        text-align: center;
    }

    #licensed-entry-form .signature-box {
        flex: 1;
        text-align: center;
        border-top: 1px solid black;
        padding-top: 5px;
        margin: 0 10px;
    }

    #licensed-entry-form .time-section {
        display: flex;
        justify-content: space-between;
        margin-top: 5px;
    }

    #licensed-entry-form .time-box {
        text-align: center;
    }
    </style>
</head>

<!-- php code here -->
<?php
// date_default_timezone_set('Asia/Kolkata'); // Set the time zone to Indian Standard Time


// $token = $_GET['token'];
// $sql = "SELECT * FROM `visitor` WHERE `token_no` = '$token'";

// $res = mysqli_query($connection, $sql);
// $row = mysqli_fetch_assoc($res);
// // print_r($row);die;
// $aadhar = $row['aadhar_no'];
// if ($res) {

?>
<!-- php code ends here -->

<body>


    <div class="wrapper d-flex">

        <!-- including sidebar -->
        <?php $this->load->view('include/sidebar'); ?>

        <div class="container-fluid">
            <!-- including navbar -->
            <?php $this->load->view('include/navbar'); ?>

            <!-- Page Content -->
            <div class="container-fluid">
                <!-- container-fluid -->
                <?php if($visitor){ ?>
                <div class="content border p-3 mb-3" id="content">
                    <div class="header d-flex align-items-center justify-content-between border-bottom ">
                        <img src="<?php echo base_url().$visitor['photo']; ?>" alt="" class="image-fluid" height="110"
                            width="120">
                        <div class="header-content text-center flex-grow-1">
                            <p class="fs-6 text-center fw-bold">
                                Indian Oil Corporation Limited<br>
                                Sinnar LPG Bottling Plant, Plot No. F-5, MIDC Area, Malegaon, Sinnar, Nashik,
                                Maharashtra 422103 GSTIN - 27AAACB2902M1Z2
                            </p>

                            <!-- HPCL PATALGANGA LPG PLANT
                                PLOT NO. E- 1/7, ADDITIONAL PATALGANGA MIDC
                                CHAVANE, RASAYANI
                                PATALGANGA - 410207 GSTIN - 27AAACH1118B1ZC</p> -->
                            <p class="text-uppercase text-center fs-6 fw-bolder">Visitor Slip</p>
                        </div>
                        <img src="<?php echo base_url().'uploads/qr_code/'.$visitor['qr_path']; ?>" alt=""
                            class="image-fluid" height="110" width="120">
                    </div>

                    <div class="sub-header fs-6 ">
                        <p class="text-danger"> Token No: <?php echo $visitor['token_no']; ?></p>

                        <!-- एल.पी.जी. भराई संयंत्र पातालगंगा | PATALGANGA LPG FILLING PLANT -->
                    </div>

                    <!-- Visitor Slip Info -->
                    <div class="visitor-info">
                        <div class="fs-6 ">
                            <p class=""> दिनांक (Date) : <?php echo date("d-m-Y"); ?></p>
                        </div>
                        <div>
                            <p class="fs-6"> VISITOR SLIP</p>
                        </div>
                        <div>
                            <?php
                        date_default_timezone_set('Asia/Kolkata');
                        ?>
                            <p class="fs-6">समय (Time) : <?php echo date("H:i:s"); ?></p>
                        </div>
                        <div>
                            <p class="fs-6">प्रस्थान का समय (Departure Time) <br></p>
                            <input type="text" name="departure_time" readonly>
                        </div>
                    </div>


                    <!-- SECOND SECTION -->
                    <div id="admin-area">
                        <!-- Section Header -->

                        <div class="section-header text-center text-light bg-success fs-6">
                            केवल एडमिन क्षेत्र में प्रवेश के लिए
                        </div>
                        <p class="fs-6"> SrNo: <span class="text-danger fs-6" id="srNo">Auto
                                Generated Sr
                                No</span></p>
                        <!-- Form Fields -->
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group fs-6">
                                    <label>१) आगंतुक का नाम</label>
                                    <input type="text" name="visitor_name" class="fs-6"
                                        value="<?php echo $visitor['full_name'] ?>" class="fs-6" readonly style=" font-weight: bold;
">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group fs-6">
                                    <label>२) कहाँ से आये (संपूर्ण पता)</label>
                                    <input type="text" name="visitor_address" value="<?php echo $visitor['address']; ?>"
                                        class="fs-6" readonly style=" font-weight: bold;
">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group fs-6">
                                    <label>३) आगंतुक का मोबाइल नं.</label>
                                    <div class="box-input">
                                        <input type="text" maxlength="10" value="<?php echo $visitor['mobile_no']; ?>"
                                            class="fs-6" readonly>

                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group fs-6">
                                    <label>४) पहचान पत्र क्रं.</label>
                                    <div class="box-input">
                                        <input type="text" maxlength="12" value="<?php echo $visitor['aadhar_no']; ?>"
                                            class="fs-6" readonly>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group fs-6">
                                    <label>५) मिलनेवालेका नाम</label>
                                    <input type="text" name="meeting_person"
                                        value="<?php echo $visitor['to_see_whom']; ?>" class="fs-6" readonly style=" font-weight: bold;
">
                                </div>
                            </div>
                            <div class="col-sm-4 ">
                                <div class="form-group fs-6 ">
                                    <label>आने का प्रयोजन</label>
                                    <input type="text" name="purpose"
                                        value="<?php echo $visitor['purpose_to_visit']; ?>" class="fs-6" readonly style="font-weight: bold;
">
                                </div>
                            </div>

                        </div>






                        <!-- Signature Section -->
                        <div class="signature-section mt-4">
                            <div class="signature-box fs-6">आगंतुक के हस्ताक्षर</div>
                            <div class="signature-box fs-6">सुरक्षाकर्मी के हस्ताक्षर</div>
                            <div class="signature-box fs-6">मिलनेवाले के हस्ताक्षर</div>
                        </div>
                    </div>


                    <!-- LAST SECTION -->
                    <div id="licensed-entry-form mt-2">
                        <!-- Section Header -->
                        <div class="section-header text-center text-light bg-danger fs-5">
                            लाइसेंस प्राप्त क्षेत्र में प्रवेश के लिए
                        </div>

                        <p style="text-align: center; font-size: 12px;"><b>द्वारा अधिकृत</b></p>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-section  fs-6">
                                    <p>नाम : <span
                                            style="border-bottom: 1px solid black; display: inline-block; width: 200px;"></span>
                                    </p>
                                    <!-- <input type="text" name="visitor_name" class="fs-6" readonly> -->

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-section fs-6">
                                    <p class="">हस्ताक्षर : <span
                                            style="border-bottom: 1px solid black; display: inline-block; width: 200px;"></span>
                                    </p>
                                    <!-- <input type="text" name="visitor_signature" class="fs-6" readonly> -->
                                </div>
                            </div>
                            <div class="col-sm-4 fs-6 text-bold">
                                <p style="font-weight: bold;">Approve Status: <span
                                        style="margin-left: 10px; display: inline-block; width: auto; font-weight: bold;">
                                        <?php echo $visitor['visitor_status'] == 1 ? 'Approved' : 'Pending'; ?>
                                    </span>
                                </p>
                                <p style="font-weight: bold;">Access: <span style="color:red;";>
                                        <?php echo $visitor['access']; ?>
                                    </span>
                                </p>
                                <!-- <input type="text" readonly> -->

                            </div>
                        </div>


                        <!-- Visitor Information -->


                        <!-- ID & Purpose -->
                        <div class="form-section fs-6">

                            <p class="mt-1">उद्देश्य : </p>
                            <!-- <input type="text" name="purpose" class="fs-6" readonly> -->
                        </div>

                        <!-- Safety Information -->
                        <p class="fs-6" style=" text-align: center;">
                            I have been appraised about all safety precautions to be taken while in licensed area and
                            which
                            are also
                            printed on the backside of visitor slip.<br>
                            मुझे लाइसेंस क्षेत्र में प्रवेश हेतु जाने वाले सारे सुरक्षा सावधानियों के बारे में बताया गया
                            है।<br>
                            तथा सभी अनुदेश आगंतुक पत्र के पीछे मुद्रित है।
                        </p>

                        <!-- Signature Section -->
                        <div class="signature-section">
                            <div class="signature-box fs-5" id="security-signature">सुरक्षाकर्मी के हस्ताक्षर</div>
                            <div class="signature-box fs-5" id="visitor-signature">आगंतुक के हस्ताक्षर</div>
                        </div>

                        <!-- Time Entry Section -->
                        <div class="time-section">
                            <!-- <div class="time-box fs-6">
                                    <label>आगमन का समय</label>
                                    <div class="box-input">
                                        <input type="text" value=" <?php echo date('H:i:s'); ?>" class="fs-6" readonly>

                                    </div>
                                </div>
                                <div class="time-box fs-6">
                                    <label>प्रस्थान का समय</label>
                                    <div class="box-input">
                                        <input type="text" readonly>

                                    </div>
                                </div> -->
                        </div>
                    </div>




                    <div class="container-fluid">

                        <div class="content border-1">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="text-center text-light bg-danger fs-5 ">कृपया इन बातो को ध्यान रखे ।</h3>
                                    <ol class="fs-6">
                                        <li> सभी लोगोस अनुरोध है की अपनी सुरक्षा का ध्यान रखे ।</li>
                                        <li>संयंत्र में प्रवेश करते समय, सेफ्टी शुज, हेलमेट पहनकर आपना कार्य करे । </li>
                                        <li>संयंत्र को साफ सुथरा रखने मे सहयोग करे। संयंत्र मे पान मसाला एवं गुंटखों
                                            धूम्रपान वर्जित है।
                                        </li>
                                        <li>संयंत्र मे प्रवेश के लिए आज्ञा एवं अनुमतिपत्र का, होना आवश्यक है इसके लिए
                                            सेक्युरीटी
                                            गेट
                                            नं. १ पर संपर्क करे ।</li>
                                        <li>सभी अगंतुक आपना मोबाईल या अन्य इलेक्ट्रॉनिक उपकरण जमा करे और एवंम सुरक्षा
                                            जाच के लिए
                                            सहयोग करे । </li>
                                        <li> संयंत्र मे काई भी प्रकारकी अज्ञात वस्तु का, स्फोटक, पाये जानेपर सेक्युरीटी
                                            गेट नं. पर
                                            संपर्क करे । </li>
                                        <li> अपना निर्धारीत कर्यास्थल छोडकर अन्य किसी स्थान पे ना जाए |</li>
                                        <li> संयंत्र मे आपातकालीन स्थिती मे सभी आगंतूक जमाव स्थल पर एकत्रीत हो ।</li>

                                    </ol>

                                </div>
                                <div class="col-sm-6">
                                    <h3 class="text-center  fs-5 text-light bg-danger">PLEASE KEEP THIS POINTS IN MIND
                                    </h3>
                                    <ol class="fs-6">
                                        <li class="text-dark">Individuals are requested to take care of their safety.
                                        </li>
                                        <li>While entering the plant, please wear safety shoes and a helmet.</li>
                                        <li>Help in keeping the plant clean. Bringing pan masala and gutka into the
                                            plant
                                            is prohibited,Smoking is prohibited</li>
                                        <li>Entry into the plant requires permission and a pass. For this, please
                                            contact to
                                            Security
                                            Gate No. 1.</li>
                                        <li>All visitors are requested to deposit their mobile phones or other
                                            electronic
                                            devices
                                        </li>
                                        <li>If any unknown object, explosive, or suspicious items are found in the
                                            plant, please
                                            contact to Security Gate No. 1.</li>
                                        <li>Do not leave your designated work area and go to any other location.</li>
                                        <li>In case of an emergency, all visitors should gather at the assembly point.
                                        </li>


                                    </ol>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <?php // }?>
                <!-- Print Preview Modal -->


                <div class="modal-footer">
                    <footer>
                        <div class="d-flex m-auto justify-content-center">
                            <button class="btn btn-success me-1" onclick="printContent();">PRINT</button>

                            <button class="btn btn-primary ms-1" onclick="window.history.back()">BACK</button>
                        </div>
                    </footer>

                </div>

            </div> <!-- container-fluid ends here -->
            <!-- End Page Content -->
        </div>
    </div>

    <!-- Start writing content here -->
    <main>

    </main>

    <!-- printing code -->
    <script>
    function printContent() {
        // Get the new SrNo value
        var newSrNo = "<?php echo $last_srno + 1; ?>"; // Assuming $last_srno is defined

        // Update the SrNo element
        document.getElementById('srNo').innerText = newSrNo;

        // Get the token value
        const token = '<?php echo $visitor['token_no']; ?>'; // Assuming $token is defined

        // Construct the URL with token and newSrNo for CodeIgniter API
        var url =
            `<?php echo base_url('Visitor/processVisitor'); ?>?token=${encodeURIComponent(token)}&srno=${encodeURIComponent(newSrNo)}`;

        // Fetch data from the server
        fetch(url)
            .then(response => response.json()) // Parse JSON response
            .then(data => {
                console.log(data);
                if (data.success) {
                    console.log('Data sent successfully');
                } else {
                    console.log('Failed to send data:', data.message);
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });

        // Save the current content and then print
        var visitorContent = document.getElementById("content").innerHTML;
        var originalDocument = document.body.innerHTML;

        // Set the document content to the visitor's content and then print
        document.body.innerHTML = visitorContent;
        window.print();

        // Restore the original content
        document.body.innerHTML = originalDocument;
    }
    </script>




    <!-- giving title to document and navbar -->
    <script>
    document.getElementById('page-title').innerHTML = "IOCL  INOUT | Visitor Gate Pass";
    document.getElementById('navbar-title').innerHTML = "Visitor Gate Pass <i class='fa-solid fa-ticket'></i>";
    </script>

    <!-- Bootstrap JS (optional, only needed if you use Bootstrap components that require JavaScript) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Font Awesome JS (optional, only needed if you use Font Awesome icons) -->
    <!-- <script src="https://kit.fontawesome.com/6ee00b2260.js" crossorigin="anonymous"></script> -->

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
</body>
<?php
    // }
}
?>

</html>