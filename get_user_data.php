<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

// Connect to qweez database
$conn = new mysqli("localhost", "root", "", "qweez", 3306);
if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user info
$user_stmt = $conn->prepare("SELECT name, email FROM users WHERE user_id = ?");
$user_stmt->bind_param("s", $user_id);
$user_stmt->execute();
$user_result = $user_stmt->get_result()->fetch_assoc();

// Fetch ride history
$ride_stmt = $conn->prepare("SELECT ride_date, pickup_location, dropoff_location, vehicle, fare FROM rides WHERE user_id = ?");
$ride_stmt->bind_param("s", $user_id);
$ride_stmt->execute();
$ride_result = $ride_stmt->get_result();

$rides = [];
while ($row = $ride_result->fetch_assoc()) {
    $rides[] = [
        'date' => $row['ride_date'],
        'pickup' => $row['pickup_location'],
        'dropoff' => $row['dropoff_location'],
        'vehicle' => $row['vehicle'],
        'fare' => $row['fare']
    ];
}

// Output combined JSON
echo json_encode([
    'user' => $user_result,
    'rides' => $rides
]);
?>
