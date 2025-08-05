<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: driverlogin.php");
    exit();
}

$user = $_SESSION['user'];

// RC clean (once)
if (!isset($_SESSION['rc_cleaned']) && isset($user['rcno'])) {
    $_SESSION['user']['rcno'] = strtoupper(str_replace(' ', '', $_SESSION['user']['rcno']));
    $_SESSION['rc_cleaned'] = true;
    $user = $_SESSION['user']; // refresh
}

// Ride customer info
$name = $_SESSION['name'] ?? 'Unknown';
$mobile = $_SESSION['mobile'] ?? 'Unknown';
$pickup = $_SESSION['pickup'] ?? 'Not specified';
$drop = $_SESSION['drop'] ?? 'Not specified';
$rideStatus = $_SESSION['ride_status'] ?? null;

// Vehicle RC Number
$vehicleNo = strtoupper(str_replace(' ', '', $user['rcno'] ?? 'N/A'));

// Get model from database using RC
function getModelFromRC($rcno_raw) {
    $rcno = strtoupper(str_replace(' ', '', $rcno_raw));
    $conn = new mysqli("localhost", "root", "", "qweez");
    if ($conn->connect_error) {
        return 'N/A';
    }

    $tables = ['sedan_cars', 'hatchback_cars', 'gear_bikes', 'non_gear_bikes', 'auto_vehicles'];
    foreach ($tables as $table) {
        $stmt = $conn->prepare("SELECT model FROM `$table` WHERE REPLACE(UPPER(number), ' ', '') = ?");
        $stmt->bind_param("s", $rcno);
        $stmt->execute();
        $stmt->bind_result($model);
        if ($stmt->fetch()) {
            $stmt->close();
            $conn->close();
            return $model;
        }
        $stmt->close();
    }

    $conn->close();
    return 'N/A';
}

$rcno_raw = $user['rcno'] ?? '';
$model = getModelFromRC($rcno_raw);

// Accept/Reject Ride
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accept'])) {
        $_SESSION['ride_status'] = 'accepted';
        $_SESSION['driver_name'] = $user['firstname'] ?? '';
        $_SESSION['driver_photo'] = $user['idphoto'] ?? '';
        $_SESSION['driver_mobile'] = $user['mobileno'] ?? '';
        $_SESSION['driver_info'] = [
            'idphoto'   => $user['idphoto'] ?? 'N/A',
            'firstname' => $user['firstname'] ?? 'N/A'
        ];
        header("Location: drivermain.php");
        exit();
    } elseif (isset($_POST['reject'])) {
        $_SESSION['ride_status'] = 'rejected';
        $rideStatus = 'rejected';
    }
}

