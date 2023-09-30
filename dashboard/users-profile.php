<?php session_start(); ?>



<?php
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  $user_id1 = $_SESSION['user_id'];
  $username1 = $_SESSION['username'];
  $names1 = $_SESSION['names'];
} else {
  // User is not logged in, redirect to login page
  header("Location: logout.php");
  exit();
}
ini_set('display_errors', 1);
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
                        <span class="d-none d-md-block dropdown-toggle ps-2"></php echo $username1; ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>Admin Name</h6>
                            <span>
                                <?php echo $names1; ?>
                            </span>
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
                    <i class="bi bi-layout-text-window-reverse"></i><span>Session</span><i
                        class="bi bi-chevron-down ms-auto"></i>
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
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->



        <div class="message">
            <?php
      if (isset($_SESSION['save'])) {
        $message = $_SESSION['save'];
        unset($_SESSION['save']); // Clear the session variable
        echo "<script>
                console.log('Session message:', '$message'); // Debug output
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
                console.log('Session error:', '$error'); // Debug output
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: '$error',
                });
              </script>";
      }
      ?>

        </div>
        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="assets/img/profile.png" alt="Profile" class="rounded-circle">
                            <h2>Admin</h2>
                            <h3>KPL Visitor Admin</h3>
                            <div class="social-links mt-2">

                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <?php

              $query = mysqli_query($conn, "SELECT names,email,phone,password FROM admin WHERE adminCode = '$user_id1'");
              if ($query) {
                $row = mysqli_fetch_assoc($query);

                $names = $row['names'];
                $email = $row['email'];
                $phone = $row['phone'];
              } else {
                echo "Query failed: " . mysqli_error($conn); // Debug error
              }


              ?>

                            <!-- Profile Edit Form -->
                            <form method="post">

                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="names" type="text" class="form-control" id="fullName"
                                            value="<?php echo $names; ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="phone" type="text" class="form-control" id="Phone"
                                            value="<?php echo $phone; ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control" id="Email"
                                            value="<?php echo $email; ?>">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" name="profileChange" class="btn btn-primary">Save
                                        Changes</button>
                                </div>
                            </form><!-- End Profile Edit Form -->
                            <?php
              if (isset($_POST['profileChange'])) {
                $names = $_POST['names'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                if ($names != null && $email != null && $phone != null) {
                  $query = mysqli_query($conn, "update admin set names= '$names', email= '$email', phone='$phone' where adminCode='$user_id1'");
                  if ($query) {
                    $_SESSION['save'] = "user update sucussfull !";
                  } else {
                    $_SESSION['error'] = "user not updated sucessfuly";
                  }
                }
              }
              ?>

                        </div>

                        <form method="post">

                            <div class="row mb-3">
                                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                    Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="password" type="password" class="form-control" id="currentPassword">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="newpassword" type="password" class="form-control" id="newPassword">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-entuer New
                                    Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" name="changePassword" class="btn btn-primary">Change
                                    Password</button>
                            </div>
                        </form><!-- End Change Password Form -->

                        <?php
            // Database configuration
            $host = "localhost";
            $username = "root";
            $password = "";
            $database = "KPLV_Db";

            if (isset($_POST['changePassword'])) {
              $password = $_POST['password'];
              $newpassword = $_POST['newpassword'];
              $renewpassword = $_POST['renewpassword'];

              // Assuming you have a valid database connection named $con
              if (!empty($password) && !empty($newpassword) && !empty($renewpassword)) {
                // Prevent SQL injection by using prepared statements
                $user_id1 = mysqli_real_escape_string($conn, $user_id1);
                $password = mysqli_real_escape_string($conn, $password);

                // Use prepared statement for SELECT
                $query = "SELECT * FROM admin WHERE adminCode = ? AND password = ?";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "ss", $user_id1, $password);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($result && mysqli_num_rows($result) > 0) {
                  if ($newpassword === $renewpassword) {
                    // Update password using a prepared statement
                    $newpassword = mysqli_real_escape_string($conn, $newpassword);
                    $updateQuery = "UPDATE admin SET password = ? WHERE adminCode = ?";
                    $updateStmt = mysqli_prepare($conn, $updateQuery);
                    mysqli_stmt_bind_param($updateStmt, "ss", $newpassword, $user_id1);
                    $updateResult = mysqli_stmt_execute($updateStmt);

                    if ($updateResult) {
                      $_SESSION['save'] = "Password updated successfully";
                      unset($_POST);
                    } else {
                      $_SESSION['error'] = "Failed to update password";
                      unset($_POST);
                    }
                  } else {
                    $_SESSION['error'] = "Password mismatch";
                    unset($_POST);
                  }
                } else {
                  $_SESSION['error'] = "Invalid credentials";
                  unset($_POST);
                }

                // Close the SELECT statement
                mysqli_stmt_close($stmt);
              } else {
                $_SESSION['error'] = "Please fill in all fields";
                unset($_POST);
              }
            }
            ?>




                    </div>

                </div><!-- End Bordered Tabs -->

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
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
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