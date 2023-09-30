<?php session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  $user_id1 = $_SESSION['user_id'];
$username1 = $_SESSION['username'];
$names1=$_SESSION['names'];

} else {
  // User is not logged in, redirect to login page
  header("Location: logout.php");
  exit();
}

// Display all PHP errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$database = "KPLV_Db";

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Admin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo kpl.jpg" rel="icon">
  <link href="assets/img/KPL_white.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!--  Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo kpl.jpg" alt="">
        <span class="d-none d-lg-block">KPL Visitor Admin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $username1; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Admin Name</h6>
              <span><?php echo $names1; ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
    
            <li>
    <a class="dropdown-item d-flex align-items-center" href="logout.php">
        <i class="bi bi-box-arrow-right"></i>
        <span>Sign Out</span>
    </a>
</li>

</li>


          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>

        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="newUser.php">
              <i class="bi bi-circle"></i><span>New User</span>
            </a>
          </li>

          <li>
            <a href="updateUser.php">
              <i class="bi bi-circle"></i><span>Update user</span>
            </a>
          </li>
          <li>
            <a href="viewUser.php">
              <i class="bi bi-circle"></i><span>View User</span>
            </a>
          </li>

        </ul>

      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Event</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="newEvent.php">
              <i class="bi bi-circle"></i><span>New Event</span>
            </a>
          </li>

          <li>
            <a href="updateEvent.php">
              <i class="bi bi-circle"></i><span>Update Event</span>
            </a>
          </li>
          <li>
            <a href="vewEvent.php">
              <i class="bi bi-circle"></i><span>View Events</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Session</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="vewSession.php">
              <i class="bi bi-circle"></i><span>View Session</span>
            </a>
          </li>

        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Visitor</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="newVistor.php">
              <i class="bi bi-circle"></i><span>New Visitor</span>
            </a>
          </li>
          <li>
            <a href="attendance.php">
              <i class="bi bi-circle"></i><span>Attendance</span>
            </a>
          </li>

          <li>
            <a href="updateVistor.php">
              <i class="bi bi-circle"></i><span>Update Visitor</span>
            </a>
          </li>
          <li>
            <a href="vewVistor.php">
              <i class="bi bi-circle"></i><span>View Visitor</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-heading">Page</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="report.php">
          <i class="bi bi-list"></i>
          <span>report</span>
        </a>
      </li><!-- End report Page Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="chart.php">
          <i class="bi bi-bar-chart"></i>
          <span>Charts</span>
        </a>
      </li><!-- End report Page Nav -->

      
      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

<?php 

$query = mysqli_query($conn, "SELECT COUNT(*) AS total_visitors, 
    SUM(CASE WHEN sex = 'Male' THEN 1 ELSE 0 END) AS total_male, 
    SUM(CASE WHEN sex = 'Female' THEN 1 ELSE 0 END) AS total_female,
    SUM(CASE WHEN category = 'Child' THEN 1 ELSE 0 END) AS total_child, 
    SUM(CASE WHEN category = 'student' THEN 1 ELSE 0 END) AS total_student, 
    SUM(CASE WHEN category = 'Adult' THEN 1 ELSE 0 END) AS total_adult 
    FROM vistors");

if ($query) {
    $row = mysqli_fetch_assoc($query);
}
?>




    <section class="section dashboard">
      <div class="row">
      <div class="col-12">
          <h2 class="section-title">Summary of Visitor Categories</h2>
        </div>
        <!-- Total Visitors Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card total-visitors-card">
            <div class="card-body">
              <h5 class="card-title">Total Visitors</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-person"></i>
                </div>
                <div class="ps-3">
                 
                  <h6 id="totalVisitors"> <?php echo $row['total_visitors']; ?></php> &nbsp;&nbsp;&nbsp; Loading...</h6>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Total Visitors Card -->

        <!-- Total Male Visitors Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card total-male-card">
            <div class="card-body">
              <h5 class="card-title">Total Male Visitors</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-gender-male"></i>
                </div>
                <div class="ps-3">
                  <h6 id="totalMale"><?php echo $row['total_male']; ?></php> &nbsp;&nbsp;&nbsp;Loading...</h6>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Total Male Visitors Card -->

        <!-- Total Female Visitors Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card total-female-card">
            <div class="card-body">
              <h5 class="card-title">Total Female Visitors</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-gender-female"></i>
                </div>
                <div class="ps-3">
                  <h6 id="totalFemale"><?php echo $row['total_female']; ?></php> &nbsp;&nbsp;&nbsp;Loading...</h6>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Total Female Visitors Card -->

        <!-- Total Child Visitors Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card total-child-card">
            <div class="card-body">
              <h5 class="card-title">Total Child Visitors</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-emoji-smile"></i>
                </div>
                <div class="ps-3">
                  <h6 id="totalChild"><?php echo $row['total_child']; ?></php> &nbsp;&nbsp;&nbsp;Loading...</h6>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Total Child Visitors Card -->

        <!-- Total Young Visitors Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card total-young-card">
            <div class="card-body">
              <h5 class="card-title">Total Students Visitors</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-emoji-sunglasses"></i>
                </div>
                <div class="ps-3">
                  <h6 id="totalYoung"><?php echo $row['total_student']; ?></php> &nbsp;&nbsp;&nbsp;Loading...</h6>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Total Young Visitors Card -->

        <!-- Total Adult Visitors Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card total-adult-card">
            <div class="card-body">
              <h5 class="card-title">Total Adult Visitors</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-adult"></i>
                </div>
                <div class="ps-3">
                  <h6 id="totalAdult"><?php echo $row['total_adult']; ?></php> &nbsp;&nbsp;&nbsp;Loading...</h6>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Total Adult Visitors Card -->
      </div>
      <?php
 
// Fetch the data from your database query
$query = mysqli_query($conn, "SELECT COUNT(*) AS total_visitors, 
    SUM(CASE WHEN sex = 'Male' THEN 1 ELSE 0 END) AS total_male, 
    SUM(CASE WHEN sex = 'Female' THEN 1 ELSE 0 END) AS total_female,
    SUM(CASE WHEN category = 'Child' THEN 1 ELSE 0 END) AS total_child, 
    SUM(CASE WHEN category = 'student' THEN 1 ELSE 0 END) AS total_student, 
    SUM(CASE WHEN category = 'Adult' THEN 1 ELSE 0 END) AS total_adult 
    FROM vistors");

if ($query) {
    $row = mysqli_fetch_assoc($query);
}

// Prepare data for the pie chart
$dataPoints = array(
    array("label" => "Total Male Visitors", "y" => $row['total_male']),
    array("label" => "Total Female Visitors", "y" => $row['total_female']),
    array("label" => "Total Child Visitors", "y" => $row['total_child']),
    array("label" => "Total Student Visitors", "y" => $row['total_student']),
    array("label" => "Total Adult Visitors", "y" => $row['total_adult'])
);
?>

 



<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>


    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>kpl visitors</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by Alliance Parfaite id:22555
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        exportEnabled: true,
        title: {
            text: "Visitor Categories"
        },
        subtitles: [{
            text: "Total Visitors by Category"
        }],
        data: [{
            type: "pie",
            showInLegend: true,
            legendText: "{label}",
            indexLabelFontSize: 16,
            indexLabel: "{label} - #percent%",
            yValueFormatString: "#,##0",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
}
</script>

</body>

</html>