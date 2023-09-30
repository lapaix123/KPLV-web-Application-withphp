<?php session_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
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
    //////////////////////attendance /////////////////////////////
    if (isset($_POST['newAttend'])) {
        $vistor = $_POST['vistorCode'];
        $reason = $_POST['reason'];
        $belongs = $_POST['belongs'];
        $session = $_POST['session'];
        $names = $_POST['names'];
        $phone = $_POST['Phone'];
        $email = $_POST['email'];
        $vCode = rand(10000, 90000);
        if ($vistor == null) {
            $_SESSION['error'] = "visitorCode is required !";
        } elseif ($reason == null) {
            $_SESSION['error'] = "reason is required !";
        } elseif ($session == null) {
            $_SESSION['error'] = "session is required  !!";
        } elseif ($names == null) {
            $_SESSION['error'] = "names are required !!";
        } elseif ($phone == null) {
            $_SESSION['error'] = "phone are required: ";
        } else {



            // Prepare and execute the insertion
            $stmt = $conn->prepare("INSERT INTO attendance (vistor, reason, belongs, session, VistorAttendanceCode) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $vistor, $reason, $belongs, $session, $vCode);

            if ($stmt->execute()) {
                $_SESSION['save'] = "thank you " . $vistor . " : " . $names . " this is your Exit Code is :" . $vCode;




                $url = "https://script.google.com/macros/s/AKfycbyX1W3cIu4qZktgx6ZPBOh2q1Qr4We2wP1BtMJ0FAB7-HRbvajCtbq4TaLa1lUOlKmqaw/exec";
                $ch = curl_init($url);
                curl_setopt_array($ch, [
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_POSTFIELDS => http_build_query([
                        "recipient" => $email,
                        "subject" => 'Exit Code For You',
                        "body" => "thank you " . $vistor . " : " . $names . " this is your Exit Code is :" . $vCode
                    ])
                ]);
                $result = curl_exec($ch);
                echo $result;





                // require __DIR__ . '../twilio-php-main/src/Twilio/autoload.php';
                require __DIR__ . './../twilio-php-main/src/Twilio/autoload.php';

                // Set Twilio credentials as environment variables
                putenv("TWILIO_ACCOUNT_SID=AC37257881c4ecf743a1e85bd92712a288");
                putenv("TWILIO_AUTH_TOKEN=50934723bbc3b0f5286492b3b8f52718");

                // Retrieve Twilio credentials from environment variables
                $sid = getenv("TWILIO_ACCOUNT_SID");
                $token = getenv("TWILIO_AUTH_TOKEN");

                $twilio = new Twilio\Rest\Client($sid, $token);

                // Use the Client to make requests to the Twilio REST API
                $twilio->messages->create(
                    // The number you'd like to send the message to
                    '+250786270827',
                    [
                        // A Twilio phone number you purchased at https://console.twilio.com
                        'from' => '+17628009230',
                        // The body of the text message you'd like to send
                        'body' => "thank you " . $vistor . " : " . $names . " this is your Exit Code is :" . $vCode
                    ]
                );







                header("Location: attendance.php");
                exit();
            } else {
                $_SESSION['error'] = "Error fail to attend: ";
            }
        }
        unset($_POST);
        header("Location: attendance.php");
        exit();
    }

    // Check if the form was submitted
    if (isset($_POST['updateVisitor'])) {
        // Get the form input values
        $id = $_POST['id'];
        $names = $_POST['names'];
        $nid = $_POST['nid'];
        $gnd = $_POST['gnd'];
        $dob = $_POST['dob'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // Check if required fields are not empty
        if (!empty($names) && !empty($dob) && !empty($phone) && !empty($gnd)) {
            // Get the current date
            $today = new DateTime();

            // Calculate the age
            $dob1 = new DateTime($dob);
            $diff = $today->diff($dob1);
            $age = $diff->y;

            // Determine category based on age
            if ($age >= 0 && $age <= 12) {
                $category = "child";
            } elseif ($age >= 18 && $age <= 25) {
                $category = "young";
            } else {
                $category = "adult";
            }

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

            // Prepare and execute the UPDATE query
            $query = "UPDATE vistors SET names=?, email=?, dob=?, phone=?, nId=?,sex=?, category=? WHERE vistorCode=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssssssi", $names, $email, $dob, $phone, $nid, $gnd, $category, $id);

            if ($stmt->execute()) {
                $_SESSION['save'] = "Visitor Updated: ";
                $stmt->close();
                $conn->close();
                header("Location: vewVistor.php");
                exit();
            } else {
                $_SESSION['error'] = "Event not Updated: " . $stmt->error;
                $stmt->close();
                $conn->close();
                header("Location: updateVistor.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Please fill in all required fields.";
            header("Location: updateVistor.php");
            exit();
        }
    }
    ////////////////////////////////////////////////////////vistor registration
    // Visitor registration
    if (isset($_POST['newVisitor'])) {
        $names = $_POST["names"];
        $nId = $_POST["nid"];
        $sex = $_POST["gnd"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $dob = $_POST['dob'];
        $VCode = rand(2023001, 2023999);
        if ($names != null && $dob != null & $phone != null && $sex != null) {
            // Get the date of birth from the user
            $dobString = $_POST['dob'];
            $dob1 = new DateTime($dobString);
            $category;

            // Get the current date
            $today = new DateTime();

            // Calculate the age
            $diff = $today->diff($dob1);
            $age = $diff->y;

            // Display the age
            if ($age >= 0 && $age <= 12) {
                $category = "child";
            } elseif ($age > 12 && $age < 18) {
                $category = "student";
            } else {
                $category = "adult";
            }
            $stmt = $conn->prepare("INSERT INTO vistors (vistorCode ,names,nId, sex, category, email, phone,dob) VALUES (?, ?, ?, ?, ?,  ?,?,?)");
            $stmt->bind_param("ssssssss", $VCode, $names, $nId, $sex, $category, $email, $phone, $dob);

            if ($stmt->execute()) {

                $_SESSION['save'] = "Visitor .$names. added Successful With Registration Code :" . $VCode;


                $url = "https://script.google.com/macros/s/AKfycbyX1W3cIu4qZktgx6ZPBOh2q1Qr4We2wP1BtMJ0FAB7-HRbvajCtbq4TaLa1lUOlKmqaw/exec";
                $ch = curl_init($url);
                curl_setopt_array($ch, [
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_POSTFIELDS => http_build_query([
                        "recipient" => $email,
                        "subject" => 'Exit Code For You',
                        "body" => "Visitor .$names. added Successful With Registration Code :" . $VCode
                    ])
                ]);
                $result = curl_exec($ch);
                echo $result;






                // require __DIR__ . '../twilio-php-main/src/Twilio/autoload.php';
                require __DIR__ . './../twilio-php-main/src/Twilio/autoload.php';

                // Set Twilio credentials as environment variables
                putenv("TWILIO_ACCOUNT_SID=AC37257881c4ecf743a1e85bd92712a288");
                putenv("TWILIO_AUTH_TOKEN=50934723bbc3b0f5286492b3b8f52718");

                // Retrieve Twilio credentials from environment variables
                $sid = getenv("TWILIO_ACCOUNT_SID");
                $token = getenv("TWILIO_AUTH_TOKEN");

                $twilio = new Twilio\Rest\Client($sid, $token);

                // Use the Client to make requests to the Twilio REST API
                $twilio->messages->create(
                    // The number you'd like to send the message to
                    '+250786270827',
                    [
                        // A Twilio phone number you purchased at https://console.twilio.com
                        'from' => '+17628009230',
                        // The body of the text message you'd like to send
                        'body' => "Visitor .$names. added Successful With Registration Code :" . $VCode
                    ]
                );
            } else {

                $_SESSION['error'] = "Error: ";
            }
        } else {
            $_SESSION['error'] = "provide important Data";
        }
        unset($_POST); // Clear form da
        header("Location: newVistor.php");
        exit();
    }
    ///////////////////////////////////////////////on view page//////
    // Visitor registration on view page
    if (isset($_POST['newVisitorView'])) {
        $names = $_POST["names"];
        $nId = $_POST["nid"];
        $sex = $_POST["gnd"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $dob = $_POST['dob'];
        $VCode = rand(2023001, 2023999);

        /* if (!empty($nId) && strlen($nId) !== 16) {
            $_SESSION['error'] = "National ID is Invalid";
            header("Location: vewVistor.php");
            exit();
        }
        if (!empty($phone) && !preg_match('/^\+2507\d{8}$/', $phone)) {

            $_SESSION['error'] = "Phone number is not valid. It must start with +2507 and be 13 characters long.";
            header("Location: vewVistor.php");
            exit();
        }
*/

        if ($names != null && $dob != null & $phone != null && $sex != null) {



            // Get the date of birth from the user
            $dobString = $_POST['dob'];
            $dob1 = new DateTime($dobString);
            $category;

            // Get the current date
            $today = new DateTime();

            // Calculate the age
            $diff = $today->diff($dob1);
            $age = $diff->y;

            // Display the age
            if ($age >= 0 && $age <= 12) {
                $category = "child";
            } elseif ($age > 12 && $age < 18) {
                $category = "student";
            } else {
                $category = "adult";
            }
            $stmt = $conn->prepare("INSERT INTO vistors (vistorCode ,names,nId, sex, category, email, phone,dob) VALUES (?, ?, ?, ?, ?,  ?,?,?)");
            $stmt->bind_param("ssssssss", $VCode, $names, $nId, $sex, $category, $email, $phone, $dob);

            if ($stmt->execute()) {

                $_SESSION['save'] = "Visitor .$names. added Successful With Registration Code :" . $VCode;

                if ($email != null) {
                    $url = "https://script.google.com/macros/s/AKfycbyX1W3cIu4qZktgx6ZPBOh2q1Qr4We2wP1BtMJ0FAB7-HRbvajCtbq4TaLa1lUOlKmqaw/exec";
                    $ch = curl_init($url);
                    curl_setopt_array($ch, [
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_POSTFIELDS => http_build_query([
                            "recipient" => $email,
                            "subject" => 'Exit Code For You',
                            "body" => "Visitor .$names. added Successful With Registration Code :" . $VCode
                        ])
                    ]);
                    $result = curl_exec($ch);
                    echo $result;
                }


                // require __DIR__ . '../twilio-php-main/src/Twilio/autoload.php';
                require __DIR__ . './../twilio-php-main/src/Twilio/autoload.php';

                // Set Twilio credentials as environment variables
                putenv("TWILIO_ACCOUNT_SID=AC37257881c4ecf743a1e85bd92712a288");
                putenv("TWILIO_AUTH_TOKEN=50934723bbc3b0f5286492b3b8f52718");

                // Retrieve Twilio credentials from environment variables
                $sid = getenv("TWILIO_ACCOUNT_SID");
                $token = getenv("TWILIO_AUTH_TOKEN");

                $twilio = new Twilio\Rest\Client($sid, $token);

                // Use the Client to make requests to the Twilio REST API
                $twilio->messages->create(
                    // The number you'd like to send the message to
                    '+250786270827',
                    [
                        // A Twilio phone number you purchased at https://console.twilio.com
                        'from' => '+17628009230',
                        // The body of the text message you'd like to send
                        'body' => "Visitor .$names. added Successful With Registration Code :" . $VCode
                    ]
                );
            } else {

                $_SESSION['error'] = "Error: " . $stmt->error;
            }
        } else {
            $_SESSION['error'] = "provide important Data";
        }
        unset($_POST); // Clear form da
        header("Location: vewVistor.php");
        exit();
    }

    ///////////////////////exit Vistor
    if (isset($_POST['exit'])) {
        $exitCode = $_POST['vistorCodeexit'];
        $bookOut=$_POST['bookCode'];

        $query = "UPDATE attendance SET exitTime = NOW() ,bookOut=$bookOut WHERE VistorAttendanceCode = '$exitCode'";

        if (mysqli_query($conn, $query)) {
            $_SESSION['save'] = "Visitor exit Successful";
            if($bookOut != null){
 $getEmailQuery = "SELECT v.email, v.names FROM vistors v JOIN attendance a ON v.vistorCode = a.vistor WHERE a.VistorAttendanceCode = '$exitCode'";
            $result = mysqli_query($conn, $getEmailQuery);
            $row = mysqli_fetch_assoc($result);
            $email = $row['email'];
            $names = $row['names'];

                $url = "https://script.google.com/macros/s/AKfycbyX1W3cIu4qZktgx6ZPBOh2q1Qr4We2wP1BtMJ0FAB7-HRbvajCtbq4TaLa1lUOlKmqaw/exec";
                    $ch = curl_init($url);
                    curl_setopt_array($ch, [
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_POSTFIELDS => http_build_query([
                            "recipient" => $email,
                            "subject" => 'Exit Code For You',
                            "body" => "Visitor $names, remember that you exited with book code $bookOut. Please make sure to return the book on time. Your exit code is: $exitCode"
                        ])
                    ]);
                    $result = curl_exec($ch);
                    echo $result;
                


                // require __DIR__ . '../twilio-php-main/src/Twilio/autoload.php';
                require __DIR__ . './../twilio-php-main/src/Twilio/autoload.php';

                // Set Twilio credentials as environment variables
                putenv("TWILIO_ACCOUNT_SID=AC37257881c4ecf743a1e85bd92712a288");
                putenv("TWILIO_AUTH_TOKEN=50934723bbc3b0f5286492b3b8f52718");

                // Retrieve Twilio credentials from environment variables
                $sid = getenv("TWILIO_ACCOUNT_SID");
                $token = getenv("TWILIO_AUTH_TOKEN");

                $twilio = new Twilio\Rest\Client($sid, $token);

                // Use the Client to make requests to the Twilio REST API
                $twilio->messages->create(
                    // The number you'd like to send the message to
                    '+250786270827',
                    [
                        // A Twilio phone number you purchased at https://console.twilio.com
                        'from' => '+17628009230',
                        // The body of the text message you'd like to send
                        'body' => "Visitor $names, remember that you exited with book code $bookOut. Please make sure to return the book on time. Your exit code is: $exitCode"
                    ]
                );





            }


        } else {
            $_SESSION['error'] = "Failed to update exit time for the visitor: " . $conn->error;
        }

        mysqli_close($conn); // Close the database connection

        header("Location: attendance.php");
        exit();
    }

    ?>

</body>

</html>