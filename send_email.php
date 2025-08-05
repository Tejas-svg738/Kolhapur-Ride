<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';

$conn = new mysqli("localhost", "root", "", "qweez", 3306);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Get driver info from request
$rc = $_POST['rc'];
$name = $_POST['name'];
$email = $_POST['email'];

// Get latest ride
$ride = $conn->query("SELECT * FROM ride_requests ORDER BY id DESC LIMIT 1")->fetch_assoc();
$passenger_id = $ride['passenger_id'];
$pass = $conn->query("SELECT * FROM passengerinfo WHERE id = $passenger_id")->fetch_assoc();

// Debug: Check if passengerPhone exists and print it
if (isset($pass['passengerPhone'])) {
    echo "Passenger Phone: " . $pass['passengerPhone'];  // Debugging line
} else {
    echo "Passenger Phone not found";  // Error message
}

// Generate OTP
$otp = rand(100000, 999999);
$conn->query("INSERT INTO ride_otp (ride_id, driver_email, otp) VALUES ({$ride['id']}, '$email', '$otp')");

// Email setup
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'sender.qweez@gmail.com'; // 🔁 तुमचं Gmail
    $mail->Password = 'jhjn ljpm aazb ijhz';   // 🔁 App password वापरा
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('sender.qweez@gmail.com', 'Qweez Ride');
    $mail->addAddress($email, $name);
    $mail->isHTML(true);
    $mail->Subject = "New Ride Assigned";

    $mail->Body = "
        Hello $name,<br><br>
        You've been assigned a new ride.<br><br>
        <b>Pickup:</b> {$ride['pickup_location']}<br>
        <b>Drop:</b> {$ride['drop_location']}<br>
        <b>Date:</b> {$ride['ride_date']}<br>
        <b>Time:</b> {$ride['ride_time']}<br><br>
        <b>Passenger Name:</b> {$pass['passengerName']}<br>
        <b>Contact:</b> {$pass['passengerPhone']}<br>
        <b>No. of Passengers:</b> {$pass['NumberofPassengers']}<br><br>
        <b>Pickup OTP:</b> <strong>$otp</strong><br><br>
        Thank you,<br>
        Qweez Team
    ";

    $mail->send();
    $_SESSION['ride_info'] = [
    'pickup' => $ride['pickup_location'],
    'drop' => $ride['drop_location'],
    'date' => $ride['ride_date'],
    'time' => $ride['ride_time'],
    'passenger_name' => $pass['passengerName'],
    'passenger_phone' => $pass['passengerPhone'],
    'num_passengers' => $pass['NumberofPassengers'],
    'otp' => $otp
];

    echo "Message has been sent";
} catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
}
?>