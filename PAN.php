


<?php
// Get previous form data
// $firstname = $_POST['firstname'] ?? '';
// $lastname = $_POST['lastname'] ?? '';
// $email = $_POST['email'] ?? '';
// $mobileno = $_POST['mobileno'] ?? '';
// $aadhar_number = $_POST['aadhar_number'] ?? ''; // from page3 input


// File handling directory
// $upload_dir = "uploads/";
// $photo_path = '';
// $aadhar_photo_path = '';



// if (!is_dir($upload_dir)) {
//   mkdir($upload_dir, 0777, true);
// }

// Initialize variables to hold file paths


// $photo_path = '';
// $aadhar_photo_path = '';


// $error = "";

// Handle file uploads
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//   if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
//       $photo_path = $upload_dir . uniqid('user_') . "_" . basename($_FILES['photo']['name']);
//       move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path);
//   }

//   if (isset($_FILES['aadhar_photo']) && $_FILES['aadhar_photo']['error'] === UPLOAD_ERR_OK) {
//       $aadhar_photo_path = $upload_dir . uniqid('aadhar_') . "_" . basename($_FILES['aadhar_photo']['name']);
//       move_uploaded_file($_FILES['aadhar_photo']['tmp_name'], $aadhar_photo_path);
//   }

// }

// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// // Add this inside your current page
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//   echo "<pre>";
//   print_r($_POST);
//   print_r($_FILES);
//   echo "</pre>";
// }
// if (move_uploaded_file(...)) {
//   echo "Uploaded successfully<br>";
// } else {
//   echo "Upload failed<br>";
// }
// if (file_exists($photo_path)) {
//   echo "<img src='$photo_path'>";
// } else {
//   echo "Image not found: $photo_path";
// }
// // $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
// // if (!in_array($_FILES['photo']['type'], $allowed_types)) {
// //     $error .= "Invalid user photo type.<br>";
// // }


// ?>

<?php

session_start();
// ✅ If user is not logged in, redirect
if (!isset($_SESSION['userid'])) {
    header("Location:/Kolhapur/index/index.html");
    exit;
}


// Safely get the POST data

$firstname = $_POST['firstname'] ?? '';
$lastname = $_POST['lastname'] ?? '';
$email = $_POST['email'] ?? '';
$mobileno = $_POST['mobileno'] ?? '';
$idimage = $_POST['idimage'] ?? '';
$aadhar_number = $_POST['aadhaar_number'] ?? '';
// Aadhar validation (optional for this page)
// $error = '';
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if (!preg_match("/^\d{12}$/", $aadhar_no)) {
//         $error = "Invalid Aadhar number. It must be exactly 12 digits.";
//     }
// }
// $aadhar_photo_path =$_POST['aadhaar_image'] ?? '';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['aadhaar_image'])) {


  $tmpName = $_FILES['aadhaar_image']['tmp_name'];
  $fileName = basename($_FILES['aadhaar_image']['name']);
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
  <title>PAN Card</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<title>PAN Card Verification</title>
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
      height: 400px;

      margin: auto;
      background: white;
      padding: 20px;
      border-radius: 8px;
     box-shadow:0 0 8px #efa111;
      position: relative;
      margin-top: 50px;
      /* margin-left: 40%; */
      margin-bottom: 25px;
  }

  form {
    margin-top: 5%;
  }

  h2 {
    text-align: center;
    font-weight:bold;
  }

  label {
    font-weight: bold;
  }

  input,
  select {
    width: 100%;
    padding: 8px;
    margin: 5px 0 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  button {
     width: 100%;
      padding: 10px;
      background:#EFA111;
      color: white;
      border: none;
      cursor: pointer;
      border-radius: 4px;
  }



  /* media */
  /* Responsive Design */
  @media (max-width: 768px) {
    .container {
      width: 90%;
      padding: 15px;
    }

    h2 {
      font-size: 22px;
    }

    button {
      font-size: 16px;
      padding: 8px;
    }

    #previewImage {
      width: 100%;
      height: auto;
    }
  }

  @media (max-width: 480px) {
    .container {
      width: 95%;
      padding: 10px;
    }

    input,
    select {
      font-size: 14px;
    }

    button {
      font-size: 14px;
    }

    h2 {
      font-size: 20px;
    }

    h3 {
      font-size: 16px;
    }
  }

