<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$dbname = "qweez";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if (isset($_GET['userid']) && isset($_GET['password'])) {
    $username = $_GET['userid'];
    $password_plain = $_GET['password'];

    $stmt = $conn->prepare("SELECT password FROM drivedatabase WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    
    if ($stmt->fetch()) {
        if (password_verify($password_plain, $hashed_password)) {
            $_SESSION['username'] = $username;

            // तुम्ही user चं नाव पण सेट करू शकता - Example:
            // $_SESSION['name'] = $name;

            echo "<script>alert('Login successful!'); window.location.href='dashboarddriver.php';</script>";
            exit;
        } else {
            echo "<script>alert('Invalid credentials.'); window.location.href='loginform.php';</script>";
        }
    } else {
        echo "<script>alert('User not found.'); window.location.href='loginform.php';</script>";
    }
    $stmt->close();
} else {
    echo "<script>alert('Missing credentials.'); window.location.href='loginform.php';</script>";
}
?>
