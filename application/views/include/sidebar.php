<div class="wrapper d-flex">

    <!-- Main Content -->
    <div class="main-content">
        <!--      Sidebar -->
        <aside class="sidebar overflow-y-scroll scroll ">

            <header>
                <div
                    class="navbar-header m-auto mt-3 mb-3 botder border-bottom border-dark border-opacity-25 border-3 w-100">
                    <a class="w-100">
                        <!--  href="https://www.hindustanpetroleum.com/"  -->
                        <img src="<?php echo base_url() . 'assets/images/iocllogo.png'; ?>" alt="" class="image-fluid w-100">
                        <!-- ../assets/imgs/hpcl.jpeg -->
                    </a>
                </div> <!-- https://manasvi.tech/assets/img/new_logo.png -->
                <div class="time-div">
                    <!-- adding digital clock -->
                    <p class="text-light fs-4 text-center">&nbsp;<span id="digiclock"></span></p>
                    <!-- including clock script -->
                    <script>
                        function startTime() {
                            var today = new Date();
                            var now = new Date();
                            var h = today.getHours();
                            var m = today.getMinutes();
                            var s = today.getSeconds();

                            var month = String(now.getMonth() + 1).padStart(2, '0');
                            var day = String(now.getDate()).padStart(2, '0');
                            var year = now.getFullYear();
                            var dateString = `${day}/${month}/${year}`;

                            // var date = today.getDate();
                            // var month = today.getMonth();
                            // var year = today.getFullYear();
                            m = checkTime(m);
                            s = checkTime(s);
                            document.getElementById('digiclock').innerHTML =
                                "Now: " + dateString + " " + "@" + " " + h + ":" + m + ":" + s;
                            var t = setTimeout(startTime, 500);
                        }

                        function checkTime(i) {
                            if (i < 10) {
                                i = "0" + i;
                            } // add zero in front of numbers < 10
                            return i;
                        }
                        startTime();
                    </script>
                </div>

            </header>
            <!-- <marquee>HPCL MAHUL PLANT</marquee> -->

            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="<?php echo base_url() . 'Dashboard'; ?>" class="sidebar-link text-decoration-none link-hover">
                        <i class="fa fa-solid fa-house"></i>
                        Dashboard
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href=""
                        class="sidebar-link collapsed dropdown-toggle flex-row-reverse text-decoration-none link-hover dropdown-toggle"
                        data-bs-target="#operation" data-bs-toggle="collapse" data-toggle="collapse"
                        aria-expanded="false">
                        <i class="fa-solid fa-users"></i>
                        <span class="pe-3">Operation</span>
                    </a>

                    <ul id="operation" class="sidebar-dropdown list-unstyled collapse ms-5" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'Officer'; ?>"
                                class="sidebar-link list-unstyled text-decoration-none link-hover">Officer</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'Employee'; ?>"
                                class="sidebar-link text-decoration-none link-hover">Employee</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'Contractor'; ?>"
                                class="sidebar-link text-decoration-none link-hover">Contractor</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'ContractorWorkman'; ?>"
                                class="sidebar-link text-decoration-none link-hover">Contractor
                                Workman</a>
                        </li>

                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'Mathadi'; ?>"
                                class="sidebar-link text-decoration-none link-hover">Mathadi</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'Gat'; ?> "
                                class="sidebar-link text-decoration-none link-hover">Gat</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'Tat'; ?>"
                                class="sidebar-link text-decoration-none link-hover">Tat</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'Feg'; ?> "
                                class="sidebar-link text-decoration-none link-hover">Feg</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'Sec'; ?>"
                                class="sidebar-link text-decoration-none link-hover">Sec</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a href="#driver" class="sidebar-link collapsed dropdown-toggle text-decoration-none link-hover"
                        data-bs-target="#driver" data-bs-toggle="collapse" aria-expanded="false"><i
                            class="fa-sharp fa-solid fa-truck text-white ps-1"></i>
                        <span class="pe-5">Driver</span> </a>



                    <ul id="driver" class="sidebar-dropdown list-unstyled collapse ms-5" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'Packed'; ?>"
                                class="sidebar-link text-decoration-none link-hover">Packed</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'Bulk'; ?>"
                                class="sidebar-link text-decoration-none link-hover">Bulk</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'Transporter'; ?>"
                                class="sidebar-link text-decoration-none link-hover">Transporter</a>
                        </li>

                           <!-- <li class="sidebar-item">
                            <a href="<?php //echo base_url() . 'Parking'; ?>"
                                class="sidebar-link text-decoration-none link-hover">Parking Section</a>
                        </li> -->
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a href="#project"
                        class="sidebar-link collapsed dropdown-toggle flex-row-reverse text-decoration-none link-hover"
                        data-bs-target="#project" data-bs-toggle="collapse" aria-expanded="false"><i
                            class="fa-solid fa-id-card"></i>
                        <span class="pe-5">Project</span>
                    </a>

                    <ul id="project" class="sidebar-dropdown list-unstyled collapse ms-5" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'Workman' // echo $project_dir . 'workman.php'; 
                                        ?>"
                                class="sidebar-link text-decoration-none link-hover">Workman</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'Amc'; ?>"
                                class="sidebar-link text-decoration-none link-hover">AMC</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a href="#visitor"
                        class="sidebar-link collapsed dropdown-toggle flex-row-reverse text-decoration-none link-hover"
                        data-bs-target="#visitor" data-bs-toggle="collapse" aria-expanded="false"
                        data-toggle="dropdown"><i class="fa-solid fa-users"></i>
                        <span class="pe-5">Visitor</span> </a>

                    <ul id="visitor" class="sidebar-dropdown list-unstyled collapse ms-5" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'Visitor' // echo $visitor_dir . "visitor.php"; 
                                        ?>"
                                class="sidebar-link text-decoration-none link-hover">Visitor</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                     <a href="#visitor"
                        class="sidebar-link collapsed dropdown-toggle flex-row-reverse text-decoration-none link-hover"
                        data-bs-target="#parking" data-bs-toggle="collapse" aria-expanded="false"
                        data-toggle="dropdown"><i class="fa-solid fa-truck"></i>
                        <span class="pe-5">Parking</span> </a>

                    <ul id="parking" class="sidebar-dropdown list-unstyled collapse ms-5" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                             <a href="<?php echo base_url() . 'Parking'; ?>"
                                class="sidebar-link text-decoration-none link-hover">Parking Section</a>
                        </li>
                    </ul> 
                </li>

                <li class="sidebar-item">
                    <a href="#report" class="sidebar-link collapsed dropdown-toggle text-decoration-none link-hover"
                        data-bs-target="#report" data-bs-toggle="collapse" aria-expanded="false"><i
                            class="fa-solid fa-address-book"></i>
                        <span class="pe-5">Report</span>
                    </a>

                    <ul id="report" class="sidebar-dropdown list-unstyled collapse ms-5" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'AdvancedReport'?>"
                                class="sidebar-link text-decoration-none link-hover">Advance Report</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'NightReport'?>"
                                class="sidebar-link text-decoration-none link-hover">Night Report</a>
                        </li>
                         <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'parkingreport'?>"
                                class="sidebar-link text-decoration-none link-hover">Parking Report</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'WorkingHours'?>"
                                class="sidebar-link text-decoration-none link-hover">Working Hours</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a href="#setting" class="sidebar-link collapsed dropdown-toggle text-decoration-none link-hover"
                        data-bs-target="#setting" data-bs-toggle="collapse" aria-expanded="false">
                        <i class="fa-solid fa-gear"></i>
                        <span class="pe-5">Settings</span>
                    </a>

                    <ul id="setting" class="sidebar-dropdown list-unstyled collapse ms-5" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'Settings' ?>"
                                class="sidebar-link text-decoration-none link-hover">Settings</a>
                        </li>
                    </ul>
                </li>

            </ul>
            <footer class="px-3">
                <div class="navbar-header m-auto w-100 text-center"
                    height="20">
                    <!-- <a href="https://manasvi.tech/" class="w-100 bg-white" height="30" width="250"> -->
                    <img src="<?php echo base_url() . 'assets/images/Manasvi.png'; ?>" alt="" class="img-fluid w-75"
                        height="30" width="250"><!-- ../assets/imgs/manasvilogo.jpeg -->
                    <!-- </a> -->
                </div> <!-- https://manasvi.tech/assets/img/new_logo.png -->

                <div class="navbar-header m-auto w-100" height="30">
                    <p class="fs-3 text-center text-white">
                        <span><span id="dayscount">
                                <?php echo $data = getRemainingLicenseDays(); 
                                ?>
                            </span> days remaining for license to expire</span>
                    </p>
                </div>

            </footer>
        </aside>
        <!-- End Sidebar -->
    </div>
</div>




<!-- jQuery -->

<!-- Custom JavaScript -->
<script>
    $(document).ready(function() {
        $('.sidebar-link').on('click', function() {
            // Close all open dropdowns
            $('.collapse.show').collapse('hide');
        });
    });
</script>