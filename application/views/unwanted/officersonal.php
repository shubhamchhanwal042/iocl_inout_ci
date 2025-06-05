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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    <script src="<?php echo base_url().'logout.js';?> "></script>


    <!-- stylesheet files -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/css_js/style.css';?> ">


    
    <link rel="stylesheet"
        href="<?php //echo 'http://localhost\eaglebyte\hpcl_in_out\hpcl_in_out\assets\css_js\style.css'; ?>">

    <!-- including config file to use database -->
    <?php // include($config_loc); ?>

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
                <!-- including content for dashboard -->






                <!-- ++++++++++++++++++++++++++++++++DASHBOARD CONTENT START HERE ++++++++++++++++++++++++++++++-->


                <!-- <div class="container-fluid"> -->
                <!-- container-fluid -->
                <!-- <h1> HELLO THIS IS THE THEME</h1> -->





<!-- Page Content -->
<div class="container-fluid">
    <!-- Officer dynamic cards here -->
    <form action="#" id="officerForm" onsubmit="generateCards(event)" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-3">
                <label class="fs-3">Officer Cylinder Count</label>
            </div>
            <div class="col-lg-9">
                <div class="error-box w-100 d-block text-start">
                    <p class="align-center ps-1 pe-1 d-inline fs-4">&nbsp;
                        <span class="bg-danger text-light"></span>
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Input field -->
            <div class="col-lg-5">
                <input type="text" name="addtoken" 
                    oninput="this.value=this.value.replace(/[^0-9]/g,'')" 
                    size="2" minlength="1" maxlength="2" 
                    id="officerInput" class="form-control" autocomplete="off" required>
            </div>
            <!-- Add Officer button -->
            <div class="col-lg-7">
                <button type="submit" name="submit" id="submit" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    <span>Add Officer</span>
                </button>
            </div>
        </div>
    </form>

    <div class="row mt-4" id="cardContainer"></div>
</div>







<script>
//     let totalCards = 0; // Counter to keep track of the total number of cards

//     async function generateCards(event) {
//         // Prevent form from refreshing the page
//         event.preventDefault();

//         // Get the number of cards to generate
//         const officerCount = parseInt(document.getElementById("officerInput").value, 10);

//         // Validate the input
//         if (isNaN(officerCount) || officerCount <= 0) {
//             alert("Please enter a valid number greater than 0.");
//             return;
//         }

//         // Get the card container
//         const cardContainer = document.getElementById("cardContainer");



//             // Insert new token into the database
//             try {
//                 const response = await fetch('<?php echo base_url("Operation/OfficerToken") ?>', {
//     method: 'POST',
//     headers: {
//         'Content-Type': 'application/x-www-form-urlencoded'  // Change this if your server expects URL-encoded
//     },
//     body: `token_no=${totalCards}`  // Send data in URL-encoded format
// });


//                 if (!response.ok) throw new Error('Failed to add officer');

//                 const result = await response.json();
//                 console.log('Officer added:', result);
//             } catch (error) {
//                 console.error('Error:', error);
//             }


//                     // Generate the specified number of cards
//         for (let i = 1; i <= officerCount; i++) {
//             totalCards++; // Increment the total card count

//             const card = document.createElement("div");
//             card.className = "col-sm-6 col-md-3 col-lg-2 mb-5";

//             card.innerHTML = `
//                 <div class="card text-center">
//                     <div class="error-box w-100 d-block text-start">
//                         <p class="align-center mb-0 ps-1 pe-1 fs-5 text-center">&nbsp;
//                             <span class="bg-danger text-light"></span>
//                         </p>
//                     </div>
//                     <div style="position: relative;">
//                         <p class="h4" style="color:white;position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1;">
//                             ${totalCards}
//                         </p>
//                         <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQrAfNAjMWDejP0YqvXWZLsIBWWwKn0IJv1AgXVEa7bw&s" class="card-img-top" alt="...">
//                     </div>
//                     <div class="card-body">
//                         <h5 class="card-title" style="height: 30px; overflow: hidden;">Officer ${totalCards}</h5>
//                         <a href="#" class="btn btn-primary form-control">
//                             <i class="fa-solid fa-plus"></i>Add
//                         </a>
//                     </div>
//                 </div>
//             `;

//             // Append card to container
//             cardContainer.appendChild(card);




            
//         }
//     }
















// let totalCards = 0; // Counter to keep track of the total number of cards

// async function generateCards(event) {
//     // Prevent form from refreshing the page
//     event.preventDefault();

//     // Get the number of cards to generate
//     const officerCount = parseInt(document.getElementById("officerInput").value, 10);

//     // Validate the input
//     if (isNaN(officerCount) || officerCount <= 0) {
//         alert("Please enter a valid number greater than 0.");
//         return;
//     }

