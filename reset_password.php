<?php
$host = "localhost";
$dbname = "qweez";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if (empty($token) || empty($newPassword) || empty($confirmPassword)) {
        die("All fields are required.");
    }

    if ($newPassword !== $confirmPassword) {
        die("Passwords do not match.");
    }

    $stmt = $conn->prepare("SELECT id, reset_token_expires_at FROM users WHERE reset_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $expiresAt = strtotime($row['reset_token_expires_at']);
        if ($expiresAt < time()) {
            die("Token has expired.");
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $update = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expires_at = NULL WHERE id = ?");
        $update->bind_param("si", $hashedPassword, $row['id']);
        if ($update->execute()) {
            echo "Password updated successfully. <a href='login.html'>Login</a>";
        } else {
            echo "Failed to update password.";
        }
    } else {
        echo "Invalid or expired token.";
    }
}
?>
