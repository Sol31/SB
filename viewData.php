<?php
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
    <meta
      name="viewport"
      content="widtd=device-widtd, initial-scale=1, shrink-to-fit=no"
    />
    <title>Sangguniang Bayan</title>
    <!-- plugins:css -->
    <link
      rel="stylesheet"
      href="assets/vendors/mdi/css/materialdesignicons.min.css"
    />
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css" />
    <!-- endinject -->
    <!-- Plugin css for tdis page -->
    <!-- End plugin css for tdis page -->
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
      <nav
        class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row"
      >
        <div
          class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center"
        >
          <a class="navbar-brand brand-logo" href="adminDashboard.php"
            ><img src="assets/images/sb.svg" alt="logo" style="width: 200px; height: 100px;"
          /></a>
          <a class="navbar-brand brand-logo-mini" href="adminDashboard.php"
            ><img src="assets/images/mini-sb.svg" alt="logo" style="width: 350px; height: 150px;"
          /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button
            class="navbar-toggler navbar-toggler align-self-center"
            type="button"
            data-toggle="minimize"
          >
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
              <a
                class="nav-link dropdown-toggle"
                id="profileDropdown"
                href="#"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <div class="nav-profile-img">
                  
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black"><i class="mdi mdi-account-circle" style="font-size: 30px;"></i> Admin</p>
                </div>
              </a>
              <div
                class="dropdown-menu navbar-dropdown"
                aria-labelledby="profileDropdown"
              >
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="database/logout.php">
                  <i class="mdi mdi-logout me-2 text-inverse-info"></i> Signout
                </a>
              </div>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>
          </ul>
          <button
            class="navbar-toggler navbar-toggler-right d-lg-none align-self-center"
            type="button"
            data-toggle="offcanvas"
          >
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
              <a
                class="nav-link"
                data-bs-toggle="collapse"
                href="#ui-basic"
                aria-expanded="false"
                aria-controls="ui-basic"
              >
                <span class="menu-title">Menu</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="addData.php"
                      >Add Data</a
                    >
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="viewData.php"
                      >View Data</a
                    >
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
                <h4 class="card-title text-center">TODA LIST</h4>
                </p>
                <table class="table table-bordered text-center">
                  <tdead>
                    <tr>
                      <th> TODA </th>
                      <th> ACTION </th>
                    </tr>
                  </tdead>
                  <tbody>
                    <tr>
                      <td> BATODA</td>
                      <td><a href="toda/batoda.php?table=batoda_2024"><button class="btn btn-inverse-info">View Data</button></a></td>
                    </tr>
                    <tr>
                      <td>BBS TODA</td>
                      <td><a href="toda/bbstoda.php?table=bbstoda_2024"><button class="btn btn-inverse-info">View Data</button></a></td>
                    </tr>
                    <tr>
                      <td>CN TODA</td>
                      <td><a href="toda/cntoda.php?table=cntoda_2024"><button class="btn btn-inverse-info">View Data</button></a></td>
                    </tr>
                    <tr>
                      <td>COA1 TODA</td>
                      <td><a href="toda/coa1toda.php?table=co1toda_2024"><button class="btn btn-inverse-info">View Data</button></a></td>
                    </tr>
                    <tr>
                      <td>COA2 TODA</td>
                      <td><a href="toda/coa2toda.php?table=co2toda_2024"><button class="btn btn-inverse-info">View Data</button></a></td>
                    </tr>
                    <tr>
                      <td>DOMMSA TODA</td>
                      <td><a href="toda/dommsatoda.php?table=dommsa_2024"><button class="btn btn-inverse-info">View Data</button></a></td>
                    </tr>
                    <tr>
                      <td>HC TODA</td>
                      <td><a href="toda/hctoda.php?table=hctoda_2024"><button class="btn btn-inverse-info">View Data</button></a></td>
                    </tr>
                    <tr>
                      <td>HM TODA</td>
                      <td><a href="toda/hmtoda.php?table=hmtoda_2024"><button class="btn btn-inverse-info">View Data</button></a></td>
                    </tr>
                    <tr>
                      <td>HVR TODA</td>
                      <td><a href="toda/hvrtoda.php?table=hvrtoda_2024"><button class="btn btn-inverse-info">View Data</button></a></td>
                    </tr>
                    <tr>
                      <td>MALA TODA</td>
                      <td><a href="toda/malatoda.php?table=malatoda_2024"><button class="btn btn-inverse-info">View Data</button></a></td>
                    </tr>
                    <tr>
                      <td>MM TODA</td>
                      <td><a href="toda/mmtoda.php?table=mmtoda_2024"><button class="btn btn-inverse-info">View Data</button></a></td>
                    </tr>
                    <tr>
                      <td>MMG TODA</td>
                      <td><a href="toda/mmgtoda.php?table=mmgtoda_2024"><button class="btn btn-inverse-info">View Data</button></a></td>
                    </tr>
                    <tr>
                      <td>NP TODA</td>
                      <td><a href="toda/nptoda.php?table=nptoda_2024"><button class="btn btn-inverse-info">View Data</button></a></td>
                    </tr>
                    <tr>
                      <td>PAL1 TODA</td>
                      <td><a href="toda/pal1toda.php?table=pal1toda_2024"><button class="btn btn-inverse-info">View Data</button></a></td>
                    </tr>
                    <tr>
                      <td>PAL2 TODA</td>
                      <td><a href="toda/pal2toda.php?table=pal2toda_2024"><button class="btn btn-inverse-info">View Data</button></a></td>
                    </tr>
                    <tr>
                      <td>SA TODA</td>
                      <td><a href="toda/sabangtoda.php?table=sabangtoda_2024"><button class="btn btn-inverse-info">View Data</button></a></td>
                    </tr>
                    <tr>
                      <td>SS TODA</td>
                      <td><a href="toda/sstoda.php?table=sstoda_2024"><button class="btn btn-inverse-info">View Data</button></a></td>
                    </tr>
                    <tr>
                      <td>VAS TODA</td>
                      <td><a href="toda/vastoda.php?table=vastoda_2024"><button class="btn btn-inverse-info">View Data</button></a></td>
                    </tr>
                    <tr>
                      <td>VIS TODA</td>
                      <td><a href="toda/vistoda.php?table=vistoda_2024"><button class="btn btn-inverse-info">View Data</button></a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
              <span
                class="text-muted d-block text-center text-sm-start d-sm-inline-block"
              >Developed by: Angel and Nantz</span>
              <span class="float-none float-sm-end mt-1 mt-sm-0 text-end">
                Sangguniang Bayan</span
              >
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
    <!-- Plugin js for tdis page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for tdis page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for tdis page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- End custom js for tdis page -->
  </body>
</html>
