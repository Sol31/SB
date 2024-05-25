<?php
include ("database/addDataHandler.php");

session_start();

// Check if user is not authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
  // Set error message
  $_SESSION['error_message'] = "Please log in to access the admin dashboard.";

  // Redirect to index.php
  header("Location: index.php");
  exit();
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
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-center">REGISTRATION</h4>
              <hr>
              <form class="forms-sample" method="POST" action="addData.php">
                <div class="form-group">
                  <label for="toda"> TODA</label>
                  <select name="toda" id="toda" class="form-control">
                    <option value="" selected disabled>SELECT TODA</option>
                    <option value="ba">BATODA</option>
                    <option value="bbs">BBS TODA</option>
                    <option value="cn">CN TODA</option>
                    <option value="coa1">COA1 TODA</option>
                    <option value="coa2">COA2 TODA</option>
                    <option value="dommsa">DOMMSA TODA</option>
                    <option value="hc">HCTODA</option>
                    <option value="hm">HMTODA</option>
                    <option value="hvr">HVRTODA</option>
                    <option value="mala">MALATODA</option>
                    <option value="mmg">MMGTODA</option>
                    <option value="mm">MMTODA</option>
                    <option value="np">NPTODA</option>
                    <option value="pal1">PAL1TODA</option>
                    <option value="pal2">PAL2TODA</option>
                    <option value="sabang">SABANG TODA</option>
                    <option value="ss">SSTODA</option>
                    <option value="vas">VASTODA</option>
                    <option value="vis">VISTODA</option>
                  </select>
                </div>
                <hr>
                <div class="form-group">
                  <label for="sbn">SBN NO.</label>
                  <input type="text" class="form-control" id="sbn" name="sbn" placeholder="SBN NO.">
                </div>
                <div class="form-group">
                  <label for="name">NAME</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="NAME">
                </div>
                <div class="form-group">
                  <label for="address">ADDRESS</label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="ADDRESS">
                </div>
                <div class="form-group">
                  <label for="motor">MOTOR NO</label>
                  <input type="text" class="form-control" id="motor" name="motor" placeholder="MOTOR NO">
                </div>
                <div class="form-group">
                  <label for="chassis">CHASSIS NO</label>
                  <input type="text" class="form-control" id="chassis" name="chassis" placeholder="CHASSIS NO">
                </div>
                <div class="form-group">
                  <label for="plate">PLATE NUMBER</label>
                  <input type="text" class="form-control" id="plate" name="plate" placeholder="PLATE NUMBER">
                </div>
                <div class="form-group">
                  <label for="dateRenew">DATE OF RENEWAL</label>
                  <input type="date" class="form-control" id="dateRenew" name="dateRenew" placeholder="DATE OF RENEWAL">
                </div>

                <div class="form-group">
                  <label for="make">MAKE</label>
                  <input type="text" class="form-control" id="make" name="make" placeholder="make">
                </div>
                <hr>
                <button type="submit" class="btn btn-gradient-primary me-2" name="submit">Submit</button>
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
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/vendors/chart.js/Chart.min.js"></script>
  <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="assets/js/dashboard.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- End custom js for this page -->
  <script>
    // Function to update the SBN NO. input field based on selected TODA
    function updateSBNPrefix() {
      // Get the selected TODA value
      var selectedTODA = document.getElementById("toda").value;

      // Get the SBN NO. input field
      var sbnInput = document.getElementById("sbn");

      // Map TODA values to their corresponding prefixes
      var prefixes = {
        "ba": "BA",
        "bbs": "BBS",
        "cn": "CN",
        "coa1": "COA1",
        "coa2": "COA2",
        "dommsa": "DOM",
        "hc": "HC",
        "hm": "HM",
        "hvr": "HVR",
        "mala": "MALA",
        "mmg": "MMG",
        "mm": "MM",
        "np": "NP",
        "pal1": "PAL1",
        "pal2": "PAL2",
        "sabang": "SA",
        "ss": "SS",
        "vas": "VAS",
        "vis": "VIS"
      };

      // Update the placeholder and value of SBN NO. input field based on the selected TODA
      if (prefixes.hasOwnProperty(selectedTODA)) {
        sbnInput.placeholder = prefixes[selectedTODA] + " - SBN NO.";
        sbnInput.value = prefixes[selectedTODA] + "-";
      } else {
        sbnInput.placeholder = "SBN NO.";
        sbnInput.value = "";
      }
    }

    // Attach event listener to the TODA select element
    document.getElementById("toda").addEventListener("change", updateSBNPrefix);

    // Call the function initially to set the default SBN NO. prefix
    updateSBNPrefix();
  </script>
</body>

</html>