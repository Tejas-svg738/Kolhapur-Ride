<?php
session_start();

// Database connection
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "qweez";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$user_id = $_SESSION['user_id'];

// Get user info
$user_stmt = $conn->prepare("SELECT name, email FROM users WHERE user_id = ?");
$user_stmt->bind_param("s", $user_id);
$user_stmt->execute();
$user_result = $user_stmt->get_result();
$user_data = $user_result->fetch_assoc();

// Get ride history
$ride_stmt = $conn->prepare("SELECT ride_date, pickup_location, dropoff_location, vehicle, fare FROM rides WHERE user_id = ? ORDER BY ride_date DESC");
$ride_stmt->bind_param("s", $user_id);
$ride_stmt->execute();
$ride_result = $ride_stmt->get_result();

$rides = [];
while ($row = $ride_result->fetch_assoc()) {
    $rides[] = [
        "date" => date("Y-m-d H:i", strtotime($row['ride_date'])),
        "pickup" => $row['pickup_location'],
        "dropoff" => $row['dropoff_location'],
        "vehicle" => $row['vehicle'],
        "fare" => number_format($row['fare'], 2)
    ];
}

// Output JSON
echo json_encode([
    "user" => $user_data,
    "rides" => $rides
]);
?>
