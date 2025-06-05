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
    <link rel="stylesheet" href="<?php //echo 'http://localhost\eaglebyte\hpcl_in_out\hpcl_in_out\assets\css_js\style.css'; 
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

                <div class="card  border-0 shadow mt-4" id="two">

                    <div class="row mb-2">
                        <div class="col-md-12 mt-2 ms-2">
                            <button type="button" name="print" id="print" onclick="printContent();"
                                class="btn btn-success mx-1">Print</button>

                            <button type="submit" name="" onclick="exportToExcel()" class="btn btn-primary mx-1">Export
                                To
                                Excel</button>

                            <button type="button" name="back"
                                onclick="window.location.href = `<?php echo base_url('Report/AdvancedReport'); ?>`;"
                                class="btn btn-secondary mx-1">Back</button>
                            <!-- onclick="history.back(); location.reload(); return false;" -->
                        </div>

                    </div>

                    <div id="content">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th colspan="8" class="text-center">IN-OUT Report of IOCL</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4">From Date: <span id="fromdate1"><?= $fromdate ?></span></th>
                                        <th colspan="4">To Date: <span id="todate1"><?= $todate ?></span></th>
                                    </tr>
                                    <tr>
                                        <th>Driver Name</th>
                                        <th>Aadhar Number</th>
                                        <th>Vehicle Type</th>
                                        <th>Vehicle Number</th>
                                        <th>Parking Slot</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($reportdata) && (is_array($reportdata) || is_object($reportdata))): ?>
                                    <?php foreach ($reportdata as $report): ?>
                                    <tr>
                                        <td><?= $report['full_name'] ?></td>
                                        <td><?= $report['aadhar_no'] ?></td>
                                        <td><?= $report['vechile_type'] ?></td>
                                        <td><?= $report['vechile_number'] ?></td>
                                        <td><?= $report['parkingslots'] ?></td>
                                        <td><?= $report['time_in'] ?></td>
                                        <td><?= $report['out_time'] ?></td>
                                        <td><?= $report['parking_date'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center text-danger">Record Not Found</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div> <!-- container-fluid ends -->
                <!-- </div> -->

            </div>
            <!-- refresh code -->


            <!-- Custom JavaScript -->
            <script>
            document.getElementById('fromdate').addEventListener('change', function() {
                var fromDate = this.value;
                document.getElementById('todate').min = fromDate;
            });
            // Set the max attribute to today's date
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('fromdate').setAttribute('max', today);
            document.getElementById('todate').setAttribute('max', today);
            </script>
            <script>
            function setToDateMin() {
                let fromDate = document.getElementById('fromDate').value;
                document.getElementById('todate').min = fromDate;
            }
            </script>

            <!-- javascript print content function -->
            <script>
            function printContent() {

                var visitorContent = document.getElementById("content").innerHTML;
                var originalDocument = document.body.innerHTML;

                document.body.innerHTML = visitorContent;

                window.print();
                document.body.innerHTML = originalDocument;
            }
            </script>
            <!-- javascript print content function ends here -->

            <!-- javascript show function -->

            <!-- show function ends here -->

            <!-- export to excel file js code -->
            <script>
            function exportToExcel() {
                var location = 'data:application/vnd.ms-excel;base64,';
                var excelTemplate = '<html> ' +
                    '<head> ' +
                    '<meta http-equiv="content-type" content="text/plain; charset=UTF-8"/> ' +
                    '</head> ' +
                    '<body> ' +
                    document.getElementById("content").innerHTML +
                    '</body> ' +
                    '</html>'
                window.location.href = location + window.btoa(excelTemplate);
            }
            </script>
            <!-- export to excel file js code ends here -->

            <!-- giving title to document and navbar -->
            <script>
            document.getElementById('page-title').innerHTML = "IOCL  INOUT | ADVANCE REPORT";
            document.getElementById('navbar-title').innerHTML = "Advance Report";
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
            document.getElementById('sidebar-toggle').addEventListener('click', function() {
                document.querySelector('.wrapper').classList.toggle('sidebar-open');
                document.querySelector('.wrapper').classList.toggle('sidebar-closed');
            });
            </script>
            <?php
            if (isset($_POST['export_excel'])) {
                echo "<script>alert('Executed')</script>";
                header('Content-Type: application/xls');
                header('Content-Disposition: attachment; filename="report.xls"');
            }
            ?>
</body>

</html>