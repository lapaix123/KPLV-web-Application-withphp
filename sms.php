<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Require the bundled autoload file - the path may need to change
// based on where you downloaded and unzipped the SDK
require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';

// Set Twilio credentials as environment variables
putenv("TWILIO_ACCOUNT_SID=AC496a9571c58e0f2a8cc21319146ddac8");
putenv("TWILIO_AUTH_TOKEN=a53c9e0bab9ae3d77fede31ad014122f");

// Retrieve Twilio credentials from environment variables
$sid = getenv("TWILIO_ACCOUNT_SID");
$token = getenv("TWILIO_AUTH_TOKEN");

$twilio = new Twilio\Rest\Client($sid, $token);

// Use the Client to make requests to the Twilio REST API
$twilio->messages->create(
    // The number you'd like to send the message to
    '+250788965501',
    [
        // A Twilio phone number you purchased at https://console.twilio.com
        'from' => '+18159120229',
        // The body of the text message you'd like to send
        'body' => "Hey Jenny! Good luck on the bar exam!"
    ]
);
?>
