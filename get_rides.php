<?php
$conn = new mysqli("localhost", "root", "", "qweez", 4306);

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // If applicable

// Generate unique user ID
$user_id = 'USR' . rand(100000, 999999);

// Ensure user_id is unique
while (mysqli_num_rows($conn->query("SELECT * FROM users WHERE user_id='$user_id'")) > 0) {
    $user_id = 'USR' . rand(100000, 999999);
}

// Insert into users table
$sql = "INSERT INTO users (user_id, username, password) VALUES ('$user_id', '$email', '$password')";

if ($conn->query($sql)) {
    // Optionally store ride data separately
    session_start();
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $email;
    header("Location: profile.php");
    exit;
} else {
    echo "Error: " . $conn->error;
}
?>
