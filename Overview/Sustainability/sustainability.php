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
  <title>sustainability</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
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
  

.container {
  /* background-color: blanchedalmond; */
  display: flex;
  /* flex-direction: row; */
  align-items: center;
  margin-top: 20px;
  min-height: 100px;
  padding: 20px;
}

.text {
  flex: 1;
    padding: 20px;
}

h1{
  font-size: 40px;
}

.container p{
  flex: 3;
 
}
.image {
  flex: 1;
  padding: 20px;
  margin-left: 50px;
}

.image img {
  max-width: 80%;
  height: auto;
  display: block;
}

/* card */
.container2 {
  display: flex;
  justify-content: space-between;
  gap: 20px;
  padding: 40px;
  flex-wrap: wrap;
  /* Allows wrapping on smaller screens */
}

.card {
  flex: 1;
  min-width: 300px;
  /* Prevents shrinking too much */
  max-width: 400px;
  background: white; 
  border: 1px solid #ccc; 
  border-radius: 8px;
  box-shadow:0 0 8px #efa111;
  transition: transform 0.3s; 
  text-align: center;
  padding: 20px;
  height: 500px;
}

.card:hover {
  transform: translateY(-10px);
} 

  .card h3 {
  margin: 0;
  /* color: #333; */
} 

  

  /* Media query for responsiveness */
  @media (max-width: 900px) {
    .container {
      justify-content: center;
      /* Center cards in smaller screens */
    }

    .container .text h1{
      font-size: 30px;

    }

    .text p{
      font-size: 20px;
    }
  }

  @media (max-width: 600px) {
    .card {
      min-width: 100%;
      /* Cards take full width on smaller screens */
    }

    .container .text{
      font-size: 30px;

    }
  }



  /* icon card */
.container3 {
  display: flex;
  justify-content: space-between;
  gap: 20px;
  padding: 40px;
  flex-wrap: wrap;
  height: 850px;
  /* Allows wrapping on smaller screens */
  margin-top: 30px;
}

.card3 {
  flex: 1;
  min-width: 300px;
  /* Prevents shrinking too much */
  max-width: 400px;
  /* background: white;
  border: 1px solid #ccc;
  border-radius: 8px;*/
  box-shadow:0 0 8px #efa111;
  /* transition: transform 0.3s;  */
  text-align: center;
  padding: 20px;
  height: 250px;
}

.card3:hover {
  transform: translateY(-10px);
}

.card3 h3 {
  margin: 0;
  color: #333333;
}

.container4{
  height: 400px; 
  background-color: #EFA111;
  color:white;
  font-size:30px;
  display:flex;
  margin-top: 30px;
  
  
}

.container4 h1{
  
  margin-top: 60px; 
  padding: 80px;
  text-align: center; 
  font-size: 30px;
}

/* icon card */
.container5{
  display: flex;
  justify-content: space-between;
  gap: 20px;
  padding: 40px;
  flex-wrap: wrap;
  height: 400px;
  /* Allows wrapping on smaller screens */
}

.card3 {
  flex: 1;
  min-width: 300px;
  /* Prevents shrinking too much */
  max-width: 400px;
  background: white;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-shadow:0 0 8px #efa111;
  transition: transform 0.3s;
  text-align: center;
  padding: 20px;
  height: 250px;
}

.card3:hover {
  transform: translateY(-10px);
}

.card3 h3 {
  margin: 0;
  color: #333;
}

.container6{
  /* background-color: black; */
  height: 200px;
  justify-content: space-between;
  gap: 20px;
  padding: 50px;
  flex-wrap: wrap;    
  /* Allows wrapping on smaller screens */
  margin-top: 30px;
  
  
}

.container6 h1{
  color: #333333; 
  text-align: center; 
  font-size: 30px;
}

/* Media query for smaller screens */

  @media (max-width: 768px) {
    .icon-container3 {
      flex-direction: column;
      gap: 15px;
    }
    .container5{
      height: auto;
    }
  }

  /* Media query for smaller screens */

  @media (max-width: 768px) {
    .container .image{
      display:none;

      
    }
    .icon-container3 {
      flex-direction: column;
      gap: 15px;
    }

    .container4 {
    height: auto;
    padding: 40px 20px;
  }
  
  .container4 h1 {
    font-size: 24px;
    margin-left: 0;
  }

  .container6{
    height: auto;
  }
}

@media (max-width: 480px) {
  .container4 h1 {
    font-size: 20px;
  }

  
}
  
  /* footer */
