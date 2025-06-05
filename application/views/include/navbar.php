<?php //print_r($notifications);die; ?>
<style>
/* #access {
    height: auto;
    overflow-y: hidden;
} */
</style>
<div class="navbar-container">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <!-- Toggle Sidebar Button -->
            <button class="btn" id="sidebar-toggle">
                <i class="fas fa-bars text-primary" style="font-size: 22px;"></i>
            </button>

            <!-- Officer Text -->
            <p class="navbar-brand m-auto"><span class="fs-1 fw-bolder text-capitalize" id="navbar-title"></span></p>

            <!-- Navbar admin time and logout button -->
            <div class="ms-auto">
                <ul class="nav">
                    <li class="nav-item">
                        <a type="button" data-toggle="modal" class="mt-1 mb-2 align-center" data-target="#myModal">
                           <span><i class="fa fa-bell fs-2 p-1"
                                    style="color: #ff0000;"></i><?php echo $count = get_officer_notifications_count();?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-white mt-3" onclick="window.location.replace('');" title="Refresh Page">
                            <span><i class="fa-solid fa-refresh  border-none ps-2 text-primary"></i></span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <a class="mt-2 mb-3 text-decoration-none disabled"
                            style="pointer-events: none; cursor: default;">
                            <span class="text-capitalize"><?php echo $this->session->userdata('username'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php  echo base_url().'logout'; ?>"
                            class="nav-link btn btn-danger btn-sm mt-2 mb-3 align-center">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Approval Requests</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr No</th>

                            <th>Full Name</th>

                            <th>Purpose to Visit</th>
                            <th>Access</th>
                            <!-- <th>Officer</th> -->
                            <th>Visitor_id</th>

                            <th>Approve</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $notifications = get_officer_notifications();
                        $counter=1; foreach ($notifications as $not) :  ?>

                        <tr>
                            <td><?php  echo $counter;$counter++; ?></td>
                            <td><?php  echo $not->full_name; ?></td>

                            <td><?php  echo $not->purpose_to_visit; ?></td>
                            <td><?php // echo $not->access; ?>


                                <?php $access_list = explode(",", $not->access); // Convert "License Gate,Main Gate" to an array
?>

                                <!-- <td> -->
                                <label for="access" style="width:100px;">Access:</label>
                                <div id="access-container-<?php echo $not->visitor_id; ?>">
                                    <input type="checkbox" name="access[]" value="License Gate"
                                        <?php echo in_array("License Gate", $access_list) ? 'checked' : ''; ?>
                                        onclick="updateAccess(<?php echo $not->visitor_id; ?>)"> License Gate

                                    <input type="checkbox" name="access[]" value="Main Gate"
                                        <?php echo in_array("Main Gate", $access_list) ? 'checked' : ''; ?>
                                        onclick="updateAccess(<?php echo $not->visitor_id; ?>)"> Main Gate

                                    <input type="checkbox" name="access[]" value="Driver Gate"
                                        <?php echo in_array("Driver Gate", $access_list) ? 'checked' : ''; ?>
                                        onclick="updateAccess(<?php echo $not->visitor_id; ?>)"> Driver Gate
                                </div>
                                <small id="accesserror-<?php echo $not->visitor_id; ?>"
                                    class="error text-danger"></small>
                                <!-- </td> -->






                            </td>
                            <!-- <td><?php  echo $not->to_see_whom; ?></td> -->
                            <td><?php  echo $not->visitor_id; ?></td>

                            <td>


                                <?php if($not->status==1){?>
                                <button type="button" class="btn btn-primary btn-sm" disabled>
                                    Approved
                                </button>
                                <?php }else{?>
                                <button type="button" class="btn btn-primary btn-sm"
                                    data-id="<?php  echo $not->officer_id; ?>"
                                    data-visitor-id="<?php  echo $not->visitor_id; ?>" onclick="approveRequest(this)">
                                    Approve
                                </button>

                                <?php } ?>
                            </td>
                        </tr>
                        <?php  endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
//        function approveRequest(button) {
//     var officer_id = button.getAttribute('data-id');  // Get the officer ID from the data-id attribute
//     var visitor_id = button.getAttribute('data-visitor-id');  // Get the visitor ID from the data-visitor-id attribute

//     console.log("Sending request for Officer ID: " + officer_id + " and Visitor ID: " + visitor_id);

//     // Make an AJAX request to the PHP script
//     var xhr = new XMLHttpRequest();
//     console.log(xhr);
//     xhr.open("POST", "Dashboard/update_visitor_status", true);
//     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

//     // Send both officer_id and visitor_id to the PHP script
//     xhr.send("officer_id=" + officer_id + "&visitor_id=" + visitor_id);

//     // Handle the response
//     xhr.onload = function () {
//         if (xhr.status == 200) {
//             var response = xhr.responseText;
//             console.log("Response from server: " + response);

//             if (response == "success") {
//                 alert("Status updated successfully!");
//                 button.disabled = true; // Disable the button after approval
//                 button.innerText = "Approved"; // Change button text to "Approved"
//             } else {
//                 alert("Error: " + response);
//             }
//         } else {
//             alert("Request failed. Please try again.");
//         }
//     };

//     xhr.onerror = function () {
//         alert("An error occurred while sending the request.");
//     };
// }
</script>



<script>
//     function approveRequest(button) {
//     var officer_id = button.getAttribute('data-officer-id');
//     var visitor_id = button.getAttribute('data-visitor-id');

//     var accessSelect = document.getElementById("access_" + visitor_id);
//     var selectedOptions = Array.from(accessSelect.selectedOptions).map(option => option.value);

//     if (selectedOptions.length === 0) {
//         alert("Please select at least one access option.");
//         return;
//     }

//     var xhr = new XMLHttpRequest();
//     xhr.open("POST", "<?php echo base_url('Dashboard/update_visitor_status'); ?>", true);
//     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

//     xhr.onload = function () {
//         if (xhr.status == 200) {
//             var response = xhr.responseText.trim();
//             if (response == "success") {
//                 alert("Status updated successfully!");
//                 button.disabled = true;
//                 button.innerText = "Approved";
//             } else {
//                 alert("Error: " + response);
//             }
//         } else {
//             alert("Request failed. Please try again.");
//         }
//     };

//     xhr.onerror = function () {
//         alert("An error occurred while sending the request.");
//     };

//     xhr.send("officer_id=" + officer_id + "&visitor_id=" + visitor_id + "&access=" + selectedOptions.join(","));
// }




// function approveRequest(button) {
//     var officer_id = button.getAttribute('data-id');
//     var visitor_id = button.getAttribute('data-visitor-id');

//     console.log("Sending request for Officer ID: " + officer_id + " and Visitor ID: " + visitor_id);

//     var accessSelect = document.querySelector('select[name="access[]"]');

//     if (!accessSelect) {
//         console.error("Access select element not found!");
//         alert("Access selection is missing. Please refresh and try again.");
//         return;
//     }

//     var selectedAccess = [...accessSelect.selectedOptions].map(option => option.value);

//     if (selectedAccess.length === 0) {
//         alert("Please select at least one access type.");
//         return;
//     }

//     // Make an AJAX request
//     var xhr = new XMLHttpRequest();
//     xhr.open("POST", "Dashboard/update_visitor_status", true);
//     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

//     var params = `officer_id=${officer_id}&visitor_id=${visitor_id}&access=${selectedAccess.join(",")}`;
//     xhr.send(params);

//     xhr.onload = function() {
//         if (xhr.status == 200) {
//             var response = xhr.responseText;
//             console.log("Response from server: " + response);

//             if (response == "success") {
//                 alert("Status updated successfully!");
//                 button.disabled = true;
//                 button.innerText = "Approved";
//             } else {
//                 alert("Error: " + response);
//             }
//         } else {
//             alert("Request failed. Please try again.");
//         }
//     };

//     xhr.onerror = function() {
//         alert("An error occurred while sending the request.");
//     };
// }






function approveRequest(button) {
    var officer_id = button.getAttribute('data-id');
    var visitor_id = button.getAttribute('data-visitor-id');

    console.log("Sending request for Officer ID: " + officer_id + " and Visitor ID: " + visitor_id);

    var accessContainer = document.querySelector(`#access-container-${visitor_id}`);
    if (!accessContainer) {
        console.error("Access selection container not found!");
        alert("Access selection is missing. Please refresh and try again.");
        return;
    }

    var selectedAccess = [...accessContainer.querySelectorAll('input[name="access[]"]:checked')].map(el => el.value);

    if (selectedAccess.length === 0) {
        alert("Please select at least one access type.");
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "Dashboard/update_visitor_status", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    var params = `officer_id=${officer_id}&visitor_id=${visitor_id}&access=${selectedAccess.join(",")}`;
    xhr.send(params);

    xhr.onload = function() {
        if (xhr.status == 200) {
            var response = xhr.responseText.trim();
            console.log("Response from server: " + response);

            if (response == "success") {
                alert("Status updated successfully!");
                button.disabled = true;
                button.innerText = "Approved";
                location.reload(); // Refresh the page

            } else {
                alert("Error: " + response);
            }
        } else {
            alert("Request failed. Please try again.");
        }
    };

    xhr.onerror = function() {
        alert("An error occurred while sending the request.");
    };
}
</script>

<!-- Include the required JS libraries -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>