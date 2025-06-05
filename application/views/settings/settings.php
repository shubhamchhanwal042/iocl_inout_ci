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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <script src="<?php echo base_url().'logout.js';?> "></script>

    <!-- stylesheet files -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/css_js/style.css';?> ">

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

        <div class="container-fluid">
            <!-- container-fluid -->

            <!-- including navbar -->
            <?php $this->load->view('include/navbar'); ?>

            <!-- Page Content -->
            <div class="container-fluid">
                <div class="row">
                    <!-- Combined Card -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <!-- php code here -->
                            <h1 class="text-center" id="header-title">
                                <i class='fas fa-user' id="headerIcon"></i>
                                <span>Profile</span>
                            </h1>

                            <div class="card-body border">

                                <div class="row">

                                    <!-- Button Card -->
                                    <!-- buttons starts here -->
                                    <div class="col-md-3">
                                        <div class="card m-0 shadow">
                                            <div class="card-body">
                                                <div class="d-grid gap-1">

                                                    <a onclick="showSection('profile')"
                                                        class="btn btn-outline-primary border-primary mb-3 fs-4"
                                                        role="button">
                                                        <i class="fas fa-user"></i>Profile</a>
                                                    <a onclick="showSection('access')"
                                                        class="btn btn-outline-primary border-primary mb-3 fs-4"
                                                        tabindex="-1" role="button">
                                                        <i class="fas fa-key"></i>Access</a>

                                                    <a onclick="showSection('reset')"
                                                        class="btn btn-outline-primary border-primary mb-3 fs-4"
                                                        tabindex="-1" role="button">
                                                        <i class="fas fa-sync-alt"></i>Change Reset</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- profile form starts here -->

                                    <div class="col-md-9" id="profile-section">
                                        <form method="post" action="<?php echo base_url('Setting/UpdatePassword') ?>"
                                            enctype="multipart/form-data" class="col-md-9">
                                            <input type="hidden" name="id" value="<?php echo $_SESSION['id'] ?>">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name" class="form-label">Name :</label>
                                                        <input type="text" id="name" name="name" class="form-control"
                                                            oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'')"
                                                            placeholder="enter name"
                                                            value="<?php echo $_SESSION['username'] ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="oldpassword" class="form-label">Old Password
                                                            :</label>
                                                        <input type="password" id="oldpassword" required
                                                            placeholder="Enter Old Password" oninput="ws(this.id)"
                                                            name="oldpassword" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="newpassword" class="form-label">New Password
                                                            :</label>
                                                        <input type="password" id="newpassword" required
                                                            placeholder="Enter New Password" oninput="ws(this.id)"
                                                            name="newpassword" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 pt-4">
                                                    <button type="submit" class="btn btn-success" name="update-btn"><i
                                                            class="fas fa-sync-alt"></i> Change</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- access section starts here -->
                                    <div class="col-md-9" id="access-section" style="display:none;">
                                        <form method="post" action="<?php echo base_url('Setting/AddUserPost') ?>"
                                            enctype="multipart/form-data" id="myform">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name" class="form-label">Username :</label>
                                                        <input type="text" id="user_name" name="username"
                                                            oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'');ws(this.id)"
                                                            placeholder="Enter the Username" required
                                                            class="form-control">
                                                        <span id="usernameerror" style="color: red;"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="password" class="form-label">Password :</label>
                                                        <input type="password" id="password"
                                                            placeholder="Enter Password" oninput="ws(this.id);"
                                                            name="password" class="form-control" required>
                                                        <span id="passerror" style="color: red;"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="access" class="form-label">Access :</label>
                                                        <select class="form-select form-control" onchange="getNames(this.value)"
                                                            aria-label="Default select example" id="access"
                                                            name="access" required>
                                                            <option value="">Select</option>
                                                            <option value="admin">Admin</option>
                                                            <option value="officer">Officer</option>
                                                            <option value="security">Security</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Second Dropdown for Names (Initially Hidden) -->
                                            <div id="namesDropdownContainer" style="display: none;">
                                                <select class="form-select form-control" aria-label="Select Name"
                                                    id="names" name="access_id">
                                                    <option value="">Select Name</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-center pt-4">
                                                    <button type="submit" id="submit" class="btn btn-success px-4">
                                                        <i class="fas fa-plus"></i> Add
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="row pt-4">
                                            <div class="col-12">
                                                <div class="card-body">
                                                    <table class="table table-responsive">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" class="text-center">Name</th>
                                                                <th scope="col" class="text-center">Access</th>
                                                                <th scope="col" class="text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($users as $row) { ?>
                                                            <tr>
                                                                <td class="text-center">
                                                                    <?php echo $row['username'] ?>
                                                                </td>
                                                                <td class="text-capitalize text-center">
                                                                    <?php echo $row['access'] ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <button class="text-decoration-none btn btn-danger"
                                                                        onclick="confirmDelete(event, <?php echo $row['id']; ?>)">
                                                                        <i class="fa-solid fa-user"></i>
                                                                        <span>Delete</span>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- reset section starts here -->
                                    <div class="col-md-9" id="reset-section" style="display: none;">
                                        <form method="post"
                                            action="<?php echo base_url('Setting/ResetDashboardCountKey') ?>"
                                            enctype="multipart/form-data" class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="oldpassword" class="form-label">Reset Password
                                                            :</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="password" id="passwordkey" name="passwordkey"
                                                            oninput="ws(this.id)" class="form-control"
                                                            placeholder="Reset Password.." required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success form-control"
                                                            name="change-reset-btn">
                                                            <i class="fas fa-sync-alt"></i>
                                                            <span>Change</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- container-fluid ends -->

        </div>

        <script>
        function showSection(section) {
            const profile = document.getElementById('profile-section');
            const access = document.getElementById('access-section');
            const reset = document.getElementById('reset-section');
            const headerTitle = document.getElementById('header-title');
            const headerIcon = document.getElementById('headerIcon');

            if (section == 'profile') {
                profile.style.display = 'block';
                access.style.display = 'none';
                reset.style.display = 'none';
                headerTitle.innerHTML = '<i class="fas fa-user"></i> Profile';
            } else if (section == 'access') {
                profile.style.display = 'none';
                access.style.display = 'block';
                reset.style.display = 'none';
                headerTitle.innerHTML = '<i class="fas fa-key"></i> Access';
            } else if (section == 'reset') {
                profile.style.display = 'none';
                access.style.display = 'none';
                reset.style.display = 'block';
                headerTitle.innerHTML = '<i class="fas fa-sync-alt"></i> Reset';
            }
        }
        </script>

        <!-- getting names from database -->
            <script>
               function getNames(access) {
                    console.log("access", access);
                    const namesDropdownContainer = document.getElementById('namesDropdownContainer');
     
                    if (access == 'admin' || access == 'officer') {
                         namesDropdownContainer.style.display = 'block';
                         namesDropdownContainer.innerHTML = `
                         <select class="form-select form-control" aria-label="Select Name" id="names" name="access_id" required>
                              <option value="">Select Name</option>
                              <?php foreach ($officer as $row) { ?>
                                   <option value="<?php echo $row['id'] ?>"><?php echo $row['full_name'] ?></option>
                              <?php } ?>
                         </select>
                         `;
                    } else if(access == 'security') {
                         namesDropdownContainer.style.display = 'block';
                         namesDropdownContainer.innerHTML = `
                         <select class="form-select form-control" aria-label="Select Name" id="names" name="access_id" required>
                              <option value="">Select Name</option>
                              <?php foreach ($security as $row) { ?>
                                   <option value="<?php echo $row['id'] .'-'. $row['full_name']; ?>"><?php echo $row['full_name'] ?></option>
                              <?php } ?>
                         </select>
                         `;
                    } else {
                         namesDropdownContainer.style.display = 'none';
                    }
               }
          </script>
        <!-- refresh code -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

        <!-- Font Awesome JS (optional, only needed if you use Font Awesome icons) -->
        <script src="https://kit.fontawesome.com/6ee00b2260.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-NZA+MOJ7ckuDwH/Bpq3UL8uU8v4/UpxF0B/Uw9Js5PntSAfMR0J4caB+FVFVlZ9J" crossorigin="anonymous">
        </script>
        <!-- giving title to document and navbar -->
        <script>
        document.getElementById('page-title').innerHTML = "IOCL  INOUT | Settings";
        document.getElementById('navbar-title').innerHTML = "Settings <i class='fa-solid fa-gear'></i>";
        </script>

        <!-- Custom JavaScript -->
        <script>
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            document.querySelector('.wrapper').classList.toggle('sidebar-open');
            document.querySelector('.wrapper').classList.toggle('sidebar-closed');
        });

        function ws(name) {
            var name = document.getElementById(name);
            name.value = name.value.replace(/^\s+/, '');
        }

        var nameField = document.getElementById("user_name");
        var passField = document.getElementById("password");

        nameField.addEventListener("input", validateName);
        passField.addEventListener("input", validatePass);

        function validateName() {
            var fullname = nameField.value;
            var errorElement = document.getElementById("usernameerror");

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

        function validatePass() {
            var name = passField.value;
            var errorElement = document.getElementById("passerror");

            if (name.trim() == "") {
                errorElement.textContent = "Fill Out This Field";
                passField.classList.add("invalid");
                return false;
            } else {
                errorElement.textContent = "";
                passField.classList.remove("invalid");
                return true;
            }
        }

        const form = document.getElementById('myform');

        form.addEventListener('submit', (event) => {
            if (!validateName() || !validatePass()) {
                event.preventDefault();
            }
        });
        </script>
        <!-- Custom JavaScript -->

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($this->session->flashdata('error')) { ?>
            Swal.fire({
                icon: 'error', // 'success' or 'error'
                title: '<?= $this->session->flashdata('error'); ?>',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
            <?php } ?>
            <?php if ($this->session->flashdata('success')) { ?>
            Swal.fire({
                icon: 'success', // 'success' or 'error'
                title: '<?= $this->session->flashdata('success'); ?>',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
            <?php } ?>
        });
        </script>

        <script>
        function ws(name) {
            var name = document.getElementById(name);
            name.value = name.value.replace(/^\s+/, '');

        }

        function confirmDelete(event, id) {
        event.preventDefault();  // Prevent default button action

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.isConfirmed) {
               // Proceed with fetch request for deletion
               fetch("<?php echo base_url().'Setting/DeleteUser/'?>" + id, {
                    method: 'GET'
               })
               .then(response => response.json())
               .then(data => {
                    console.log(data);
                    if (data.status == 'success') {
                         Swal.fire('Deleted!', 'The user has been deleted.', 'success')
                         .then(() => {
                              location.reload(); // Reload the page after deletion
                         });
                    } else {
                         Swal.fire('Error!', 'There was an error deleting the user.', 'error');
                    }
               })
               .catch(error => {
                    Swal.fire('Error!', 'There was an error deleting the user.', 'error');
               });
            } else {
                // Optionally, handle cancel logic here if needed
            }
        });
    }
        </script>

</body>

</html>