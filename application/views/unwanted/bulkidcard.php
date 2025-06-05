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
            <div class="container-fluid mb-5">
                              <!-- container-fluid -->
                              <!-- Icard code here -->
                              <div class="content" id="contentToPrint">
                                   <header class="mb-2">
                                        <div class="row">
                                             <!-- logo div -->
                                             <div class="col-lg-1">
                                                  <img id="image2" src="https://manasvi.tech/demo/assest/img/logos/hp.png" alt="hpcl logo"
                                                       class="img-fluid" style="max-width: 70px;">
                                             </div>
                                             <!-- header text div -->
                                             <div class="col-lg-11 text-body-tertiary text-center" id="hpcl">
                                                  <p class="fw-medium fs-3"><span>Hindustan Petroleum Corporation
                                                            Limited</span><br>
                                                       <span>Sinnar LPG Bottling Plant, G-6, MIDC, MIDC Area, Malegaon, Maharashtra 422113</span>
                                                  </p>
                                             </div>
                                        </div>
                                   </header>
                                   <main>
                                        <div class="qr-text-div row text-center mb-4" style="background-color: red;" id="nav1">
                                             <p class="fs-1 fw-bold text-light text-uppercase"><span id="qr-text">
                                                    OPR - <?php //echo $qr_code; ?>
                                                  </span></p> <!-- OPR-GAT/HPNSK/2 -->
                                        </div>
                                        <div class="row">
                                             <div class="col-lg-8">
                                                  <ul class="fs-3 fw-bold text-start text-body-tertiary"
                                                       style="list-style-type: none;">
                                                       <li><span>Name: </span><span>
                                                                 <?php //echo $name; ?>
                                                            </span></li>
                                                       <li><span>Phone  Number: </span><span>
                                                                 <?php //echo $mobile_no; ?>
                                                            </span></li>
                                                       <li><span>Address: </span><span>
                                                                 <?php //echo $address; ?>
                                                            </span></li>
                                                       <li><span>Working as : </span><span>
                                                                 <?php //echo $working_as; ?>
                                                                 Driver - Bulk

                                                            </span></li>
                                                  </ul>
                                             </div>
                                             <div class="col-lg-4">
                                                  <img id="image1"  src="<?php //echo $filename; ?>" alt="qr_code"
                                                       height="200" width="200" class="d-block m-auto">
                                                  <!-- qr_code image -->
                                             </div>
                                        </div>
                                        <div class="row fs-1 fw-medium text-dark" id="si">
                                             <div class="col-lg-4 col-md-4" id="sign1">
                                                  <p class="text-center">Sign and Seal of <br> Contractor</p>
                                             </div>
                                             <div class="col-lg-4 col-md-4" id="sign2">
                                                  <p class="text-center">Sign./ Thumb <br> Impression of the <br> pass holder</p>
                                             </div>
                                             <div class="col-lg-4 col-md-4"  id="sign3">
                                                  <p class="text-center">Attestation by HPCL <br> Plant In charge</p>
                                             </div>
                                        </div>

                                        <div class="qr-text-div row text-center mb-4" id="nav1" style="background-color: red;">
                                             <p class="fs-1 fw-bold text-light"><span id="qr-text">
                                                       <?php //echo $working_as; ?>
                                                       DRIVER - BULK

                                                  </span></p>
                                        </div>
                                   </main>
                              </div>
                              <footer>
                                   <div class="row">
                                        <div class="col-lg-1">
                                             <button class="btn btn-success" name="submit"  id="printButton">
                                                  <i class="fa-solid fa-print"></i>
                                                  <span>Print</span></button>
                                        </div>
                                        <div class="col-lg-1">
                                             <button class="btn btn-danger" onclick="history.back(); return false;" name="back"><i
                                                       class="fa-solid fa-arrow-left"></i>
                                                  Back</button>
                                        </div>
                                   </div>
                              </footer>
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
                    document.getElementById('page-title').innerHTML = "IOCL  INOUT | Bulk";
                    document.getElementById('navbar-title').innerHTML = "Bulk I-Card";               
               </script>

               <!-- Bootstrap JS (optional, only needed if you use Bootstrap components that require JavaScript) -->
               <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                    crossorigin="anonymous"></script>

               <!-- Font Awesome JS (optional, only needed if you use Font Awesome icons) -->
               <script src="https://kit.fontawesome.com/6ee00b2260.js" crossorigin="anonymous"></script>

               <!-- Custom JavaScript -->
               <script>
                    // JavaScript to toggle sidebar
                    // document.getElementById('sidebar-toggle').addEventListener('click', function () {
                    //      document.querySelector('.wrapper').classList.toggle('sidebar-open');
                    //      document.querySelector('.wrapper').classList.toggle('sidebar-closed');
                    // });
                    document.getElementById('sidebar-toggle').addEventListener('click', function () {
                         document.querySelector('.wrapper').classList.toggle('sidebar-open');
                         document.querySelector('.wrapper').classList.toggle('sidebar-closed');
                    });
               </script>
          </body>
          <?php
    // }

