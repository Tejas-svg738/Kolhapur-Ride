<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: /Kolhapur/Userlogin/login.html");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $pickup = $_POST['pickup'];
    $drop = $_POST['drop'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $_SESSION['name'] = $name;
    $_SESSION['mobile'] = $mobile;
    $_SESSION['pickup'] = $pickup;
    $_SESSION['drop'] = $drop;
    $_SESSION['date'] = $date;
    $_SESSION['time'] = $time;

    header("Location: Rprice.php");
    exit();
}

$name = $_SESSION['name'] ?? '';
$mobile = $_SESSION['mobile'] ?? '';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ride Booking</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
           
             /* background: linear-gradient(to right, rgb(255, 255, 255), #facf32); */
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

    /* .dropdown-content a:hover {
      background-color:;
    } */

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




        .user-info {
            padding: 20px;
            text-align: left;
            padding-left: 40px;
        }

    .main-section {
    display: flex;
    justify-content: flex-start;
    align-items: flex-start;
    gap: 60px;
    padding: 30px 60px;
    margin-top: 10px; /*⬅️ More Up */
    flex-wrap: wrap;
}



        .form-box {
            background: white;
            padding: 30px 30px;
            border-radius: 10px ;
            box-shadow:0 0 8px #efa111 ;
            width: 100%;
            max-width: 460px;
            margin-left: 30px;
            color:#33333;
        }

        .form-box h2 {
            margin-bottom: 15px;
        }

        .form-box input {
            width: 100%;
            padding: 14px;
            margin: 10px 0;
            border: 1px solid #666666;
            border-radius: 6px;
            font-size: 16px;
        }

        #btn {
              background-color: #EFA111;

            color: white;
            border: none;
            width: 100%;
            padding: 14px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        

        .map-box iframe {
           box-shadow:0 0 8px #efa111 ;
            border-radius: 10px;
            width: 820px;
            height: 540px;
        }

        @media (max-width: 1200px) {
            .main-section {
                flex-direction: column;
                align-items: center;
            }

            .form-box {
                margin-left: 0;
            }

            .map-box iframe {
                width: 95%;
                height: 400px;
            }
        }

        input::placeholder{
            color:#666666;
        }
        
    </style>
</head>
<body>

<header>
    <h1>Kolhapur</h1>
    <button class="menu-toggle" onclick="toggleMenu()">☰</button>
    <nav>
        <ul id="navList">
            <li><a href="/Kolhapur/Ride/ride.php">Ride</a></li>
            <li><a href="/Kolhapur/Driver/test/firstpage.php">Drive</a></li>
            <li><a href="/Kolhapur/Business/business.php">Business</a></li>
            <li><a href="/Kolhapur/Services/services.php">Services</a></li>
            <li><a href="/Kolhapur/Ride/Courier.php">Courier</a></li>
            <?php if (isset($_SESSION['userid'])): ?>
                <li class="dropdown">
                    <a href="#"><?php echo htmlspecialchars($_SESSION['userid']); ?></a>
                    <div class="dropdown-content">
                        <a href="/Kolhapur/ProfileUser/Profile">Profile</a>
                        <a href="/Kolhapur/Logout/logout.php">Logout</a>
                    </div>
                </li>
            <?php else: ?>
                <li><a href="/Kolhapur/Userlogin/login.html">Login</a></li>
                <li><a href="/Kolhapur/Userlogin/register.html">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<div class="user-info">
    <h2 style="margin-left: 52px; color:#333333" >Welcome, <?php echo htmlspecialchars($name); ?>!</h2>
    <!-- <p>Mobile: <?php echo htmlspecialchars($mobile); ?></p> -->
</div>

<div class="main-section">
    <div class="form-box">
        <h2>Request a Ride</h2>
        <p>Enter your ride details:</p>
        <form id="rideForm">
            <input type="text" id="pickup" placeholder="Pickup Location" required>
            <input type="text" id="drop" placeholder="Drop Location" required>
            <button type="button" id="btn">Book Now</button>
        </form>
    </div>

    <div class="map-box">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d122283.79400671698!2d74.15646588457898!3d16.708452233396038!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc1000cdec07a29%3A0xece8ea642952e42f!2sKolhapur%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1740820107091!5m2!1sen!2sin"
        allowfullscreen="" loading="lazy"></iframe>
    </div>
</div>

<script>
    function toggleMenu() {
        document.getElementById('navList').classList.toggle('show');
    }

    document.getElementById("btn").addEventListener("click", function () {
        const pickup = document.getElementById("pickup").value.trim();
        const drop = document.getElementById("drop").value.trim();

        if (!pickup || !drop) {
            alert("Please enter both pickup and drop locations.");
            return;
        }

        const now = new Date();
        const rideDate = now.toISOString().split("T")[0];
        const rideTime = now.toTimeString().split(" ")[0].slice(0, 5);

        const formData = new FormData();
        formData.append("pickup", pickup);
        formData.append("drop", drop);
        formData.append("ride_date", rideDate);
        formData.append("ride_time", rideTime);

        fetch("save_ride.php", {
            method: "POST",
            body: formData,
            credentials: 'include'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const params = new URLSearchParams({
                    pickup,
                    drop,
                    date: rideDate,
                    time: rideTime
                });
                window.location.href = "set_session.php?" + params.toString();
            } else {
                alert("Error: " + data.error);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred while booking.");
        });
    });
</script>

</body>
</html>