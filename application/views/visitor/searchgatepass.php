
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

                <div class="card " id="card">

                    <div class="card-body p-4">
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                        <div class="row">
                            <h3 class="card-title">Search By Sr No</h3>
                            <hr>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="inputsrno" class="form-label">Enter Sr No.</label>
                                    <input type="text" class="form-control" placeholder="Enter Sr No"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'')" name="inputsrno"
                                        id="inputsrno">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-1">
                                    <a class="btn btn-primary" onclick="searchGatePass()"><i class="fa-solid fa-magnifying-glass"></i> Search</a>
                                </div>
                                <div class="col-sm-1 ms-5">
                                    <a class="btn btn-secondary" onclick="window.history.back()"><i class="fa-solid fa-arrow-left"></i> Back</a>
                                </div>
                            </div>
                            <span id="nodata" style="color:red;"></span>



                        </div>
                    </div>
                </div>
            </div>
            <div class="content border p-3 mb-3" id="content" style="display: none;">

                <div class="header d-flex align-items-center justify-content-between border-bottom ">
                    <img src="" alt="" id="photo" class="image-fluid" height="80" width="120">
                    <div class="header-content text-center flex-grow-1">
                        <p class="fs-6 text-center fw-bold">Indian Oil Corporation Limited
                        <br>
                        Sinnar LPG Bottling Plant, G-6, MIDC, MIDC Area, Malegaon, 
                        Maharashtra 422113 GSTIN - 27AAACH1118B1ZC

