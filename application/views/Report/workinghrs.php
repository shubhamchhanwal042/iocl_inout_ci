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
    <link rel="icon" href="<?php echo base_url() . 'assets/images/bpcllogo.jfif'; ?>" type="image/gif" sizes="16x16">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="icon" href="<?php echo base_url() . 'assets/images/bpcllogo.jfif'; ?>" type="image/gif" sizes="16x16">
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

        <div></div>
        <div class="container-fluid">
            <!-- including navbar -->
            <?php $this->load->view('include/navbar'); ?>

            <div></div>
            <!-- Page Content -->
            <div class="container-fluid">
                <!-- container-fluid -->
                <div class="card border-0 shadow mt-4" id="one" style="display:block;">
                    <div class="card-body">
                        <div class="one">
                            <form method="post" action="">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fromdate" class="col-form-label ">From Date :</label>
                                            <input type="date" class="form-control" name="fromdate" id="fromdate" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="todate" class="col-form-label ">To Date :</label>
                                            <input type="date" class="form-control" name="todate" id="todate" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="dept" class="col-form-label ">Department :</label>
                                            <select class="form-control" name="dept" id="dept"
                                                onchange="p(this.id,'sub_dept'); gatefun(this.id, 'gate');"
                                                required>
                                                <option value="" disbled selected>Select Department</option>
                                                <option value="operation">Operation</option>
                                                <option value="driver">Driver</option>
                                                <option value="project">Project</option>
                                                <option value="visitor">Visitor</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sub_dept" class="col-form-label ">Sub-Department :</label>
                                            <select class="form-control form-control" name="sub_dept" id="sub_dept"
                                                onchange="setNames()" required>
                                                <option value="" disabled selected>Select Sub-Department</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s_by_name" class="col-form-label ">Search by Name :</label>
                                            <select class="form-control" name="s_by_name"
                                                placeholder="Select Name" id="s_by_name" required>
                                                <option value="" disabled selected>Search by Name :</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <button type="submit" name="generate" onclick="show()"
                                            class="btn btn-lg btn-primary">Generate Report</button>
                                    </div>
                                    <div class="col-md-9"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="report-results" class="mt-4"></div>

            </div> <!-- container-fluid ends here -->

            <script>
            function setNames() {
                // Get selected sub-department
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
            </script>
            <!-- End Page Content -->
        </div>
    </div>

    <!-- Start writing content here -->
    <main>
    </main>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        let fromDateInput = document.getElementById("fromdate");
        let toDateInput = document.getElementById("todate");

        function updateFromDateLimit() {
            let today = new Date();
            let todayStr = today.toISOString().split("T")[0];
            fromDateInput.max = todayStr;
        }

        function updateToDateLimits() {
            if (!fromDateInput.value) return;
            let fromDate = new Date(fromDateInput.value);
            let today = new Date();
            let nextDate = new Date(fromDate);
            nextDate.setDate(fromDate.getDate() + 1);
            let fromDateStr = fromDate.toISOString().split("T")[0];
            let nextDateStr = nextDate.toISOString().split("T")[0];
            let todayStr = today.toISOString().split("T")[0];
            if (fromDateStr === todayStr) {
                toDateInput.min = todayStr;
                toDateInput.max = todayStr;
            } else {
                toDateInput.min = fromDateStr;
                toDateInput.max = nextDateStr;
            }
            toDateInput.value = "";
        }
        updateFromDateLimit();
        fromDateInput.addEventListener("change", updateToDateLimits);
    });
    </script>

    <!-- <script>
    function setNames() {
        const sub_dept = document.getElementById('sub_dept').value.trim();
        const namefield = document.getElementById('s_by_name');
        namefield.innerHTML = "";
        var defaultOption = document.createElement("option");
        defaultOption.value = "";
        defaultOption.innerHTML = "Select Name";
        defaultOption.disabled = true;
        defaultOption.selected = true;
        namefield.options.add(defaultOption);
        if (sub_dept !== "all") {
            fetch('autofillnm.php?sub_dept=' + sub_dept)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    for (var i = 0; i < data.length; i++) {
                        var newOption = document.createElement("option");
                        newOption.value = data[i];
                        newOption.innerHTML = data[i];
                        namefield.options.add(newOption);
                    }
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
        }
    }
    </script> -->
    <script>
    function p(s1, s2) {
        var s1 = document.getElementById(s1);
        var s2 = document.getElementById(s2);
        s2.innerHTML = "";
        if (s1.value == "operation") {
            var optionArray = ['|Select', 'officer|Officer', 'employee|Employee', 'contractor|Contractor',
                'contractor workman|Contractor Workman', 'gat|GAT', 'tat|TAT', 'sec|SEC', 'feg|FEG'
            ];
        } else if (s1.value == "driver") {
            var optionArray = ['|Select', 'packed|Packed', 'bulk|Bulk', 'transporter|Transporter'];
            var gateoption = ['driver gate|Driver Gate'];
        } else if (s1.value == "project") {
            var optionArray = ['|Select', 'workman|Workman', 'amc|AMC'];
        } else if (s1.value == "visitor") {
            var optionArray = ['|Select', 'visitor|Visitor'];
        } else {
            var optionArray = ['|Select', ];
        }
        for (var option in optionArray) {
            var pair = optionArray[option].split("|");
            var newoption = document.createElement("option");
            newoption.value = pair[0];
            newoption.innerHTML = pair[1];
            if (option == 0) {
                newoption.disabled = true;
                newoption.selected = true;
            }
            s2.options.add(newoption);
        }
    }

    function gatefun(dept, gates) {
        var dept = document.getElementById(dept);
        var gates = document.getElementById(gates);
        gates.innerHTML = "";
        if (dept.value == "driver") {
            var optionArray = ['drivergate|Driver Gate'];
        } else {
            var optionArray = ['all|All', 'maingate|Main Gate', 'licensegate|License Gate'];
        }
        for (var option in optionArray) {
            var pair = optionArray[option].split("|");
            var newoption = document.createElement("option");
            newoption.value = pair[0];
            newoption.innerHTML = pair[1];
            gates.options.add(newoption);
        }
    }
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
    }
    </script>
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
    <script>
    document.getElementById('page-title').innerHTML = "BPCL INOUT | WORKING HOURS REPORT";
    document.getElementById('navbar-title').innerHTML = "Report For Working Hours";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/6ee00b2260.js" crossorigin="anonymous"></script>
    <script>
    document.getElementById('sidebar-toggle').addEventListener('click', function() {
        document.querySelector('.wrapper').classList.toggle('sidebar-open');
        document.querySelector('.wrapper').classList.toggle('sidebar-closed');
    });
    </script>


