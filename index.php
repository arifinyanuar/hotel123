<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: home.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="form-container" id="login-container">
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
            <p>Belum punya akun? <a href="#" onclick="switchToRegister()">Register</a></p>
        </div>

        <div class="form-container hidden" id="register-container">
            <h2>Register</h2>
            <form action="register.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="text" name="whatsapp" placeholder="Nomor WhatsApp" required>
                <button type="submit">Register</button>
            </form>
            <p>Sudah punya akun? <a href="#" onclick="switchToLogin()">Login</a></p>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
