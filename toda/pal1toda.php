<?php
session_start(); // Start the session

// Retrieve the table name from the URL parameter
$table = $_GET['table'];

// Store the table name in a session variable
$_SESSION['table'] = $table;

// Check if user is not authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // Set error message
    $_SESSION['error_message'] = "Please log in to access the admin dashboard.";

    // Redirect to index.php
    header("Location: ../index.php");
    exit();
}

// Check if error message session variable exists
if (isset($_SESSION['error_message'])) {
    // Display error message
    echo '<script>alert("' . $_SESSION['error_message'] . '");</script>';
 
    // Remove error message session variable
    unset($_SESSION['error_message']);
 }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Sangguniang Bayan</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css" />

    <link rel="stylesheet" href="../css/jquery.dataTables.css">
    <link rel="stylesheet" href="../css/buttons.dataTables.min.css">
    <!-- endinject -->
    <!-- Plugin css for tdis page -->
    <!-- End plugin css for tdis page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css" />
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/SBB.png" />
    <style>
        .btn {
            width: 150px;
            height: 50px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="../adminDashboard.php"><img src="../assets/images/sb.svg"
                        alt="logo" style="width: 200px; height: 100px;" /></a>
                <a class="navbar-brand brand-logo-mini" href="../adminDashboard.php"><img
                        src="../assets/images/mini-sb.svg" alt="logo" style="width: 350px; height: 150px;" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <!-- <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input
                  type="text"
                  class="form-control bg-transparent border-0"
                  placeholder="Search projects"
                />
              </div>
            </form>
          </div> -->
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="nav-profile-img">

                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black"><i class="mdi mdi-account-circle"
                                        style="font-size: 30px;"></i> Admin</p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../database/logout.php">
                                <i class="mdi mdi-logout me-2 text-primary"></i> Signout
                            </a>
                        </div>
                    </li>
                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../adminDashboard.php">
                            <span class="menu-title">Dashboard</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <span class="menu-title">Menu</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="../addData.php">Add Data</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../viewData.php">View Data</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">PAL1 TODA</h4>
                            <div class="mb-3">
                                <!-- Buttons container -->
                                <div class="top-buttons"></div>
                            </div>
                            <table id="exampleTable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SBN No.</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>MOTOR NO.</th>
                                        <th>CHASSIS NO.</th>
                                        <th>PLATE NO.</th>
                                        <th>Date of Renewal</th>
                                        <th>Make</th>
                                        <th>Action</th>
                                        <!-- Add more columns if necessary -->
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div style="position: fixed; bottom: 10px; right: 10px;">
                    <button id="scrollButton" class="btn btn-inverse-primary btn-rounded btn-icon">
                        <i class="mdi mdi-arrow-down"></i>
                    </button>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="container-fluid d-flex justify-content-between">
                        <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Developed by: Angel
                            and Nantz</span>
                        <span class="float-none float-sm-end mt-1 mt-sm-0 text-end">
                            Sangguniang Bayan</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for tdis page -->
    <script src="../assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for tdis page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <!-- endinject -->
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.buttons.min.js"></script>
    <script src="../js/jszip.min.js"></script>
    <script src="../js/pdfmake.min.js"></script>
    <script src="../js/vfs_fonts.js"></script>
    <script src="../js/buttons.html5.min.js"></script>
    <script src="../js/buttons.print.min.js"></script>
    <!-- <script src="../js/dataTables.responsive.js"></script> -->
    <!-- <script href="../js/datatables.js"></script> -->
    <script>
        $(document).ready(function () {
            var table = $('#exampleTable').DataTable({
                "processing": true,
                "serverSide": true,
                "searching": true,
                "paging": true,
                "pageLength": 25,
                "lengthMenu": [[10, 25, 50, 9999], [10, 25, 50, "All"]],
                dom: '<"top"lfB>rt<"bottom"ip><"clear">', // Add Buttons to the DataTable
                buttons: [
                    {
                        extend: 'copy',
                        filename: 'PAL1TODA',
                        exportOptions: {
                            columns: ':not(:last-child)' // Exclude the last column (actions)
                        }
                    },
                    {
                        extend: 'csv',
                        filename: 'PAL1TODA',
                        exportOptions: {
                            columns: ':not(:last-child)' // Exclude the last column (actions)
                        }
                    },
                    {
                        extend: 'excel',
                        filename: 'PAL1TODA',
                        exportOptions: {
                            columns: ':not(:last-child)' // Exclude the last column (actions)
                        }
                    },
                    {
                        extend: 'pdf',
                        filename: 'PAL1TODA',
                        exportOptions: {
                            columns: ':not(:last-child)' // Exclude the last column (actions)
                        }
                    },
                    {
                        extend: 'print',
                        filename: 'PAL1TODA',
                        exportOptions: {
                            columns: ':not(:last-child)' // Exclude the last column (actions)
                        }
                    }
                ],
                "ajax": {
                    "url": "../database/tableFetch.php", // URL to your backend script
                    "type": "POST"
                },
                "columnDefs": [
                    {
                        "targets": -1, // Target the last column
                        "render": function (data, type, row, meta) {
                            var editButton = "<button class='btn btn-primary edit-btn'><i class='mdi mdi-file-check btn-icon-append'></i> Edit</button>";
                            var deleteButton = "<button class='btn btn-danger delete-btn'><i class='mdi mdi-alert btn-icon-prepend'></i> Delete</button>";
                            var printButton = "<button class='btn btn-info print-btn'><i class='mdi mdi-printer btn-icon-prepend'></i> Print</button>";
                            return editButton + " " + deleteButton + " " + printButton;
                        },
                    }
                ],
                columns: [
                    { data: 'SBN_NO' },
                    { data: 'NAME' },
                    { data: 'ADDRESS' },
                    { data: 'MOTOR_NO' },
                    { data: 'CHASSIS_NO' },
                    { data: 'PLATE_NO' },
                    { data: "DATE_OF_RENEWAL" },
                    { data: "MAKE" },
                    { data: '' },
                ],
            });

            // Bind the handlePrintButtonClick function to the click event of the print button
            $('#exampleTable tbody').on('click', 'button.print-btn', function (e) {
                e.preventDefault(); // Prevent the default form submission behavior

                var data = table.row($(this).parents('tr')).data(); // Get data of the clicked row

                // Redirect to editRecord.php with the SBN_NO parameter
                window.location.href = 'PhpOffice/PHPWord.php?SBN_NO=' + data['SBN_NO'];
            });


            // Event listener for delete buttons
            $('#exampleTable tbody').on('click', 'button.delete-btn', function (e) {
                e.preventDefault(); // Prevent the default form submission behavior

                var data = table.row($(this).parents('tr')).data(); // Get data of the clicked row
                var SBN_NO = data['SBN_NO']; // Get the value of SBN_NO

                // Prompt the user for confirmation
                var confirmDelete = confirm("Are you sure you want to delete this record?");

                if (confirmDelete) {
                    // User confirmed, proceed with deletion
                    $.ajax({
                        url: '../database/deleteRecord.php',
                        method: 'POST',
                        data: { SBN_NO: SBN_NO },
                        success: function (response) {
                            // Handle success response, e.g., reload the table
                            alert("Deleted Successfully");
                            table.ajax.reload();
                        },
                        error: function (xhr, status, error) {
                            // Handle error response
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    // User canceled the deletion
                    alert("Deletion canceled.");
                }
            });

            $('#exampleTable tbody').on('click', 'button.edit-btn', function (e) {
        e.preventDefault(); // Prevent the default form submission behavior

        var data = table.row($(this).parents('tr')).data(); // Get data of the clicked row

        // Redirect to editRecord.php with the SBN_NO parameter
        window.location.href = '../database/editRecord.php?SBN_NO=' + data['SBN_NO'];
    });


            const scrollButton = document.getElementById('scrollButton');

            // Add a click event listener to the scroll button
            scrollButton.addEventListener('click', function () {
                // Check if the current scroll position is at the top of the page
                if (window.scrollY === 0) {
                    // Scroll to the bottom of the page
                    window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
                    // Change the button icon to "mdi-arrow-up"
                    this.innerHTML = '<i class="mdi mdi-arrow-up"></i>';
                } else {
                    // Scroll to the top of the page
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    // Change the button icon to "mdi-arrow-down"
                    this.innerHTML = '<i class="mdi mdi-arrow-down"></i>';
                }
            });

        });

    </script>
    <!-- Custom js for tdis page -->
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- End custom js for tdis page -->
</body>

</html>