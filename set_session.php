<?php
session_start();

// Store the ride details into session
$_SESSION['pickup'] = isset($_GET['pickup']) ? $_GET['pickup'] : '';
$_SESSION['drop'] = isset($_GET['drop']) ? $_GET['drop'] : '';
$_SESSION['date'] = isset($_GET['date']) ? $_GET['date'] : '';
$_SESSION['time'] = isset($_GET['time']) ? $_GET['time'] : '';

// Redirect to Rprice.php
header("Location: Rprice.php");
exit();
?>