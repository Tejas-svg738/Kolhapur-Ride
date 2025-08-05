<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$dbname = "qweez";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error variable
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_POST['username'];
    $password_input = $_POST['password'];

    // Query to check user credentials
    // Using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM drivedatabase WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $userid, $password_input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $userData = $result->fetch_assoc();
        $_SESSION['user'] = $userData; // Store all user data in session
        header("Location: drivermain.php"); // Redirect to PHP version
        exit();
    } else {
        $error = "Invalid username or password.";
    }
    $stmt->close(); // Close the statement
}
$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Login</title>
    <!-- Google Fonts - Inter for a modern look -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for social icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Basic Reset & Body Styling */
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5; /* Light background */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden; /* Prevent scroll if content overflows slightly */
        }

        /* Main Login Container */
        .login-container {
            display: flex;
            width: 90%; /* Responsive width */
            max-width: 800px; /* Max width for larger screens */
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden; /* Ensures rounded corners apply to children */
            min-height: 500px; /* Minimum height for the container */
        }

        /* Left Panel (Login Form) */
        .login-panel {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-color: #ffffff;
            position: relative; /* For error message positioning */
        }

        .login-panel h2 {
            font-size: 2.2em;
            font-weight: 700;
            color: #333;
            margin-bottom: 30px;
        }

        /* Social Icons */
        .social-icons {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }

        .social-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 1px solid #e0e0e0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.2em;
            color: #555;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .social-icon:hover {
            border-color: #efa111;
            color: #efa111;
            box-shadow: 0 0 10px rgba(239, 161, 17, 0.3);
        }

        /* Form Styling */
        .login-panel form {
            width: 100%;
            max-width: 300px; /* Limit form width */
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group input {
            width: calc(100% - 24px); /* Account for padding */
            padding: 12px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1em;
            color: #333;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            outline: none;
        }

        .input-group input::placeholder {
            color: #aaa;
        }

        .input-group input:focus {
            border-color: #efa111;
            box-shadow: 0 0 8px rgba(239, 161, 17, 0.2);
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: #efa111;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 5px 15px rgba(239, 161, 17, 0.3);
        }

        .btn:hover {
            background-color: #e0920a;
            transform: translateY(-2px);
        }

        .forgot-password, .register-link {
            margin-top: 20px;
            font-size: 0.9em;
            color: #555;
        }

        .forgot-password a, .register-link a {
            color: #efa111;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover, .register-link a:hover {
            color: #e0920a;
            text-decoration: underline;
        }

        /* Error Message */
        .error {
            color: #ff4d4d;
            margin-top: 15px;
            font-size: 0.9em;
            font-weight: 500;
        }

        /* Right Panel (Welcome Message) */
        .welcome-panel {
            flex: 1;
            background-color: #efa111; /* Orange color from the GIF */
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #fff;
        }

        .welcome-panel h2 {
            font-size: 2.5em;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .welcome-panel p {
            font-size: 1.1em;
            margin-bottom: 30px;
            font-weight: 300;
        }

        .welcome-panel .btn  {
            background-color: #fff;
            color: #efa111;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

         .welcome-panel .btn a{
            color:#333333;
            text-decoration:none;
         }

        .welcome-panel .btn:hover {
            background-color: #f0f0f0;
            color: #e0920a;
            transform: translateY(-2px);
        }



        /* Responsive adjustments */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                width: 95%;
                min-height: auto; /* Allow height to adjust */
            }

            .login-panel, .welcome-panel {
                padding: 30px;
            }

            .login-panel h2 {
                font-size: 1.8em;
            }

            .welcome-panel h2 {
                font-size: 2em;
            }
        }

        @media (max-width: 480px) {
            .login-panel, .welcome-panel {
                padding: 20px;
            }

            .login-panel h2 {
                font-size: 1.5em;
            }

            .welcome-panel h2 {
                font-size: 1.8em;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Left Panel: Login Form -->
        <div class="login-panel">
            <h2>Driver Login</h2>
            <div class="social-icons">
                <div class="social-icon"><i class="fab fa-facebook-f"></i></div>
                <div class="social-icon"><i class="fab fa-google"></i></div>
                
            </div>
            <form method="POST">
                <div class="input-group">
                    <input type="text" name="username" required placeholder="Username">
                </div>
                <div class="input-group">
                    <input type="password" name="password" required placeholder="Password">
                </div>
                <button type="submit" class="btn">SIGN IN</button>
            </form>
            
            <div class="register-link">
                <p>Don't have an account? <a href="/Kolhapur/Driver/test/SignUp1.php">Register</a></p>
            </div>
            <?php if (!empty($error)) : ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
        </div>

        <!-- Right Panel: Welcome Message -->
        <div class="welcome-panel">
            <h2>Welcome To <br>Kolhapur Ride</h2>
            <p>New Here?</p>
            <button type="button" class="btn">
                <a href="/Kolhapur/Driver/test/SignUp1.php">
                SIGN UP</a></button>
        </div>
    </div>
</body>

</html>
