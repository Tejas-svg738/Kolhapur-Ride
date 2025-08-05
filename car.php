
<?php
// Safely get the POST data

$firstname = $_POST['firstname'] ?? '';
$lastname = $_POST['lastname'] ?? '';
$email = $_POST['email'] ?? '';
$mobileno = $_POST['mobileno'] ?? '';
$idimage = $_POST['idimage']?? '';
$aadhar_number = $_POST['aadhaar_number'] ?? '';
$aadhaar_image = $_POST['aadhaar_image'] ?? '';
$pan_number = $_POST['pan_number'] ?? '';
$pan_image = $_POST['pan_image'] ?? '';
$dlNumber = $_POST['dlNumber'] ?? '';
//$dlFile  = $_POST['dlFile'] ?? '';

// Aadhar validation (optional for this page)
// $error = '';
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if (!preg_match("/^\d{12}$/", $aadhar_no)) {
//         $error = "Invalid Aadhar number. It must be exactly 12 digits.";
//     }
// }
// $aadhar_photo_path =$_POST['aadhaar_image'] ?? '';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['dlFile'])) {


  $tmpName = $_FILES['dlFile']['tmp_name'];
  $fileName = basename($_FILES['dlFile']['name']);
  $uploadDir = 'uploads/';
  $destination = $uploadDir . uniqid() . "_" . $fileName;

  if (!file_exists($uploadDir)){
      mkdir($uploadDir, 0777, true);
  }

  move_uploaded_file($tmpName, $destination);
}
?>

<!doctype html>
<html lang="en">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Car</title>
    <style>
    .first {
      width: 300px;
      height: auto;
      margin: auto;
      background: white;
      padding: 30px 20px;
      border-radius: 8px;
      box-shadow: 0px 0px 10px #ccc;
      position: relative;
      margin-top: 25px;
      margin-left: 30%;
      margin-bottom: 25px;
      margin-left: 37%;
    }
    input, select, button {
      width: 90%;
      margin-top: 5px;
      padding: 8px;
    }
    label {
      font: weight h 3px;;
    }
    button {
            width: 100%;
            padding: 10px;
            background:green;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background: #4CAF50;

            
        }


        /* media query */
        @media (max-width: 600px) {
  .first {
    width: 90%;
    margin-left: auto;
    margin-right: auto;
    margin-top: 20px;
    padding: 20px 15px;
  }

  input, select, button {
    width: 100%;
    font-size: 14px;
  }

  label {
    font-size: 14px;
  }

  button {
    padding: 10px;
    font-size: 15px;
  }
}



        /* footer */
