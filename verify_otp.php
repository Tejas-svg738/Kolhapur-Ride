<?php
session_start();
include 'db.php'; // Assuming db.php contains your database connection logic

$message = ''; // Feedback message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entered_otp_raw = $_POST['otp'] ?? '';
    // Combine individual OTP digits if submitted as separate inputs (as in the new design)
    if (isset($_POST['digit1']) && isset($_POST['digit2']) && isset($_POST['digit3']) && isset($_POST['digit4']) && isset($_POST['digit5']) && isset($_POST['digit6'])) {
        $entered_otp = $_POST['digit1'] . $_POST['digit2'] . $_POST['digit3'] . $_POST['digit4'] . $_POST['digit5'] . $_POST['digit6'];
    } else {
        $entered_otp = $entered_otp_raw; // Fallback if old input is used
    }

    $session_data = $_SESSION['user_data'] ?? null;

    if ($session_data) {
        $original_otp = $session_data['otp'];

        if ($entered_otp == $original_otp) {
            // OTP verified, insert into DB
            $userid = $session_data['userid'];
            $name = $session_data['name'];
            $mobile = $session_data['mobile'];
            $email = $session_data['email'];
            $password = $session_data['password'];

            // Check if email already registered
            $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $check->bind_param("s", $email);
            $check->execute();
            $check->store_result();

            if ($check->num_rows > 0) {
                $message = "⚠️ This email is already registered.";
            } else {
                $stmt = $conn->prepare("INSERT INTO users (userid, name, mobile, email, password, is_verified) VALUES (?, ?, ?, ?, ?, 1)");
                $stmt->bind_param("sssss", $userid, $name, $mobile, $email, $password);

                if ($stmt->execute()) {
                    unset($_SESSION['user_data']);
                    $message = "✅ Registration successful! <a href='login.html'>Click here to Login</a>";
                } else {
                    $message = "❌ Registration failed. Try again.";
                }
            }
        } else {
            $message = "❌ Incorrect OTP. Please try again.";
        }
    } else {
        $message = "❌ Session expired. Please register again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            /* background-color: #fcefdc; */
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .otp-wrapper {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            /* box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); */
            width: 100%;
            max-width: 450px; /* Adjusted to fit the design better */
            text-align: center;
            position: relative;
             box-shadow:0 0 8px #efa111;
        }

        .close-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            font-size: 1.5em;
            color: #ccc;
            cursor: pointer;
        }
        .close-button:hover {
            color: #888;
        }

        .header-icon {
            margin-bottom: 30px;
            position: relative;
            display: inline-block; /* To contain the key icon */
        }
        .header-icon img {
            width: 120px; /* Adjust envelope size */
            height: auto;
        }
        .header-icon .fa-key {
            position: absolute;
            top: 10px; /* Adjust key position */
            right: -10px; /* Adjust key position */
            font-size: 3em;
            color: #ff9900; /* Orange color for the key */
            transform: rotate(-30deg);
        }

        h2 {
            color: #333;
            margin-bottom: 15px;
            font-size: 1.8em;
        }

        p {
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
            font-size: 0.95em;
        }

        .otp-inputs {
            display: flex;
            justify-content: center;
            gap: 15px; /* Space between input boxes */
            margin-bottom: 30px;
        }

        .otp-inputs input[type="text"] {
            width: 50px; /* Width of each box */
            height: 50px; /* Height of each box */
            text-align: center;
            font-size: 1.5em;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
            background-color: #f9f9f9; /* Light background for boxes */
            color: #333;
        }

        .otp-inputs input[type="text"]:focus {
            border-color: #ff9900; /* Orange border on focus */
            box-shadow: 0 0 8px rgba(255, 153, 0, 0.3);
        }

        .otp-inputs input[type="text"][value=""] { /* Style for empty boxes */
             background-color: #f0f0f0;
        }

        .change-email {
            margin-bottom: 30px;
            font-size: 0.9em;
            color: #666;
        }

        .change-email a {
            color: #ff9900; /* Orange link */
            text-decoration: none;
            font-weight: bold;
        }

        .change-email a:hover {
            text-decoration: underline;
        }

        .verify-button {
            background-color: #ff9900; /* Orange button */
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 30px;
            font-size: 1.1em;
            cursor: pointer;
            width: 80%;
            max-width: 250px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
        }

        .verify-button:hover {
            background-color: #e0851c; /* Darker orange on hover */
        }

        .resend-code {
            margin-top: 20px;
        }

        .resend-code a {
            color: #888;
            text-decoration: none;
            font-size: 0.9em;
        }

        .resend-code a:hover {
            text-decoration: underline;
        }

        .message {
            margin-top: 25px;
            padding: 15px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 0.95em;
            border: 1px solid;
            background-color: #f8d7da; /* Default for error */
            color: #721c24; /* Default for error */
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
        .message.warning {
            background-color: #fff3cd;
            color: #856404;
            border-color: #ffeeba;
        }
    </style>
</head>
<body>
    <div class="otp-wrapper">
        

        <div class="header-icon">
            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjE1MCIgdmlld0JveD0iMCAwIDIwMCAxNTAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIyMDAiIGhlaWdodD0iMTUwIiByeD0iMjAiIGZpbGw9IiNmZmFhNDAiLz4KPHBhdGggZD0iTTE4MCAyMEwyMCAxMzBIMTgwVjIwWk0yMCAyMEwxODAgMTMwVjIwSDIwWiIgc3Ryb2tlPSJibGFjayIgc3Ryb2tlLW9wYWNpdHk9IjAuMSIvPgo8cGF0aCBkPSJNMCAyMEwyMi40NzcyIDY3Ljc3MDdMNjAuODE3OCAyMi41NjI3TTAgMjBaIiBmaWxsPSJ3aGl0ZSIgb3BhY2l0eT0iMC4zIi8+CjxwYXRoIGQ9Ik0wIDEzMEwyMi40NzcyIDgyLjIyOTNMNDUuNzIwNyAxMzBIMDBaIiBmaWxsPSJ3aGl0ZSIgb3BhY2l0eT0iMC4zIi8+CjxwYXRoIGQ9Ik02MC44MTc4IDIyLjU2MjdMMjAwIDIwTDE3My4zMjQgMTEzLjgyMUwxMDAuMDEgNjcuMjY1TDM3LjMxNTUgMjAuMjQ5NUw2MC44MTc4IDIyLjU2MjdaIiBmaWxsPSJ3aGl0ZSIgb3BhY2l0eT0iMC4zIi8+CjxwYXRoIGQ9Ik00NS43MjA3IDEzMEwxNzMuMzI0IDExMy44MjFMNDUuNzIwNyAxMzBaIiBmaWxsPSJ3aGl0ZSIgb3BhY2l0eT0iMC4zIi8+Cjwvc3ZnPgo=" alt="Envelope">
            <i class="fas fa-key"></i>
        </div>

        <h2>Verify Your Email Address</h2>
       

        <form method="post" action="">
            <div class="otp-inputs">
                <input type="text" name="digit1" maxlength="1" required onkeyup="moveToNext(this, 'digit2')">
                <input type="text" name="digit2" maxlength="1" required onkeyup="moveToNext(this, 'digit3')">
                <input type="text" name="digit3" maxlength="1" required onkeyup="moveToNext(this, 'digit4')">
                <input type="text" name="digit4" maxlength="1" required onkeyup="moveToNext(this, 'digit5')">
                <input type="text" name="digit5" maxlength="1" required onkeyup="moveToNext(this, 'digit6')">
                <input type="text" name="digit6" maxlength="1" required>
            </div>
            <input type="hidden" name="otp" id="combinedOtp">

           
          

            <button type="submit" class="verify-button">Verify Email</button>
        </form>

       

        <?php if ($message): ?>
            <div class="message <?php echo (strpos($message, '✅') !== false) ? 'success' : ((strpos($message, '⚠️') !== false) ? 'warning' : 'error'); ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // JavaScript to automatically move focus to the next input field
        function moveToNext(currentInput, nextInputId) {
            if (currentInput.value.length === currentInput.maxLength) {
                const nextInput = document.getElementsByName(nextInputId)[0];
                if (nextInput) {
                    nextInput.focus();
                }
            }
            combineOtp(); // Combine OTP on each input
        }

        // JavaScript to combine OTP digits into a single hidden input
        function combineOtp() {
            const inputs = document.querySelectorAll('.otp-inputs input[type="text"]');
            let combinedValue = '';
            inputs.forEach(input => {
                combinedValue += input.value;
            });
            document.getElementById('combinedOtp').value = combinedValue;
        }

        // Add event listeners to combine OTP on load and input
        document.addEventListener('DOMContentLoaded', combineOtp);
        document.querySelectorAll('.otp-inputs input[type="text"]').forEach(input => {
            input.addEventListener('input', combineOtp);
        });
    </script>
</body>
</html>