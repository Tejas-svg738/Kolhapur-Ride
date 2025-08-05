<?php
session_start();
// ✅ If user is not logged in, redirect
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courier</title>
    <link rel="Stylesheet" href="Courier.css">
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



  </style>
    
</head>
<header>
  <h1><a  style="color: white; text-decoration: none;">Kolhapur</a></h1>
  <button class="menu-toggle" onclick="toggleMenu()">☰</button>
  <nav>
    <ul id="navList">
      
      <li><a href="/Kolhapur/Ride/ride.php">Ride</a></li>
      <li><a href="/Kolhapur/Driver/test/firstpage.php">Drive</a></li>
      <li><a href="/Kolhapur/Business/business.php">Business</a></li>
      <li><a href="/Kolhapur/Services/services.php">Services</a></li>
      <li><a href="/Kolhapur/Ride/Courier.php">Courier</a></li>
      
      
    
       <?php if (isset($_SESSION['user_id'])): ?>
        <li class="dropdown">
          <a href="#"><?php echo htmlspecialchars($_SESSION['name']); ?> </a>
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
  

<body>
   
    <section>
        
        <div class="img">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d122283.79400671698!2d74.15646588457898!3d16.708452233396038!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc1000cdec07a29%3A0xece8ea642952e42f!2sKolhapur%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1740820107091!5m2!1sen!2sin" 
            width="800" height="550" style="border:1PX solid black;" 
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="location">
            <h2>Send Your Courier Anywhere</h2>   
            <h3>Parcel Reach to Destination just like Rocket!!!</h3>
            <input type="text" placeholder="Enter Your Pickup Point"><br><br>
            <input type="text" placeholder="Enter Your Destination"><br><br>
           
            <form>
                <table>
                    <tr>
                        <td><input type="date" id="datePicker" /> </td>
                         <td>  <input type="time" id="timePicker" /></td>
                         
                    </tr>
                    
                    
                </table>
            
            </form>
    
    
            <button id="openModalBtn">Courier Info</button>
    
    <!-- Modal Structure -->
    <div id="passengerModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h4 id="pass1">Courier Information</h4>
            <form id="passengerForm">
                <label for="passengerName">Full Name</label>
                <input type="text" id="passengerName" required>
    
                <label for="passengerEmail">Email</label>
                <input type="email" id="passengerEmail" required>
    
                <label for="passengerPhone">Phone Number</label>
                <input type="tel" id="passengerPhone" required>
                
                <label for="NumberofPassengers"> Number of Item</label>
                <input type="number" id="NumberofPassengers">
                
    
                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>
    
    <script>
        // script.js
    
    // Get modal elements
    const modal = document.getElementById("passengerModal");
    const openModalBtn = document.getElementById("openModalBtn");
    const closeModalBtn = document.querySelector(".close-btn");
    
    // Open modal when clicking the button
    openModalBtn.addEventListener("click", () => {
    modal.style.display = "flex";
    });
    
    // Close modal when clicking the close button
    closeModalBtn.addEventListener("click", () => {
    modal.style.display = "none";
    });
    
    // Close modal when clicking outside the modal content
    window.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.style.display = "none";
    }
    });
    
    // Handle form submission
    document.getElementById("passengerForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    let name = document.getElementById("passengerName").value;
    let email = document.getElementById("passengerEmail").value;
    let phone = document.getElementById("passengerPhone").value;
    
    console.log("Passenger Info:", { name, email, phone });
    
    // Close modal after submission
    modal.style.display = "none";
    
    // Reset form
    this.reset();
    });
    
    </script>
            
        
        
        <div id="confirmation-message"></div>
    </div>
    
        <div class="btns">
    
            <button type="submit" id="btn">Request Now</button>
            <button id="btnn">Schedule later</button>
           
            
            
        </div>
        
        
        
     <script>
        
        function updateDateTimeLimits() {
            const now = new Date();  // Get the current date and time
            
            // Format Date (YYYY-MM-DD)
            const minDate = now.toISOString().split("T")[0];  
            document.getElementById("datePicker").min = minDate;
        
            // Format Time (HH:MM) - Only applies if today is selected
            const datePicker = document.getElementById("datePicker");
            const timePicker = document.getElementById("timePicker");
        
            datePicker.addEventListener("change", function() {
                if (this.value === minDate) { // If today is selected
                    const minTime = now.toTimeString().slice(0, 5); // Get HH:MM format
                    timePicker.min = minTime; // Restrict past times
                } else {
                    timePicker.min = "00:00"; // Reset min time for future dates
                }
            });
        }
        
        function updateTime() {
            const now = new Date();
            const options = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
            document.getElementById('current-time').innerText = now.toLocaleTimeString([], options);
        }
        
        document.getElementById('btn').addEventListener('click', function() {
            const bookingDate = document.getElementById('datePicker').value;
            const bookingTime = document.getElementById('timePicker').value;
            
            if (bookingDate && bookingTime) {
                const bookingDateTime = new Date(`${bookingDate}T${bookingTime}`);
                document.getElementById('confirmation-message').innerText = `Cab booked for ${bookingDateTime.toLocaleString()}`;
            } else {
                document.getElementById('confirmation-message').innerText = 'Please select a booking date and time.';
            }
        });
        
        // Initialize the date and time limits
        updateDateTimeLimits();
        setInterval(updateDateTimeLimits, 60000); // Update every minute
        
        // Update time every second
        setInterval(updateTime, 1000);
        updateTime(); // Initial call to display time immediately
    </script>
    </section>

    <script>
    function toggleMenu() {
      const navList = document.getElementById('navList');
      navList.classList.toggle('show');
    }

    
  </script>
    
</body>
</html>