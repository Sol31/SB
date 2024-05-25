<?php
include ("database/connection.php");
session_start();

// Check if user is not authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
  // Set error message
  $_SESSION['error_message'] = "Please log in to access the admin dashboard.";

  // Redirect to index.php
  header("Location: index.php");
  exit();
}

$monthly = 0;
$yearly = 0;

// Define an array to hold counts from each table
$tableCounts = array();

// Define an array of table names
$tables = array(
  "batoda_2024",
  "bbstoda_2024",
  "cntoda_2024",
  "co1toda_2024",
  "co2toda_2024",
  "dommsa_2024",
  "hctoda_2024",
  "hmtoda_2024",
  "hvrtoda_2024",
  "malatoda_2024",
  "mmgtoda_2024",
  "mmtoda_2024",
  "nptoda_2024",
  "pal1toda_2024",
  "pal2toda_2024",
  "sabangtoda_2024",
  "sstoda_2024",
  "vastoda_2024",
  "vistoda_2024"
);

// Initialize total counts
$totalAll = 0;
$totalLast30Days = 0;
$totalLastYear = 0;

// Iterate through each table
foreach ($tables as $table) {
  // Execute the SQL query to count all registrations
  $queryAll = "SELECT COUNT(SBN_NO) AS count_all 
                 FROM $table 
                 WHERE SBN_NO IS NOT NULL";
  $resultAll = $conn->query($queryAll);

  // Execute the SQL query to count registrations within the last 30 days
  $queryLast30Days = "SELECT COUNT(SBN_NO) AS count_last30days 
                        FROM $table 
                        WHERE SBN_NO IS NOT NULL 
                        AND DATE_OF_RENEWAL BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()";
  $resultLast30Days = $conn->query($queryLast30Days);

  // Execute the SQL query to count registrations within the last year
  $queryLastYear = "SELECT COUNT(SBN_NO) AS count_lastyear 
                      FROM $table 
                      WHERE SBN_NO IS NOT NULL 
                      AND DATE_OF_RENEWAL BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE()";
  $resultLastYear = $conn->query($queryLastYear);

  if ($resultAll && $resultLast30Days && $resultLastYear) {
    // Fetch the result rows
    $rowAll = $resultAll->fetch_assoc();
    $rowLast30Days = $resultLast30Days->fetch_assoc();
    $rowLastYear = $resultLastYear->fetch_assoc();

    // Store the counts in the $tableCounts array using the table name as the key
    $tableCounts[$table] = array(
      'count_all' => $rowAll['count_all'],
      'count_last30days' => $rowLast30Days['count_last30days'],
      'count_lastyear' => $rowLastYear['count_lastyear']
    );

    // Increment total counts
    $totalAll += $rowAll['count_all'];
    $totalLast30Days += $rowLast30Days['count_last30days'];
    $totalLastYear += $rowLastYear['count_lastyear'];
  } else {
    // Handle query error
    echo "Error executing query: " . $conn->error;
  }
}

// Convert $tableCounts array into a format suitable for Chart.js
$labels = array();
$dataAll = array();
$dataLast30Days = array();
$dataLastYear = array();

foreach ($tableCounts as $tableName => $counts) {
  $labels[] = $tableName;
  $dataAll[] = $counts['count_all'];
  $dataLast30Days[] = $counts['count_last30days'];
  $dataLastYear[] = $counts['count_lastyear'];
}

// Convert the arrays to JSON for use in JavaScript
$labelsJson = json_encode($labels);
$dataAllJson = json_encode($dataAll);
$dataLast30DaysJson = json_encode($dataLast30Days);
$dataLastYearJson = json_encode($dataLastYear);