//}
?>

   <!-- <script>
        $(document).ready(function(){
            $('#printBtn').click(function(){
                var divToPrint=document.getElementById('content');

                var newWin=window.open('','Print-Window');

                newWin.document.open();

                newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

                newWin.document.close();

                setTimeout(function(){newWin.close();},10);
            });

        })
    </script> -->




    <script>
       
       document.getElementById('printButton').addEventListener('click', function () {
           var contentToPrint = document.getElementById('contentToPrint').outerHTML;
           var printWindow = window.open('', '', 'width=1000, height=800');
           printWindow.document.open();
           printWindow.document.write('<html><head><title>Print</title></head><body>');
           // Add CSS styles for individual images by their IDs
           printWindow.document.write('<style type="text/css">');
              printWindow.document.write('#image2 { margin-left: 0px; margin-top: 0px; }');
              printWindow.document.write('#hpcl { margin-left: 100px;margin-top: -80px;}');
           printWindow.document.write('#image1 { margin-left: 500px; margin-top: -100px; }');

           printWindow.document.write('#si {margin-left:50px  }'); 

           
               printWindow.document.write('#sign1 {display:inline-flex;  }');
              printWindow.document.write('#sign2 {display:inline-flex; margin-left:150px;  }');
              printWindow.document.write('#sign3 {display:inline-flex;margin-left:150px  }'); 
              printWindow.document.write('#nav1 { margin-left: 0px; margin-top: 0px; font-size: 32px; text-align: center; color:white;font-weight: bold; }');

           printWindow.document.write('</style>');
           printWindow.document.write(contentToPrint);
           printWindow.document.write('</body></html>');
           printWindow.document.close();
           // You can add a delay to ensure images load before printing
           setTimeout(function () {
               printWindow.print();
               printWindow.close();
           }, 1000); // Adjust the delay as needed
       });
   </script>
    <!-- <script>
       
       document.getElementById('printButton').addEventListener('click', function () {
           var contentToPrint = document.getElementById('contentToPrint').outerHTML;
           var printWindow = window.open('', '', 'width=1000, height=800');
           printWindow.document.open();
           printWindow.document.write('<html><head><title>Print</title></head><body>');
           // Add CSS styles for individual images by their IDs
           printWindow.document.write('<style type="text/css">');
              printWindow.document.write('#image2 { margin-left: 0px; margin-top: 0px; }');
              printWindow.document.write('#hpcl { margin-left: 100px;margin-top: -80px;}');
           printWindow.document.write('#image1 { margin-left: 500px; margin-top: -100px; }');
               printWindow.document.write('#sign1 {display:inline-flex;  }');
              printWindow.document.write('#sign2 {display:inline-flex; margin-left:150px;  }');
              printWindow.document.write('#sign3 {display:inline-flex;margin-left:150px  }'); 
              printWindow.document.write('#nav1 { margin-left: 0px; margin-top: 0px; font-size: 32px; text-align: center; color:white;font-weight: bold; }');

           printWindow.document.write('</style>');
           printWindow.document.write(contentToPrint);
           printWindow.document.write('</body></html>');
           printWindow.document.close();
           // You can add a delay to ensure images load before printing
           setTimeout(function () {
               printWindow.print();
               printWindow.close();
           }, 1000); // Adjust the delay as needed
       });
   </script> -->
</body>

</html>
