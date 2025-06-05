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
<?php 


function getSubDepartment($section)
{
     switch ($section) {
               // operation
          case 'OFC':
               return "Officer";
          case 'EMP':
               return "Employee";
          case 'CON':
               return "Contractor";
          case 'CONW':
               return "Contractor Workman";
          case 'GAT':
               return "GAT";
          case 'TAT':
               return "TAT";
          case 'FEG':
               return "FEG";
          case 'SEC':
               return "SEC";
          case 'MT':
               return "Mathadi";

               // driver 
          case 'PT':
               return "Packed";
          case 'BK':
               return "Bulk";
          case 'TR':
               return "Transporter";

               // project
          case 'AMC':
               return "AMC";
          case 'PW':
               return "Workman";

               // visitor
          case 'V':
               return "Visitor";

            //    all departments
               case 'all':
                    return "all";
               case 'All':
                    return "all";
     }
}
?>
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

                            <button type="submit" name="" onclick="exportToExcel()"
                                class="btn btn-primary mx-1">Export To
                                Excel</button>

                            <button type="button" name="back" onclick="window.location.href = `<?php echo base_url('Report/AdvancedReport'); ?>`;"
                                class="btn btn-secondary mx-1">Back</button>
                            <!-- onclick="history.back(); location.reload(); return false;" -->
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
                                        <th>Department :<span id="dept1" style="text-transform: capitalize ">
                                                <?php echo $urldata['department']; ?>
                                                <!-- <script>document.write(document.getElementById('dept').value);</script> -->
                                            </span></th>
                                        <th colspan="2">Sub-Department :<span id="sub_dept1" style="text-transform: capitalize ">
                                                <?php echo $urldata['sub_department']; ?>
                                                <!-- <script>document.getElementById('sub_dept1').innerHTML = document.getElementById('sub_dept').value</script> -->
                                            </span></th>
                                        <th colspan="2">From Date :<span id="fromdate1">
                                                <?php echo $urldata['fromdate']; ?>
                                                <!-- <script>document.getElementById('fromdate1').innerHTML = document.getElementById('fromdate').value</script> -->
                                            </span></th>
                                        <th colspan="2">To Date :<span id="todate1">
                                                <?php echo $urldata['todate']; ?>
                                                <!-- <script>document.getElementById('todate1').innerHTML = document.getElementById('todate').value</script> -->
                                            </span></th>
                                    </tr>

                                    <tr>
                                        <!-- <th>sr</th> -->
                                        <th>Department</th>
                                        <th>Name</th>
                                        <th>Sub-Department</th>
                                        <th>Check-In Date</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                        <th>Check-Out Date</th>
                                        <th>Gate Name</th>
                                    </tr>

                                    
                                        <?php 
                                        if(is_array($reportdata) || is_object($reportdata)){
                                            foreach($reportdata as $report){
                                        ?>
                                        <tr>
                                        <!-- <th>sr</th> -->
                                        <td><?php echo $report['department'] ?></td>
                                        <td><?php echo $report['name'] ?></td>
                                        <td><?php echo getSubDepartment($report['section']) ?></td>
                                        <td><?php echo $report['date'] ?></td>
                                        <td>
                                            <?php 
                                            echo !empty($report['intime']) ? date("h:i A", strtotime($report['intime'])) : '-'; 
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                            echo !empty($report['outtime']) ? date("h:i A", strtotime($report['outtime'])) : '-'; 
                                            ?>
                                        </td>

                                        <td><?php echo $report['date'] ?></td>
                                        <?php 
                                        if($report['gatename'] == "maingate"){
                                            $gate = "Main Gate";
                                        } elseif($report['gatename'] == "licensegate"){
                                            $gate = "License Gate";
                                        } elseif($report['gatename'] == "drivermaingate"){
                                            $gate = "Truck Main Gate";
                                        } elseif($report['gatename'] == "driverlicensegate"){
                                            $gate = "Truck License Gate";
                                        } else {
                                            $gate = "no gate found";
                                        }
                                        ?>
                                         <td><?php echo $gate ?>

                                    </td>
                                    </tr>
<?php
                                            }
                                        }else{
                                            ?>
                                            <tr>
                                        <td colspan="8">
                                            <span class="text-danger">
                                                <?php echo "Record Not Found"; ?>
                                            </span>
                                        </td>
                                    </tr>
                                            <?php
                                        }
                                        ?>

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
            <script>
                function show() {
                    let f = document.getElementById('fromdate').value;
                    let t = document.getElementById('todate').value;
                    let d = document.getElementById('dept').value;
                    let s = document.getElementById('sub_dept').value;

                    document.getElementById('fromdate1').innerText = f;
                    document.getElementById('todate1').innerText = t;
                    document.getElementById('dept1').innerText = d;
                    document.getElementById('sub_dept1').innerText = s;

                    // console.log(f);
                    // console.log(t);

                    // console.log(d);

                    // console.log(s);

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