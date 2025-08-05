<?php
session_start();
include 'db_connection.php';

// ✅ Check login status
if (!isset($_SESSION['user_id'])) {
    header("Location: /Kolhapur/Userlogin/login.html");
    exit;
}

$name = $_SESSION['name'];
$email = $_SESSION['email'];

// ✅ Fetch data for the logged-in user
$sql = "SELECT * FROM user_account_view WHERE user_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Account - UberLike</title>
    <style>
      header {
      background-color: black;
      color: white;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    h1 {
      margin: 0;
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

    /* Profile dropdown styles */
    .dropdown {
      position: relative;
      display: inline-block;
      
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #222;
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

    .dropdown-content a:hover {
      background-color: Black;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    /* Toggle button styles */
    .menu-toggle {
      display: none;
      font-size: 26px;
      background: none;
      border: none;
      color: white;
      cursor: pointer;
    }

    @media (max-width: 768px) {
      .menu-toggle {
        display: block;
      }

      nav {
        width: 100%;
      }

      nav ul {
        flex-direction: column;
        width: 100%;
        display: none;
        background-color: #111;
      }

      nav ul.show {
        display: flex;
      }

      nav ul li {
        width: 100%;
        text-align: left;
        padding: 10px;
        border-bottom: 1px solid #333;
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





        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #ececec, #ffffff);
            font-family: 'Segoe UI', sans-serif;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            overflow-x: auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #444;
        }

        .user-info {
            background-color: #f8f8f8;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            border-left: 4px solid #888;
        }

        .user-info p {
            margin: 8px 0;
            font-size: 17px;
        }

        .user-info span {
            font-weight: bold;
            color: #333;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc;
        }

        .user-table th,
        .user-table td {
            padding: 12px 14px;
            text-align: left;
            border: 1px solid #ccc;
        }

        .user-table th {
            background-color: #e0e0e0;
            color: #333;
        }

        .user-table td {
            background-color: #fafafa;
        }

        .no-data {
            text-align: center;
            color: #777;
            font-style: italic;
            margin-top: 20px;
        }
        .btn {
            border: 1px solid black;
            background-color: rgb(0, 123, 255);
            color: white;
            border-radius: 5px;
            display: block;
            margin-left: auto;
            margin-right: auto; /* Center the button horizontally */
            margin-top: 30px; /* Added margin-top to create space between the button and table */
            text-decoration: none;
            font-weight: bold;
            padding: 12px 0; /* Added padding for proper text fit */
            text-align: center;
            cursor: pointer;
            font-family: Arial, sans-serif;
            font-size: 16px;
            width: 250px; /* Fixed width */
            height: 50px; /* Fixed height to ensure the text fits comfortably */
        }

        .btn:hover {
            background-color: grey;
        }


        @media (max-width: 768px) {
            .user-info p {
                font-size: 15px;
            }

            .user-table th,
            .user-table td {
                font-size: 14px;
                padding: 10px;
            }

            .container {
                margin: 20px;
                padding: 20px;
            }
        }
    </style>
</head>
<header>
  <h1><a  style="color: white; text-decoration: none;">Kolhapur</a></h1>
  <button class="menu-toggle" onclick="toggleMenu()">☰</button>
  <nav>
    <ul id="navList">
      
      <li><a href="/Kolhapur/Ride/ride.php">Ride</a></li>
      <li><a href="/Kolhapur/Driver/test/firstpage.php">Drive</a></li>
      <li><a href="/Kolhapur/Business/business.php">Business</a></li>
      <li><a href="/Kolhapur/Services/services.php">Services</a></li>
      <li><a href="/Kolhapur/Ride/Courier.php">Courier</a></li>
      
      
    
       <?php if (isset($_SESSION['user_id'])): ?>
        <li class="dropdown">
          <a href="#"><?php echo htmlspecialchars($_SESSION['name']); ?> </a>
          <div class="dropdown-content">
            <a href="/Kolhapur/ProfileUser/Profile">Profile</a>
            <a href="/Kolhapur/Logout/logout.php">Logout</a>
          </div>
        </li>
      <?php else: ?>
      <li>  <a href="/Kolhapur/Userlogin/login.html">Login</a></li>
     <li>   <a href="/Kolhapur/Userlogin/register.html">Register</a></li>
      <?php endif; ?>
   

      </ul>

  </nav>
</header>

<body>

<div class="container">
    <h2>Welcome to Your Kolhapur Ride Account</h2>

    <!-- Top Name and Email Section -->
    <div class="user-info">
        <p><span>Name:</span> <?= htmlspecialchars($name) ?></p>
        <p><span>Email:</span> <?= htmlspecialchars($email) ?></p>
    </div>

    <!-- Ride History Table -->
    <div class="table-wrapper">
        <?php if ($result->num_rows > 0): ?>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Alternate Contact</th>
                        <th>Pickup Location</th>
                        <th>Drop Location</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['user_name']) ?></td>
                            <td><?= htmlspecialchars($row['user_email']) ?></td>
                            <td><?= htmlspecialchars($row['passengerPhone']) ?></td>
                            <td><?= htmlspecialchars($row['altContact']) ?></td>
                            <td><?= htmlspecialchars($row['pickup_location']) ?></td>
                            <td><?= htmlspecialchars($row['drop_location']) ?></td>

                            
                            <td><?= htmlspecialchars($row['ride_date']) ?></td>
                            <td><?= htmlspecialchars($row['ride_time']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-data">No ride details found for your account.</p>
        <?php endif; ?>
    </div>
     <a href="ride.php" class="btn">Continue to book Rides</a>
</div>

</body>
</html>