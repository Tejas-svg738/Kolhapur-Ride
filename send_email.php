<?php
session_start();
require 'db_connection.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Input validation
$subtype = strtolower(trim($_GET['subtype'] ?? ''));

if (!$subtype) {
    echo "❌ Vehicle subtype is missing.";
    exit;
}

// Define table mappings
$tableMap = [
    'sedan' => 'sedan_cars',
    'hatchback' => 'hatchback_cars',
    'gear' => 'gear_bikes',
    'withoutgear' => 'without_gear_bikes',
    'auto' => 'auto_cars'
];

if (!array_key_exists($subtype, $tableMap)) {
    echo "❌ Unknown subtype: '$subtype'";
    exit;
}

// Session data
$pickup = $_SESSION['pickup'] ?? 'Not specified';
$drop = $_SESSION['drop'] ?? 'Not specified';
$name = $_SESSION['name'] ?? 'Unknown Customer';
$mobile = $_SESSION['mobile'] ?? 'Not Provided';

// Fetch approved drivers
$query = "SELECT firstname, lastname, emailid FROM drivedatabase";
$result = $conn->query($query);

if (!$result) {
    echo "❌ Database Error: " . $conn->error;
    
    exit;
}

if ($result->num_rows == 0) {
    echo "ℹ️ No approved drivers found for subtype '$subtype'.";
    exit;
}

// Email sending function
function sendEmail($to_email, $to_name, $name, $mobile, $pickup, $drop) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sender.qweez@gmail.com';
        $mail->Password = 'jhjn ljpm aazb ijhz'; // ⚠️ Use environment variable for security
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('sender.qweez@gmail.com', 'Qweez Cab Service');
        $mail->addAddress($to_email, $to_name);

        $mail->isHTML(true);
        $mail->Subject = 'New Ride Request';

        $mail->Body = "
            <h3>Hi $to_name,</h3>
            <p>You have a new ride request from a customer.</p>
            <p><strong>Customer name:</strong> $name<br>
               <strong>Mobile no:</strong> $mobile<br>
               <strong>Pickup:</strong> $pickup<br>
               <strong>Drop:</strong> $drop</p>
            <p>Please login to your driver account to view and confirm the ride.</p>
            <br>
            <p>Thank you,<br>Qweez Cab Team</p>
        ";

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "⚠️ Failed to send to $to_email: {$mail->ErrorInfo}<br>";
        return false;
    }
} 

// Send emails
$sent_count = 0;
while ($row = $result->fetch_assoc()) {
    $firstname = $row['firstname'] ?? '';
    $lastname = $row['lastname'] ?? '';
    $emailid = $row['emailid'] ?? '';

    if (filter_var($emailid, FILTER_VALIDATE_EMAIL)) {
        $fullname = trim($firstname . ' ' . $lastname);
        if (sendEmail($emailid, $fullname, $name, $mobile, $pickup, $drop)) {
            $sent_count++;
        }
    }
}

// Final message
echo "✅ Email sent to $sent_count approved drivers of subtype '$subtype'.";
?>
