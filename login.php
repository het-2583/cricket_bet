<?php
require_once 'includes/auth.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (login($username, $password)) {
        header('Location: dashboard.php');
        exit;
    } else {
        $message = 'Login failed. Invalid credentials.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Cricket Betting</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Login</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
    <p><?php echo $message; ?></p>
    <p>Don't have an account? <a href="register.php">Register</a></p>
</body>
</html> 