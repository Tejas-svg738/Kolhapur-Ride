<?php
session_start();
// ✅ If user is not logged in, redirect
if (!isset($_SESSION['userid'])) {
    header("Location:/Kolhapur/index/index.html");
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Driver Registration</title>
  
  <style>
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

    
    

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
  }

  html,
  body {
    height: 100%;
  }

  body {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background-color: #f7f7f7;
  }

  .container {
    display: flex;
    flex: 1;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* overflow: hidden; */
    width: 500px;
    max-width: 100%;
    margin: 40px auto;
    margin-top: 50px;
    height: 650px;
  }


  /* .left {
    flex: 1;
    background: #f9f9f9;
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

    .left img {
     width: 100%;
    max-width: 300px;
} */

  .right {
    flex: 1;
    padding: 40px;
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 900px;
  }

  .right h2 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
  }

  .form-group {
    width: 100%;
    max-width: 400px;
    margin-bottom: 20px;
    margin-top: 10px;
  }

  .form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
  }

  .form-group a {
    display: block;
    margin-top: 0px;
    font-size: 14px;
    color: #007BFF;
    text-decoration: none;
    text-align: right;
  }

  .form-group a:hover {
    text-decoration: underline;
  }

  .btn {
    width: 100%;
    max-width: 400px;
    padding: 10px;
    background-color:#EFA111;
    border: none;
    color: #fff;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
  }

  /* .btn:hover {
    background: #0056b3;
  } */

  .separator {
    display: flex;
    align-items: center;
    margin: 1.5rem 0;
    color: #6c757d;
  }

  .separator::before,
  .separator::after {
    content: "";
    flex: 1;
    border-bottom: 1px solid #dee2e6;
  }

  .separator:not(:empty)::before {
    margin-right: 1rem;
  }

  .separator:not(:empty)::after {
    margin-left: 1rem;
  }

  .form-control {
    padding: 12px;
    margin-bottom: 1rem;
  }

  .small-text {
    font-size: 0.75rem;
    color: #6c757d;
    margin-top: 1rem;
  }

  /* footer */

  /* footer */
  footer {
     background-color: #EFA111;
    color: #fff;
    padding: 20px 0;
    /* text-align: center; */
    font-size: 16px;
    margin-top:30px;
  }

  .footer-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    max-width: 1200px;
    margin: 0 auto;
  }

  .footer-section {
    margin: 10px;
  }

  .footer-section h3 {
    margin-bottom: 10px;
    font-size: 16px;
  }

  .footer-section ul {
    list-style: none;
    padding: 0;
  }

  .footer-section ul li {
    margin-bottom: 5px;
  }

  .footer-section ul li a {
    color: #fff;
    text-decoration: none;
  }

  .footer-section ul li a:hover {
    text-decoration: underline;
  }

  .footer-section-1 {
    padding: 0%;
  }

  .footer-section img {
    /* margin-top: 20px; */
    border-radius: 18px;
    box-shadow: 0 0px 30px rgba(0, 0, 0, 0.5);
    ;
  }

  .footer-section img:hover {
    transform: translateY(-5px);
  }

  /* .footer-icons a {
            margin: 0 10px;
            color: #fff;
            font-size: 20px;
            text-decoration: none;
        }
        .footer-icons a:hover {
            color: #f06c00;
        } */

  /* media footer */

  @media (max-width:768px) {
    .footer-container {
      flex-direction: column;
      align-items: center;
      text-align: center;
    }
  }

  @media (max-width:480px) {
    .footer-container {
      padding: 15px;
    }

    .footer-section {
      width: 100%;
      margin: 8px 0;
    }

    .container-sm p {
      margin-left: 55px;

      font-size: 20px;
    }


  }

  @media (max-width: 768px) {
    .container-sm p {
      font-size: 20px;
      padding-right: 20px;
      padding-left: 20px;
    }
  }

  @media (max-width: 429px) {
    .container-sm {
      height: 500px;
    }

    .container-sm p {
      font-size: 15px;
      padding-right: 10px;
      padding-left: 10px;

    }
  }

  @media(max-width:400px) {
    .container-sm {
      height: 600px;
    }

  }

  @media (max-width: 390px) {
    .container-sm {
      min-width: 100%;
    }

    .container-sm p {
      font-size: 15px;
      padding: 30px 10px 0;
    }
  }
</style>
</head>
<header>
  <h1><a href="index.html" style="color: white; text-decoration: none;">Kolhapur</a></h1>
  <icon class="menu-toggle" onclick="toggleMenu()">☰</icon>
  <nav>
    <ul id="navList">
      
    <li><a href="/Kolhapur/Ride/ride.php">Ride</a></li>
      <li><a href="/Kolhapur/Driver/test/firstpage.php">Drive</a></li>
      <li><a href="/Kolhapur/Business/business.php">Business</a></li>
      <li><a href="/Kolhapur/Services/services.php">Services</a></li>
      <li><a href="/Kolhapur/Overview/Safety/Safetyl.php">Overview</a></li>
      <li><a href="/Kolhapur/Resources/resources.php">Resources</a></li>
    
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

