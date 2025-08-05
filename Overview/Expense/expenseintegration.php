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
  <title>Expense Integration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
/* Header */
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

/* Menu Toggle */
.menu-toggle {
  display: none;
  font-size: 26px;
  background: none;
  border: none;
  color: white;
  cursor: pointer;
}

/* Layout container */
.container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 20px;
  min-height: 100px;
  padding: 40px 20px;
  flex-wrap: wrap;
}

.text {
  flex: 1;
  padding: 20px;
}

.image {
  flex: 1;
  padding: 20px;
}

.image img {
  max-width: 100%;
  height: auto;
  display: block;
}

/* Card Container */
.container2 {
  display: flex;
  justify-content: space-between;
  gap: 20px;
  padding: 40px 20px;
  flex-wrap: wrap;
  margin-top: 50px;
  
}

/* Card Style */
.card {
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
  height: auto;
  
}

.card:hover {
  transform: translateY(-10px);
}

.card h3 {
  margin: 0;
  color: #333;
}

.card p {
  color: #666;
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

.footer-section-1 {
  padding: 0;
}

.footer-section img {
  border-radius: 18px;
  box-shadow: 0 0px 30px rgba(0, 0, 0, 0.5);
}

.footer-section img:hover {
  transform: translateY(-5px);
}

/* ======================= MEDIA QUERIES ======================= */

/* Navbar and menu responsiveness */
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

/* Responsive Layout for Text and Image */
@media (max-width: 992px) {
  .container {
    flex-direction: column;
    text-align: center;
  }

  .text,
  .image {
    padding: 15px 10px;
    flex: 1 1 100%;
  }

  .image img {
    max-width: 100%;
  }
}

/* Cards wrap and stack properly */
@media (max-width: 992px) {
  .container2 {
    justify-content: center;
    gap: 30px;
  }

  .card {
    min-width: 280px;
    max-width: 90%;
  }
}

/* Footer responsive stacking */
@media (max-width: 768px) {
  .footer-container {
    flex-direction: column;
    align-items: center;
    text-align: center;
  }

  .footer-section, .footer-section-1 {
    width: 100%;
    margin: 10px 0;
  }

  .footer-icons {
    margin-top: 10px;
  }

  .footer-icons img {
    margin: 0 5px;
  }
}

/* Smaller Screens (Text sizing and padding) */
@media (max-width: 576px) {
  .container-sm p {
    font-size: 18px;
    padding: 15px 20px;
  }
 
  .card h3 {
    font-size: 20px;
  }

  .card p {
    font-size: 14px;
  }

  .footer-section h3 {
    font-size: 15px;
  }

  .footer-section ul li {
    font-size: 14px;
  }
}

/* Very small screens */
@media (max-width: 400px) {
  .container-sm {
    height: auto;
    padding: 20px 10px;
  }

  .container-sm p {
    font-size: 16px;
    padding: 20px 10px;
  }

  header h1 {
    font-size: 22px;
  }

  .menu-toggle {
    font-size: 24px;
  }

  .card {
    padding: 15px;
    height: auto;
  }
}

  
</style>
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
  
  

 
  <!-- welcome secation -->
  <div class="container">
    <div class="text">
      <h1 id="H11">Simplify your expense <br>
        reports with platform <br>
        integrations </h1>
      <p><i>We’ve partnered with leading expense providers to help businesses save time <br>
          and improve employee satisfaction.</i></p>
    </div>
    <div class="image">
      <img src="int.jpg" alt="jpg">
    </div>
  </div>

  
  <div class="container-sm" style="height: 400px; background-color: #EFA111;">
    <p style=" text-align: center;color:white; font-size: 30px;padding-top:100px;">Perficient streamlined its <br>
      employees’ corporate travel expensing <br>
      process with Uber for Business and SAP Concur.</p>

  </div>

  <!-- disply block -->
  <!-- <h1 style="margin-left: 50px; font-size: 30px; margin-top: 30px;">Provides Expense</h1> -->
    <div class="container2">
      <div class="card">
        <img src="https://img.icons8.com/?size=100&id=N5JNmydXBuCl&format=png&color=000000" alt="Nature" style="height: 50px; width: 50px;">
        <div class="card-content">
          <h3>Ride For Others</h3>
          <p>Central helps control costs and improve operational efficiency without sacrificing customer experience.</p>
        </div>
      </div>

      <div class="card">
        <img src="icons8-document-94.png"  alt="City Life" style="height: 50px; width: 50px;">
        <div class="card-content">
          <h3>Easy policy adherence</h3>
          <p>You’ll have the option to prompt employees
            to select an expense code from a list before
            requesting a ride or meal.</p>
        </div>
      </div>

      <div class="card">
        <img src="icons8-team-94.png" alt="Adventure" style="height: 50px; width: 50px; ">
        <div class="card-content">
          <h3>Seamless employee onboarding</h3>
          <p>Automatically add new team members to your
            Business account by syncing with your
            expense providers’ employee roster</p>
        </div>
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

  </body>

</html>



<script>
  function toggleMenu() {
    const navList = document.getElementById('navList');
    navList.classList.toggle('show');
  }
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>