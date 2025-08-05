<?php
session_start();

// Enable for debugging only (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

// Only allow POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["success" => false, "error" => "Invalid request method."]);
    exit;
}

// Connect to database
$conn = new mysqli("localhost", "root", "", "qweez", 3306);
if ($conn->connect_error) {
    echo json_encode(["success" => false, "error" => "DB connection failed: " . $conn->connect_error]);
    exit;
}

// Get and sanitize POST data
$pickup = trim($_POST['pickup'] ?? '');
$drop = trim($_POST['drop'] ?? '');
$ride_date = trim($_POST['ride_date'] ?? '');
$ride_time = trim($_POST['ride_time'] ?? '');

// Use dummy passenger ID or session one
$passenger_id = $_SESSION['user_id'] ?? 1;

// Validate inputs
if (!$pickup || !$drop || !$ride_date || !$ride_time) {
    echo json_encode(["success" => false, "error" => "All fields are required."]);
    exit;
}

$date_valid = DateTime::createFromFormat('Y-m-d', $ride_date);
$time_valid = DateTime::createFromFormat('H:i', $ride_time);

if (!$date_valid || $date_valid->format('Y-m-d') !== $ride_date) {
    echo json_encode(["success" => false, "error" => "Invalid date format."]);
    exit;
}
if (!$time_valid || $time_valid->format('H:i') !== $ride_time) {
    echo json_encode(["success" => false, "error" => "Invalid time format."]);
    exit;
}

// Insert into ride_requests
$stmt = $conn->prepare("INSERT INTO ride_requests (pickup_location, drop_location, ride_date, ride_time, passenger_id) VALUES (?, ?, ?, ?, ?)");
if (!$stmt) {
    echo json_encode(["success" => false, "error" => "Prepare failed: " . $conn->error]);
    exit;
}

$stmt->bind_param("ssssi", $pickup, $drop, $ride_date, $ride_time, $passenger_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Insert failed: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>