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
    body {
        overflow-x: auto;
    }

    .success-alert {
        display: none;
    }

    .danger-alert {
        display: none;
    }

    /* .tableOverflow{
            overflow-x: scroll !important;
        } */



    @media screen and (max-width: 576px) {
        .card-container {
            flex-direction: row;
            z-index: -2;
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


                <!-- content here -->

                <div class="row">
                    <p class="fs-3 fw-bold ms-2">
                        <span>Print Contractor Workman List</span>
                        <button class="btn btn-primary" onclick="printTable()">Print Count</button>
                    </p>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex flex-wrap py-2" style="overflow-x: auto; white-space: normal;">
                            <?php
            if (is_array($contractors) || is_object($contractors)) {
                foreach ($contractors as $contractor) {
            ?>
                            <div>
                                <button
                                    class="btn btn-outline-primary border-primary fs-4 fw-bolder contractor_list_btns m-2"
                                    data-value="<?php echo $contractor['id']; ?>"
                                    onclick="sortTable('<?php echo $contractor['id']; ?>')">
                                    <?php echo $contractor['name']; ?>
                                </button>
                            </div>
                            <?php
                }
            }
            ?>
                        </div>
                    </div>
                </div>




                <div class="row mt-5">
                    <div class="col-lg-12 ">
                        <div class="table-responsive">
                            <!-- data table starts here -->
                            <table class="table fs-3 fw-normal table-striped tableOverflow" id="mytable">
                                <thead>
                                    <tr>
                                        <th class="col-lg-4">Name</th>
                                        <th>Department</th>
                                        <th>Sub Department</th>
                                        <th>Time In</th>
                                        <th>Restrict</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($contractorworkman as $row) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['department']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['section']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['intime']; ?>
                                        </td>
                                        <td>
                                            <?php if ($row['restricted'] == '0') { ?>
                                            <button class="btn btn-danger" name="restricted" value="1"
                                                onclick="updateRestriction('<?php echo $row['id']; ?>', 1)"><span>Restrict</span></button>
                                            <?php  } elseif ($row['restricted'] == '1') { ?>
                                            <button class="btn btn-secondary" name="restricted" value="0"
                                                onclick="updateRestriction('<?php echo $row['id']; ?>', 0)"><span>Unrestrict</span></button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="back-button">
                <button class="btn btn-primary fs-4 fw-normal" onclick="window.history.back()"><i
                        class="fas fa-arrow-left"></i> Go
                    Back</button>
            </div>
        </div> <!-- container-fluid ends -->
        <!-- </div> -->

    </div>
    <!-- refresh code -->
    <script>
    function printTable() {
        var tableContent = document.getElementById("mytable").outerHTML;

        var newWin = window.open("", "", "width=800,height=600");
        newWin.document.write(`
                <html>
                <head>
                    <title>Print Table</title>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                    <style>
                        @media print {
                            th:last-child, td:last-child {
                                display: none; /* Hide last column */
                            }
                        }
                    </style>
                </head>
                <body>
                    ${tableContent}
                    <script>
                        window.onload = function() {
                            window.print();
                            window.close();
                        }
                    <\/script>
                </body>
                </html>
            `);

        newWin.document.close();
    }
    </script>
    <script>
    let originalData = <?php echo json_encode($contractorworkman); ?>;
    console.log(originalData);

    function sortTable(contractorid) {
        let table = document.getElementById("mytable");
        let tbody = table.getElementsByTagName("tbody")[0];

        // Reset to original data before sorting
        let filteredData = originalData.filter(item => item.contractorid == contractorid);

        // Sort the filtered data
        filteredData.sort((a, b) => parseInt(a.contractorid) - parseInt(b.contractorid));

        // Clear and re-populate the table
        tbody.innerHTML = "";
        sr_no = 1;
        filteredData.forEach((item) => {
            let row = document.createElement("tr");
            row.setAttribute("data-contractor_id", item.contractorid);

            row.innerHTML = `
                    <td>${item.name}</td>
                    <td>${item.department}</td>
                    <td>${item.section}</td>
                    <td>${item.intime}</td>
                    <td>
                        <button class="btn ${item.restricted == 0 ? 'btn-danger' : 'btn-secondary'}"
                                onclick="updateRestriction(${item.id})">
                            <span>${item.restricted == 0 ? 'Restrict' : 'Unrestrict'}</span>
                        </button>
                    </td>
                `;

            tbody.appendChild(row);
        });
    }

    const subdepartment = "Contractor_Workman";
    const gateName = "maingate"; // Replace with the actual gate name if needed

    function updateRestriction(id, status) {
        // Show confirmation dialog using SweetAlert
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to change the restriction status.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Prepare the data to send
                const data = new URLSearchParams();
                data.append('id', id);
                data.append('restricted', status);
                data.append('subdepartment', subdepartment);
                data.append('gateName', gateName);
console.log(data);
                // Make the fetch request
                fetch('<?php echo base_url('Dashboard/UpdateRestriction') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: data.toString(),
                    })
                    .then(response => response.json()) // Parse the response as JSON
                    .then(data => {
                        console.log(data);
                        if (data.status === 'success') {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Restriction status updated successfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload(); // Reload the page after successful reset
                            });
                        } else {
                            Swal.fire('Failed!', 'Failed to update restriction.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error!', 'An error occurred while updating the restriction.', 'error');
                    });
            }
        });
    }
    </script>


    <!-- Custom JavaScript -->
    <!-- giving title to document and navbar -->
    <script>
    document.getElementById('page-title').innerHTML = "IOCL INOUT | Dashboard";
    document.getElementById('navbar-title').innerHTML =
    "Infomore <i class='fas fa-info-circle'></i>"; // <i class='fas fa-info'></i>
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
    <script>
    function searchfun(filter) {
        filter = filter.toUpperCase(); // Convert filter value to uppercase
        let mytab = document.getElementById('mytable');
        let tr = mytab.getElementsByTagName('tr');

        for (var i = 0; i < tr.length; i++) {
            let td = tr[i].getElementsByTagName('td')[2]; // Targeting the third column (index 2)

            if (td) {
                let textvalue = td.textContent || td.innerHTML;

                // Convert text value to uppercase for comparison
                let textUpper = textvalue.toUpperCase();

                // Check if the filter is 'ALL' or matches in uppercase or lowercase
                if (filter === 'ALL' || textUpper.includes(filter)) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    </script>
</body>

</html>