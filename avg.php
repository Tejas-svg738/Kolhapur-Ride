<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "qweez";

// Database connection
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from form
$model = $_POST['model'];
$fuel = $_POST['fuel'];
$number = $_POST['number'];
$average = $_POST['average'];
$price = $_POST['price'];
$vehicle_category = $_POST['vehicle_category']; // car, bike, auto
$vehicle_type = $_POST['vehicle_type']; // sedan, hatchback, gear, without_gear, auto

// Determine the target table
$table = "";

if ($vehicle_category === "car") {
    if ($vehicle_type === "sedan") {
        $table = "sedan_cars";
    } elseif ($vehicle_type === "hatchback") {
        $table = "hatchback_cars";
    }
} elseif ($vehicle_category === "bike") {
    if ($vehicle_type === "gear") {
        $table = "gear_bikes";
    } elseif ($vehicle_type === "without_gear") {
        $table = "non_gear_bikes";
    }
} elseif ($vehicle_category === "auto" && $vehicle_type === "auto") {
    $table = "auto_vehicles";
}

if ($table === "") {
    echo "❌ Invalid vehicle category or type.";
    exit;
}

// Insert data into the selected table
$sql = "INSERT INTO $table (model, fuel, number, average, price) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssdd", $model, $fuel, $number, $average, $price);

if ($stmt->execute()) {
    echo "✅ Vehicle data successfully added to <strong>$table</strong>.";
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>