<!-- including config file to use database -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="page-title"></title>
    <link rel="icon" href="../../assest/img/logos/hp.png" type="image/gif" sizes="16x16">
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




    <?php //include($external_links_loc); 
    ?>
    <!-- stylesheet files -->
    <!-- <link rel="stylesheet" href="<?php echo base_url() . 'assets/css_js/style.css'; ?> "> -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css_js/style.css'; ?> ">

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

                <?php
                // echo "failllllllllllllllllllllllllllllllllllllllllllll";die;

                // echo $_GET['fd'];
                // echo $_GET['ft'];
                // echo 'hello';die;
                if (isset($_GET['fd']) && isset($_GET['ft']) && isset($_GET['tt'])) {
                    // echo "yessssssssssssssssssssssssssssssssssssssssssssssssssssssse";die;
                ?>

                    <div class="card border-0 shadow mt-4" id="two">
                        <div class="row mb-2">
                            <div class="col-md-12 mt-2 ms-2">
                                <button type="button" name="print" id="print" onclick="printContent();" class="btn btn-success mx-1">Print</button>
                                <button type="submit" name="" onclick="exportToExcel()" class="btn btn-primary mx-1">Export To Excel</button>
                                <!-- <button type="button" name="back" onclick="window.location.href = 'night_report.php';" class="btn btn-secondary mx-1">Back</button> -->
                                <a href="<?php echo base_url() . 'Report/NightReport'; ?>" class="btn btn-secondary mx-1">Back</a>

                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12 mt-2 ms-2">
                                <ul class="nav nav-tabs" id="gateTabs">
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo (!isset($_GET['gate']) || $_GET['gate'] == 'all') ? 'active' : ''; ?>" href="#" data-gate="all">All</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo (isset($_GET['gate']) && $_GET['gate'] == 'maingate') ? 'active' : ''; ?>" href="#" data-gate="maingate">Main Gate</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo (isset($_GET['gate']) && $_GET['gate'] == 'licensegate') ? 'active' : ''; ?>" href="#" data-gate="licensegate">License Gate</a>
                                    </li>
                                </ul>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        const tabs = document.querySelectorAll('#gateTabs .nav-link');
                                        tabs.forEach(function(tab) {
                                            tab.addEventListener('click', function(e) {
                                                e.preventDefault();
                                                tabs.forEach(t => t.classList.remove('active'));
                                                this.classList.add('active');
                                                const gate = this.getAttribute('data-gate');
                                                document.querySelectorAll('tr.data-row').forEach(function(row) {
                                                    if (gate === 'all' || row.getAttribute('data-gate') === gate) {
                                                        row.style.display = '';
                                                    } else {
                                                        row.style.display = 'none';
                                                    }
                                                });
                                            });
                                        });
                                    });
                         </script>
                            </div>
                        </div>

                        <div id="content">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th colspan="7">IN-OUT Report of IOCL</th>
                                        </tr>
                                        <tr>
                                            <th>Department : <span id="dept1" style="text-transform: capitalize"><?php echo $_GET['dept'] ?? 'All'; ?></span></th>
                                            <th colspan="2">Sub-Department : <span id="date1" style="text-transform: capitalize"><?php echo $_GET['sub_dept'] ?? 'All'; ?></span></th>
                                            <th colspan="2">From Time : <span id="fromtime1"><?php 
                                            echo !empty($_GET['ft']) ? date("h:i A", strtotime($_GET['ft'])) : '-'; 
                                            ?></span></th>
                                                                                <th colspan="2">To Time : <span id="totime1"><?php 
                                            echo !empty($_GET['tt']) ? date("h:i A", strtotime($_GET['tt'])) : '-'; 
                                            ?></span></th>
                                        </tr>
                                        <tr>
                                            <th>Department</th>
                                            <th>Name</th>
                                            <th>Sub-Department</th>
                                            <th>Check In Date</th>
                                            <th>Time In</th>
                                            <th>Time Out</th>
                                            <th>Check Out Date</th>
                                            <th>Gate Name</th>
                                        </tr>

                                        <?php
                                        // Get the selected gate filter from URL
                                        $selectedGate = $_GET['gate'] ?? 'all';
                                        // Get SQL query
                                        // $sqldata = GetSql();

                                        foreach ($data1['data'] as $row) {
                                        ?>
                                            <tr class="data-row" data-gate="<?php echo $row['source_table']; ?>">
                                                <td class="text-capitalize"><?php echo $row['department']; ?></td>
                                                <td class="text-capitalize"><?php echo $row['name']; ?></td>
                                                <?php 
                                                if($row['section'] == 'OFC'){
                                                    echo '<td class="text-capitalize">Officer</td>';
                                                } elseif($row['section'] == 'EMP') {
                                                   echo '<td class="text-capitalize">Employee</td>';

                                                } elseif($row['section'] == 'CON'){
                                                   echo '<td class="text-capitalize">Contractor</td>';
                                                } elseif($row['section'] == 'CONW'){
                                                    echo '<td class="text-capitalize">Contractor_Workman</td>';
                                                } elseif($row['section'] == 'GAT'){
                                                    echo '<td class="text-capitalize">Gat</td>';
                                                } elseif($row['section'] == 'TAT'){
                                                     echo '<td class="text-capitalize">Tat</td>';
                                                } elseif($row['section'] == 'FEG'){
                                                    echo '<td class="text-capitalize">Feg</td>';
                                                } elseif($row['section'] == 'SEC'){
                                                    echo '<td class="text-capitalize">Sec</td>';
                                                } elseif($row['section'] == 'MT') {
                                                     echo '<td class="text-capitalize">Mathadi</td>';
                                                } elseif($row['section'] == 'PT'){
                                                     echo '<td class="text-capitalize">Packed</td>';
                                                } elseif($row['section'] == 'BK'){
                                                     echo '<td class="text-capitalize">Bulk</td>';
                                                } elseif($row['section'] == 'TR'){
                                                     echo '<td class="text-capitalize">Transporter</td>';
                                                } elseif($row['section'] == 'PW'){
                                                     echo '<td class="text-capitalize">Workman</td>';
                                                } elseif($row['section'] == 'AMC'){
                                                     echo '<td class="text-capitalize">Amc</td>';
                                                } elseif($row['section'] == 'V'){
                                                     echo '<td class="text-capitalize">Visitor</td>';
                                                } else {
                                                    echo '<td class="text-capitalize">Unknown</td>';
                                                }   
                                                    
                                                ?>
                                                <td><?php echo $row['date']; ?></td>
                                               <td>
                                            <?php 
                                            echo !empty($row['intime']) ? date("h:i A", strtotime($row['intime'])) : '-'; 
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                            echo !empty($row['outtime']) ? date("h:i A", strtotime($row['outtime'])) : '-'; 
                                            ?>
                                        </td>
                                                <td><?php echo $row['date']; ?></td>
                                                <td class="text-capitalize">
                                                    <?php
                                                    if ($row['source_table'] == "drivergate") {
                                                        echo "Driver Gate";
                                                    } else if ($row["source_table"] == "maingate") {
                                                        echo "Main Gate";
                                                    } else if ($row["source_table"] == "licensegate") {
                                                        echo "License Gate";
                                                    } else {
                                                        echo $row["source_table"];
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
        <?php
                } else {
        ?>
            <div class="card border-0 shadow mt-4" id="one" style="display:block;">
                <div class="card-body">
                    <div class="one">
                        <form method="get" action="<?php echo base_url() . 'Report/generate'; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date" class="col-form-label">From Date:</label>
                                        <input type="date" class="form-control" name="fromdate"
                                            value="<?= date("Y-m-d"); ?>" id="fromdate" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date" class="col-form-label">To Date:</label>
                                        <input type="date" class="form-control" name="todate"
                                            value="<?= date("Y-m-d", strtotime("+1 day")); ?>" id="todate" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fromtime" class="col-form-label">From Time :</label>
                                        <input type="time" class="form-control" name="fromtime" id="fromtime" value="16:00:00" min="" max="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="totime" class="col-form-label">To Time :</label>
                                        <input type="time" class="form-control" name="totime" id="totime" min="" max="" value="07:00:00">
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-3">
                                    <div class="form-group col-md-3 text-center">
                                        <button type="submit" onclick="show()" class="btn btn-lg btn-primary">Generate Report</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>


                <!-- alert div -->
                <?php
                    if ($this->session->flashdata("Error")) {
                ?>
                    <div class="alert alert-danger" id="errorbox">
                        <?php echo $this->session->flashdata("Error"); ?>
                    </div>
                <?php
                    }
                ?>

                <script>
                    setTimeout(function() {
                        document.getElementById("errorbox").style.display = "none";
                    }, 3000);
                </script>

            </div>
        <?php
                }
        ?>
        </div>
    </div>

    <script>
        document.getElementById("fromdate").addEventListener("change", function() {
            let fromDate = this.value;
            if (fromDate) {
                let nextDate = new Date(fromDate);
                nextDate.setDate(nextDate.getDate() + 1); // Add 1 day

                let nextDateStr = nextDate.toISOString().split('T')[0]; // Format as YYYY-MM-DD
                document.getElementById("todate").value = nextDateStr;
            }
        });
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
    <script>
        function show() {
            // let f = document.getElementById('fromdate').value;
            // let e = document.getElementById('todate').value;

            let t = document.getElementById('fromtime').value;
            let d = document.getElementById('totime').value;

            // document.getElementById('date1').innerText = f;
            // document.getElementById('date2').innerText = e;

            document.getElementById('fromtime1').innerText = t;
            document.getElementById('totime1').innerText = d;
        }
    </script>
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
        document.getElementById('page-title').innerHTML = "IOCL  INOUT | Night REPORT";
        document.getElementById('navbar-title').innerHTML = "Night Report";
    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Font Awesome CDN (Replaced Invalid Kit) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Custom JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarToggle = document.getElementById("sidebar-toggle");
            if (sidebarToggle) {
                sidebarToggle.addEventListener("click", function() {
                    document.querySelector(".wrapper").classList.toggle("sidebar-open");
                    document.querySelector(".wrapper").classList.toggle("sidebar-closed");
                });
            }
        });
    </script>

    <?php
    if (isset($_POST['export_excel'])) {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="report.xls"');
        exit(); // Stop script execution after headers
    }
    ?>

</body>

</html>