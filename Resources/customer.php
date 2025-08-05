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
  <title>customers</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
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
  
  

.container{
  /* background-color: blanchedalmond; */
  display: flex;
  /* flex-direction: row; */
  align-items: center;
  margin-top: 20px;
  min-height: 100px;
  padding: 20px;
  background-color: rgb(243, 233, 233);
}

.text{
  flex: 1;
    padding: 20px;
}

h1{
  font-size: 50px;
  text-align: center;
}

.container p{
  flex: 3;
  text-align: center;
}
.image{
  flex: 1;
  padding: 20px;
  margin-left: 50px;
}

.image img{
  max-width: 80%;
  height: auto;
  display: block;
}

/* card */
.container2{
  display: flex;
  justify-content: space-between;
  gap: 20px;
  padding: 40px;
  flex-wrap: wrap;
  /* Allows wrapping on smaller screens */
  background-color: rgba(238, 235, 235, 0.948);
  margin-top: 20px;
 
}

.card{
  flex: 1;
  min-width: 300px;
  /* Prevents shrinking too much */
  max-width: 400px;
  background: white; 
  border: 1px solid #ccc; 
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
  transition: transform 0.3s; 
  text-align: center;
  padding: 20px;
  height: 350px;
}

.card:hover{
  transform: translateY(-10px);
} 

.card h3{
  margin: 0;
   color: #333;
}  

 .container3{
  display: flex;
  justify-content: space-between;
  gap: 20px;
  padding: 40px;
  flex-wrap: wrap;
  /* Allows wrapping on smaller screens */
  /* background-color: rgba(238, 235, 235, 0.948); */
  margin-top: 20px;
 
}

.card{
  flex: 1;
  min-width: 300px;
  /* Prevents shrinking too much */
  max-width: 400px;
  background: white; 
  border: 1px solid #ccc; 
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
  transition: transform 0.3s; 
  text-align: center;
  padding: 20px;
  height: 350px;
}

.card:hover{
  transform: translateY(-10px);
} 

.card h3{
  margin: 0;
   color: #333;
}  

.container-h1{
    height: auto;
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

h1{
    margin-top: 100px;
}

.container-h1 h1{
   flex: auto;
   margin-left:20px;
   margin-right: 30px;
}
}

@media (max-width: 600px){
.card {
    min-width: 100%;
      /* Cards take full width on smaller screens */
}

.container .text{
    font-size: 30px;

    }
}

  /* icon card */


/* Media query for smaller screens */

@media (max-width: 768px){
.icon-container3 {
    flex-direction: column;
    gap: 15px;
}

.container5{
    height: auto;
    }
}

  /* Media query for smaller screens */

@media (max-width: 768px){
.container .image{
    display:none;      
}

.icon-container3{
    flex-direction: column;
    gap: 15px;
}

.container4{
    height: auto;
    padding: 40px 20px;
}
  
.container4 h1{
    font-size: 24px;
    margin-left: 0;
}

.container6{
    height: auto;
  }
}

@media (max-width: 480px){
  .container4 h1 {
    font-size: 20px;
  }  
}
  
  /* footer */
footer{
  background-color: #1d1d30;
  color: #fff;
  padding: 20px 0;
  /* text-align: center; */
  font-size: 16px;
  margin-top: 80px;
}

.footer-container{
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
  max-width: 1200px;
  margin: 0 auto;
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
.footer-container{
    padding: 15px;
}

.footer-section{
    width: 100%;
    margin: 8px 0;
    }
}
</style>

<body>
  <header>
  <h1><a  style="color: white; text-decoration: none; ">Kolhapur</a></h1>
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
<div class="container">
  <div class="text">
    <h1>Proud partner of businesses
        everywhere </h1> 
    <p>Learn how companies across industries are solving some of their toughest challenges with Kolhapur Ride
        for Business.</p>    
  </div>
  
</div>
      
    <div class="container-h1">
    <h1 style="margin-left: 60px; font-size: 40px; margin-top: 150px;">Most Popular Customer Stories</h1>
    
    </div>
      <!-- card -->
    <div class="container2">
      <div class="card">
        <img src="Rmx - Galaxy s22 _ Samsung US.jpeg" alt="Nature">
        <div class="card-content">   
          <p style="margin-top: 30px;">Samsung helps local customers support<br>
            local businesses with a popular kolhapur Eats<br>
            promotion.</p>
        </div>
      </div>

      <div class="card">
        <img src="Pantry by Plum (CLOSED).jpg" alt="City Life" style="margin-top: 10px;">
        <div class="card-content">       
          <p style="margin-top: 60px;">Coca-Cola boosts team morale with kolhapur
             gift cards.</p>
        </div>
      </div>

      <div class="card">
        <img src="Optimizing Your Online Piano Teaching Setup.jpeg" alt="Adventure" >
        <div class="card-content">
          <p >Zoom moves its rapidly growing employee<br>
             base around the globe with Kolhapur Ride for<br>
             Business.</p>
        </div>
      </div>
    </div>
    
    <!-- card2 -->
    <h1 style="margin-left: 60px; font-size: 40px; margin-top: 150px;">Courtesy rides</h1>
      
    <div class="container3">
      <div class="card">
        <img src="Newsroom.jpg" alt="Nature">
        <div class="card-content">   
          <p style="margin-top: 30px;">Ryder surpasses 100,000 rides by integrating<br>
            kolhapur API. </p>     
        </div>
      </div>

      <div class="card">
        <img src="" alt="City Life" style="margin-top: 10px;">
        <div class="card-content">       
          <p style="margin-top: 60px;">Honda Auto Center of Bellevue saves 47% by
            replacing shuttles with Kolhapur Ride.</p>
        </div>
      </div>

      <div class="card">
        <img src="" alt="Adventure">
        <div class="card-content">
          <p>Zenique Hotels replaces airport shuttles with
            rides with Kolhapur Ride and saves 30%.</p>
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
           <p><strong>📞 Mobile:</strong> <a href="tel: 9922904252"> 9922904252</a></p>
            <p><strong>📧 Email:</strong> <a href="mailto:qweeztechnology@gmail.com">qweeztechnology@gmail.com</a></p>
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