/*  */
  footer{
    background-color: #EFA111;
    color: #fff;
    padding: 20px 0;
    /* text-align: center; */
    font-sizef: 16px;
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
    <h2>PAN Card Verification</h2>
    <form class='contact-form' action="licence.php" method="post" enctype="multipart/form-data">
      <!-- Hidden fields to persist data -->
      <input type="hidden" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>">
      <input type="hidden" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>">
      <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
      <input type="hidden" name="mobileno" value="<?php echo htmlspecialchars($mobileno); ?>">
      <input type="hidden" name="idimage" value="<?php echo htmlspecialchars($idimage); ?>">
      <input type="hidden" name="aadhaar_number" value="<?php echo htmlspecialchars($aadhar_number); ?>">
      <input type="hidden" name="aadhaar_image" value="<?php echo htmlspecialchars($destination); ?>">

      <!-- display -->
      <!-- <p><strong>First Name:</strong> <?php echo htmlspecialchars($firstname); ?></p>
      <p><strong>Last Name:</strong> <?php echo htmlspecialchars($lastname); ?></p>
      <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
      <p><strong>Mobile No:</strong> <?php echo htmlspecialchars($mobileno); ?></p>
      <img src="<?php echo $idimage; ?>" alt="Preview" style="max-width:300px;"><br><br>

      <p><strong>Aadhaar No:</strong> <?php echo htmlspecialchars($aadhar_number); ?></p>

      <p><strong>Aadhaar Photo:</strong></p>
      <img src="<?php echo htmlspecialchars($destination); ?>" alt="aadhaar_image" width="150">
 -->

      <label for="userPAN">PAN Card Number</label>
      <input type="text" id="userPAN" name="pan_number" placeholder="Enter PAN Number" maxlength="10" required>

      <input type="file" id="imageInput" name="pan_image" accept="image/*" required>

      <button type="button" id="extractBtn">Verify PAN</button>

      <img id="previewImage" src="" alt="" style="display: none; width:200px; height: 100px;" />
      <p id="loading" style="display: none;color:#333333">Extracting text, please wait...</p>
      <h3 style="color:#333333">Extracted PAN Number:<span id="panResult">Not Extracted</span></h3>
      <p id="matchResult"></p>
      <button>Next </button>
      <input type="hidden" id="extracted_pan" name="extracted_pan" value="">
      <input type="hidden" id="extracted_pan" name="extracted_pan" value="">


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

    document.getElementById('extractBtn').addEventListener('click', async function () {
      const fileInput = document.getElementById('imageInput');
      const userPANInput = document.getElementById('userPAN');
      const previewImage = document.getElementById('previewImage');
      const panResult = document.getElementById('panResult');
      const matchResult = document.getElementById('matchResult');
      const loadingText = document.getElementById('loading');

      if (fileInput.files.length === 0) {
        alert("Please upload a PAN card image.");
        return;
      }

      if (!userPANInput.value.match(/^[A-Z]{5}[0-9]{4}[A-Z]$/)) {
        alert("Please enter a valid PAN number (e.g., ABCDE1234F). ");
        return;
      }

      const userPAN = userPANInput.value.trim();
      const imageFile = fileInput.files[0];
      const reader = new FileReader();

      reader.onload = async function (event) {
        const image = event.target.result;
        previewImage.src = image;
        previewImage.style.display = 'block';
        loadingText.style.display = 'block';
        panResult.textContent = "Extracting...";

        try {
          const result = await Tesseract.recognize(image, 'eng', {
            logger: (m) => console.log(m),
          });

          console.log("Extracted Text:", result.data.text);
          const panPattern = /([A-Z]{5}[0-9]{4}[A-Z])/g;
          const matches = result.data.text.match(panPattern);

          if (matches) {
            const extractedPAN = matches[0];
            panResult.textContent = extractedPAN;

            if (extractedPAN === userPAN) {
              matchResult.textContent = "✅ PAN Number Matched!";
              matchResult.style.color = "green";
            } else {
              matchResult.textContent = "❌ PAN Number Does Not Match!";

              matchResult.style.color = "red";
            }
          } else {
            panResult.textContent = "Not Found";
            matchResult.textContent = "❌ PAN Number Could Not Be Extracted";
            matchResult.style.color = "red";
          }
        } catch (error) {
          console.error("OCR Error:", error);
          panResult.textContent = "Error Extracting Text";
          matchResult.textContent = "❌ Error Occurred During Processing";
          matchResult.style.color = "red";
        }

        loadingText.style.display = 'none';
      };

      reader.readAsDataURL(imageFile);
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/tesseract.js@4.0.2/dist/tesseract.min.js"></script>



</body>

<script>
    function toggleMenu() {
      const navList = document.getElementById('navList');
      navList.classList.toggle('show');
    }

    
  </script>

</html>