// Ride PIN Verification
$pin_verified = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['entered_pin'])) {
    $entered_pin = $_POST['entered_pin'];
    if (isset($_SESSION['ride_pin']) && $_SESSION['ride_pin'] == $entered_pin) {
        $pin_verified = true;
        $_SESSION['ride_pin_verified'] = true;
    } else {
        $error = "Invalid ride PIN. Try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Driver Main | Kolhapur</title>
  <style>
    :root {
      --primary-yellow: #F59E0B;
      --dark-yellow: #D97706;
      --light-yellow: #FCD34D;
      --gray-dark: #666666;
      --gray-light: #f0f2f5;
      --white: #ffffff;
    }
    
    body {
      font-family: Arial, sans-serif;
      background-color: var(--gray-light);
      color: var(--gray-dark);
      margin: 0;
      padding: 0;
    }
    
    header {
      background: linear-gradient(to right, var(--white), var(--light-yellow));
      padding: 10px 20px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .header-container {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .logo {
      font-size: 24px;
      font-weight: bold;
      color: var(--gray-dark);
      text-decoration: none;
    }
    
    .logo:hover {
      color: var(--dark-yellow);
    }
    
    nav ul {
      list-style: none;
      display: flex;
      margin: 0;
      padding: 0;
    }
    
    nav ul li {
      margin-left: 20px;
      position: relative;
    }
    
    nav ul li a {
      color: var(--gray-dark);
      text-decoration: none;
      font-weight: 500;
      padding: 5px 10px;
      border-radius: 4px;
      transition: all 0.3s;
    }
    
    nav ul li a:hover {
      color: var(--dark-yellow);
      background-color: rgba(245, 158, 11, 0.1);
    }
    
    .dropdown-content {
      display: none;
      position: absolute;
      right: 0;
      background-color: var(--white);
      min-width: 160px;
      box-shadow: 0px 8px 16px rgba(0,0,0,0.1);
      z-index: 1;
      border-radius: 5px;
    }
    
    .dropdown:hover .dropdown-content {
      display: block;
    }
    
    .dropdown-content a {
      color: var(--gray-dark);
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }
    
    .dropdown-content a:hover {
      background-color: var(--light-yellow);
      color: var(--white);
    }
    
    .menu-toggle {
      display: none;
      font-size: 24px;
      background: none;
      border: none;
      color: var(--gray-dark);
      cursor: pointer;
    }
    
    .main-container {
      max-width: 800px;
      margin: 30px auto;
      padding: 30px;
      background: var(--white);
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(245, 158, 11, 0.2);
    }
    
    h2 {
      color: var(--primary-yellow);
      text-align: center;
      margin-bottom: 25px;
    }
    
    .ride-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    
    .ride-table th, .ride-table td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    
    .ride-table th {
      background-color: var(--light-yellow);
      color: var(--gray-dark);
    }
    
    .btn-group {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 20px;
    }
    
    .btn {
      background-color: var(--primary-yellow);
      color: var(--white);
      border: none;
      padding: 12px 25px;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: all 0.3s;
      font-weight: 600;
    }
    
    .btn:hover {
      background-color: var(--dark-yellow);
    }
    
    .btn-accept {
      background-color: #28a745;
    }
    
    .btn-reject {
      background-color: #dc3545;
    }
    
    .btn-accept:hover {
      background-color: #218838;
    }
    
    .btn-reject:hover {
      background-color: #c82333;
    }
    
    .message {
      text-align: center;
      padding: 15px;
      margin: 20px 0;
      border-radius: 5px;
      font-weight: 500;
    }
    
    .message-success {
      background-color: rgba(40, 167, 69, 0.2);
      color: #28a745;
    }
    
    .message-error {
      background-color: rgba(220, 53, 69, 0.2);
      color: #dc3545;
    }
    
    .message-info {
      background-color: rgba(23, 162, 184, 0.2);
      color: #17a2b8;
    }
    
    .driver-info {
      display: none;
      background-color: var(--white);
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      max-width: 300px;
      margin: 30px auto;
    }
    
    .driver-info.show {
      display: block;
      animation: fadeIn 0.5s ease-in-out;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to   { opacity: 1; transform: scale(1); }
    }
    
    .driver-info img {
      width: 100%;
      height: auto;
      border-radius: 5px;
      margin-bottom: 15px;
    }
    
    .info-text p {
      margin: 8px 0;
    }
    
    .info-text span {
      font-weight: bold;
      color: var(--gray-dark);
    }
    
    .pin-box {
      max-width: 400px;
      margin: 30px auto;
      padding: 25px;
      background: var(--white);
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      text-align: center;
    }
    
    .pin-box h3 {
      color: var(--primary-yellow);
      margin-bottom: 20px;
    }
    
    .pin-form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    
    .pin-form input {
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 16px;
      text-align: center;
    }
    
    .pin-form input:focus {
      border-color: var(--primary-yellow);
      outline: none;
      box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.2);
    }
    
    .pin-error {
      color: #dc3545;
      margin-bottom: 15px;
      font-weight: 500;
    }
    
    .pin-success {
      color: #28a745;
      margin-bottom: 15px;
      font-weight: 500;
    }
    
    footer {
      background: linear-gradient(to right, var(--white), var(--light-yellow));
      padding: 30px 0;
      margin-top: 50px;
    }
    
    .footer-container {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }
    
    .footer-section {
      flex: 1;
      min-width: 200px;
      margin-bottom: 20px;
      padding: 0 15px;
    }
    
    .footer-section h3 {
      color: var(--gray-dark);
      margin-bottom: 15px;
    }
    
    .footer-section ul {
      list-style: none;
      padding: 0;
    }
    
    .footer-section ul li {
      margin-bottom: 8px;
    }
    
    .footer-section ul li a {
      color: var(--gray-dark);
      text-decoration: none;
      transition: all 0.3s;
    }
    
    .footer-section ul li a:hover {
      color: var(--dark-yellow);
      padding-left: 5px;
    }
    
    .social-icons {
      display: flex;
      gap: 10px;
    }
    
    .social-icons a {
      display: inline-block;
      width: 36px;
      height: 36px;
      background-color: var(--primary-yellow);
      color: var(--white);
      border-radius: 50%;
      text-align: center;
      line-height: 36px;
      transition: all 0.3s;
    }
    
    .social-icons a:hover {
      background-color: var(--dark-yellow);
      transform: translateY(-3px);
    }
    
    @media (max-width: 768px) {
      .header-container {
        flex-direction: column;
        align-items: flex-start;
      }
      
      nav ul {
        flex-direction: column;
        width: 100%;
        display: none;
      }
      
      nav ul.show {
        display: flex;
      }
      
      nav ul li {
        margin: 5px 0;
        margin-left: 0;
      }
      
      .menu-toggle {
        display: block;
        position: absolute;
        top: 15px;
        right: 20px;
      }
      
      .main-container {
        margin: 20px;
        padding: 20px;
      }
      
      .btn-group {
        flex-direction: column;
        gap: 10px;
      }
      
      .btn {
        width: 100%;
      }
      
      .footer-container {
        flex-direction: column;
      }
      
      .footer-section {
        margin-bottom: 30px;
      }
    }
  </style>
</head>

<body>
  <header>
    <div class="header-container">
      <a href="index.html" class="logo">Kolhapur</a>
      <button class="menu-toggle" onclick="toggleMenu()">☰</button>
      <nav>
        <ul id="navList">
          <li><a href="/Kolhapur/Ride/ride.php">Ride</a></li>
          <li><a href="/Kolhapur/Driver/test/firstpage.php">Drive</a></li>
          <li><a href="/Kolhapur/Business/business.php">Business</a></li>
          <li><a href="/Kolhapur/Services/services.php">Services</a></li>
          <li class="dropdown">
            <a href="#">About</a>
            <div class="dropdown-content">
              <a href="get_payments.php">Payment History</a>
              <a href="ride_history.html">Recent Rides</a>
              <a href="customer_support.html">Customer Support</a>
            </div>
          </li>
          <li class="dropdown">
            <a href="#">Details</a>
            <div class="dropdown-content">
              <a href="document.php">Document Section</a>
              <a href="bankdetail.html">Bank Details</a>
            </div>
          </li>
          <li class="dropdown">
            <a href="#">👤 Profile</a>
            <div class="dropdown-content">
              <a href="#" onclick="toggleInfo()">Show Info</a>
              <a href="logout.php">Logout</a>
            </div>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <div class="main-container">
    <?php if (isset($_SESSION['ride_locked']) && $_SESSION['ride_locked']): ?>
      <div class="message message-info">
        🚫 You have already accepted a ride. Please wait until it's completed before receiving a new one.
      </div>
    <?php elseif ($rideStatus === 'accepted'): ?>
      <div class="message message-success">
        ✅ Ride accepted. Please proceed to the pickup location.
      </div>
    <?php elseif ($rideStatus === 'rejected'): ?>
      <div class="message message-error">
        ❌ Ride rejected. Waiting for the next ride.
      </div>
    <?php elseif (isset($_SESSION['ride_booked']) && $_SESSION['ride_booked']): ?>
      <div class="message message-info">
        🚕 Ride already booked by another driver.<br>Please wait for the next ride.
      </div>
    <?php else: ?>
      <h2>New Ride Request</h2>
      <table class="ride-table">
        <tr>
          <th>Customer Name</th>
          <td><?= htmlspecialchars($name) ?></td>
        </tr>
        <tr>
          <th>Mobile Number</th>
          <td><?= htmlspecialchars($mobile) ?></td>
        </tr>
        <tr>
          <th>Pickup Location</th>
          <td><?= htmlspecialchars($pickup) ?></td>
        </tr>
        <tr>
          <th>Drop Location</th>
          <td><?= htmlspecialchars($drop) ?></td>
        </tr>
      </table>

      <form method="post">
        <div class="btn-group">
          <button type="submit" name="accept" class="btn btn-accept">Accept</button>
          <button type="submit" name="reject" class="btn btn-reject">Reject</button>
        </div>
      </form>
    <?php endif; ?>
  </div>

  <!-- Driver Info Card -->
  <div class="driver-info" id="driverCard">
    <img src="<?= htmlspecialchars($user['idphoto']) ?>" alt="Driver Photo">
    <div class="info-text">
      <p><span>Mobile No:</span> <?= htmlspecialchars($user['mobileno']) ?></p>
      <p><span>Firstname:</span> <?= htmlspecialchars($user['firstname']) ?></p>
      <p><span>Model:</span> <?= htmlspecialchars($model) ?></p>
      <p><span>Vehicle Number:</span> <?= htmlspecialchars($vehicleNo) ?></p>
    </div>
  </div>

  <!-- PIN Verification -->
  <?php if ($rideStatus === 'accepted'): ?>
    <div class="pin-box">
      <h3>🔐 Ride PIN Verification</h3>

      <?php if (isset($error)): ?>
        <p class="pin-error"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>

      <?php if (!$pin_verified && !isset($_SESSION['ride_pin_verified'])): ?>
        <form method="POST" class="pin-form">
          <input type="text" id="entered_pin" name="entered_pin" placeholder="Enter Ride PIN" required>
          <button type="submit" class="btn">Verify PIN</button>
        </form>
      <?php else: ?>
        <p class="pin-success">✅ Ride PIN Verified</p>
        <form method="post" action="start_ride.php">
          <button type="submit" class="btn" name="start_ride">Start Ride</button>
        </form>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <footer>
    <div class="footer-container">
      <div class="footer-section">
        <h3>LINKS</h3>
        <ul>
          <li><a href="/Kolhapur/Ride/ride.php">Ride</a></li>
          <li><a href="/Kolhapur/Driver/test/firstpage.php">Drive</a></li>
          <li><a href="/Kolhapur/Business/business.php">Business</a></li>
          <li><a href="/Kolhapur/Services/services.php">Services</a></li>
        </ul>
      </div>
      
      <div class="footer-section">
        <h3>GET IN TOUCH</h3>
        <p>📞 9922904252</p>
        <p>📧 qweeztechnology@gmail.com</p>
        <p>📍 Dist-Kolhapur</p>
      </div>
      
      <div class="footer-section">
        <h3>FOLLOW US</h3>
        <div class="social-icons">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
  </footer>

  <script>
    function toggleMenu() {
      document.getElementById('navList').classList.toggle('show');
    }
    
    function toggleInfo() {
      const card = document.getElementById('driverCard');
      card.classList.toggle('show');
    }
  </script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>