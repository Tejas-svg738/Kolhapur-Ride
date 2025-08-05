<?php
session_start();
require 'db_connection.php'; // Include your database connection if needed

// Get driver details from POST request (sent from the Accept button form)
$firstname = $_POST['firstname'] ?? 'Unknown Driver';
$mobile = $_POST['mobile'] ?? '0000000000';
$model = $_POST['model'] ?? 'Unknown Model';
$rcno = $_POST['rcno'] ?? 'MH00XX0000';
$idphoto = $_POST['idphoto'] ?? '/Kolhapur/Driver/test/uploads/default.jpg';

// Store driver details in session so they can be used in Rprice.php
$_SESSION['driver_info'] = [
    'firstname' => $firstname,
    'mobile' => $mobile,
    'model' => $model,
    'rcno' => $rcno,
    'idphoto' => $idphoto 
];

// Mark the ride status as accepted
$_SESSION['ride_status'] = 'accepted';

// Redirect to Rprice.php page to show the accepted driver info
header("Location: Rprice.php");
exit();
?>