//     // Get the card container
//     const cardContainer = document.getElementById("cardContainer");

//     // Generate the specified number of cards
//     for (let i = 1; i <= officerCount; i++) {
//         totalCards++; // Increment the total card count

//         // Insert new token into the database (send a single POST request for the total count)
//         try {
//             const response = await fetch('<?php echo base_url("Operation/OfficerToken") ?>', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/x-www-form-urlencoded'
//                 },
//                 body: `token_no=${totalCards}`
//             });

//             // Ensure the response is ok before processing
//             if (!response.ok) {
//                 throw new Error('Failed to add officer');
//             }

//             const result = await response.json(); // Parse the response directly as JSON
//             console.log('Officer added:', result);

//             // Create the card for the officer
//             const card = document.createElement("div");
//             card.className = "col-sm-6 col-md-3 col-lg-2 mb-5";

//             card.innerHTML = `
//                 <div class="card text-center">
//                     <div class="error-box w-100 d-block text-start">
//                         <p class="align-center mb-0 ps-1 pe-1 fs-5 text-center">&nbsp;
//                             <span class="bg-danger text-light"></span>
//                         </p>
//                     </div>
//                     <div style="position: relative;">
//                         <p class="h4" style="color:white;position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1;">
//                             ${totalCards}
//                         </p>
//                         <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQrAfNAjMWDejP0YqvXWZLsIBWWwKn0IJv1AgXVEa7bw&s" class="card-img-top" alt="...">
//                     </div>
//                     <div class="card-body">
//                         <h5 class="card-title" style="height: 30px; overflow: hidden;">Officer ${totalCards}</h5>
//                         <a href="#" class="btn btn-primary form-control">
//                             <i class="fa-solid fa-plus"></i>Add
//                         </a>
//                     </div>
//                 </div>
//             `;

//             // Append card to container
//             cardContainer.appendChild(card);

//         } catch (error) {
//             console.error('Error:', error);
//         }
//     }
// }




// let totalCards = 0;

// async function generateCards(event) {
//     event.preventDefault();
//     const officerCount = parseInt(document.getElementById("officerInput").value, 10);
//     if (isNaN(officerCount) || officerCount <= 0) {
//         alert("Please enter a valid number greater than 0.");
//         return;
//     }

//     const cardContainer = document.getElementById("cardContainer");
//     for (let i = 1; i <= officerCount; i++) {
//         totalCards++;
//         try {
//             const response = await fetch('<?php echo base_url("Operation/OfficerToken") ?>', {
//                 method: 'POST',
//                 headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
//                 body: `token_no=${totalCards}`
//             });

//             if (!response.ok) throw new Error('Failed to add officer');
//             const result = await response.json();

// // Ensure that the response is in the expected format
// if (result.status === 'success') {
//     console.log('Officer added:', result.tokens);
//     location.reload();

//     // Use result.tokens to display the added tokens if necessary
// } else {
//     console.error('Error adding officer:', result.message);
// }

//             console.log('Officer added:', result);

//             // const card = document.createElement("div");
//             // card.className = "col-sm-6 col-md-3 col-lg-2 mb-5";
//             // card.innerHTML = `
//             //     <div class="card text-center">
//             //         <div class="error-box w-100 d-block text-start">
//             //             <p class="align-center mb-0 ps-1 pe-1 fs-5 text-center">&nbsp;
//             //                 <span class="bg-danger text-light"></span>
//             //             </p>
//             //         </div>
//             //         <div style="position: relative;">
//             //             <p class="h4" style="color:white;position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1;">
//             //                 ${totalCards}
//             //             </p>
//             //             <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQrAfNAjMWDejP0YqvXWZLsIBWWwKn0IJv1AgXVEa7bw&s" class="card-img-top" alt="...">
//             //         </div>
//             //         <div class="card-body">
//             //             <h5 class="card-title" style="height: 30px; overflow: hidden;">Officer ${totalCards}</h5>
//             //             <a href="#" class="btn btn-primary form-control">
//             //                 <i class="fa-solid fa-plus"></i>Add
//             //             </a>
//             //         </div>
//             //     </div>
//             // `;
//             // cardContainer.appendChild(card);
//         } catch (error) {
//             console.error('Error:', error);
//         }
//     }
// }





// let totalCards = 0;

// async function generateCards(event) {
//     event.preventDefault();
//     const officerCount = parseInt(document.getElementById("officerInput").value, 10);
//     if (isNaN(officerCount) || officerCount <= 0) {
//         alert("Please enter a valid number greater than 0.");
//         return;
//     }

//     const cardContainer = document.getElementById("cardContainer");
//     for (let i = 1; i <= officerCount; i++) {
//         totalCards++;
//         try {
//             const response = await fetch(`<?php echo base_url("Operation/OfficerToken") ?>?token_no=${totalCards}`, {
//                 method: 'GET',
//                 headers: { 'Content-Type': 'application/json' }
//             });

