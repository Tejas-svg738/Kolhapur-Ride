<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hardcoded login (change this as per your need)
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit();
    } else {
        echo "<script>alert('Invalid credentials');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Admin Login</title></head>
<body>
    <h2>Admin Login</h2>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username"><br><br>
        <label>Password:</label>
        <input type="password" name="password"><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
