<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qweez"; // make sure this is your correct DB name
$port="3306";

$conn = new mysqli($servername, $username, $password, $dbname,$port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>