</p>
                        <p class="text-uppercase text-center fs-6 fw-bolder">Visitor Slip</p>
                    </div>
                    <img src="" alt="" class="image-fluid" id="idphoto" height="120" width="120">
                </div>


                <div class="sub-header fs-6">
                    एल.पी.जी. भराई संयंत्र पातालगंगा | SINNAR LPG FILLING PLANT
                </div>

                <!-- Visitor Slip Info -->
                <div class="visitor-info">
                    <div class="fs-6 ">
                        <p class=""> दिनांक : <?php echo date("d-m-Y"); ?></p>
                        <span id="date"></span>
                        <label> Token No: <span id="token"></span></label>
                    </div>
                    <div>
                        <p class="fs-6"> VISITOR SLIP</p>
                    </div>
                    <p class="fs-6"> आगमन का समय (Arrival Time) : <span id="time_in"></span></p>
                    <div>
                        <p class="fs-6">प्रस्थान का समय (Departure Time) <br></p>
                        <input type="text" name="departure_time" id="time_out" readonly>
                    </div>
                </div>


                <!-- SECOND SECTION -->
                <div id="admin-area">
                    <!-- Section Header -->

                    <div class="section-header text-center text-light bg-success fs-6">
                        केवल एडमिन क्षेत्र में प्रवेश के लिए
                    </div>
                    <p class="fs-6"> SrNo: <span class="text-danger" id="srNo"></span></p>
                    <!-- Form Fields -->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group fs-6">
                                <label>१) आगंतुक का नाम</label>
                                <span class="text-uppercase" id="full_name">
                                </span>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group fs-6">
                                <label>२) कहाँ से आये (संपूर्ण पता)</label>
                                <span class="text-uppercase" id="address"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group fs-6">
                                <label> ३) आगंतुक का मोबाइल नं.</label><span id="mobile_no"></span>
                                <div class="box-input">

                                    <!-- <input type="text" name="mobile_no" id="mobile_no"> -->

                                </div>
                            </div>
                        </div>



                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group fs-6">
                                <label>४) पहचान पत्र क्रं.</label> <Span id="aadhar_no"></span>
                                <div class="box-input">
                                    <!-- <input type="text" name="aadhar_no" id="aadhar_no"> -->
                                    <!-- <span id="mobile_no"></span> -->

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group fs-6">
                                <label>५) मिलनेवालेका नाम</label>
                                <span class="text-uppercase" id="to_see_whom"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group fs-6">
                                <label>आने का प्रयोजन</label>
                                <span class="text-uppercase" id="purpose"></span>
                            </div>
                        </div>
                    </div>


                    <!-- Signature Section -->
                    <div class="signature-section">
                        <div class="signature-box fs-6">आगंतुक के हस्ताक्षर</div>
                        <div class="signature-box fs-6">सुरक्षाकर्मी के हस्ताक्षर</div>
                        <div class="signature-box fs-6">मिलनेवाले के हस्ताक्षर</div>
                    </div>
                </div>


                <!-- LAST SECTION -->
                <div id="licensed-entry-form">
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
                        <div class="col-sm-4 fs-6">
                        <p style="font-weight: bold;">Approve Status: <span style="margin-left: 10px; display: inline-block; width: auto; font-weight: bold;" id="visitor_status">
                                           
                                    </span>
                                </p>
                            <!-- <input type="text" readonly> -->

                        </div>
                    </div>


                    <!-- Visitor Information -->


                    <!-- ID & Purpose -->
                    <div class="form-section fs-6">

                        <!-- <p class="mt-1">उद्देश्य : </p> -->
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
                                    <input type="text" value="<?php // echo date('H:i:s'); ?>" class="fs-6" readonly>

                                </div>
                            </div> -->
                        <!-- <div class="time-box fs-6">
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
                                    <li>सभी अगंतुक आपना मोबाईल या अन्य इलेक्ट्रॉनिक उपकरण जमा करे और एवंम सुरक्षा जाच के
                                        लिए
                                        सहयोग करे । </li>
                                    <li> संयंत्र मे काई भी प्रकारकी अज्ञात वस्तु का, स्फोटक, पाये जानेपर सेक्युरीटी गेट
                                        नं. पर
                                        संपर्क करे । </li>
                                    <li> अपना निर्धारीत कर्यास्थल छोडकर अन्य किसी स्थान पे ना जाए |</li>
                                    <li> संयंत्र मे आपातकालीन स्थिती मे सभी आगंतूक जमाव स्थल पर एकत्रीत हो ।</li>

                                </ol>

                            </div>
                            <div class="col-sm-6">
                                <h3 class="text-center  fs-5 text-light bg-danger">PLEASE KEEP THIS POINTS IN MIND</h3>
                                <ol class="fs-6">
                                    <li class="text-dark">individuals are requested to take care of their safety.</li>
                                    <li>While entering the plant, please wear safety shoes and a helmet.</li>
                                    <li>Help in keeping the plant clean. Bringing pan masala and gutka into the
                                        plant
                                        is prohibited,Smoking is prohibited</li>
                                    <li>Entry into the plant requires permission and a pass. For this, please contact
                                        Security
                                        Gate No. 1.</li>
                                    <li>All visitors are requested to deposit their mobile phones or other electronic
                                        devices
                                    </li>
                                    <li>If any unknown object, explosive, or suspicious items are found in the plant,
                                        please
                                        contact Security Gate No. 1.</li>
                                    <li>Do not leave your designated work area and go to any other location.</li>
                                    <li>In case of an emergency, all visitors should gather at the assembly point.</li>


                                </ol>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
            <footer id="footer" style="display: none;">
                <div class="d-flex m-auto justify-content-center">
                    <button class="btn btn-success me-1" onclick="printContent()">PRINT</button>

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



    <script>
    // function searchGatePass() {
    //     var srno = document.getElementById('inputsrno').value.trim();
    //     if (srno.trim() === '') {
    //         alert("Enter the Sr No");
    //         return;
    //     }

    //     // Make a fetch request to check if visitor details are available
    //     fetch('search_visitor.php?srno=' + srno)
    //         .then(response => {
    //             if (!response.ok) {
    //                 throw new Error('Network response was not ok');
    //             }
    //             return response.json();
    //         })
    //         .then(data => {
    //             console.log(data);

    //             if (data.message == "data found") {
    //                 //var visitor = data.visitor;
    //                 console.log(true);
    //                 document.getElementById('content').style.display = "block";
    //                 document.getElementById('footer').style.display = "block";
    //                 document.getElementById('card').style.display = "none";

    //                 document.getElementById('srNo').innerHTML = data.srno;
    //                 document.getElementById('time_in').innerHTML = data.timein;
    //                 document.getElementById('time_out').innerHTML = data.timeout;
    //                 document.getElementById('date').innerHTML = data.date;
    //                 document.getElementById('token').innerHTML = data.token_no;
    //                 document.getElementById('aadhar_no').innerHTML = data.aadhar;
    //                 document.getElementById('mobile_no').innerHTML = data.mobile_no;
    //                 document.getElementById('full_name').innerHTML = data.full_name;
    //                 document.getElementById('address').innerHTML = data.address;
    //                 document.getElementById('to_see_whom').innerHTML = data.to_see_whom;
    //                 document.getElementById('purpose').innerHTML = data.purpose_to_visit;
    //                 document.getElementById('photo').src = data.photo;
    //                 document.getElementById('idphoto').src = data.idphoto;
    //                 console.log(idphoto);
    //                 // document.getElementById('qr_code').src = data.qrpath;






    //                 // Add more details as needed
    //             } else {
    //                 document.getElementById('nodata').textContent = "No data found";
    //             }
    //         })
    //         .catch(error => {
    //             console.error('There was an error with the fetch request:', error);
    //             document.getElementById('result').textContent = "An error occurred while processing your request.";
    //         });
    // }
    </script>


