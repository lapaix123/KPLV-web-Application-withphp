<?php session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  $user_id1 = $_SESSION['user_id'];
  echo $user_id1;
  $username1 = $_SESSION['username'];
  $snames1 = $_SESSION['snames'];
} else {
  // User is not logged in, redirect to login page
  header("Location: logout.php");
  exit();
}
?>
<?php

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

  <title>Dashboard - Staff</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo kpl.jpg" rel="icon">
  <link href="assets/img/logo kpl.jpg" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

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
        <span class="d-none d-lg-block">KPL Visitor Staff</span>
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
            <span class="d-none d-md-block dropdown-toggle ps-2">
              <?php echo $username1; ?>
            </span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
               <h6>Staff Name</h6>
                            <span><?php echo $snames1; ?></span>
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
          <i class="bi bi-menu-button-wide"></i><span>Attendance</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>

        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="attendance.php">
              <i class="bi bi-circle"></i><span>Attendance</span>
            </a>
          </li>

          <li>
            <a href="viewAttendance.php">
              <i class="bi bi-circle"></i><span>View Attendance</span>
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
            <a href="vewVistor.php">
              <i class="bi bi-circle"></i><span>View Visitor</span>
            </a>
          </li>
          <li>
            <a href="updateVistor.php">
              <i class="bi bi-circle"></i><span>update Visitor</span>
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
        <a class="nav-link collapsed" href="users-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
 <div class="message">



                                        <?php
                                        if (isset($_SESSION['save'])) {
                                            $message = $_SESSION['save'];
                                            unset($_SESSION['save']); // Clear the session variable
                                            echo "<script>
                       Swal.fire({
                         icon: 'success',
                         title: 'Success',
                         text: '$message',
                       });
                     </script>";
                                        }

                                        if (isset($_SESSION['error'])) {
                                            $error = $_SESSION['error'];
                                            unset($_SESSION['error']); // Clear the session variable
                                            echo "<script>
                       Swal.fire({
                         icon: 'error',
                         title: 'Error',
                         text: '$error',
                       });
                     </script>";
                                        }
                                        ?>


                                    </div>




                                    <div class="row mb-3">
                                        <label class="
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Session / View Session</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between mb-3">
                <form method="post">
                   <button type="submit" class="btn btn-primary" name="openSession">Open Session</button>
                <button type="submit" class="btn btn-danger" name="closeSession">Close Session</button>
                  
                </form>
               
              <?php 
  

if (isset($_POST['openSession'])) {
   
    $query = "SELECT stufCode FROM stuff WHERE email = ?";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Error in preparing statement: " . $conn->error);
    }

    // Bind the username value
    $stmt->bind_param("s", $username1);
    $stmt->execute();

    if ($stmt->error) {
        die("Error in execution: " . $stmt->error);
    } else {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $user_id1 = $user['stufCode']; // Get the stuffCode

            // Insert into the session table
            $insertQuery = "INSERT INTO session (User, status) VALUES (?, 'active')";
            $insertStmt = $conn->prepare($insertQuery);

            if (!$insertStmt) {
                die("Error in preparing insert statement: " . $conn->error);
            }

            // Bind the user_id1 value
            $insertStmt->bind_param("s", $user_id1);

            if ($insertStmt->execute()) {
                $_SESSION['save'] = "Session Opened!";
                unset($_POST);
            } else {
                $_SESSION['error'] = "Error opening session: " . $insertStmt->error;
                unset($_POST);
            }
        } else {
            $_SESSION['error'] = "Invalid username";
            unset($_POST);
        }
    }
}

if (isset($_POST['closeSession'])) {
    // Get the stuffCode associated with the user
    $stuffQuery = "SELECT stufCode FROM stuff WHERE email = '$username1'";
    $stuffResult = $conn->query($stuffQuery);

    if ($stuffResult && $stuffResult->num_rows > 0) {
        $stuffData = $stuffResult->fetch_assoc();
        $user_id1 = $stuffData['stufCode']; // Get the stuffCode

        // Update the session status to 'closed' and set endTime to current timestamp for active sessions
        $updateQuery = "UPDATE session SET status = 'closed', closeTime = NOW() WHERE User = '$user_id1' AND status = 'active'";
        
        if ($conn->query($updateQuery)) {
            $_SESSION['save'] = "Session Closed!";
            unset($_POST);
        } else {
            $_SESSION['error'] = "Error closing session: " . $conn->error;
            unset($_POST);
        }
    } else {
        $_SESSION['error'] = "Invalid username";
        unset($_POST);
    }
}
?>

              </div>

              <h5 class="card-title">Session List</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#Code</th>
                    <th scope="col">Start Time</th>
                    <th scope="col">End Time</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">User</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query1 = $conn->prepare("SELECT st.snames, s.sCode, s.startTime, s.status, s.sessionDate, s.closeTime, st.stufCode 
                 FROM session s 
                 INNER JOIN stuff st ON s.User = st.stufCode 
                 WHERE s.status = 'active' and st.email=?");
                  $query1->bind_param("s", $username1);

                  if ($query1->execute()) {
                    $result = $query1->get_result();

                    while ($row1 = $result->fetch_assoc()) {
                      ?>
                      <tr>
                        <th scope="row">
                          <?php echo $row1['sCode']; ?>
                        </th>
                        <td>
                          <?php echo $row1['startTime']; ?>
                        </td>
                        <td>
                          <?php echo $row1['closeTime']; ?>
                        </td>
                        <td>
                          <?php echo $row1['sessionDate']; ?>
                        </td>
                        <td>
                          <?php echo $row1['status']; ?>
                        </td>
                        <td>
                          <?php echo $row1['snames']; ?>
                        </td>
                      </tr>
                    <?php }
                  } ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
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
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-Staff-bootstrap-Staff-html-template/ -->
      Designed by Alliance Parfaite id:22555
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

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
 

</body>

</html>