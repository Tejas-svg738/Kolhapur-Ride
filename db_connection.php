<?php
$servername = "localhost";
$username = "root";
$password = ""; // XAMPP मध्ये default password रिकामं असतं
$dbname = "qweez"; // ⛔ इथे तुमचं खरं DB नाव टाका (उदा: drivedatabase)

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