footer {
      background-color: #1d1d30;
      color: #fff;
      padding: 20px 0;
      /* text-align: center; */
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

      .contact-form {
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

<body>
  <nav class="navbar navbar-expand-lg bg-black text-white">
    <div class="container-fluid">
      <a class="navbar-brand text-white fs-2 text" href="#">Kolhapur</a>
      
      <button2 class="navbar-toggler bg-white"  type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button2>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup" >
        <div class="navbar-nav ">
          <a class="nav-link  text-white fs-4 text" href="#">Ride</a>
          <a class="nav-link  text-white fs-4 text" href="#">Drive</a>
          <a class="nav-link  text-white fs-4 text" href="#">Business</a>
          <a class="nav-link  text-white fs-4 text" href="#">Services</a>
        </div>
      </div>
    </div>
  </nav>
<div class="first">

  <!-- Car Brand -->
  <form id="dlForm" action="rcbook.php" method="post">

   <!-- display -->
  <p><strong>First Name:</strong> <?php echo htmlspecialchars($firstname); ?></p>
  <p><strong>Last Name:</strong> <?php echo htmlspecialchars($lastname); ?></p>
  <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
  <p><strong>Mobile No:</strong> <?php echo htmlspecialchars($mobileno); ?></p>
  <img src="<?php echo $idimage; ?>" alt="Preview" style="max-width:300px;"><br><br>
 
 

  <p><strong>Aadhaar No:</strong> <?php echo htmlspecialchars($aadhar_number); ?></p>
 
<p><strong>Aadhaar Photo:</strong></p>
<img src="<?php echo htmlspecialchars($aadhaar_image); ?>" alt="aadhaar_image" width="150">

<p><strong>pan no:</strong> <?php echo htmlspecialchars($pan_number); ?></p>

<p><strong>pan Photo:</strong></p>
<img src="<?php echo htmlspecialchars($pan_image); ?>" alt="pan_image" width="150">

<p><strong>Driving License no:</strong> <?php echo htmlspecialchars($dlNumber); ?></p>

<p><strong>dlFile:</strong></p>
<img src="<?php echo htmlspecialchars($destination); ?>" alt="image " width="150">

<!-- Hidden fields to persist data -->
<input type="hidden" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>">
  <input type="hidden" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>">
  <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
  <input type="hidden" name="mobileno" value="<?php echo htmlspecialchars($mobileno); ?>">
  <input type="hidden" name="idimage" value="<?php echo htmlspecialchars($idimage); ?>">
  <input type="hidden" name="aadhaar_number" value="<?php echo htmlspecialchars($aadhar_number); ?>">
  <input type="hidden" name="aadhaar_image" value="<?php echo htmlspecialchars($aadhaar_image); ?>">
  <input type="hidden" name="pan_image" value="<?php echo htmlspecialchars($pan_image); ?>">
  <input type="hidden" name="pan_number" value="<?php echo htmlspecialchars($pan_number); ?>">
  <input type="hidden" name="dlNumber" value="<?php echo htmlspecialchars($dlNumber); ?>">
  <input type="hidden" name="dl_image" value="<?php echo htmlspecialchars($destination); ?>">

        
  <label for="cars">Choose a car brand:</label>
  <select id="cars" onchange="showOtherInput('cars', 'otherCarInput')" required>
    <option value="tata">TATA</option>
    <option value="mahindra">Mahindra</option>
    <option value="maruti">Maruti Suzuki</option>
    <option value="toyota">Toyota</option>
    <option value="other">Other</option>
  </select>
  <input type="text" id="otherCarInput" placeholder="Please specify brand" style="display: none;">
  <br><br>

  <!-- Car Model -->
  <label for="carName">Enter car model:</label>
  <input type="text" id="carName" placeholder="e.g. Innova" required><br><br>

  <!-- Vehicle Number -->
  <label for="vehicle">Vehicle number:</label>
  <input type="text" id="vehicle" placeholder="MH09AA0000" required><br><br>

  <!-- Vehicle Type -->
  <label for="vehicleType">Vehicle Type:</label>
  <select id="vehicleType" onchange="showOtherInput('vehicleType', 'otherVehicleTypeInput')">
    <option value="petrol">Petrol</option>
    <option value="diesel">Diesel</option>
    <option value="cng">CNG</option>
    <option value="electric">Electric</option>
    <option value="other">Other</option>
  </select>
  <input type="text" id="otherVehicleTypeInput" placeholder="Enter vehicle type" style="display: none;">
  <br><br>

  <!-- Passenger Capacity -->
  <label for="passengerCapacity">Passenger Capacity:</label>
  <select id="passengerCapacity" onchange="showOtherInput('passengerCapacity', 'otherPassengerInput')">
    <option value="4">4 seater</option>
    <option value="7">7 seater</option>
    <option value="9">9 seater</option>
    <option value="other">Other</option>
  </select>
  <input type="text" id="otherPassengerInput" placeholder="Enter capacity" style="display: none;">
  <br><br>

  <!-- Next Page Button -->
  <button onclick="goToNextPage()">Next Page</button>

</div>


<!--footer -->
<footer>
  <div class="footer-container">

    <div class="footer-section">


      <h3>LINKS</h3>
      <ul>
        <li><a href="index.html">Ride</a></li>
        <li><a href="index.html?#course">Drive</a></li>
        <li><a href="ContactUs.html">Business</a></li>
        <li><a href="AboutUs.html">Services</a></li>
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
      <p>📞 9922904252</p>
      <p>📧 qweeztechnology@gmail.com</p>
      <p>📍 Dist-Kolhapur</p>
    </div>
    <div class="footer-section-1">
      <h3>FOLLOW US</h3>
      <div class="footer-icons">
        <a href="#"><img src="facebook.jpg" style="width: 30px; height: 30px;"></a>
        <a href="#"><img src="instgram.jpg" style="height: 30px; height: 30px;"></a>
        <a href="#"><img src="youtube.jpg" style="height: 30px; width: 30px;"></a>
      </div>
      <div style="margin-top: 15px;">
        <a href="#" style="color: #fff; margin: 0 10px; text-decoration: none; font-size: 24px;">
          <i class="fab fa-facebook"></i>
        </a>
        <a href="#" style="color: #fff; margin: 0 10px; text-decoration: none; font-size: 24px;">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="#" style="color: #fff; margin: 0 10px; text-decoration: none; font-size: 24px;">
          <i class="fab fa-youtube"></i>
        </a>
      </div>
    </div>
  </div>
</footer>
<script>
  function showOtherInput(selectId, inputId) {
    const select = document.getElementById(selectId);
    const input = document.getElementById(inputId);

    if (select.value === "other") {
      input.style.display = "inline";
    } else {
      input.style.display = "none";
    }
  }

  function goToNextPage() {
    // Optional: Add form validation here before redirecting
    window.location.href = "rcbook.html"; // Change to your actual next page URL
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>


</html>
