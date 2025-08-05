<?php

include '../conn.php';
// Enable error reporting for debugging
ini_set('display_errors', 0);  // Suppress direct error display
ini_set('log_errors', 1);     // Enable error logging
error_reporting(E_ALL);       // Log all errors
error_log("verify_otp.php script started");

// Include PHPMailer (make sure PHPMailer is installed via Composer)
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Set headers for JSON response
header('Content-Type: application/json');

// Debug: Log raw POST data
$rawData = file_get_contents("php://input");
error_log("Raw POST data: " . $rawData);

// Parse JSON
$data = json_decode($rawData, true);

if (!$data) {
    error_log("Error: Failed to parse POST data");
    echo json_encode(["status" => "error", "message" => "Invalid request format."]);
    exit;
}

// Get and sanitize email and OTP from request
$email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
$otp = filter_var($data['otp'], FILTER_SANITIZE_STRING);

// Validate sanitized email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    error_log("Error: Invalid email provided - $email");
    echo json_encode(["status" => "error", "message" => "Invalid email address. Please provide a valid email."]);
    exit;
}

// Database connection details
// $servername = "localhost";
// $username = "root";
// $password = "root"; // Ensure this is the correct password for your database
// $dbname = "otp_db";

// Create a new connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// Check for DB connection errors
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    echo json_encode(["status" => "error", "message" => "Database connection failed. Please try again later."]);
    exit;
}

// Check if OTP is valid for the given email
$stmt = $conn->prepare("SELECT otp, expiry_time FROM otp_table WHERE email = ? ORDER BY id DESC LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($db_otp, $expiry_time);

if ($stmt->num_rows === 0) {
    error_log("Error: No OTP found for email $email");
    echo json_encode(["status" => "error", "message" => "No OTP request found for this email."]);
    $stmt->close();
    $conn->close();
    exit;
}

$stmt->fetch();

// Check if OTP matches and if it's not expired
if ($otp === $db_otp && strtotime($expiry_time) > time()) {
    // OTP is valid
    echo json_encode(["status" => "success", "message" => "OTP verified successfully!"]);
} else {
    // OTP is invalid or expired
    echo json_encode(["status" => "error", "message" => "Invalid or expired OTP."]);
}

$stmt->close();
$conn->close();
error_log("verify_otp.php script completed successfully");
?>
