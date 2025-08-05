<?php
ob_start();

// Error logging (only to log file, not screen)
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);
error_log("send_otp.php started");

// Force JSON response
header('Content-Type: application/json');

// Load PHPMailer
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include DB connection (IMPORTANT: ensure no echo or output in conn.php)
include '../conn.php';

// Read and decode raw JSON input
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

// Input validation
if (!isset($data['email'])) {
    http_response_code(400);
    ob_clean();
    echo json_encode(["status" => "error", "message" => "Email is required."]);
    exit;
}

$email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    ob_clean();
    echo json_encode(["status" => "error", "message" => "Invalid email address."]);
    exit;
}

// Generate OTP and expiry time
$otp = random_int(100000, 999999);
$expiry_time = date("Y-m-d H:i:s", strtotime("+10 minutes"));

// Insert OTP into database
$stmt = $conn->prepare("INSERT INTO otp_table (email, otp, expiry_time) VALUES (?, ?, ?)");
if (!$stmt) {
    error_log("Database prepare failed: " . $conn->error);
    http_response_code(500);
    ob_clean();
    echo json_encode(["status" => "error", "message" => "Database error."]);
    exit;
}
$stmt->bind_param("sss", $email, $otp, $expiry_time);

if (!$stmt->execute()) {
    error_log("Database execute failed: " . $stmt->error);
    $stmt->close();
    http_response_code(500);
    ob_clean();
    echo json_encode(["status" => "error", "message" => "Failed to store OTP."]);
    exit;
}
$stmt->close();

// Send OTP email
$mail = new PHPMailer(true);
try {
   
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'sender.qweez@gmail.com';  // Your Gmail
    $mail->Password = 'jhjn ljpm aazb ijhz';      // App password (not Gmail password)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('no-reply@example.com', 'No Reply');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Your OTP for Sign Up';
    $mail->Body = "
        <p>Your OTP is: <strong>$otp</strong></p>
        <p>This code will expire in 10 minutes.</p>
    ";

    $mail->send();

    ob_clean();
    echo json_encode(["status" => "success", "message" => "OTP sent to your email."]);
    exit;
} catch (Exception $e) {
    error_log("PHPMailer Error: " . $mail->ErrorInfo);
    http_response_code(500);
    ob_clean();
    echo json_encode(["status" => "error", "message" => "Failed to send email."]);
    exit;
}


?>