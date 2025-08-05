<?php
session_start();
// ✅ If user is not logged in, redirect
if (!isset($_SESSION['userid'])) {
    header("Location:/Kolhapur/index/index.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['photo'])) {
  // Handle other inputs
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $mobileno = $_POST['number'];
  $email = $_POST['email'];

  // Handle file upload
  $tmpName = $_FILES['photo']['tmp_name'];
  $fileName = basename($_FILES['photo']['name']);
  $uploadDir = 'uploads/';
  $destination = $uploadDir . uniqid() . "_" . $fileName;

  if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
  }

  move_uploaded_file($tmpName, $destination);
}
?>
<!-- <?php
// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['photo'])) {
//     $tmpName = $_FILES['photo']['tmp_name'];
//     $fileName = basename($_FILES['photo']['name']);
//     $uploadDir = 'uploads/';
//     $destination = $uploadDir . uniqid() . "_" . $fileName;

//     if (!file_exists($uploadDir)) {
//         mkdir($uploadDir, 0777, true);
//     }

//     move_uploaded_file($tmpName, $destination);
// }
?> -->



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Term And Condition</title>
  
  <style>

    body{
      margin:0;
      font-family: 'Roboto', sans-serif;
    }
   /* navbar */

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



    .container {
      border: 2px solid #efa111;
      width: 500px;
      height: 400px;
      border-radius: 2%;
      margin-top: 50px;
       box-shadow:0 0 8px #efa111 ;
    }

    .container{

    }

    button {
      background-color: #efa111;
      border:2px solid #efa111;
      color:white;
    }

    button a {
      text-decoration: none;
      color:white;
    }

    .terms-box {
  padding: 10px 15px;
  max-height: 300px;
  overflow-y: auto;
  /* border: 2px solid #efa111; */
  border-radius: 5px;
  margin-bottom: 15px;
  font-size: 14px;
  text-align: left;
  /* background-color: #fffdf7; */
  /* box-shadow: 0 0 5px rgba(239, 161, 17, 0.3); */
}

.terms-box h3 {
  color: #efa111;
  margin-top: 0;
  font-size: 16px;
}

.terms-box ul {
  padding-left: 20px;
}

.terms-box ul li {
  margin-bottom: 8px;
}


@media (max-width: 768px) {
  .container {
    width: 90%;
    height: auto;
    padding: 20px 10px;
  }

  .terms-box {
    font-size: 13px;
    padding: 10px;
    max-height: 250px;
  }

  .terms-box h3 {
    font-size: 15px;
  }

  .terms-box ul li {
    margin-bottom: 6px;
  }
}

@media (max-width: 480px) {
  .container {
    width: 95%;
    height: auto;
    padding: 15px 8px;
  }

  .terms-box {
    font-size: 12px;
    padding: 8px;
    max-height: 200px;
  }

  .terms-box h3 {
    font-size: 14px;
  }

  .terms-box ul {
    padding-left: 18px;
  }
}

@media (max-width: 360px) {
  .container {
    width: 100%;
    height: auto;
    padding: 12px 6px;
  }

  .terms-box {
    font-size: 11.5px;
    padding: 6px;
    max-height: 180px;
  }

  .terms-box h3 {
    font-size: 13px;
  }
}


    /* footer */
  footer{
    background-color: #EFA111;
    color: #fff;
    padding: 20px 0;
    /* text-align: center; */
    font-size: 16px;
    margin-top:10px;
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
  
  <center>
    <div class="container">
      <!-- <img src="<?php echo $destination; ?>" alt="Preview" style="max-width:300px;"><br><br> -->



      <form action="AdharCard.php" method="post" enctype="multipart/form-data">
        <!-- Hidden fields to pass previous data -->
        <input type="hidden" name="firstname" value="<?php echo htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8'); ?>">
        <input type="hidden" name="lastname" value="<?php echo htmlspecialchars($lastname, ENT_QUOTES, 'UTF-8'); ?>">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>">
        <input type="hidden" name="mobileno" value="<?php echo htmlspecialchars($mobileno, ENT_QUOTES, 'UTF-8'); ?>">
        <input type="hidden" name="idimage" value="<?php echo htmlspecialchars($destination); ?>">



        <!-- Display submitted data -->
      <!-- <div class="info-display">
          <p>First Name: <?php echo htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8'); ?></p>
          <p>Last Name: <?php echo htmlspecialchars($lastname, ENT_QUOTES, 'UTF-8'); ?></p>
          <p>Email ID: <?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></p>
          <p>Mobile No: <?php echo htmlspecialchars($mobileno, ENT_QUOTES, 'UTF-8'); ?></p> 

        </div> -->


        <!-- Consent checkbox -->
       <div class="terms-box">
  <h3>Terms and Conditions</h3>
  <p>By proceeding, you agree to the following terms:</p>
  <ul>
    <li>You confirm that all the personal details and documents provided are true and correct.</li>
    <li>Your uploaded image will be stored securely and may be used for verification purposes.</li>
    <li>Your personal data will be processed according to our privacy policy and will not be shared with third parties without your consent.</li>
    <li>Any misuse or fraudulent activity may lead to disqualification or legal action.</li>
    <li>This platform reserves the right to modify or update the terms at any time without prior notice.</li>
  </ul>
</div>


        <label for="agree">I Agree</label>
        <input type="checkbox" name="agree" value="yes" required><br><br>
        <button>Next</button>

    </div>

  </center>
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


  <script>
    function toggleMenu() {
      const navList = document.getElementById('navList');
      navList.classList.toggle('show');
    }

    
  </script>
</body>

</html>