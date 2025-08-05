<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['pickup'] = $_POST['pickup'];
    $_SESSION['drop'] = $_POST['drop'];
    $_SESSION['date'] = $_POST['date'];
    $_SESSION['time'] = $_POST['time'];

    // Redirect to drivermain.php
    header("Location: drivermain.php");
    exit;
} else {
    echo "Invalid access!";
}
