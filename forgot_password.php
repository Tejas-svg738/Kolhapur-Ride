<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$host = "localhost";
$dbname = "qweez";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $userResult = $stmt->get_result();

    if ($userResult->num_rows > 0) {
        $token = bin2hex(random_bytes(32));
        $expires = date("Y-m-d H:i:s", time() + 3600); // 1 hour from now

        $updateStmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_token_expires_at = ? WHERE email = ?");
        $updateStmt->bind_param("sss", $token, $expires, $email);
        $updateStmt->execute();

        $resetLink = "http://localhost/Kolhapur/Userlogin/reset_password.html?token=$token";

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // use your mail server
            $mail->SMTPAuth = true;
            $mail->Username = 'sender.qweez@gmail.com'; // change this
            $mail->Password = 'jhjn ljpm aazb ijhz';    // app-specific password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('sender.qweez@gmail.com', 'Kolhapur Ride');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body = "
                <h2>Reset Your Password</h2>
                <p>Click the link below to reset your password:</p>
                <a href='$resetLink'>$resetLink</a><br><br>
                <p>This link will expire in 1 hour.</p>
            ";

            $mail->send();
            echo "A reset link has been sent to your email.";
        } catch (Exception $e) {
            echo "Failed to send reset email. Error: " . $mail->ErrorInfo;
        }
    } else {
        echo "Email not found in our records.";
    }
}
?>