//             if (!response.ok) throw new Error('Failed to add officer');
//             const result = await response.json();

//             if (result.status === 'success') {
//                 console.log('Officer added:', result.tokens);
//                 location.reload();
//             } else {
//                 console.error('Error adding officer:', result.message);
//             }

//         } catch (error) {
//             console.error('Error:', error);
//         }
//     }
// }




let totalCards = 0;

const generateCards = async (event) => {
    event.preventDefault();

    const officerCount = Number(document.getElementById("officerInput").value);
    if (!officerCount || officerCount <= 0) {
        alert("Please enter a valid number greater than 0.");
        return;
    }

    try {
        // Fetch the current maximum token number from the server
        const maxTokenResponse = await fetch(`<?php echo base_url("Operation/OfficerToken") ?>`, {
            method: 'GET',
            headers: { 'Content-Type': 'application/json' },
        });

        if (!maxTokenResponse.ok) throw new Error('Failed to fetch max token number');

        const { token_no: currentMaxToken = 0 } = await maxTokenResponse.json();

        // Generate tokens starting from the current max token
        const cardContainer = document.getElementById("cardContainer");

        const generateToken = async (newTokenNo) => {
            const response = await fetch(`<?php echo base_url("Operation/OfficerToken") ?>?token_no=${newTokenNo}`, {
                method: 'GET',
                headers: { 'Content-Type': 'application/json' },
            });

            if (!response.ok) throw new Error('Failed to add officer');
            const result = await response.json();

            if (result.status === 'success') {
                console.log('Officer added:', newTokenNo);

                location.reload();

                // Create and append the new card
                // const card = document.createElement('div');
                // card.className = 'card';
                // card.innerText = `Token ${newTokenNo}`;
                // cardContainer.appendChild(card);
            } else {
                console.error('Error adding officer:', result.message);
            }
        };

        // Loop through to generate and add tokens
        for (let i = 1; i <= officerCount; i++) {
            const newTokenNo = currentMaxToken + i;
            await generateToken(newTokenNo);
        }
    } catch (error) {
        console.error('Error:', error.message);
    }
};



    </script>
















<script>
        // Function to generate card HTML working 
        const generateCard = (officer) => `
            <div class="col-sm-6 col-md-3 col-lg-2 mb-5">
                <div class="card text-center">
                    <div style="position: relative;">
                        <p class="h4" style="color:white;position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1;">
                            ${officer.token_no}
                        </p>
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQrAfNAjMWDejP0YqvXWZLsIBWWwKn0IJv1AgXVEa7bw&s" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title" style="height: 30px; overflow: hidden;">
                            ${officer.full_name}
                        </h5>
                        <a href="<?php echo base_url().'EditOfficer/';?>${officer.id}" class="btn btn-primary form-control">
                            <i class="fa-solid fa-edit"></i>Edit
                        </a>
                    </div>
                </div>
            </div>
        `;

        // Function to fetch officers and populate cards
        const fetchOfficers = async () => {
            try {
                const response = await fetch('<?= base_url("Operation/fetchOfficers") ?>');
                if (!response.ok) throw new Error('Failed to fetch officers');

                const officers = await response.json();
                const cardContainer = document.getElementById('cardContainer');
                cardContainer.innerHTML = officers.map(generateCard).join('');
            } catch (error) {
                console.error('Error:', error);
                document.getElementById('cardContainer').innerHTML = '<p class="text-center">Error loading officers.</p>';
            }
        };

        // Fetch officers on page load
        document.addEventListener('DOMContentLoaded', fetchOfficers);
</script>
 <!-- container-fluid ends here -->
            <!-- End Page Content -->
            <!-- </div> -->
            <!-- container-fluid -->



            <!-- ++++++++++++++++++++++++++++++++++++++++++++++DASHBOARD CONTENT END HERE+++++++++++++++++++++++++++++++++++ -->






            <!--  container-fluid ends here -->
        </div> <!-- container-fluid ends -->
        <!-- </div> -->

    </div>
    <!-- refresh code -->

    
    
    



    <script>
    document.getElementById('page-title').innerHTML = "IOCL  INOUT | Dashboard";
    document.getElementById('navbar-title').innerHTML = "Dashboard <i class='fas fa-home'></i>";
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
    <!-- Custom JavaScript -->



    <script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if ($this->session->flashdata('swal_type') && $this->session->flashdata('swal_message')) { ?>
        Swal.fire({
            icon: '<?= $this->session->flashdata('swal_type'); ?>', // 'success' or 'error'
            title: '<?= $this->session->flashdata('swal_message'); ?>',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    <?php } ?>
});
</script>




</body>

</html>