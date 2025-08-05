<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

$stmt = $pdo->query("SELECT amount, payment_mode, created_at FROM payments ORDER BY created_at DESC");
$payments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment History</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px 12px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        body {
            font-family: Arial, sans-serif;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Payment History</h2>
    <table>
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Amount</th>
                <th>Payment Mode</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $srNo = 1;
            if (!empty($payments)) {
                foreach ($payments as $payment): ?>
                <tr>
                    <td><?= $srNo++ ?></td>
                    <td>₹<?= htmlspecialchars($payment['amount']) ?></td>
                    <td><?= htmlspecialchars($payment['payment_mode']) ?></td>
                    <td><?= htmlspecialchars($payment['created_at']) ?></td>
                </tr>
                <?php endforeach; 
            } else { ?>
                <tr>
                    <td colspan="4">No payment history found.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>