footer{
    background-color: #EFA111;
    color: #fff;
    padding: 20px 0;
    /* text-align: center; */
    font-size: 16px;
   
  }

  .footer-container{
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    max-width: 1200px;
    margin: 0 auto;
    margin-bottom:30px;
   
  }

  .footer-section{
    margin: 10px;
  }

  .footer-section h3{
    margin-bottom: 10px;
    font-size: 16px;
  }

  .footer-section ul{
    list-style: none;
    padding: 0;
  }

  .footer-section ul li{
    margin-bottom: 5px;
  }

  .footer-section ul li a{
    color: #fff;
    text-decoration: none;
  }

  .footer-section ul li a:hover{
    text-decoration: underline;
  }

  .footer-section-1{
    padding: 0%;
  } 

  .footer-section img{
    /* margin-top: 20px; */
    border-radius: 18px;
    box-shadow: 0 0px 30px rgba(0, 0, 0, 0.5);
    ;
  }

  .footer-section img:hover{
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

  @media (max-width:768px){
    .footer-container {
      flex-direction: column;
      align-items: center;
      text-align: center;
    }
  }

  @media (max-width:480px){
    .footer-container {
      padding: 15px;
    }

    .footer-section {
      width: 100%;
      margin: 8px 0;
    }
  }
  
</style>

<body>
  <header>
  <h1><a  style="color: white; text-decoration: none;font-size:35px;">Kolhapur</a></h1>
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
  
  <div>
    <!-- welcome  -->
   
<!-- welcome  -->
<div class="container">
  <div class="text">
    <h1>Let’s rise to the challenge of sustainability</h1>
    <p style="font-size:20px;color:#666666">Making sustainability the better choice, one ride at a time</p>
  </div>
  <div class="image">
    <img src="Why Many New Cars Are Cheaper Than Used.jpg" alt="jpg">
  </div>
</div>
      
    <!-- card -->
    <h1 style="margin-left: 60px; font-size: 30px; margin-top: 100px;color:#333333">Take control of your carbon footprint</h1>
    <p style="margin-left: 60px;font-size:20px;color:#666666">Uber for Business can help with comprehensive climate metrics, transparent emissions tracking, and<br>
      greener options for every employee.</p>
    
    <div class="container2">
      <div class="card">
        <img src="Lesson_ Transportation - ESL Gold.jpg" alt="Nature">
        <div class="card-content">
          <h3>Company-wide emissions reporting</h3>
          <p style="color:#666666">Get clear climate metrics to measure and share<br>
             your company’s achievements, including total<br>
             CO₂ emissions, total low-emission trips, and<br>
             average CO₂ per mile.
          </p>
        </div>
      </div>

      <div class="card">
        <img src="Panne de voiture _ elle découvre de l’eau dans l’essence Leclerc.jpg" alt="City Life">
        <div class="card-content">
          <h3>No- and low-emission rides</h3>
          <p style="color:#666666">Your sustainability goals shouldn’t cost extra.<br>
             Uber Green, our EV and hybrid ride option, is the<br>
             most widely available solution in the world for<br>
             no- or low-emission rides, available to your<br>
             employees with a tap.*
          </p>
        </div>
      </div>

      <div class="card">
        <img src="This Is the One Thing You Shouldn’t Order at Fast-Food Restaurants.jpg" alt="Adventure" style="padding: 10px; ">
        <div class="card-content">
          <h3>Greener options for delivery with group
            orders</h3>
          <p style="color:#666666">Feed company morale while improving delivery<br>
            efficiency. Group orders are an easy, sustainable<br>
            choice that grows your impact by requiring fewer<br>
            trips for delivery.
          </p>
        </div>
      </div>
    </div>

    <h1 style="font-size: 30px;margin-left: 50px; margin-top: 40px;">Track your climate progress in the dashboard</h1>
    <p style="margin-left: 50px; font-size: 20px;color:#666666">Visit your Uber for Business dashboard to easily see, track, and share your sustainability efforts.</p>

    <div class="container4" >
        <h1 >“On the mobility side, we’re working to make
          low- and no-emission mobility accessible for
          more consumers at the tap of a button. If
          you're traveling with Uber, that has a positive
          impact on the world.”
        </h1>
   </div>
   

   <h1 style="margin-left:50px; font-size: 30px; margin-left: 55px; margin-top: 40px;">On the road to net zero</h1>
    <div class="container5">
      <div class="card3" >
        <img src="icons8-cash-40.png" style="width: 50px; height: 50px; margin-left: 10px;">
        <i class="bi bi-luggage"></i>
        <div class="card-content">
          <h3>Uber Comfort Electric**</h3>
          <p style="color:#666666">Expanding Uber Comfort Electric so
            businesses and consumers can travel in
            no-emission luxury vehicles.
          </p>

        </div>
      </div>

      <div class="card3" >
        <img src="icons8-gift-40.png" style="width: 50px; height: 50px; margin-left: 10px;">
        <i class="bi bi-luggage"></i>
        <div class="card-content">
          <h3>More EVs on the road**</h3>
          <p>Helping drivers transition to electric
            vehicles with $800 million in resources
            through our Green Future program.
          </p>
        </div>
      </div>
    </div> 

  <div class="container6">    
  <h1 style="color:#33333;">The future of sustainability is together</h1>
  <div style="text-align: center; margin-top: 20px;">
    <a href="business2.html" class="btn btn-primary" style="color: white; text-decoration: none;background-color:#EFA111;border:none;">Contact Sales</a>
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