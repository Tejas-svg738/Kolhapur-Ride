<?php
session_start();
// ✅ If user is not logged in, redirect
if (!isset($_SESSION['userid'])) {
    header("Location:/Kolhapur/Userlogin/login.html");
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Platform</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous">
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

    /* Layout Containers */
    .container, .container2, .container3 {
      display: flex;
      justify-content: space-between;
      gap: 20px;
      padding: 40px;
      flex-wrap: wrap;
    }

    .text {
      flex: 1;
      padding: 20px;
    }

    .text h1 {
      margin-left: 5px;
      color: #333;
      font-size: 30px;
    }

    .text p {
      margin-left: 5px;
      color: #666;
      font-size: 20px;
    }

    .image {
      flex: 1;
      padding: 20px;
      margin-left: 50px;
    }

    .image img {
      max-width: 100%;
      height: auto;
      display: block;
    }

    .card, .card3 {
      flex: 1;
      min-width: 300px;
      max-width: 400px;
      background: white;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-shadow: 0 0 8px #efa111;
      transition: transform 0.3s;
      text-align: center;
      padding: 20px;
    }

    .card:hover, .card3:hover {
      transform: translateY(-10px);
    }

    .card h3, .card3 h3 {
      color: #333;
    }

    .card p, .card3 p {
      color: #666;
      font-size: 16px;
    }

    .card img {
      width: 100%;
      height: auto;
      border-radius: 4px;
    }

    .card3 img {
      width: 50px;
      height: 50px;
      margin-bottom: 10px;
    }

    /* Footer */
    footer {
      background-color: #EFA111;
      color: #fff;
      padding: 20px 0;
      font-size: 16px;
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

    .footer-section img {
      border-radius: 18px;
      box-shadow: 0 0px 30px rgba(0, 0, 0, 0.5);
    }

    .footer-section-1 .footer-icons img {
      margin: 0 5px;
      width: 30px;
      height: 30px;
    }

    /* ===== Responsive Media Queries ===== */

    @media (max-width: 991px) {
      .container, .container2, .container3 {
        flex-direction: column;
        align-items: center;
        padding: 20px;
      }

      .image {
        margin-left: 0;
      }

      .card, .card3 {
        max-width: 90%;
        height: auto;
      }

      .footer-container {
        flex-direction: column;
        align-items: center;
      }

      .footer-section, .footer-section-1 {
        width: 100%;
        text-align: center;
      }
    }

    @media (max-width: 767px) {
      .menu-toggle {
        display: block;
      }

      nav ul {
        flex-direction: column;
        display: none;
        background-color: #EFA111;
        width: 100%;
      }

      nav ul.show {
        display: flex;
      }

      nav ul li {
        width: 100%;
        padding: 10px;
        border-bottom: 1px solid white;
        text-align: left;
      }

      nav ul li a {
        display: block;
        width: 100%;
      }

      .text h1 {
        font-size: 24px;
      }

      .text p {
        font-size: 16px;
      }

      .card, .card3 {
        min-width: 100%;
        height: auto;
      }
    }

    @media (max-width: 480px) {
      .text h1 {
        font-size: 20px;
      }

      .text p {
        font-size: 14px;
      }

      .container, .container2, .container3 {
        padding: 10px;
      }

      .footer-section img {
        width: 80%;
      }

      .footer-icons img {
        width: 25px;
        height: 25px;
      }
    }
  </style>
</head>

<body>

  <header>
  <h1><a  style="color: white; text-decoration: none;">Kolhapur</a></h1>
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
      <li>  <a href="/Kolhapur/Userlogin/login.html">Login</a></li>
     <li>   <a href="/Kolhapur/Userlogin/register.html">Register</a></li>
      <?php endif; ?>
   

      </ul>

  </nav>
</header>
 
<script>
    function toggleMenu() {
      const navList = document.getElementById('navList');
      navList.classList.toggle('show');
    }

    
  </script>

  <div class="container">
    <div class="text">
      <h1 style="margin-top:70px;">A platform that was built to move.</h1>
      <p style="margin-top:10px;">Transform the way your company moves and feeds its people with uber for Business</p>
    </div>
    <div class="image">
      <img src="plat.jpg" alt="Platform Image">
    </div>
  </div>

  <h1 style="margin-left: 50px; font-size: 30px;color:#333;">A single platform for employee and customer needs</h1>
  <div class="container2">
    <div class="card">
      <img src="businesstrvelplt.jpg" alt="Business Travel">
      <h3>Business Travel</h3>
      <p>Include title, date, your name and colleagues, names of customers or partners met, dates and descriptions of event.</p>
    </div>
    <div class="card">
      <img src="12 Best Cars for Uber and Lyft Drivers.jpg" alt="Safety">
      <h3>Safety</h3>
      <p>Every ride is tracked and monitored by Uber.</p>
    </div>
    <div class="card">
      <img src="safty.jpg" alt="Commute" style="padding: 10px;">
      <h3>Commute programs</h3>
      <p>Help your employees get to work by subsidizing rides to and from the office.</p>
    </div>
  </div>

  <h1 style="margin-left:55px; font-size: 35px;">Advanced features</h1>
  <div class="container3">
    <div class="card3">
      <img src="icons8-cash-40.png" alt="Customize">
      <h3>Customize your programs</h3>
      <p>Set ride and meal limits based on day, time, location, and budget.</p>
    </div>
    <div class="card3">
      <img src="icons8-gift-40.png" alt="Vouchers">
      <h3>Vouchers</h3>
      <p>Provide a voucher for any amount you choose. You’ll pay only for what recipients actually use.</p>
    </div>
    <div class="card3">
      <img src="icons8-courier-40.png" alt="Delivery">
      <h3>Local delivery</h3>
      <p>Request on-demand, local deliveries for you and your customers. It’s as fast as requesting a ride.</p>
    </div>
  </div>
<!-- footer -->

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

 

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>