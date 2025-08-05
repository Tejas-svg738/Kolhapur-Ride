<?php
// get_price.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qweez"; // <-- change this
$port="4306";

$conn = new mysqli($servername, $username, $password, $dbname,$port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get vehicle id from query parameter
$vehicle_id = isset($_GET['vehicle_id']) ? intval($_GET['vehicle_id']) : 0;

$price = '';

if ($vehicle_id > 0) {
    $sql = "SELECT price FROM vehicle WHERE id = $vehicle_id LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $row = $result->fetch_assoc()) {
        $price = $row['price'];
    }
}

echo $price;
$conn->close();
?>
