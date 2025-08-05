<?php
session_start();
include 'db.php'; // Ensure your db.php connects to the database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the statement
    $stmt = $conn->prepare("SELECT userid, name, mobile, password, is_verified FROM users WHERE email = ?");
    if ($stmt === false) {
        // Handle prepare error
        echo "Database error: Unable to prepare statement.";
        exit;
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if ($user['is_verified'] == 0) {
            echo "Please verify your email first.";
        } elseif (password_verify($password, $user['password'])) {
            // Success: Store user info in session
            $_SESSION['userid'] = $user['userid'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['mobile'] = $user['mobile'];

            // Redirect to dashboard on successful login
            header("Location: /Kolhapur/Ride/ride.php");
            exit;
        } else {
            // Echo the message for JavaScript to pick up
            echo "Incorrect password.";
        }
    } else {
        // Echo the message for JavaScript to pick up
        echo "User not found.";
    }

    $stmt->close();
    $conn->close(); // Close the database connection
}
?>