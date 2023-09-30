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

    <title>Dashboard - Admin</title>
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
                        <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
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
                            <a class="dropdown-item d-flex align-items-center" href="logout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
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
                <a class="nav-link collapsed" href="report.php">
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

        <section class="section">
            <div class="row">
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Vistor information</h5>
                            <form method="post">
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Visitor Code</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="visitorCode" placeholder="Visitor Code"
                                            class="form-control" id="inputText">
                                        <button type="submit" name="find" class="btn btn-primary">Find Visitor</button>
                                    </div>
                                </div>

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

                            </form>
                            <?php
                            if (isset($_POST['find'])) {
                                $id = $_POST['visitorCode'];
                                $query = "SELECT * FROM vistors where vistorCode='$id' ";

                                $query_run = mysqli_query($conn, $query);
                                if (!$query_run) {
                                    $_SESSION['error'] = "Visitor Not Found: ";
                                    header("location: attendance.php");
                                } else {

                                    while ($row = mysqli_fetch_array($query_run)) {
                                        ?>
                                        <!-- Horizontal Form -->
                                        <form class="row g-3" method="post" action="../backend.php">

                                            <div class="row mb-3">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Names</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="vistorCode" value="<?php echo $row['vistorCode'] ?>"
                                                        hidden>
                                                    <input type="text" class="form-control" name="names"
                                                        value="<?php echo $row['names'] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" name="email"
                                                        value="<?php echo $row['email']; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputPassword3" class="col-sm-2 col-form-label">Phone</label>
                                                <div class="col-sm-10">
                                                    <input type="tel" class="form-control" name="Phone"
                                                        value="<?php echo $row['phone']; ?>" >
                                                </div>
                                            </div>

                                            <h5 class="card-title">Attendance Form</h5>

                                            <div class="col-12">
                                                <label for="inputNanme4" class="form-label">Reason</label>
                                                <select class="form-select" name="reason" aria-label="Default select example">
                                                    <option selected>---Select Your Reason---</option>
                                                    <?php
                                                    $query = mysqli_query($conn, "SELECT * FROM event");
                                                    while ($row = mysqli_fetch_array($query)) { ?>
                                                        <option value="<?php echo $row['eCode']; ?>"> <?php echo $row['eName']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmail4" class="form-label">belongs</label>
                                                <textarea class="form-control" name="belongs" style="height: 100px"
                                                    placeholder="example: laptop,bugs etc..."></textarea>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputNanme4" class="form-label">Session</label>
                                                <select class="form-select" name="session" aria-label="Default select example">
                                                    <option selected>---Select Session---</option>
                                                    <?php
                                                    $query1 = mysqli_query($conn, "SELECT snames, sCode,startTime FROM session s INNER JOIN stuff st ON s.User = st.stufCode WHERE s.status = 'active'");

                                                    while ($row1 = mysqli_fetch_array($query1)) { ?>

                                                        <option value="<?php echo $row1['sCode']; ?>">
                                                            <?php echo $row1['snames'] . ' ' . $row1['startTime']; ?>
                                                        </option>
                                                    <?php } ?>

                                                </select>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" name="newAttend" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-secondary">Reset</button>
                                            </div>
                                        </form><!-- Vertical Form -->

                                        <?php

                                    }

                                }
                            }

                            ?>

                        </div>
                    </div>

                </div>
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Exit Visitor</h5>
                            <form method="post">
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Visitor code</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="visitorCode">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" name="exitBtn" class="btn btn-primary">Exit</button>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST['exitBtn'])) {
                                $eventCode = $_POST['visitorCode'];
                                if ($eventCode != null) {

                                    $query = "SELECT v.names, a.belongs, a.VistorAttendanceCode FROM attendance a JOIN vistors v ON v.vistorCode = a.vistor WHERE VistorAttendanceCode = '$eventCode' AND exitTime IS NULL;";
                                    $result = mysqli_query($conn, $query);

                                    if (!$result) {
                                        $_SESSION['error'] = "Visitor Not Found";
                                        header("location: attendance.php"); // Corrected redirect URL
                                        exit(); // Make sure to exit after header redirect
                                    } else {
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <!-- Horizontal Form -->
                                            <form class="row g-3" method="post" action="../backend.php">
                                                <div class="row mb-3">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Names</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="vistorCodeexit"
                                                            value="<?php echo $row['VistorAttendanceCode'] ?>" hidden>
                                                        <input type="text" class="form-control" name="names"
                                                            value="<?php echo $row['names'] ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">belongs with</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="belongs"
                                                            value="<?php echo $row['belongs']; ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Confirm Exit</label>
                                                    <div class="col-sm-10">
                                                        <button name="exit" class="btn btn-primary">Confirm Exit</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <?php
                                        }
                                    }

                                }
                            }
                            ?>

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