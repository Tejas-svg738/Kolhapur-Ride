<?php
$name = $bank = $account = $ifsc = ""; // Default values

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $bank = htmlspecialchars($_POST['bank']);
    $account = htmlspecialchars($_POST['account']);
    $ifsc = htmlspecialchars($_POST['ifsc']);

    // DB connection
    $host = "localhost";

  
    
$user = "root";         // default for XAMPP
$pass = "";             // default is empty for XAMPPTGQQ
$db   = "qweez";    // must match your DB name
$port=3306;
$conn = new mysqli

    
    
    
       ($host, $user, $pass, $db,$port);

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO bank_details (name, bank, account, ifsc) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $bank, $account, $ifsc);
    $stmt->execute();

    $stmt->close();
    $conn->close();
} else {
    // Prevent direct access
    header("Location: bankdetail.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bank Details Submitted</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  
  <div class="container">
    <h2>Bank Details Submitted Successfully</h2>
    <p><strong>Account Holder Name:</strong> <?php echo $name; ?></p>
    <p><strong>Bank Name:</strong> <?php echo $bank; ?></p>
    <p><strong>Account Number:</strong> <?php echo $account; ?></p>
    <p><strong>IFSC Code:</strong> <?php echo $ifsc; ?></p>

    <a href=" bankdetail.html"><button style="margin-top: 20px;">Go Back</button></a>
  </div>

  
</body>
</html>