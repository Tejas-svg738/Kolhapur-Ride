<?php
session_start();

// Simulate a correct OTP for testing
$correct_otp = "1234"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the combined OTP
    $entered_otp = $_POST['otp'] ?? '';

    // Validate OTP format (4 digits)
    if (!preg_match('/^\d{4}$/', $entered_otp)) {
        echo "<h3 style='color: red;'>Invalid OTP format.</h3>";
        exit();
    }

    // Check if OTP is correct
    if ($entered_otp === $correct_otp) {
        echo "<h3 style='color: green;'>✅ OTP Verified Successfully!</h3>";
    } else {
        echo "<h3 style='color: red;'>❌ Invalid OTP. Please try again.</h3>";
    }
} else {
    echo "<h3 style='color: red;'>Invalid request.</h3>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .otp-container {
            max-width: 400px;
            margin: 50px auto;
            text-align: center;
        }
        .otp-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 24px;
            margin: 5px;
        }
    </style>
</head>
<body>

<div class="container otp-container">
    <h2>Welcome back</h2>
    <p>Enter the 4-digit code sent via SMS at</p>
    <a href="#">Changed your mobile number?</a>

    <form method="POST" action="" class="mt-3">
        <div class="d-flex justify-content-center">
            <input type="text" name="otp1" maxlength="1" class="form-control otp-input" required>
            <input type="text" name="otp2" maxlength="1" class="form-control otp-input" required>
            <input type="text" name="otp3" maxlength="1" class="form-control otp-input" required>
            <input type="text" name="otp4" maxlength="1" class="form-control otp-input" required>
        </div>
        <input type="hidden" name="otp" id="otp" value="">

        <button type="submit" class="btn btn-primary mt-3">Next →</button>
    </form>

    <button class="btn btn-secondary mt-2" id="resendOTP">Resend code by SMS</button>
    <button class="btn btn-outline-dark mt-2">More options</button>

    <!-- <button class="btn btn-light mt-3"><a href=lo Back</button> -->
</div>

<script>
    // OTP Auto Move to Next Field
    document.querySelectorAll('.otp-input').forEach((input, index, array) => {
        input.addEventListener('input', (e) => {
            if (e.target.value.length === 1 && index < array.length - 1) {
                array[index + 1].focus();
            }
        });
    });

    // Combine OTP and submit hidden field
    document.querySelector('form').addEventListener('submit', () => {
        let otp = '';
        document.querySelectorAll('.otp-input').forEach(input => otp += input.value);
        document.getElementById('otp').value = otp;
    });

    // Simulate OTP Resend
    document.getElementById('resendOTP').addEventListener('click', () => {
        alert('OTP Resent Successfully!');
    });
</script>

</body>
</html>