<?php
session_start();
// ✅ If user is not logged in, redirect
if (!isset($_SESSION['userid'])) {
    header("Location:/Kolhapur/Userlogin/login.html");
    exit;
}

?>


<!doctype html>
<lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Business</title>
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



  .container{
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

  .image {
    flex: 1;
    padding: 20px;
  }

  .image img {
    max-width: 80%;
    height: 300px;
    display: block;
    margin-left: 150px;
    /* border: 1px solid #efa111;
    box-shadow:0 0 8px #efa111; */

  }

  /* Media Query for Responsive Layout */

  .container{
    display: flex;
    justify-content: space-between;
    gap: 20px;
    padding: 40px;
    flex-wrap: wrap;
    /* Allows wrapping on smaller screens */
  }

  .card{
    flex: 1;
    min-width: 300px;
    /* Prevents shrinking too much */
    max-width: 400px;
    background: #f0f0f0;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow:0 0 8px #efa111;
    transition: transform 0.3s;
    text-align: center;
    padding: 20px;
  }

  .card:hover{
    transform: translateY(-10px);
  }

  .card h3{
    margin: 0;
    color: #333;
  }

  .card p{
    color: #666;
  }

  /* card */
  .container2{
    display: flex;
    justify-content: space-between;
    gap: 20px;
    padding: 40px;
    flex-wrap: wrap;
    /* Allows wrapping on smaller screens */
  }

  .card{
    flex: 1;
    min-width: 300px;
    /* Prevents shrinking too much */
    max-width: 400px;
    background: white;
    /* border: 1px solid #efa111; */
    border-radius: 8px;
   box-shadow:0 0 8px #efa111;
    transition: transform 0.3s;
    text-align: center;
    padding: 20px;
    height: 400px;
  }

  .card:hover{
    transform: translateY(-10px);
  }

  .card h3{
    margin: 0;
    color: #333;
  }

  .card p{
    color: #666;
  }

  /* icon card */
  .container3{
    display: flex;
    justify-content: space-between;
    gap: 20px;
    padding: 40px;
    flex-wrap: wrap;
    height: 500px;

    /* Allows wrapping on smaller screens */
  }

  .card3{
    flex: 1;
    min-width: 300px;
    /* Prevents shrinking too much */
    max-width: 400px;
    background: white;
    /* border: 1px solid #ccc; */
    border-radius: 8px;
    border: 1px solid #efa111;
    box-shadow:0 0 8px #efa111;
    transition: transform 0.3s;
    text-align: center;
    padding: 20px;
    height: 250px;
  }

  .card3:hover{
    transform: translateY(-10px);
  }

  .card3 h3{
    margin: 0;
    color: #333;
  }

  .container4{
    height: 500px; 
    background-color:#EFA111;
    display:flex;color:

  }

 /* media query */
 /* Mobile & small tablet: width less than or equal to 768px */
@media screen and (max-width: 768px) {

.container,
.container2,

.container4 {
  flex-direction: column;
  padding: 20px;
  align-items: center;
  text-align: center;
}

.text {
  padding: 10px;
}

.image {
  padding: 10px;
  margin: 0 auto;
}

.image img {
  max-width: 100%;
  
  height: auto;
  margin-left: 0;
}

.card,
.card3 {
  max-width: 100%;
  width: 100%;
  margin-bottom: 20px;
}



.container4 {
    flex-direction: column;
    align-items: center;
    height: auto !important;
    padding: 20px;
  }

  .container4 .right {
    margin-left: 0;
    text-align:left;
  }

  .container4 .right h1,
  .container4 .right ol {
    margin-left: 0;
    margin-top: 20px;
  }

  .container4 .img img {
    display:none;
  }

  

  

h1 {
  font-size: 24px;
}

.btn button {
  width: 100%;
  
}

.container3{
  height:700px ;
}
.container3 .card3{
  height: auto;
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
  
  .btn{
    margin-right: 10x;
  }

  .text h1{
    margin-left: 15px;
  }

  .text p{
    margin-left: 15px;
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

    <!-- welcome  -->
    <div class="container">
      <div class="text">
        <h1>Business profile</h1>
        <p>Find out if you are eligible for Kolhapur for Business perks and<br>
          start enjoying priority pickup, seamless expensing, and<br>
          much more.<br><br>
          With over 170,000 organizations already using Kolhapur for<br>
          Business, your employer may already be on board.</p>

          <div class="btn">
            <button class="btn btn-primary" type="button" style="background-color:#EFA111; border:none;"><a href="/Kolhapur/Business/businessemail.php" style="color:white; text-decoration: none;">Add Your Business Profile</a></button>
          </div>
      </div> 

      <div class="image"> 
        <img src="Business.jpg" alt="jpg" >
      </div>
    </div>

    <!-- card -->
    <h1 style="margin-left: 50px; font-size: 30px;">Business, your employer may already be on board.</h1>
    <div class="container2">
      <div class="card">
        <img src="icons8-car-94.png" style="height: 50px;width: 50px;">
        <div class="card-content" style="margin-top: 60px;">
          <h3>Exclusive ride option</h3>
          <p>Business Comfort is an exclusive ride option<br>
            designed for the business traveler. Save time and<br>
            stay productive on the road with priority pickup*,<br>
            enhanced support, top-rated drivers, and<br>
            much more.</p>
        </div>
      </div>

      <div class="card">
        <img src="icons8-bank-cards-94.png" style="height: 50px;width: 50px;">
        <div class="card-content" style="margin-top: 60px;">
          <h3>Save time on expenses</h3>
          <p>Enjoy effortless expense reporting and save<br>
            valuable time with automatic receipt uploads to<br>
            expense providers. Submitting an expense report<br>
            has never been easier.</p>
        </div>
      </div>

      <div class="card">
        <img src="icons8-mastercard-94.png" style="height: 50px;width: 50px;">
        <div class="card-content" style="margin-top: 60px;">
          <h3>Separate business from personal</h3>
          <p>Your work travel may be blended but your<br>
            expenses don’t have to be. Separating business<br>
            and personal profiles will ensure that your<br>
            expenses are properly split and the correct<br>
            payment method is used.</p>
        </div>
      </div>
    </div>

    <div class="container4" ><br>
    <div class="left">
      <h1 style="margin-left: 50px;margin-top: 30px; color:#fff">Getting set up is easy</h1>
   <ol style="margin-left: 50px;margin-top:40px; color:#fff">
    <li>You may be prompted to enter your personal Uber
       account credentials,and authenticate your account via a
        4-digit code sent to your phone number or email. </li>
    <li>Once logged in, enter your work email to see if you are
       eligible to connect to an organization's account. </li>
    <li>If you are eligible, you will receive an email to verify and
       activate your account. Open the email on your mobile
        device and tap Activate your account in the email.</li>   
    <li>Tap Join now.</li>
    <li>You’re all set! Next time, toggle to your business profile
       when using Kolhapur for work.</li>
   </ol>
  </div>
  <div class="img">
    <img src="freephotobusiness.jpg" style="height: 400px; width: 600px; margin-left: 200px;margin-top: 50px;">
  </div>
    </div>


    <!-- disply block -->
    <h1 style="margin-left:80px; font-size: 35px; margin-top: 40px;">How companies leverage for Business</h1>
    <div class="container3">
      <div class="card3" style="margin-left: 9%;">
        <img src="icons8-project-94.png" style="height: 40px; width: 40px;" >
        <i class="bi bi-luggage"></i>
        <div class="card-content">
          <h3>Plan ahead</h3>
          <p>You can schedule a ride for your upcoming trip<br>
             with Kolhapur Reserve, which uses technology to<br>
             help ensure on-time pick-up for a stress-<br>
             free ride.</p>

        </div>
      </div>

      <div class="card3" style="margin-right: 10%;">
        <img src="icons8-privacy-policy-94.png" style="height: 40px; width: 40px;">
        <div class="card-content">
          <h3>View perks and policy</h3>
          <p>Business hub within the Kolhapur app allows you to<br>
            easily access the travel benefits and work perks<br>
            provided by your company.</p>

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