<script>
  function toggleMenu() {
    document.getElementById('navList').classList.toggle('show');
  }
</script>
<body>
  

  <div class="container">
    <div class="right">
      <form id="driverForm" action="t&c.php" method="post" enctype="multipart/form-data">
        <h3>Driver Information</h3>
        <div class="form-group">
          <label for="photo">Select a Photo:</label>
          <input type="file" name="photo" id="photo" accept="image/*" required><br><br>
          <input type="text" placeholder="Enter your firstname" name="firstname" id="fname" required><br><br>
          <input type="text" placeholder="Enter your lastname" name="lastname" id="lname" required><br><br>
          <input type="text" placeholder="Enter your Mobile No" name="number" id="number" required><br><br>
          <input type="email" placeholder="Enter your Email" name="email" id="email" required />
        </div>
        <button id="send-otp" class="btn" type="button">Send OTP</button><br>

        <!-- OTP Verification Form -->
        <div class="form-group" id="otp-container" style="display:none;">
          <input type="text" id="otp" placeholder="Enter OTP" required />
        </div>
        <button id="verify-otp" class="btn" type="button" style="display:none;">Verify OTP</button><br><br>
      </form>
    </div>
  </div>

  <!-- Footer remains unchanged -->

  <footer>
      <div class="footer-container">

        <div class="footer-section">
          <h3>LINKS</h3>
          <ul>
             <li><a href="/Kolhapur/Ride/ride.php">Ride</a></li>
              <li><a href="/Kolhapur/Driver/test/firstpage.php">Drive</a></li>
              <li><a href="/Kolhapur/Business/business.php">Business</a></li>
              <li><a href="/Kolhapur/Services/services.php">Services</a></li>
            <!-- <li><a href="#">Reviews</a></li> -->
            <!-- <li><a href="#">Gallery</a></li> -->
          </ul>
        </div>
        <a href="https://maps.app.goo.gl/NYbnYiMy9wL3rvpR7" target="_blank">
          <div class="footer-section">
            <!-- <h3>Map</h3> -->

          </div>
        </a>
        <div class="footer-section">
          <h3>GET IN TOUCH</h3>
           <p><strong>📞 Mobile:</strong> <a href="tel: 9922904252" style="color:white;"> 9922904252</a></p>
            <p><strong>📧 Email:</strong> <a href="mailto:qweeztechnology@gmail.com" style="color:white;">qweeztechnology@gmail.com</a></p>
          <p>📍  Dist-Kolhapur</p>
        </div>
        <div class="footer-section-1">
          <h3>FOLLOW US</h3>
           <div class="footer-icons">
                  <a href="#"><img src="/Kolhapur/icons/icons8-facebook-logo-94.png" style="width: 30px; height: 30px;"></a>
                  <a href="#"><img src="/Kolhapur/icons/icons8-instagram-logo-94.png" style="height: 30px; height: 30px;"></a>
                  <a href="#"><img src="/Kolhapur/icons/icons8-youtube-logo-94.png"style="height: 30px; width: 30px;"></a>
              </div> 
         
        </div>
      </div>
    </footer>


  <!-- JavaScript logic -->
  <script>
    document.getElementById('send-otp').addEventListener('click', function () {
      const email = document.getElementById('email').value.trim();
      if (email) {
        fetch('send_otp.php', {
          method: 'POST',
          body: JSON.stringify({ email }),
          headers: { 'Content-Type': 'application/json' }
        })
          .then(response => response.json())
          .then(data => {
            if (data.status === 'success') {
              alert('OTP sent to your email!');
              document.getElementById('otp-container').style.display = 'block';
              document.getElementById('verify-otp').style.display = 'block';
            } else {
              alert(data.message);
            }
          })
          .catch(err => {
            console.error(err);
            alert('An error occurred while sending OTP.');
          });
      } else {
        alert('Please enter a valid email address.');
      }
    });

    document.getElementById('verify-otp').addEventListener('click', function () {
      const email = document.getElementById('email').value.trim();
      const otp = document.getElementById('otp').value.trim();
      if (email && otp) {
        fetch('verify_otp.php', {
          method: 'POST',
          body: JSON.stringify({ email, otp }),
          headers: { 'Content-Type': 'application/json' }
        })
          .then(response => response.json())
          .then(data => {
            if (data.status === 'success') {
              alert('OTP verified successfully.');
              // ✅ Submit the form only after successful verification
              document.getElementById('driverForm').submit();
            } else {
              alert(data.message || 'OTP verification failed.');
            }
          })
          .catch(err => {
            console.error(err);
            alert('Error verifying OTP. Please try again.');
          });
      } else {
        alert('Please enter both email and OTP.');
      }
    });
  </script>
<script>
    function toggleMenu() {
      const navList = document.getElementById('navList');
      navList.classList.toggle('show');
    }

    
  </script>
  
</body>

</html>