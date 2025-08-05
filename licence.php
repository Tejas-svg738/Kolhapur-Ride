<?php

session_start();
// ✅ If user is not logged in, redirect
if (!isset($_SESSION['userid'])) {
    header("Location:/Kolhapur/index/index.html");
    exit;
}



$destination = '';
// Safely get the POST data

$firstname = $_POST['firstname'] ?? '';
$lastname = $_POST['lastname'] ?? '';
$email = $_POST['email'] ?? '';
$mobileno = $_POST['mobileno'] ?? '';
$idimage = $_POST['idimage'] ?? '';
$aadhar_number = $_POST['aadhaar_number'] ?? '';
$aadhaar_image = $_POST['aadhaar_image'];
$pan_number = $_POST['pan_number'];

//$pan_image =$_POST['pan_image'];
// Aadhar validation (optional for this page)
// $error = '';
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if (!preg_match("/^\d{12}$/", $aadhar_no)) {
//         $error = "Invalid Aadhar number. It must be exactly 12 digits.";
//     }
// }
// $aadhar_photo_path =$_POST['aadhaar_image'] ?? '';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pan_image'])) {


  $tmpName = $_FILES['pan_image']['tmp_name'];
  $fileName = basename($_FILES['pan_image']['name']);
  $uploadDir = 'uploads/';
  $destination = $uploadDir . uniqid() . "_" . $fileName;

  if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
  }

  move_uploaded_file($tmpName, $destination);
}
?>







<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Licence</title>
  

  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <style>
    body {
    
    margin: 0;
    font-family: 'Roboto', sans-serif;
    background-color: white;
    color: black;
  
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



    
    .container {
      width: 500px;
      height: 300px;

      margin-top: 30px;
      max-width: 400px;
      /* margin: auto; */
      padding: 25px;
      background: white;
      border-radius: 10px;
      box-shadow:0 0 8px #efa111;
    }

    input,
    label {
      width: 90%;
      display: block;
      margin-bottom: 15px;
    }

    input[type="text"],
    input[type="file"] {
      padding: 10px;
      font-size: 16px;
    }

    .btn {
      padding: 10px;
      background-color:#efa111;
      color: white;
      border: none;
      cursor: pointer;
      border-radius: 5px;
      font-size: 16px;
      width: 100%;
    }

    /* .btn:hover {
      background-color: #4CAF50;
    } */

    .message {
      margin-top: 15px;
      font-weight: bold;
    }

    .error {
      color: red;
    }

    .success {
      color: green;
    }

    a {
      text-decoration: none;
      color: black;
    }

    /* media query */

   @media (max-width: 768px) {
  .container {
    width: 90%;
    height: auto;
    padding: 20px;
    margin: 20px auto;
    box-shadow: 0 0 8px #efa111;
  }

  input,
  label {
    width: 100%;
    font-size: 15px;
  }

  input[type="text"],
  input[type="file"] {
    font-size: 15px;
    width:90%;
  }

  .btn {
    font-size: 15px;
    padding: 10px;
  }

  h2 {
    font-size: 22px;
    text-align: center;
  }
}



    /* footer */
    
     /* footer */
  footer{
    background-color: #EFA111;
    color: #fff;
    padding: 20px 0;
    /* text-align: center; */
    font-size: 16px;
    margin-top:50px;
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
    <form class='contact-form' action="rcbook.php" method="post" enctype="multipart/form-data">
      <h2 style="color:#333333;">Driving Licence Verification </h2>

      <!-- display -->
      <!-- <p><strong>First Name:</strong> <?php echo htmlspecialchars($firstname); ?></p>
      <p><strong>Last Name:</strong> <?php echo htmlspecialchars($lastname); ?></p>
      <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
      <p><strong>Mobile No:</strong> <?php echo htmlspecialchars($mobileno); ?></p>
      <img src="<?php echo $idimage; ?>" alt="Preview" style="max-width:300px;"><br><br>

      <p><strong>Aadhaar No:</strong> <?php echo htmlspecialchars($aadhar_number); ?></p>

      <p><strong>Aadhaar Photo:</strong></p>
      <img src="<?php echo htmlspecialchars($aadhaar_image); ?>" alt="aadhaar_image" width="150">

      <p><strong>pan no:</strong> <?php echo htmlspecialchars($pan_number); ?></p>

      <p><strong>pan Photo:</strong></p>
      <img src="<?php echo htmlspecialchars($destination); ?>" alt="pan_image" width="150"> -->


      <!-- Hidden fields to persist data -->
      <input type="hidden" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>">
      <input type="hidden" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>">
      <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
      <input type="hidden" name="mobileno" value="<?php echo htmlspecialchars($mobileno); ?>">
      <input type="hidden" name="idimage" value="<?php echo htmlspecialchars($idimage); ?>">
      <input type="hidden" name="aadhaar_number" value="<?php echo htmlspecialchars($aadhar_number); ?>">
      <input type="hidden" name="aadhaar_image" value="<?php echo htmlspecialchars($aadhaar_image); ?>">
      <input type="hidden" name="pan_number" value="<?php echo htmlspecialchars($pan_number); ?>">
      <input type="hidden" name="pan_image" value="<?php echo htmlspecialchars($destination); ?>">


      <label for="dlNumber">Driving Licence Number</label>
      <input type="text" id="dlNumber" name="dlNumber" placeholder="e.g. MH1219950123456" required />

      <label for="dlFile1">Upload Document (PDF, PNG, JPG)</label>
      <input type="file" id="dlFile" name="dlFile" accept="image/*" required />
      <!-- <input type="file" id="dl_image" name="dl_image" accept="image/*" required> -->
      <button type="submit" class="btn"><!--a href="vehicle.php"-->Next</button>

    </form>
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
    document.getElementById("dlForm").addEventListener("submit", function (e) {
      e.preventDefault();

      const dlNumber = document.getElementById("dlNumber").value.trim().toUpperCase();
      const fileInput = document.getElementById("dl_image");
      const message = document.getElementById("message");

      // DL regex pattern: 2 letters + 2 digits + 4 digits + 7 digits
      const dlRegex = /^[A-Z]{2}\d{2}\d{4}\d{7}$/;

      if (!dlRegex.test(dlNumber)) {
        message.textContent = "Invalid DL number format. Use: MH1219950123456";
        message.className = "message error";
        return;
      }

      const file = fileInput.files[0];
      if (!file) {
        message.textContent = "Please upload a document.";
        message.className = "message error";
        return;
      }

      const allowedTypes = ["application/pdf", "image/png", "image/jpeg"];
      if (!allowedTypes.includes(file.type)) {
        message.textContent = "Invalid file type. Only PDF, PNG, JPG allowed.";
        message.className = "message error";
        return;
      }

      message.textContent = "DL and document validated successfully!";
      message.className = "message success";
      // You can submit the form data to backend here if needed
    });
  </script>
  
</body>

<script>
    function toggleMenu() {
      const navList = document.getElementById('navList');
      navList.classList.toggle('show');
    }

    
  </script>

</html>