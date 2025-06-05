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
                    <div class="card  border-0 shadow mt-4" id="two">

                         <div class="card border-0 shadow mt-4" id="one" style="display:block;">

                              <div class="card-body">
                                   <div class="one">
                                        <form method="post" action="<?php echo base_url('report/AdvanceReportPost'); ?>">
                                             <div class="row">
                                                  <div class="col-md-3">
                                                       <div class="form-group">
                                                            <label for="fromdate" class="col-form-label ">From Date
                                                                 :</label>
                                                            <input type="date" class="form-control" name="fromdate"
                                                                 value="<?= date("Y-m-d"); ?>" id="fromdate" max="">

                                                       </div>
                                                  </div>
                                                  <div class="col-md-3">
                                                       <div class="form-group">
                                                            <label for="todate" class="col-form-label ">To Date
                                                                 :</label>
                                                            <input type="date" class="form-control" name="todate"
                                                                 value="<?= date("Y-m-d"); ?>" id="todate" min="" max="">

                                                       </div>
                                                  </div>
                                                  <div class="col-md-3">
                                                       <div class="form-group">
                                                            <label for="dept"
                                                                 class="col-form-label ">Department :</label>
                                                            <select class="form-control" name="department" id="dept"
                                                                 onchange="setRespectiveSubDepartment(this.id,'sub_dept'); gatefun(this.id, 'gate');">
                                                                 <!-- <option value="">Select gate</option> -->
                                                                 <option class="dropdown-toggle" value="All">All
                                                                 </option>
                                                                 <option value="operation">Operation</option>
                                                                 <option value="driver">Driver</option>
                                                                 <option value="project">Project</option>
                                                                 <option value="visitor">Visitor</option>

                                                            </select>
                                                       </div>
                                                  </div>
                                                  <div class="col-md-3">
                                                       <div class="form-group">
                                                            <label for="sub_dept"
                                                                 class="col-form-label ">Sub-Department :</label>
                                                            <select class="form-control form-control" name="sub_department"
                                                                 id="sub_dept" onchange="setNames()">
                                                                 <!-- <option value="">Select gate</option> -->
                                                                 <option value="All">All</option>
                                                            </select>
                                                       </div>

                                                  </div>
                                             </div>

                                             <div class="row">
                                                  <div class="col-md-6">
                                                       <div class="form-group">
                                                            <label for="s_by_name" class="col-form-label ">Search by
                                                                 Name :</label>
                                                            <select class="form-control" name="name"
                                                                 oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'')"
                                                                 placeholder="Select Name" id="s_by_name">
                                                                 <!-- <option value="">Select gate</option> -->
                                                                 <option value="All">All</option>
                                                            </select>
                                                       </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                       <div class="form-group">
                                                            <label for="gate" class="col-form-label ">Gate :</label>
                                                            <select class="form-control form-control" name="gate"
                                                                 id="gate">
                                                                 <!-- <option value="">Select gate</option> -->
                                                                 <option value="all">All</option>
                                                                 <option value="maingate">Main Gate</option>
                                                                 <option value="licensegate">License Gate</option>
                                                                 <option value="drivermaingate">Truck Main Gate</option>
                                                                 <option value="driverlicensegate">Truck License Gate</option>
                                                            </select>
                                                       </div>
                                                  </div>
                                             </div>

                                             <div class="row">
                                                  <div class="form-group col-md-3">
                                                       <button type="submit" name="generate" onclick="show()"
                                                            class="btn btn-lg btn-primary">Generate Report</button>
                                                       <!-- <input type="submit" onclick="display();" name="generate"> -->
                                                  </div>
                                                  <div class="col-md-9"></div>
                                             </div>
                                        </form>
                                   </div>
                              </div>
                         </div>
                    </div> <!-- container-fluid ends -->
                    <!-- </div> -->

               </div>
                    <script>
                    window.addEventListener('pageshow', function (event) {
                    if (event.persisted || (window.performance && performance.getEntriesByType("navigation")[0].type === "back_forward")) {
                         // Reload the page
                         window.location.reload();
                    }
                    });
                    </script>
               <!-- Custom JavaScript -->
               <script>
                    // function to set respective sub department
                    function setRespectiveSubDepartment(s1, s2) {

                         var s1 = document.getElementById(s1);
                         var s2 = document.getElementById(s2);
                         // console.log(s1.value);
                         s2.innerHTML = "";
                         if (s1.value == "operation") {
                              var optionArray = ['All|All', 'officer|Officer', 'employee|Employee', 'contractor|Contractor', 'contractor workman|Contractor Workman', 'mathadi|Mathadi', 'gat|GAT', 'tat|TAT', 'sec|SEC', 'feg|FEG'];
                              // console.log(s1.value+"Operation");


                         } else if (s1.value == "driver") {
                              var optionArray = ['All|All', 'packed|Packed', 'bulk|Bulk', 'transporter|Transporter'];
                              var gateoption = ['driver gate|Driver Gate'];
                              // console.log(s1.value+"Driver");

                         } else if (s1.value == "project") {
                              var optionArray = ['All|All', 'workman|Workman', 'amc|AMC'];
                              // console.log(s1.value+"Project");

                         } else if (s1.value == "visitor") {
                              var optionArray = ['All|All', 'visitor|Visitor'];
                              // console.log(s1.value+"Visitor");

                         } else if (s1.value == "all") {
                              var optionArray = ['All|All'];
                              // console.log(s1.value+"All");
                         } else {
                              var optionArray = ['All|All'];
                              // console.log(s1.value+"All");
                         }

                         for (var option in optionArray) {
                              var pair = optionArray[option].split("|");
                              var newoption = document.createElement("option");
                              newoption.value = pair[0];
                              newoption.innerHTML = pair[1];
                              s2.options.add(newoption);
                         }
                    }

                    // function to set names in name fieldq
                  // function to set names in name field
                    function setNames() {
                         // Get selected department and sub-department
                         const subDepartment = document.getElementById('sub_dept').value;

                         // Build the URL with query parameters
                         const url = "<?= base_url('Report/getNames') ?>?sub_department=" + encodeURIComponent(subDepartment);

                         fetch(url)
                              .then(response => response.json())
                              .then(data => {
                                   console.log(data);
                                   const select = document.getElementById("s_by_name");

                                   // Clear existing options
                                   select.innerHTML = '';

                                   // Add the "All" option first
                                   const allOption = document.createElement("option");
                                   allOption.value = "All";
                                   allOption.textContent = "All";
                                   select.appendChild(allOption);

                                   // Add fetched names
                                   if (Array.isArray(data)) {
                                        data.forEach(item => {
                                             if (item.full_name) {
                                                  const option = document.createElement("option");
                                                  option.value = item.full_name;
                                                  option.textContent = item.full_name;
                                                  select.appendChild(option);
                                             }
                                        });
                                   }
                              })
                              .catch(error => console.error("Error fetching names:", error));
}
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