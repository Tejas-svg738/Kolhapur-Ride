<?php


session_start();
// ✅ If user is not logged in, redirect
if (!isset($_SESSION['userid'])) {
    header("Location:/Kolhapur/index/index.html");
    exit;
}
$firstname = $_POST['firstname'] ?? '';
$lastname = $_POST['lastname'] ?? '';
$email = $_POST['email'] ?? '';
$mobileno = $_POST['mobileno'] ?? '';
$idimage = $_POST['idimage'] ?? '';
$aadhar_no = $_POST['aadhar_number'] ?? '';
$aadhaar_image = $_POST['aadhaar_image'] ?? '';
$pan_number = $_POST['pan_number'] ?? '';
$pan_image = $_POST['pan_image'] ?? '';
$dlNumber = $_POST['dlNumber'] ?? '';
$dlFile = $_POST['dlFile'] ?? '';
$rcNumber = $_POST['rcNumber'] ?? '';
$rcFile = $_POST['rcFile'] ?? '';
$expiryDate = $_POST['expiryDate'] ?? '';
$insurance_photo = $_POST['insurance_photo'] ?? ''; // From insurance.php


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fileInput'])) {


  $tmpName = $_FILES['fileInput']['tmp_name'];
  $fileName = basename($_FILES['fileInput']['name']);
  $uploadDir = 'uploads/';
  $destination = $uploadDir . uniqid() . "_" . $fileName;

  if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
  }

  move_uploaded_file($tmpName, $destination);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Vehicle Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
body {
    font-family: Arial;
    background-color: #f2f2f2;
    /* height: 100vh; */
    justify-content: center;
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

/* container */
.form-container {
    margin-top: 50%;
    background-color: white;
    padding: 25px;
    border-radius: 10px;
    width: 500px;
    margin: auto;
     box-shadow:0 0 8px #efa111;
    margin-top:20px;
}

button{
    background-color:#efa111;
    color:white;
    border-radius: 8px  #efa111;
     border: none;

     
}
input,
select {
    width: 100%;
    padding: 8px;
    margin-top: 6px;
    margin-bottom: 16px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

input[type="submit"] {
    background-color: #efa111;
    color: white;
    border: none;
    cursor: pointer;
}



/* Mobile view */
@media (max-width: 600px) {
  .form-container {
    width: 95%;
    padding: 15px;
    margin: 20px auto;
  }

  input,
  select,
  button {
    font-size: 16px;
  }

  h2 {
    font-size: 20px;
  }
}

/* Tablet view */
@media (min-width: 601px) and (max-width: 1024px) {
  .form-container {
    width: 85%;
    padding: 20px;
    margin: 25px auto;
  }

  input,
  select,
  button {
    font-size: 17px;
  }

  h2 {
    font-size: 22px;
  }
}

        
/* * footer */ 
  footer{
    background-color: #EFA111;
    color: #fff;
    padding: 20px 0;
    /* text-align: center; */
    font-size: 16px;
    margin-top:20px
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
<input type="hidden" name="insurance_photo" value="<?= htmlspecialchars($insurance_photo) ?>">

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

   
<div class="form-container">
<center>
    
    <h2>Vehicle Registration</h2>

    <button type="button" onclick="showOptions('car')">Car</button>
    <button type="button" onclick="showOptions('bike')">Bike</button>
    <button type="button" onclick="showOptions('auto')">Auto</button>
</center>
    <form action="avg.php" method="post">
        <input type="hidden" name="vehicle_category" id="vehicle_category">

        <label>Vehicle Type:</label>
        <select name="vehicle_type" id="vehicle_type" required></select>

        <label>Model:</label>
        <input type="text" name="model" required>

        <label>Fuel Type:</label>
        <select name="fuel" required>
            <option value="">Select Fuel Type</option>
            <option value="Petrol">Petrol</option>
            <option value="Diesel">Diesel</option>
            <option value="CNG">CNG</option>
            <option value="Electric">Electric</option>
            <option value="Gas">Gas</option>
        </select>

        <label>Vehicle Number:</label>
        <input type="text" name="number" required>

        <label>Average (km/l):</label>
        <input type="number" name="average" required>

        <label>Price/km (₹):</label>
        <input type="number" name="price" step="0.01" required>

        <input type="submit" value="Submit">
    </form>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
    crossorigin="anonymous"></script>

    <script>
    function showOptions(type) {
        document.getElementById('vehicle_type').innerHTML = '';
        const carTypes = ['Sedan', 'Hatchback'];
        const bikeTypes = ['Gear', 'Without Gear'];
        const autoTypes = ['Auto'];
        let types = [];

        if (type === 'car') types = carTypes;
        else if (type === 'bike') types = bikeTypes;
        else if (type === 'auto') types = autoTypes;

        types.forEach(function(item) {
            let opt = document.createElement('option');
            opt.value = item.toLowerCase().replace(' ', '_');
            opt.text = item;
            document.getElementById('vehicle_type').appendChild(opt);
        });

        document.getElementById('vehicle_category').value = type;
    }
</script>
</html>