<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="page-title"></title>
    <!-- including external links -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php $this->load->view("include/CssIncludes"); ?>

    <style>
    .set-bg {
        background-color: #493cff;
    }
    </style>

</head>


<body>

    <!-- content for login page -->
    <section class="container-fluid set-bg">
        <p class="mt-1 h2 fw-bold text-center text-white"><span class="text-uppercase">IOCL  INOUT SYSTEM</span></p>
    </section>

    <section class="container-fluid mt-5 ">
        <div class="d-flex justify-content-center row">
            <div class="login-form-div col-lg-5">
                <form action="<?php echo base_url('Main/ValidateLicenceKeyPost') ?>" method="post"
                    enctype="multipart/form-data" id="loginform" class="set-bg d-block px-3 rounded">
                    <div class="label">
                        <p class="text-left text-light h1 fw-bold"><span
                                class="border-bottom border-light border-4 pb-2">License Key&nbsp;&nbsp;</span>
                        </p>
                    </div>
                    <div class="d-none" id="error-box">
                        <div class="alert alert-danger">
                            <strong>Error:</strong> <span id="error-msg">license-key not matched</span>
                        </div>
                    </div>
                    <div class="fields mx-2 pb-5">
                        <div class="plantnamefield">
                            <p class="fs-4 fw-bold text-white"><label for="#user-field">Plant name</label></p>
                            <input type="text" name="plantname" id="userfield" class="form-control bg-white" required>
                        </div>

                        <div class="license-keyfield mt-3">
                            <p class="fs-4 fw-bold text-white"><label for="#license-key">License key</label></p>
                            <div>
                                <input type="file" name="licensekey" id="license-key" class="form-control bg-white"
                                    accept=".txt" required>
                                    <span id="file-error-msg" class="d-none error text-danger">Please upload a valid text file (.txt)</span>
                            </div>
                        </div>
                        <script>
                            document.getElementById('license-key').addEventListener('change', function() {
                                const file = this.files[0];
                                if (file && file.type !== 'text/plain') {
                                    Swal.fire({
                                        icon: 'error', // 'success' or 'error'
                                        title: 'Please upload a valid text file (.txt)',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK',
                                    });
                                    this.value = ''; // Clear the input field
                                }
                            });
                        </script>

                        <div class="login-btn mt-3">
                            <button type="submit" name="login" id="submitbtn" class="btn btn-light">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
    // loginform = document.getElementById('loginform');
    subbtn = document.getElementById('submitbtn');

    function validateForm() {
        if (document.getElementById('userfield').value == "") {
            alert('Enter plantname !!!');
        } else {
            document.getElementById('loginform').submit();
        }

        // else if (document.getElementById('license-key').value == "") {
        //      alert('Enter license-key !!!');
        // }
    }


    // document.addEventListener("DOMContentLoaded", function () {
    const license_keyField = document.getElementById("license-key");
    const togglelicense_key = document.getElementById("togglelicense-key");

    togglelicense_key.addEventListener("click", function() {
        // Toggle the type attribute
        const type = license - keyField.getAttribute("type") === "license-key" ? "text" : "license-key";
        license_keyField.setAttribute("type", type);

        // Toggle the icon
        // this.textContent = type === "password" ? "<i class='fa-solid fa-eye-slash'></i>" : "<i class='fa-solid fa-eye' style='color: white'></i>";
    });
    // });
    </script>
    <script>
    document.getElementById('page-title').innerHTML = "IOCL  INOUT | License Key";
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
    document.getElementById('sidebar-toggle').addEventListener('click', function() {
        document.querySelector('.wrapper').classList.toggle('sidebar-open');
        document.querySelector('.wrapper').classList.toggle('sidebar-closed');
    });
    </script>

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
    });
    </script>
</body>

</html>