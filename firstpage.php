<?php
session_start();
// ✅ If user is not logged in, redirect
if (!isset($_SESSION['userid'])) {
    header("Location:/Kolhapur/Driver/test/firstpage.php");
    exit;
}
?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Drive</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>

    body{
     overflow: hidden;
     margin: 0;
    font-family: 'Roboto', sans-serif;
    background-color: white;
    }
     /* Add your header and nav CSS here */
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
/* end footer */


    .container {
    /* background-color: blanchedalmond; */
    display: flex;
    /* flex-direction: row; */
    align-items: center;
    margin-top: 20px;
    min-height: 100px;
    padding: 20px;
  }

  button{
    background-color: #EFA111;
    color: white;
    font-size: 20px;
    margin-top:20px;
    margin-left:20px;
    border: none;
     border-radius: 4px;
    
  }

  

/* 
Let's add responsive styles for the .container in your HTML to make it look good on mobile and tablet views.

Here's the updated CSS with media queries specifically for your .container, .text, and .image elements.

CSS

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Drive</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>

    body{
     overflow-x: hidden; /* Changed to overflow-x to allow vertical scrolling if content expands */
     margin: 0;
    font-family: 'Roboto', sans-serif;
    background-color: white;
    }
     /* Add your header and nav CSS here */
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
 /* footer */
  footer{
    background-color: #EFA111;
    color: #fff;
    padding: 20px 0;
    font-size: 16px;
    /* Added position: relative and bottom: 0; width: 100% to ensure it sticks to the bottom */
    position: relative;
    bottom: 0;
    width: 100%;
    margin-top: auto; /* Pushes footer to the bottom */
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
    border-radius: 18px;
    box-shadow: 0 0px 30px rgba(0, 0, 0, 0.5);
    ;
  }

  .footer-section img:hover{
    transform: translateY(-5px);
  }

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
/* end footer */


    .container {
    display: flex;
    align-items: center;
    margin-top: 20px;
    min-height: 100px;
    padding: 20px;
    justify-content: center; /* Center content horizontally on larger screens */
    flex-wrap: wrap; /* Allow items to wrap onto the next line */
  }

  button{
    background-color: #EFA111;
    color: white;
    font-size: 20px;
    margin-top:20px;
    border: none;
     border-radius: 4px;
    
  }

/* New Media Queries for .container */
@media (max-width: 992px) { /* For tablets and smaller desktops */
    .container {
        flex-direction: column; /* Stack items vertically */
        text-align: center; /* Center text within the container */
        padding: 15px; /* Adjust padding */
    }

    .text {
        margin-bottom: 20px; /* Add space between text and image */
    }

    .text h1 {
        font-size: 2.5em; /* Adjust font size for better readability */
        margin-left: 0; /* Remove left margin for centering */
    }

    .text p {
        margin-left: 0; /* Remove left margin for centering */
    }

    .image {
        margin-left: 0; /* Remove left margin for centering */
    }

    .image img {
        max-width: 80%; /* Make image responsive */
        height: auto; /* Maintain aspect ratio */
    }
}

@media (max-width: 576px) { /* For mobile devices */
    .container {
        padding: 10px; /* Smaller padding for very small screens */
    }

    .text h1 {
        font-size: 1.8em; /* Further reduce font size for mobile */
    }

    .text button {
        font-size: 18px; /* Adjust button font size */
        padding: 8px 15px; /* Adjust button padding */
    }

    .text p a {
        font-size: 16px; /* Adjust link font size */
    }

    .image img {
        max-width: 95%; /* Even smaller image on mobile */
    }
}

/* Ensure body allows scrolling when content exceeds viewport height */
body {
    min-height: 100vh; /* Make sure body takes at least full viewport height */
    display: flex;
    flex-direction: column; /* Arrange content and footer in a column */
}

/* The main content area should grow to fill available space */
.main-content {
    flex-grow: 1;
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
        <div class="text">
            <h1 >Drive on your terms,<br> create what you crave.</h1>
            <button id="btn1"><a href="SignUp1.php" style="text-decoration: none; color: white;margin-top:20px; ">Start</a> </button><br>
           <p style="margin-top:30px">
            <a href="driverlogin.php" id="log" style="text-decoration:none; margin-top:60px; color:black; font-size:20px;">Already have account? Login</a>
        </p>
        </div>
        <div class="image" style="margin-left: 100px;">
          <img src="heeelo pinterest.jpg" alt="jpg" height="450px" weight="200px">
          
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
</html>
