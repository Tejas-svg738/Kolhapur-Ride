<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: /Kolhapur/Userlogin/login.html");
    exit;
}

// 📌 Database connection for avg price
$host = "localhost";
$dbname = "qweez";
$username = "root";
$password = "";
$port = 3306;

$conn = new mysqli($host, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getAveragePrice($conn, $tableName) {
    $sql = "SELECT AVG(price) as avg_price FROM $tableName";
    $result = $conn->query($sql);
    if ($result && $row = $result->fetch_assoc()) {
        return round($row['avg_price'], 2);
    }
    return 0;
}

$vehicleGroups = [
    "Car" => [
        "sedan_cars" => "Sedan",
        "hatchback_cars" => "Hatchback"
    ],
    "Bike" => [
        "gear_bikes" => "Gear",
        "non_gear_bikes" => "Non-Gear"
    ],
    "Auto" => [
        "auto_vehicles" => "Standard Auto"
    ]
];

// 📌 Ride & Customer Info
$name     = $_SESSION['name'] ?? 'Unknown';
$mobile   = $_SESSION['mobile'] ?? 'Unknown';
$pickup   = $_SESSION['pickup'] ?? '';
$drop     = $_SESSION['drop'] ?? '';
$date     = $_SESSION['date'] ?? '';
$time     = $_SESSION['time'] ?? '';
$rideStatus = $_SESSION['ride_status'] ?? '';

$rideAccepted = ($rideStatus === 'accepted');
$driverName   = $driverPhoto = $driverMobile = $vehicleModel = $vehicleNo = $driverEmail = 'N/A';

if ($rideAccepted && isset($_SESSION['driver_info'])) {
    $driver        = $_SESSION['driver_info'];
    $driverName    = $driver['firstname'] ?? 'N/A';
    $vehicleModel  = $driver['model'] ?? 'N/A';
    $vehicleNo     = $driver['rcno'] ?? 'N/A';
    $driverPhoto   = $driver['idphoto'] ?? '';
    $driverMobile  = $driver['mobile'] ?? 'N/A';
    $driverEmail   = $driver['email'] ?? 'N/A';
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ride & Vehicle Info</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f4f4f4;
    }
    .container {
      max-width: 1200px;
      margin: auto;
      padding: 20px;
    }
    h2 {
      margin-bottom: 10px;
      color: #333;
    }
    .section {
      background: white;
      margin-bottom: 20px;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .driver-card {
      display: flex;
      align-items: center;
    }
    .driver-card img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 20px;
    }
    .avg-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
    }
    .avg-card {
      padding: 15px;
      border-radius: 12px;
      background: #fafafa;
      border: 1px solid #ddd;
    }
    .avg-card h4 {
      margin: 0 0 8px;
      color: #222;
    }
    .avg-card p {
      margin: 0;
      color: #555;
    }
  </style>
</head>
<body>
  <div class="container">

    <div class="section">
      <h2>Ride Information</h2>
      <p><strong>Name:</strong> <?= htmlspecialchars($name) ?></p>
      <p><strong>Mobile:</strong> <?= htmlspecialchars($mobile) ?></p>
      <p><strong>Pickup:</strong> <?= htmlspecialchars($pickup) ?></p>
      <p><strong>Drop:</strong> <?= htmlspecialchars($drop) ?></p>
      <p><strong>Date & Time:</strong> <?= htmlspecialchars($date) ?> <?= htmlspecialchars($time) ?></p>
    </div>

    <?php if ($rideAccepted): ?>
    <div class="section">
      <h2>Driver Information</h2>
      <div class="driver-card">
        <?php if ($driverPhoto): ?>
          <img src="data:image/jpeg;base64,<?= $driverPhoto ?>" alt="Driver Photo">
        <?php else: ?>
          <img src="/placeholder.jpg" alt="No Photo">
        <?php endif; ?>
        <div>
          <p><strong>Name:</strong> <?= htmlspecialchars($driverName) ?></p>
          <p><strong>Mobile:</strong> <?= htmlspecialchars($driverMobile) ?></p>
          <p><strong>Email:</strong> <?= htmlspecialchars($driverEmail) ?></p>
          <p><strong>Vehicle:</strong> <?= htmlspecialchars($vehicleModel) ?> (<?= htmlspecialchars($vehicleNo) ?>)</p>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <div class="section">
      <h2>Average Vehicle Prices</h2>
      <?php foreach ($vehicleGroups as $group => $vehicles): ?>
        <h3><?= htmlspecialchars($group) ?></h3>
        <div class="avg-grid">
        <?php foreach ($vehicles as $table => $label): ?>
          <div class="avg-card">
            <h4><?= htmlspecialchars($label) ?></h4>
            <p>Average Price: <strong>₹<?= getAveragePrice($conn, $table) ?></strong></p>
          </div>
        <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</body>
</html>