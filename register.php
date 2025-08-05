<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php'; // PHPMailer

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userid = $_POST['userid'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $otp = rand(100000, 999999);

    $_SESSION['user_data'] = [
        'userid' => $userid,
        'name' => $name,
        'mobile' => $mobile,
        'email' => $email,
        'password' => $password,
        'otp' => $otp
    ];

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'sender.qweez@gmail.com'; // तुमचा ईमेल
        $mail->Password   = 'jhjn ljpm aazb ijhz'; // अ‍ॅप पासवर्ड
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('your_email@gmail.com', 'KOlhapur Ride ');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP for Registration';
        $mail->Body    = "Your OTP is: <b>$otp</b>";

        $mail->send();
        header("Location: verify_otp.php");
        exit;
    } catch (Exception $e) {
        echo "Mail error: {$mail->ErrorInfo}";
    }
}
?>
