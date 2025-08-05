
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
$idimage = $_POST['idimage']?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['photo'])) {


  $tmpName = $_FILES['photo']['tmp_name'];
  $fileName = basename($_FILES['photo']['name']);
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

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aadhar Card</title>
  

    
  <style>
  

 /* Add your header and nav CSS here */

 /* body */

    body {
    margin: 0;
    font-family: 'Roboto', sans-serif;
    background-color: white;
    /* color: black; */
  }

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

    .photo {
      position: absolute;
      top: 20px;
      right: 20px;
      width: 100px;
      height: 120px;
      border: 1px solid #000;
      background: #ddd;
      text-align: center;
      line-height: 120px;
      font-size: 12px;
      color: #666;
    }

    form {
      margin-top: 5%;
    }

    h2 {
      text-align: center;
      color:#333333;
    }

    hr {
      margin-top: 5%;
    }

    h1 {
      text-align: center;
    }

    label {
      font-weight: bold;
      color:#333333;
    }

    input,
    select {
      width: 95%;
      padding: 8px;
      margin: 5px 0 10px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
      /* display: flex; */

    }

    input[type='radio'] {
      display: inline;
    }

    .gender input {
      width: auto;
    }

    .status input {
      width: auto;
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

    



   /* media query */
    
@media (max-width: 768px) {
  .container {
    width: 90%;
    margin-left: auto;
    margin-right: auto;
  }

  #previewImage {
    width: 100%;
    height: auto;
  }
    button {
  width: 99%;
}
}

@media (max-width: 480px) {
  .container {
    padding: 15px;
    border-radius: 6px;
    
    margin-top: 15px;
    margin-bottom: 15px;
  }

  h2 {
    font-size: 1.2rem;
  }

  input[type="text"], input[type="file"], button {
    width: 100%;
    margin-bottom: 10px;
  }

  #aadhaarResult {
    font-size: 1rem;
  }

  button a {
    display: inline-block;
    width: 100%;
    text-align: center;
    padding: 10px 0;
    text-decoration: none;
    color: white;
    background: #007bff;
    border-radius: 5px;
  }

  #loading {
    font-size: 0.9rem;
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
   


    <h2>Aadhaar Card Verification</h2>
    <form action="PAN.php" method="post"  enctype="multipart/form-data" >
       <!-- Hidden fields to pass previous data -->
  <input type="hidden" name="firstname" value="<?php echo htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8'); ?>">
    <input type="hidden" name="lastname" value="<?php echo htmlspecialchars($lastname, ENT_QUOTES, 'UTF-8'); ?>">
    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>">
    <input type="hidden" name="mobileno" value="<?php echo htmlspecialchars($mobileno, ENT_QUOTES, 'UTF-8'); ?>">
    <input type="hidden" name="idimage" value="<?php echo htmlspecialchars($idimage); ?>">


    <!--Display submitted data -->
    <!-- <div class="info-display">
        <p>First Name: <?php echo htmlspecialchars($firstname); ?></p>
        <p>Last Name: <?php echo htmlspecialchars($lastname); ?></p>
        <p>Email ID: <?php echo htmlspecialchars($email); ?></p>
        <p>Mobile No: <?php echo htmlspecialchars($mobileno); ?></p>
        <img src="<?php echo $idimage; ?>" alt="Preview" style="max-width:300px;"><br><br>
 
    </div> -->
<!--   
  <input type="file" name="file" />
  <input type="submit" value="Upload"/>
<label>Aadhaar Card Number:</label>
      <input type="text" id="userAadhaar" name="aadhaar_number" placeholder="Enter Aadhaar Number" maxlength="16">
      <input type="file" id="imageInput" name="aadhaar_image" accept="image/*" />
      <button type="button" id="extractBtn">Verify Aadhaar</button>

      <img id="previewImage" src="" alt="" style="display: none; width:200px; height: 400px;" />
      <p id="loading">Extracting text, please wait...</p>
      <h3>Extracted Aadhaar Number: <span id="aadhaarResult">Not Extracted</span></h3>
      <p id="matchResult"></p> -->

 <!-- Aadhaar Card Section  -->
<label>Aadhaar Card Number</label>
<input type="text" id="userAadhaar" name="aadhaar_number" placeholder="Enter Aadhaar Number" maxlength="16">
<input type="file" id="imageInput" name="aadhaar_image" accept="image/*" />
<button type="button" id="extractBtn">Verify Aadhaar</button>
    
<img id="previewImage" src="" alt="" style="display: none; width:200px; height: 400px; color:#333333" />
<p id="loading" style="display: none; color:#333333">Extracting text, please wait...</p>
<h3 style="color:#333333">Extracted Aadhaar Number: <span id="aadhaarResult">Not Extracted</span></h3>
<p id="matchResult"></p> 

<button type="submit">Next</button> 

      

  </form>  
  </div>
</center>
  </body>

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









<!-- JavaScript to prevent null error -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const extractBtn = document.getElementById("extractBtn");
    const imageInput = document.getElementById("imageInput");
    const previewImage = document.getElementById("previewImage");
    const loadingText = document.getElementById("loading");
    const aadhaarResult = document.getElementById("aadhaarResult");
    const matchResult = document.getElementById("matchResult");

    if (extractBtn) {
        extractBtn.addEventListener("click", function () {
            const file = imageInput.files[0];
            if (!file) {
                alert("Please upload an Aadhaar image.");
                return;
            }

            previewImage.src = URL.createObjectURL(file);
            previewImage.style.display = "block";
            loadingText.style.display = "block";

            // Simulate OCR extraction (replace with real logic)
            setTimeout(() => {
                const dummyExtractedNumber = "123456789012";
                aadhaarResult.textContent = dummyExtractedNumber;

                const userInput = document.getElementById("userAadhaar").value;
                matchResult.innerText = (userInput === dummyExtractedNumber)
                    ? "✅ Aadhaar number matches!"
                    : "❌ Aadhaar number does not match.";

                loadingText.style.display = "none";
            }, 2000);
        });
    }
  });


    function previewImage(event) {

      const hidden = document.getElementById('image');
      const reader = new FileReader();
      reader.onload = function () {
        const img = document.getElementById('preview');
        img.src = reader.result;
        img.style.display = 'block';
        hidden.style.display = 'none';

      }
      reader.readAsDataURL(event.target.files[0]);
    }

    document.querySelector('.contact-form').addEventListener('submit', function (e) {
      e.preventDefault();

      if (!isOtpVerified) {
        // alert('Please verify the Email');
        return;
      }

      const matchResult = document.getElementById('matchResult').textContent;
      if (matchResult !== "✅ Aadhaar Number Matched!") {
        alert("Aadhaar number does not match! Please verify before submitting.");
        return;
      }

      const formData = new FormData(this);
      formData.append('insert', 'true'); // Required for PHP validation

      const imageFile = document.getElementById('image').files[0];
      if (imageFile) {
        formData.append('photo', imageFile); // Append image file to FormData
      }

      fetch('submit2.php', {
        method: 'POST',
        body: formData
      })
        .then(response => response.text())
        .then(result => {
          console.log('Server response:', result);

          if (result === 'success') {
            alert('Message sent successfully!');
            document.querySelector('.contact-form').reset();
            // Redirect to the online_payment/QR_payment folder after successful admission
            window.location.href = "online_payment/QR_payment/";
          } else if (result === 'duplicate_aadhaar') {
            alert('Already registered with this Aadhaar number.');
          } else if (result === 'db_error') {
            alert('Error saving data to database.');
          } else if (result === 'invalid_request') {
            alert('Invalid request.');
          } else {
            alert('Submitted successfully.');
            document.querySelector('.contact-form').reset();
            // Redirect to the online_payment/QR_payment folder after successful admission
            window.location.href = "online_payment/QR_payment/";
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('An unexpected error occurred.');
        });
    });

    document.getElementById('extractBtn').addEventListener('click', async function () {
      const fileInput = document.getElementById('imageInput');
      const userAadhaarInput = document.getElementById('userAadhaar');
      const previewImage = document.getElementById('previewImage');
      const aadhaarResult = document.getElementById('aadhaarResult');
      const matchResult = document.getElementById('matchResult');
      const loadingText = document.getElementById('loading');

      if (fileInput.files.length === 0) {
        alert("Please upload an Aadhaar card image.");
        return;
      }

      if (!userAadhaarInput.value.match(/^\d{12}$/)) {
        alert("Please enter a valid 12-digit Aadhaar number.");
        return;
      }

      const userAadhaar = userAadhaarInput.value.trim();
      const imageFile = fileInput.files[0];
      const reader = new FileReader();

      reader.onload = async function (event) {
        const image = event.target.result;
        previewImage.src = image;
        previewImage.style.display = 'block';
        loadingText.style.display = 'block';
        aadhaarResult.textContent = "Extracting...";

        try {
          const result = await Tesseract.recognize(image, 'eng', {
            logger: (m) => console.log(m),  // Log progress
          });

          console.log("Extracted Text:", result.data.text);

          // Aadhaar Number Regex
          const aadhaarPattern = /(\d{4}[\s\-]?\d{4}[\s\-]?\d{4})/g;
          const matches = result.data.text.match(aadhaarPattern);

          if (matches) {
            const extractedAadhaar = matches[0].replace(/\D/g, ''); // Remove non-numeric characters
            aadhaarResult.textContent = extractedAadhaar;

            // Match with user input
            if (extractedAadhaar === userAadhaar) {
              matchResult.textContent = "✅ Aadhaar Number Matched!";
              matchResult.style.color = "green";
            } else {
              matchResult.textContent = "❌ Aadhaar Number Does Not Match!";
              matchResult.style.color = "red";
            }

          } else {
            aadhaarResult.textContent = "Not Found";
            matchResult.textContent = "❌ Aadhaar Number Could Not Be Extracted";
            matchResult.style.color = "red";
          }

        } catch (error) {
          console.error("OCR Error:", error);
          aadhaarResult.textContent = "Error Extracting Text";
          matchResult.textContent = "❌ Error Occurred During Processing";
          matchResult.style.color = "red";
        }

        loadingText.style.display = 'none';
      };

      reader.readAsDataURL(imageFile);
    });



    // Function to Preview Image Before Upload
    function previewImage(event) {
      const hidden = document.getElementById('image');
      const reader = new FileReader();

      reader.onload = function () {
        const preview = document.getElementById('preview');
        preview.src = reader.result;
        preview.style.display = 'block';
        hidden.style.display = 'none';
      };

      reader.readAsDataURL(event.target.files[0]);
    }
    document.getElementById('submitBtn').addEventListener('click', function(){
      alert("Button clicked!"));
    document.getElementById('submitBtn').addEventListener('click', function() {
    alert("Button clicked!");
  });
</script>





<script>
    function toggleMenu() {
      const navList = document.getElementById('navList');
      navList.classList.toggle('show');
    }

    
  </script>

</html>