if (isset($_FILES['template_file'])) {
  $uploadDir = 'toda/PhpOffice/template_directory/';
  $uploadFile = $uploadDir . basename($_FILES['template_file']['name']);
  $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

  // Check if the file has a valid Word document extension
  if ($fileType !== 'docx' && $fileType !== 'doc') {
    echo "<script>alert('Only Word documents (.docx, .doc) are allowed.')</script>";
  } else {
    // Move the uploaded file to the upload directory
    if (move_uploaded_file($_FILES['template_file']['tmp_name'], $uploadFile)) {
      echo "<script>alert('File is valid, and was successfully uploaded.')</script>";

      // Process the uploaded file, store information in the database if necessary
      // You can store the filename or other relevant information in the database
    } else {
      echo "<script>('Upload failed')</script>";
    }
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Sangguniang Bayan</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css" />
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css" />
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/style.css" />
  <!-- End layout styles -->
  <link rel="shortcut icon" href="assets/images/SBB.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="adminDashboard.php"><img src="assets/images/sb.svg" alt="logo"
            style="width: 200px; height: 100px;" /></a>
        <a class="navbar-brand brand-logo-mini" href="adminDashboard.php"><img src="assets/images/mini-sb.svg"
            alt="logo" style="width: 350px; height: 150px;" /></a>
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
                <p class="mb-1 text-black"><i class="mdi mdi-account-circle" style="font-size: 30px;"></i> Admin</p>
              </div>
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="database/logout.php">
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
            <a class="nav-link" href="adminDashboard.php">
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
                  <a class="nav-link" href="addData.php">Add Data</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="viewData.php">View Data</a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
              </span>
              Dashboard
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                  <span></span>Overview
                  <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
              </ul>
            </nav>
          </div>
          <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                  <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">
                    This Month Registered
                    <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"><?php echo $totalLast30Days ?></h2>
                  <!-- <h6 class="card-text">Increased by 60%</h6> -->
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                  <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">
                    This year Registered
                    <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"><?php echo $totalLastYear ?></h2>
                  <!-- <h6 class="card-text">Decreased by 10%</h6> -->
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                  <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">
                    Total TODA Registered
                    <i class="mdi mdi-account-box-outline mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"><?php echo $totalAll ?></h2>
                  <!-- <h6 class="card-text">Increased by 5%</h6> -->
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="clearfix">
                    <h4 class="card-title text-center">
                      Registered Franchise Data
                    </h4>
                    <div id="visit-sale-chart-legend"
                      class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                  </div>
                  <!-- <canvas id="visit-sale-chart" class="mt-4"></canvas> -->
                  <canvas id="myChart" width="400" height="200"></canvas>
                </div>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title text-center">Upload Template</h4>
                  <small class="text-center">FIle name should be: <strong style="color: red;">franchise_template.docx</strong></small>
                  <div class="table-responsive">
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <!-- <label>File upload</label> -->
                        <input type="file" name="template_file" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-info" type="button">Upload</button>
                          </span>
                        </div>
                      </div>
                      <button class="btn btn-gradient-primary" type="submit" name="upload_template">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
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
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/vendors/chart.js/Chart.min.js"></script>
  <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
  <script>
    const labels = <?php echo $labelsJson; ?>;
    const data = <?php echo $dataAllJson; ?>;

    // Define an array of colors
    const colors = [
      'rgba(255, 99, 132, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(255, 206, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 0, 0, 0.2)',     // Red
      'rgba(0, 255, 0, 0.2)',     // Green
      'rgba(0, 0, 255, 0.2)',     // Blue
      'rgba(255, 255, 0, 0.2)',   // Yellow
      'rgba(255, 0, 255, 0.2)',   // Magenta
      'rgba(0, 255, 255, 0.2)',   // Cyan
      'rgba(128, 0, 0, 0.2)',     // Maroon
      'rgba(0, 128, 0, 0.2)',     // Olive
      'rgba(0, 0, 128, 0.2)',     // Navy
      'rgba(128, 128, 0, 0.2)',   // Purple
      'rgba(128, 0, 128, 0.2)',   // Teal
      'rgba(0, 128, 128, 0.2)'    // Silver
      // Add more colors as needed
    ];

    // Create an array to hold datasets
    const datasets = [];

    // Loop through the data and assign colors dynamically
    for (let i = 0; i < data.length; i++) {
      const formattedLabel = labels[i].replace('_2024', '').toUpperCase();
      datasets.push({
        label: formattedLabel,
        data: [data[i]],
        backgroundColor: colors[i % colors.length], // Assign colors dynamically based on index
        borderColor: colors[i % colors.length],
        borderWidth: 1
      });
    }

    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Registered Franchise'],
        datasets: datasets // Use the datasets array
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

  </script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->

  <!-- Custom js for this page -->
  <script src="assets/js/file-upload.js"></script>
  <!-- End custom js for this page -->
</body>

</html>