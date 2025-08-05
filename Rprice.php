
<?php
session_start();

// Redirect if the user is not logged in
if (!isset($_SESSION['userid'])) {
    header("Location: /Kolhapur/Userlogin/login.html");
    exit;
}

// 🧑 User's ride information
$name       = $_SESSION['name'] ?? 'Unknown';
$mobile     = $_SESSION['mobile'] ?? 'Unknown';
$pickup     = $_SESSION['pickup'] ?? '';
$drop       = $_SESSION['drop'] ?? '';
$date       = $_SESSION['date'] ?? '';
$time       = $_SESSION['time'] ?? '';
// Ride status can be 'pending' or 'pending_driver_search'
$rideStatus = $_SESSION['ride_status'] ?? 'pending';
$rideAccepted = ($rideStatus === 'accepted');

// 🚘 Driver information default values
$driverName     = 'N/A';
$driverPhoto    = '';
$driverMobile   = 'N/A';
$vehicleModel   = 'N/A';
$vehicleNo      = 'N/A';
$driverEmail    = 'N/A';

// ✅ If ride is accepted and driver_info exists
if ($rideAccepted && isset($_SESSION['driver_info'])) {
    $driver         = $_SESSION['driver_info'];
    $driverName     = $driver['firstname'] ?? 'N/A';
    $vehicleModel   = $driver['model'] ?? 'N/A';
    $vehicleNo      = $driver['rcno'] ?? 'N/A';
    $driverPhoto    = $driver['idphoto'] ?? ''; // Base64 encoded image string
    $driverMobile   = $driver['mobileno'] ?? 'N/A';
    $driverEmail    = $driver['email'] ?? 'N/A';

    // Generate PIN only once
    if (!isset($_SESSION['ride_pin'])) {
        $_SESSION['ride_pin'] = rand(1000, 9999);
    }
}

// PIN Output
$pin = $_SESSION['ride_pin'] ?? 'Not Available';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Ride Booking</title>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
}

header {
    background-color: #EFA111;
    color: white;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

h1 {
    margin: 0;
    font-size: 30px;
}

nav ul {
    list-style: none;
    display: flex;
    gap: 20px;
    margin: 0;
    padding: 0;
    align-items: center;
}

nav ul li {
    font-size: 18px;
    position: relative;
}

nav ul li a {
    color: white;
    text-decoration: none;
}

/* Dropdown */
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #EFA111;
    min-width: 150px;
    right: 0;
    z-index: 1;
    border-radius: 5px;
    overflow: hidden;
}

.dropdown-content a {
    color: white;
    padding: 10px 15px;
    display: block;
    text-decoration: none;
}

.dropdown:hover .dropdown-content {
    display: block;
}

/* Toggle Button (Mobile) */
.menu-toggle {
    display: none;
    font-size: 26px;
    background: none;
    border: none;
    color: white;
    cursor: pointer;
}

/* Responsive Navigation */
@media (max-width: 768px) {
    .menu-toggle {
        display: block;
    }

    nav ul {
        flex-direction: column;
        width: 100%;
        display: none;
        background-color: #EFA111;
    }

    nav ul.show {
        display: flex;
    }

    nav ul li {
        width: 100%;
        text-align: left;
        padding: 10px;
        border-bottom: 1px solid white;
    }

    nav ul li a {
        display: block;
        width: 100%;
    }

    .dropdown-content {
        position: static;
        width: 100%;
        border: none;
        box-shadow: none;
    }
}

/* Main Flex Wrapper */
.main-flex {
    display: flex;
    justify-content: flex-start;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 40px;
    margin: 60px 0 0 40px;
}

/* Location + Driver Photo Column */
.location-driver-card {
    background: #fff;
    border: 2px solid #EFA111;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 330px; /* Fixed width for consistency */
}

.location-box, .arrow {
    text-align: center;
    font-size: 18px;
    font-weight: 500;
    margin: 10px 0;
}

.section-divider {
    margin: 20px 0;
    border-top: 1px dashed #ccc;
}

/* Driver Search Status */
.finding-status {
    text-align: center;
    margin: 20px auto; /* Center within its container */
    width: 80%;
    padding: 20px;
    background: #fff8e1;
    border: 2px solid #efa111;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    /* Hidden initially, will be shown by JS */
    display: none;
}

.status-message {
    font-size: 16px;
    color: #333;
    margin-bottom: 10px;
}

.status-bar {
    background-color: #ddd;
    height: 6px;
    border-radius: 5px;
    overflow: hidden;
}

