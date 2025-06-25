<?php
require_once 'includes/auth.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (register($username, $email, $password)) {
        $message = 'Registration successful. <a href="login.php">Login here</a>.';
    } else {
        $message = 'Registration failed. Username or email may already exist.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register - Cricket Betting</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Register</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>
    <p><?php echo $message; ?></p>
    <p>Already have an account? <a href="login.php">Login</a></p>
</body>
</html> 