<script>
const searchGatePass = async () => {
    const sr_no = document.getElementById('inputsrno').value;
    const nodata = document.getElementById('nodata');
    const content = document.getElementById('content');
    const footer = document.getElementById('footer').style.display = "block";


    if (!sr_no) {
        nodata.textContent = 'Please enter Sr No.';
        return;
    }

    try {
        const response = await fetch("<?= base_url('Visitor/search'); ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: new URLSearchParams({ inputsrno: sr_no })
        });

        const data = await response.json();

        if (data.status === 'not_found') {
            nodata.textContent = 'No data found';
            content.style.display = 'none';
        } else {
            nodata.textContent = '';
            content.style.display = 'block';
            console.log(data);

            document.getElementById('srNo').textContent = data.srno;
            document.getElementById('full_name').textContent = data.full_name;
            document.getElementById('address').textContent = data.address;
            document.getElementById('mobile_no').textContent = data.mobile_no;
            document.getElementById('time_in').textContent = data.time_in;

            document.getElementById('token').textContent = data.token_no;
            document.getElementById('photo').src = `<?= base_url(); ?>${data.photo}`;
            document.getElementById('idphoto').src = `<?= base_url(); ?>${data.idphoto}`;
            document.getElementById('to_see_whom').textContent = data.to_see_whom;
            document.getElementById('purpose').innerHTML = data.purpose_to_visit;
            document.getElementById('aadhar_no').textContent = data.aadhar_no;
            document.getElementById('visitor_status').textContent = data.visitor_status === '0' ? 'Pending' : 'Approved';



            // document.getElementById('qr_code').src =`<?= base_url().'uploads/qr_code/'; ?>${data.qr_path}`;

        }
    } catch (error) {
        console.error("Error fetching visitor data:", error);
    }
};
</script>

    <script>
    function printContent() {

        var visitorContent = document.getElementById("content").innerHTML;
        var originalDocument = document.body.innerHTML;

        document.body.innerHTML = visitorContent;

        window.print();
        document.body.innerHTML = originalDocument;
    }
    </script>
    <!-- giving title to document and navbar  -->
    <script>
    document.getElementById('page-title').innerHTML = "IOCL  INOUT | Search Gate Pass ";
    document.getElementById('navbar-title').innerHTML = "Search Gate Pass <i class='fa-solid fa-ticket'></i>";
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
</body>

</html>