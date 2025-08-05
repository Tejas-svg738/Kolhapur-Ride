<?php
$host = "localhost";
$dbname = "qweez";
$username = "root";
$password = "";
$port = 3306;

$conn = new mysqli($host, $username, $password, $dbname, $port);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

function getAvailableVehicles($conn, $tableName)
{
  $sql = "SELECT * FROM $tableName";
  $result = $conn->query($sql);
  $vehicles = [];

  if ($result) {
    while ($row = $result->fetch_assoc()) {
      $vehicles[] = $row;
    }
  }

  return $vehicles;
}

$type = $_GET['type'] ?? '';
$vehicleTables = [
  "Car" => ["sedan_cars", "hatchback_cars"],
  "Bike" => ["gear_bikes", "non_gear_bikes"],
  "Rikshaw" => ["auto_vehicles"]
];

$vehicles = [];

if (isset($vehicleTables[$type])) {
  foreach ($vehicleTables[$type] as $table) {
    $vehicles = array_merge($vehicles, getAvailableVehicles($conn, $table));
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($type) ?> Vehicles</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #fff;
      padding: 40px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
      gap: 30px;
      max-width: 1000px;
      width: 100%;
    }

    .card {
      display: flex;
      align-items: center;
      transition: transform 0.2s ease;
    }

    .card:hover {
      transform: scale(1.02);
    }

    .image-box {
      width: 160px;
      height: 160px;
      border: 2px solid #FFCB05;
      border-radius: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      background-color: #fff;
    }

    .image-box img {
      width: 100%;
      height: auto;
      object-fit: contain;
    }

    .info-box {
      background: linear-gradient(to right, #FFD700, #F4A300);
      border-radius: 15px;
      padding: 20px;
      margin-left: 10px;
      color: white;
      width: 250px;
      display: flex;
      flex-direction: column;
    }

    .info-box p {
      margin: 5px 0;
    }

    .title {
      font-weight: bold;
      font-size: 18px;
    }

    .location {
      display: flex;
      align-items: center;
      font-size: 14px;
    }

    .location::before {
      content: "🚗";
      margin-right: 5px;
    }

    .info-box button {
      margin-top: 10px;
      padding: 8px 12px;
      border: none;
      border-radius: 5px;
      background-color: #007BFF;
      color: #fff;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .info-box button:hover {
      background-color: #0056b3;
    }

    /* Popup styling */
    .popup {
      position: fixed;
      top: 20px;
      right: 20px;
      background: #4caf50;
      color: white;
      padding: 15px 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      display: none;
      z-index: 999;
    }
  </style>
</head>

<body>

  <h1><?= htmlspecialchars($type) ?> Available Vehicles</h1>

  <div class="popup" id="popup-msg">Booking request sent!</div>

  <div class="grid">
    <?php if (count($vehicles) === 0): ?>
      <p>No vehicles available.</p>
    <?php else: ?>
      <?php foreach ($vehicles as $vehicle): ?>
        <div class="card">
          <div class="image-box">
            <?php if (!empty($vehicle['photo'])): ?>
              <img src="data:image/jpeg;base64,<?= base64_encode($vehicle['photo']) ?>" alt="Vehicle Image">
            <?php else: ?>
              <img src="https://via.placeholder.com/160?text=No+Image" alt="No Image">
            <?php endif; ?>
          </div>
          <div class="info-box">
            <p class="title"><?= htmlspecialchars($vehicle['model'] ?? 'Unknown') ?></p>
            <p class="location"><?= htmlspecialchars($vehicle['rcno'] ?? 'N/A') ?></p>
            <p><?= htmlspecialchars($vehicle['mobileno'] ?? '') ?></p>
            <form method="post" action="send_email.php" onsubmit="return showPopup();">
              <input type="hidden" name="driver_email" value="<?= htmlspecialchars($vehicle['email'] ?? '') ?>">
              <input type="hidden" name="type" value="<?= htmlspecialchars($type) ?>">
              <input type="hidden" name="vehicle_id" value="<?= htmlspecialchars($vehicle['id'] ?? '') ?>">
              <button type="submit">Book Now</button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <script>
    function showPopup() {
      const popup = document.getElementById('popup-msg');
      popup.style.display = 'block';

      setTimeout(() => {
        popup.style.display = 'none';
      }, 2500);

      return true; // let form submit
    }
  </script>

</body>

</html>