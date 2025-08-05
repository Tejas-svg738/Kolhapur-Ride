<?php
session_start();

// Unset session variables when the ride is completed
unset($_SESSION['ride_locked']);
unset($_SESSION['ride_status']);
unset($_SESSION['ride_booked']); // optional: if you set this when ride is booked by another driver

// Optionally redirect to driver main page or confirmation page
header("Location: drivermain.php");
exit();
?>