.progress-line {
    height: 100%;
    width: 0%;
    background-color: #28a745;
    animation: progressMove 2s infinite linear;
    border-radius: 4px;
}

@keyframes progressMove {
    0% { width: 0%; left: 0; }
    50% { width: 100%; left: 0; }
    100% { width: 0%; left: 100%; }
}

/* Right Column: Vehicle Information */
.vehicle-column {
    background: #fff;
    border: 2px solid #EFA111;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    min-width: 500px;
    width: 300px; /* Fixed width for consistency */
}

/* Driver Info Row */
.driver-combined {
    display: none; /* Hidden initially, will be shown by PHP if ride is accepted */
    align-items: flex-start;
    gap: 20px;
    margin-top: 20px;
}

.driver-photo {
    width: 90px;
    height: 90px;
    border-radius: 8px;
    object-fit: cover;
    border: 1px solid #aaa;
}

.driver-info p {
    margin: 6px 0;
    font-size: 15px;
}

.pin-box {
    background-color: #ffe082;
    padding: 4px 10px;
    border-radius: 6px;
    font-weight: bold;
}

/* Subtype Grid (Vehicle Selection) */
.subtype-grid {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.subtype-card {
    display: flex;
    align-items: center;
    border: 2px solid #efa111;
    border-radius: 12px;
    padding: 10px 15px;
    max-width: 500px; /* Adjust as needed for vehicle column */
    background: #fff;
    box-shadow: 0 0 8px #efa111;
    gap: 15px;
}

.subtype-card img {
    width: 120px;
    height: 100px;
    object-fit: contain;
    border-radius: 8px;
}

.vehicle-title {
    font-size: 18px;
    font-weight: bold;
}

.vehicle-price {
    font-size: 16px;
    color: #555;
}

.subtype-card button {
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    background-color: #efa111;
    color: #fff;
    cursor: pointer;
}

/* New element for booking confirmation or error */
#booking-status-message {
    margin-top: 20px;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
    font-weight: bold;
    display: none; /* Hidden initially, will be shown by JS */
}
.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}
.error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

</style>

</head>
<body>

    <header>
        <h1><a style="color: white; text-decoration: none;">Kolhapur</a></h1>
        <button class="menu-toggle" onclick="toggleMenu()">☰</button>
        <nav>
            <ul id="navList">

                <li><a href="/Kolhapur/Ride/ride.php">Ride</a></li>
                <li><a href="/Kolhapur/Driver/test/firstpage.php">Drive</a></li>
                <li><a href="/Kolhapur/Business/business.php">Business</a></li>
                <li><a href="/Kolhapur/Services/services.php">Services</a></li>
                <li><a href="/Kolhapur/Overview/overview.php">Overview</a></li>
                <li><a href="/Kolhapur/Resources/resources.php">Resources</a></li>

                <?php if (isset($_SESSION['userid'])): ?>
                    <li class="dropdown">
                        <a href="#"><?php echo htmlspecialchars($_SESSION['userid']); ?> </a>
                        <div class="dropdown-content">
                            <a href="/Kolhapur/ProfileUser/Profile">Profile</a>
                            <a href="/Kolhapur/Logout/logout.php">Logout</a>
                        </div>
                    </li>
                <?php else: ?>
                    <li> <a href="/Kolhapur/Userlogin/login.html">Login</a></li>
                    <li> <a href="/Kolhapur/Userlogin/register.html">Register</a></li>
                <?php endif; ?>

            </ul>

        </nav>
    </header>


