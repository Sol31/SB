<?php
include ("connection.php");
// Assuming you have already established a database connection
// Check if user is not authenticated
session_start();
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

$table = $_SESSION['table'];
// Check if SBN_NO parameter is provided in the URL
if (isset($_GET['SBN_NO'])) {
    // Sanitize the input to prevent SQL injection
    $sbn_no = mysqli_real_escape_string($conn, $_GET['SBN_NO']);

    // Fetch the record from the database based on SBN_NO
    $query = "SELECT * FROM $table WHERE SBN_NO = '$sbn_no'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Record found, fetch the data
        $record = mysqli_fetch_assoc($result);

        // Display the form with the fetched data for editing
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
            <!-- endinject -->
            <!-- Plugin css for this page -->
            <!-- End plugin css for this page -->
            <!-- inject:css -->
            <!-- endinject -->
            <!-- Layout styles -->
            <link rel="stylesheet" href="../assets/css/style.css" />
            <!-- End layout styles -->
            <link rel="shortcut icon" href="../assets/images/SBB.png" />
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
                                    <a class="dropdown-item" href="../index.php">
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
                                    <h2>Edit Record</h2>
                                    <form class="form-sample" action="updateRecord.php" method="POST">
                                        <div class="form-group">
                                            <label for="sbn">SBN NO.</label>
                                            <input type="text" class="form-control" id="sbn" name="sbn" placeholder="SBN NO."
                                                value="<?php echo $record['SBN_NO']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">NAME</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="NAME"
                                                value="<?php echo $record['NAME']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="address">ADDRESS</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                placeholder="ADDRESS" value="<?php echo $record['ADDRESS']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="motor">MOTOR NO</label>
                                            <input type="text" class="form-control" id="motor" name="motor"
                                                placeholder="MOTOR NO" value="<?php echo $record['MOTOR_NO']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="chassis">CHASSIS NO</label>
                                            <input type="text" class="form-control" id="chassis" name="chassis"
                                                placeholder="CHASSIS NO" value="<?php echo $record['CHASSIS_NO']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="plate">PLATE NUMBER</label>
                                            <input type="text" class="form-control" id="plate" name="plate"
                                                placeholder="PLATE NUMBER" value="<?php echo $record['PLATE_NO']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="dateRenew">DATE OF RENEWAL</label>
                                            <input type="date" class="form-control" id="dateRenew" name="dateRenew"
                                                placeholder="DATE OF RENEWAL" value="<?php echo $record['DATE_OF_RENEWAL']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="dateRenew">MAKE</label>
                                            <input type="text" class="form-control" id="make" name="make" placeholder="make"
                                                value="<?php echo $record['MAKE']; ?>">
                                        </div>

                                        <button type="submit" class="btn btn-primary" name="update">Update</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- content-wrapper ends -->
                        <!-- partial:partials/_footer.html -->
                        <footer class="footer">
                            <div class="container-fluid d-flex justify-content-between">
                                <span class="text-muted d-block text-center text-sm-start d-sm-inline-block"></span>
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
            <!-- Plugin js for this page -->
            <script src="../assets/vendors/chart.js/Chart.min.js"></script>
            <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
            <!-- End plugin js for this page -->
            <!-- inject:js -->
            <script src="../assets/js/off-canvas.js"></script>
            <script src="../assets/js/hoverable-collapse.js"></script>
            <script src="../assets/js/misc.js"></script>
            <!-- endinject -->
            <!-- Custom js for this page -->
            <script src="../assets/js/dashboard.js"></script>
            <script src="../assets/js/todolist.js"></script>
            <!-- End custom js for this page -->
        </body>

        </html>
        <?php
    } else {
        // Record not found
        echo "Record not found.";
    }
} else {
    // SBN_NO parameter not provided
    echo "SBN_NO parameter is missing.";
}


?>