<script>
document.querySelector("form").addEventListener("submit", function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("<?= base_url('Report/fetchReport') ?>", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        let html = "";
        // If data is a single object, wrap it in an array for uniform processing
        if (data && !Array.isArray(data)) {
            data = [data];
        }
        if (!data || data.length === 0) {
            html = `<div class="alert alert-warning text-center mt-4">No records found.</div>`;
        } else {
            html = `<div class="container-fluid"><div class="row g-4">`; // Start fluid container and responsive row
            data.forEach(record => {
                // Map subdept code to label
                const subdeptMap = {
                    'OFC': 'Officer',
                    'EMP': 'Employee',
                    'CON': 'Contractor',
                    'CONW': 'Contractor Workman',
                    'GAT': 'GAT',
                    'TAT': 'TAT',
                    'FEG': 'FEG',
                    'SEC': 'SEC',
                    'PT': 'Packed',
                    'BK': 'Bulk',
                    'TR': 'Transporter',
                    'AMC': 'AMC',
                    'PW': 'Workman',
                    'V': 'Visitor'
                };
                let subdeptLabel = subdeptMap[record.subdept] || 'NA';

                html += `
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex align-items-stretch">
                    <div class="card shadow-lg border-0 rounded-4 w-100 h-100 mb-4">
                        <div class="card-header bg-primary text-white text-center py-3 rounded-top-4">
                            <h4 class="mb-0"><i class="fas fa-user"></i> ${record.full_name || record.name || ''}</h4>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-12 col-sm-6 mb-3">
                                    <h5 class="text-muted"><i class="fas fa-building"></i> Department</h5>
                                    <p class="fw-bold text-dark text-capitalize">${record.department || record.dept || ''}</p>
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <h5 class="text-muted"><i class="fas fa-sitemap"></i> Sub-Department</h5>
                                    <p class="fw-bold text-dark text-capitalize">${subdeptLabel}</p>
                                </div>
                                ${
                                    record.fromdate === record.todate
                                    ? `<div class="col-12 col-sm-6 mb-3">
                                        <h5 class="text-muted"><i class="fas fa-calendar-alt"></i> Date</h5>
                                        <p class="fw-bold text-dark">${record.fromdate || ''}</p>
                                    </div>`
                                    : `<div class="col-12 col-sm-6 mb-3">
                                        <h5 class="text-muted"><i class="fas fa-calendar-alt"></i> From Date</h5>
                                        <p class="fw-bold text-dark">${record.fromdate || ''}</p>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-3">
                                        <h5 class="text-muted"><i class="fas fa-calendar-check"></i> To Date</h5>
                                        <p class="fw-bold text-dark">${record.todate || ''}</p>
                                    </div>`
                                }
                                <div class="col-12 col-sm-6 mb-3">
                                    <h5 class="text-muted"><i class="fas fa-clock"></i> Time In</h5>
                                    <p class="fw-bold text-dark">${record.timein || ''}</p>
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <h5 class="text-muted"><i class="fas fa-clock"></i> Time Out</h5>
                                    <p class="fw-bold text-dark">${record.timeout || ''}</p>
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <h5 class="text-muted"><i class="fas fa-hourglass-half"></i> Shift Hours</h5>
                                    <p class="fw-bold text-dark">${record.shifthrs || ''}</p>
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <h5 class="text-muted"><i class="fas fa-exclamation-triangle"></i> Out of Plant</h5>
                                    <p class="fw-bold text-dark">${record.notwork || ''}</p>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5 class="text-muted"><i class="fas fa-chart-line"></i> In Plant</h5>
                                    <p class="fw-bold text-success">${record.totalworkhrs || ''}</p>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5 class="text-muted"><i class="fas fa-calendar-alt"></i> Shift</h5>
                                    <p class="fw-bold">
                                        ${(record.fromdate !== record.todate) ? 'Night Shift' : 'Day Shift'}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `;
            });
            html += `</div></div>`; // End responsive row and fluid container
        }
        document.getElementById("report-results").innerHTML = html;
    })
    .catch(err => {
        console.error("Error:", err);
    });
});
</script>
</body>

</html>