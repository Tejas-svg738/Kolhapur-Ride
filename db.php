<?php
// Database connection settings
$host = "127.0.0.1";         // Use IP to avoid DNS issues
$username = "root";          // Default username for XAMPP
$password = "";              // Default password is empty
$dbname = "qweez";           // Your database name
$port = 3306;                // Default MySQL port

// Create connection
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("❌ Database connection failed: " . $conn->connect_error);
}

// Optional: Set character encoding
$conn->set_charset("utf8mb4");
?>
