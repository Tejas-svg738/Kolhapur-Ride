<?php
$host = 'localhost';
$dbname = 'qweez';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $amount = $_POST['amount'];
    $paymentMode = $_POST['paymentMode'];
    $upiId = $_POST['upiId'];

    $stmt = $pdo->prepare("INSERT INTO payments (amount, payment_mode, upi_id) VALUES (:amount, :payment_mode, :upi_id)");
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':payment_mode', $paymentMode);
    $stmt->bindParam(':upi_id', $upiId);

    if ($stmt->execute()) {
        echo "Payment saved!";
    } else {
        echo "Failed to save payment.";
    }
} else {
    echo "Invalid request.";
}
?>