<div class="main-flex">
    <div class="location-driver-card">
        <div class="location-box">🟢 Pickup: <?= htmlspecialchars($pickup) ?></div>
        <div class="arrow">↓</div>
        <div class="location-box">🔴 Drop: <?= htmlspecialchars($drop) ?></div>

        <div class="finding-status" id="findingStatusBlock">
            <div class="status-message" id="statusMessage">Finding drivers nearby</div>
            <div class="status-bar">
                <div class="progress-line" id="progressLine"></div>
            </div>
        </div>

        <?php if ($rideAccepted): ?>
            <div class="driver-combined" style="display: flex;"> <?php if (!empty($driverPhoto)): ?>
                <img src="data:image/jpeg;base64,<?= htmlspecialchars($driverPhoto) ?>" alt="Driver Photo" class="driver-photo">
                <?php else: ?>
                    <p>No Photo Available</p>
                <?php endif; ?>

                <div class="driver-info">
                    <p><strong>Name:</strong> <?= htmlspecialchars($driverName) ?></p>
                    <p><strong>Model:</strong> <?= htmlspecialchars($vehicleModel) ?></p>
                    <p><strong>Vehicle No:</strong> <?= htmlspecialchars($vehicleNo) ?></p>
                    <p><strong>Ride PIN:</strong> <span class="pin-box"><?= htmlspecialchars($pin) ?></span></p>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="vehicle-column">
        <h2 id="vehicleSelectionTitle">Select Your Vehicle</h2>
        <div class="subtype-grid" id="vehicleSelectionGrid">
            <div class="subtype-card">
                <img src="/Kolhapur/Ride/Use el cotizador automático Toyota.jpeg" alt="Sedan Car">
                <div>
                    <div class="vehicle-price">₹200</div>
                    <button onclick="loadDriverOptions('Car', 'Sedan')">Book Now</button>
                </div>
            </div>

            <div class="subtype-card">
                <img src="/Kolhapur/Ride/Hyundai" alt="Hatchback Car">
                <div>
                    <div class="vehicle-price">₹200</div>
                    <button onclick="loadDriverOptions('Car', 'Hatchback')">Book Now</button>
                </div>
            </div>

            <div class="subtype-card">
                <img src="/kolhapur/Ride/Hero HF Deluxe Bike Price, Colors, Specifications.jpeg" alt="Gear Bike">
                <div>
                    <div class="vehicle-price">₹200</div>
                    <button onclick="loadDriverOptions('Bike', 'Gear')">Book Now</button>
                </div>
            </div>

            <div class="subtype-card">
                <img src="/Kolhapur/Ride/download (13).jpeg" alt="Without Gear Bike">
                <div>
                    <div class="vehicle-price">₹200</div>
                    <button onclick="loadDriverOptions('Bike', 'withoutgear')">Book Now</button>
                </div>
            </div>

            <div class="subtype-card">
                <img src="/Kolhapur/Ride/download (14).jpeg" alt="Auto Rikshaw">
                <div>
                    <div class="vehicle-price">₹200</div>
                    <button onclick="loadDriverOptions('Rikshaw', 'Auto')">Book Now</button>
                </div>
            </div>
        </div>
        <div id="booking-status-message"></div>
    </div>
</div>

<script>
let statusCheckInterval; // To store the interval ID for polling

