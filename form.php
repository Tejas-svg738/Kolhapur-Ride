<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Only allow POST requests
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Database connection
        $conn = new mysqli("localhost", "root", "", "qweez", 3306);

        // Get and sanitize inputs
        $passengerName = trim($_POST['passengerName'] ?? '');
        $passengerEmail = trim($_POST['passengerEmail'] ?? '');
        $passengerPhone = trim($_POST['passengerPhone'] ?? '');
        $altContact = trim($_POST['altContact'] ?? '');
        $NumberofPassengers = trim($_POST['NumberofPassengers'] ?? '');

        // Validate required fields
        if (
            empty($passengerName) || empty($passengerEmail) || empty($passengerPhone) ||
            empty($altContact) || empty($NumberofPassengers)
        ) {
            echo "All fields are required.";
            exit;
        }

        // Validate email
        if (!filter_var($passengerEmail, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            exit;
        }

        // Validate contact numbers
        if (strlen($passengerPhone) < 10 || strlen($altContact) < 10) {
            echo "Contact numbers must be at least 10 digits.";
            exit;
        }

        // Convert to integer
        $NumberofPassengers = (int)$NumberofPassengers;

        // Prepare insert query
        $stmt = $conn->prepare("
            INSERT INTO passengerinfo (passengerName, passengerEmail, passengerPhone, altContact, NumberofPassengers)
            VALUES (?, ?, ?, ?, ?)
        ");

        $stmt->bind_param("ssssi", $passengerName, $passengerEmail, $passengerPhone, $altContact, $NumberofPassengers);
        $stmt->execute();

        // Get inserted passenger ID and store it in session
        $passengerID = $stmt->insert_id;
        $_SESSION['user_id'] = $passengerID;  // Consistent with save_ride.php

        echo "Passenger data inserted successfully. Passenger ID: " . $passengerID;

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        error_log("Exception: " . $e->getMessage());
    }
} else {
    echo "Invalid request method.";
}
?>