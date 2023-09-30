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
// delete event ///////
if (isset($_GET['eventDelete'])) {

    $eCode = $_GET['eventDelete'];
    $stmt = $conn->prepare("DELETE FROM event WHERE  eCode= ?");
    $stmt->bind_param("s", $eCode);

    if ($stmt->execute()) {
        $_SESSION['save'] = "User Deleted";
        header("Location:vewEvent.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
        header("Location vewEvent.php");
        exit();
    }



}
////delete User////
if (isset($_GET['userDelete'])) {

    $uCode = $_GET['userDelete'];
    $stmt = $conn->prepare("DELETE FROM stuff WHERE  stufCode= ?");
    $stmt->bind_param("s", $uCode);

    if ($stmt->execute()) {
        $_SESSION['save'] = "User Deleted";
        header("Location:viewUser.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
        header("Location: viewUser.php");
        exit();
    }



}

/////////delete Visitors
if (isset($_GET['visitorDelete'])) {

    $vCode = $_GET['visitorDelete'];
    $stmt = $conn->prepare("DELETE FROM vistors WHERE  vistorCode = ?");
    $stmt->bind_param("s", $vCode);

    if ($stmt->execute()) {
        $_SESSION['save'] = "Visitor Deleted";
        header("Location:vewVistor.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
        header("Location: vewVistor.php");
        exit();
    }



}

/////////delete Visitors
if (isset($_GET['contactDelete'])) {

    $vCode = $_GET['contactDelete'];
    $stmt = $conn->prepare("DELETE FROM contact WHERE  id= ?");
    $stmt->bind_param("s", $vCode);

    if ($stmt->execute()) {
        $_SESSION['save'] = "Visitor Deleted";
        header("Location:pages-contact.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
        header("Location:pages-contact.php");
        exit();
    }



}
?>