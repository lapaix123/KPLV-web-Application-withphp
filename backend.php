<?php session_start(); ?>


<html>

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

    // User registration
    if (isset($_POST['newUser'])) {
        $names = $_POST["names"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password

        $stmt = $conn->prepare("INSERT INTO stuff (snames, email, phone, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $names, $email, $phone, $password);

        if ($stmt->execute()) {
            $_SESSION['save'] = "User Added";
        } else {
            $_SESSION['error'] = "email or Phone Used!! ";
        }

        unset($_POST);
        header("Location: ./dashboard/newUser.php");
        exit;
    }

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
                require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';

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
            } else {

                $_SESSION['error'] = "Error: ";
            }
        } else {
            $_SESSION['error'] = "provide important Data";
        }
        unset($_POST); // Clear form da
        header("Location:./dashboard/newVistor.php");
        exit();
    }
    // Visitor registration on view page
    if (isset($_POST['newVisitorView'])) {
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
                require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';

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
        header("Location: ./dashboard/vewVistor.php");
        exit();
    }

    // Event creation
    if (isset($_POST['newEvent'])) {
        $eventName = $_POST['name'];
        $coordinator = $_POST['coordinator'];


        $stmt = $conn->prepare("INSERT INTO event (eName, cordinator,Status) VALUES (?, ?,'Active')");
        $stmt->bind_param("ss", $eventName, $coordinator);

        if ($stmt->execute()) {

            $_SESSION['save'] = "Event added successfully!";
        } else {
            // Clear form da
            $_SESSION['error'] = "Error adding event: ";
            header("Location: ./dashboard/newEvent.php");
        }
        unset($_POST);
        header("Location:./dashboard/newEvent.php");
        exit();
    }
    // Event creation view page
    if (isset($_POST['newEventview'])) {
        $eventName = $_POST['name'];
        $coordinator = $_POST['coordinator'];


        $stmt = $conn->prepare("INSERT INTO event (eName, cordinator,Status) VALUES (?, ?,'Active')");
        $stmt->bind_param("ss", $eventName, $coordinator);

        if ($stmt->execute()) {

            $_SESSION['save'] = "Event added successfully!";
        } else {
            // Clear form da
            $_SESSION['error'] = "Error adding event: ";
        }
        unset($_POST);
        header("Location: ./dashboard/vewEvent.php");
        exit();
    }

    // Admin login
    if (isset($_POST['loginAdmin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT adminCode, email, names, password FROM admin WHERE email = ?");

        if (!$stmt) {
            die("Error in preparing statement: " . $conn->error);
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();

        if ($stmt->error) {
            die("Error in execution: " . $stmt->error);
        } else {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                // No need to verify the password hash here, we'll do it later
                $storedPassword = $user['password'];

                if ($password === $storedPassword) { // Check passwords directly
                    unset($_POST); // Clear form data
                    $_SESSION['user_id'] = $user['adminCode'];
                    $_SESSION['username'] = $user['email'];
                    $_SESSION['names'] = $user['names']; // Store the admin's name
                    $_SESSION['logged_in'] = true; // Set the logged in flag
                    header("Location:./dashboard/index.php");
                    exit();
                } else {
                    unset($_POST); // Clear form data
                    $_SESSION['error'] = "Invalid username or password";
                    header("location: pages-login.php");
                    exit();
                }
            } else {
                unset($_POST); // Clear form data
                $_SESSION['error'] = "Invalid username or password";
                header("location: pages-login.php");
                exit();
            }
        }
    }




    ///////new user on view page
    // User registration
    if (isset($_POST['newUserView'])) {
        $names = $_POST["names"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password

        $stmt = $conn->prepare("INSERT INTO stuff (snames, email, phone, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $names, $email, $phone, $password);

        if ($stmt->execute()) {
            $_SESSION['save'] = "User Added";
            $stmt->close();

            // Clear form data and reset session
            unset($_POST); // Clear form data
            $_SESSION['save'] = "User Added"; // Set session message

            header('Location: ./dashboard/viewUser.php'); // Redirect to viewUser.php
            exit;
        } else {
            $_SESSION['error'] = "Error: " . $stmt->error;
            $stmt->close();

            // Clear form data and reset session
            unset($_POST); // Clear form data
            $_SESSION['error'] = "user all ready exist "; // Set session message

            header('Location: ./dashboard/viewUser.php'); // Redirect to viewUser.php
            exit;
        }
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
                require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';

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




                header("Location: ./dashboard/attendance.php");
                exit();
            } else {
                $_SESSION['error'] = "Error fail to attend: ";
            }
        }
        unset($_POST);
        header("Location: ./dashboard/attendance.php");
        exit();
    }




    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////staf///////////////////////////////////////////////////////////////

    // Staff login
    if (isset($_POST['stuff_login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT stufCode, email,snames, password FROM stuff WHERE email = ?");

        if (!$stmt) {
            die("Error in preparing statement: " . $conn->error);
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();

        if ($stmt->error) {
            die("Error in execution: " . $stmt->error);
        } else {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                // Get the hashed password from the database
                $storedHashedPassword = $user['password'];

                // Verify the entered password against the stored hash
                if (password_verify($password, $storedHashedPassword)) {
                    unset($_POST); // Clear form data
                    $_SESSION['user_idf'] = $user['stuffCode'];
                    $_SESSION['username'] = $user['email'];
                    $_SESSION['snames'] = $user['snames'];
                    $_SESSION['logged_in'] = true; // Set the logged in flag
                    header("Location: ./staff/index.php");
                    exit();
                } else {
                    unset($_POST); // Clear form data
                    $_SESSION['error'] = "Invalid username or password";
                    header("location: pages-login1.php");
                    exit();
                }
            } else {
                unset($_POST); // Clear form data
                $_SESSION['error'] = "Invalid username or password";
                header("location: pages-login1.php");
                exit();
            }
        }
    }
    ///////////// user update/////

    if (isset($_POST['Userupdate'])) {
        $id = $_POST['id'];
        $names = $_POST['names'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $query = "UPDATE stuff SET snames='$names', email='$email', phone='$phone' WHERE stufCode='$id'";

        $query_run = mysqli_query($conn, $query);
        if (!$query_run) {
            $_SESSION['error'] = "User not Updated: ";
            unset($_POST);

            header("Location: ./dashboard/updateUser.php");
            exit();
        } else {
            $_SESSION['save'] = "User Updated: ";
            unset($_POST);

            header("Location: ./dashboard/viewUser.php");
            exit();
        }
    }

    ///////////// event update/////

    if (isset($_POST['eventUpdate'])) {
        $id = $_POST['id'];
        $eName = $_POST['eName'];
        $cor = $_POST['cordinator'];
        $status = $_POST['status'];

        $query = "UPDATE event SET eName='$eName', cordinator='$cor', status='$status' WHERE eCode='$id'";

        $query_run = mysqli_query($conn, $query);
        if (!$query_run) {
            $_SESSION['error'] = "Event not Updated: ";
            unset($_POST);

            header("Location: ./dashboard/updateUser.php");
            exit();
        } else {
            $_SESSION['save'] = "User Updated: ";
            unset($_POST);

            header("Location: ./dashboard/vewEvent.php");
            exit();
        }
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
            $query = "UPDATE vistors SET names=?, email=?, dob=?, phone=?, nId=?, category=? WHERE vistorCode=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssssi", $names, $email, $dob, $phone, $nid, $category, $id);

            if ($stmt->execute()) {
                $_SESSION['save'] = "User Updated: ";
                $stmt->close();
                $conn->close();
                header("Location: ./dashboard/vewVistor.php");
                exit();
            } else {
                $_SESSION['error'] = "Event not Updated: " . $stmt->error;
                $stmt->close();
                $conn->close();
                header("Location: ./dashboard/updateVistor.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Please fill in all required fields.";
            header("Location: ./dashboard/updateVistor");
            exit();
        }
    }





    // Close the database connection
    $conn->close();
    ?>

</body>

</html>