function loadDriverOptions(vehicleType, subtype) {
    const bookingStatusMessage = document.getElementById('booking-status-message');
    const vehicleSelectionGrid = document.getElementById('vehicleSelectionGrid');
    const vehicleSelectionTitle = document.getElementById('vehicleSelectionTitle');
    const findingStatusBlock = document.getElementById('findingStatusBlock');

    // Clear previous messages
    bookingStatusMessage.innerHTML = '';
    bookingStatusMessage.className = '';
    bookingStatusMessage.style.display = 'none'; // Hide message initially

    // Hide vehicle selection and show finding status immediately
    vehicleSelectionGrid.style.display = 'none';
    vehicleSelectionTitle.style.display = 'none';
    findingStatusBlock.style.display = 'block';

    // Make a fetch request to send_email.php
    fetch(`/Kolhapur/Ride/send_email.php?type=${vehicleType}&subtype=${subtype}`)
        .then(response => response.json()) // Assume send_email.php now returns JSON
        .then(data => {
            if (data.status === 'success') {
                // If email sent successfully, start polling for driver acceptance
                startRideStatusPolling();
            } else {
                // Show error message from send_email.php
                bookingStatusMessage.innerHTML = `<p>${data.message}</p>`;
                bookingStatusMessage.classList.add('error');
                bookingStatusMessage.style.display = 'block';
                // If error, show vehicle selection again
                vehicleSelectionGrid.style.display = 'flex';
                vehicleSelectionTitle.style.display = 'block';
                findingStatusBlock.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error booking ride:', error);
            bookingStatusMessage.innerHTML = '<p style="color: red;">Error booking ride. Please try again.</p>';
            bookingStatusMessage.classList.add('error');
            bookingStatusMessage.style.display = 'block';
            // If error, show vehicle selection again
            vehicleSelectionGrid.style.display = 'flex';
            vehicleSelectionTitle.style.display = 'block';
            findingStatusBlock.style.display = 'none';
        });
}

function startRideStatusPolling() {
    const bookingStatusMessage = document.getElementById('booking-status-message');
    const vehicleSelectionGrid = document.getElementById('vehicleSelectionGrid');
    const vehicleSelectionTitle = document.getElementById('vehicleSelectionTitle');
    const findingStatusBlock = document.getElementById('findingStatusBlock');
    const driverCombined = document.querySelector('.driver-combined'); // Get the driver info block

    // Ensure 'Finding Status' block is visible and animated
    findingStatusBlock.style.display = 'block';
    // Hide vehicle selection
    vehicleSelectionGrid.style.display = 'none';
    vehicleSelectionTitle.style.display = 'none';

    // Start polling
    statusCheckInterval = setInterval(() => {
        fetch('/Kolhapur/Ride/check_ride_status.php') // This file must exist and return JSON
            .then(response => response.json())
            .then(data => {
                if (data.rideStatus === 'accepted') {
                    clearInterval(statusCheckInterval); // Stop polling
                    // Reload the page to display driver's information using PHP logic
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                } else if (data.rideStatus === 'no_driver_found') {
                    clearInterval(statusCheckInterval); // Stop polling
                    bookingStatusMessage.innerHTML = '<p style="color: red;">No driver available at the moment. Please try again later.</p>';
                    bookingStatusMessage.classList.remove('success');
                    bookingStatusMessage.classList.add('error');
                    bookingStatusMessage.style.display = 'block'; // Show error message

                    findingStatusBlock.style.display = 'none'; // Hide 'Finding Status'
                    vehicleSelectionGrid.style.display = 'flex'; // Show vehicle selection again
                    vehicleSelectionTitle.style.display = 'block';

                } else {
                    // Still searching, keep rotating messages
                    rotateMessages();
                }
            })
            .catch(error => {
                console.error('Error checking ride status:', error);
                clearInterval(statusCheckInterval); // Stop on error
                bookingStatusMessage.innerHTML = '<p style="color: red;">Error checking ride status.</p>';
                bookingStatusMessage.classList.remove('success');
                bookingStatusMessage.classList.add('error');
                bookingStatusMessage.style.display = 'block'; // Show error message

                // Revert to original state if error during polling
                findingStatusBlock.style.display = 'none';
                vehicleSelectionGrid.style.display = 'flex';
                vehicleSelectionTitle.style.display = 'block';
            });
    }, 5000); // Check every 5 seconds
}

// Initial check based on PHP rideStatus when the page loads
window.onload = function() {
    const rideStatus = "<?= htmlspecialchars($rideStatus); ?>";
    const vehicleSelectionGrid = document.getElementById('vehicleSelectionGrid');
    const vehicleSelectionTitle = document.getElementById('vehicleSelectionTitle');
    const findingStatusBlock = document.getElementById('findingStatusBlock');
    const driverCombined = document.querySelector('.driver-combined'); // Get the driver info block

    if (rideStatus === 'pending_driver_search') {
        vehicleSelectionGrid.style.display = 'none';
        vehicleSelectionTitle.style.display = 'none';
        findingStatusBlock.style.display = 'block';
        driverCombined.style.display = 'none'; // Ensure driver info is hidden if searching
        startRideStatusPolling(); // Start polling if already searching
    } else if (rideStatus === 'pending') {
        vehicleSelectionGrid.style.display = 'flex'; // Ensure it's visible if pending
        vehicleSelectionTitle.style.display = 'block';
        findingStatusBlock.style.display = 'none';
        driverCombined.style.display = 'none'; // Ensure driver info is hidden if pending
    } else if (rideStatus === 'accepted') {
        vehicleSelectionGrid.style.display = 'none';
        vehicleSelectionTitle.style.display = 'none';
        findingStatusBlock.style.display = 'none';
        driverCombined.style.display = 'flex'; // Ensure driver details are visible
    }
};


// Toggle navigation menu
function toggleMenu() {
    const navList = document.getElementById('navList');
    navList.classList.toggle('show');
}

// Rotate status messages
const messages = [
    "Finding Drivers Nearby",
    "We'll Share driver details nearby",
    "We'll get you going soon"
];
let index = 0;

function rotateMessages() {
    const messageEl = document.getElementById('statusMessage');
    if (messageEl) {
        messageEl.textContent = messages[index];
        index = (index + 1) % messages.length;
    }
}
// Start rotating messages only when the 'Finding Status' block is visible.
// This is controlled by the `window.onload` logic or when `startRideStatusPolling` function is called.
setInterval(rotateMessages, 2500); // Change message every 2.5 seconds
</script>


</body>
</html>