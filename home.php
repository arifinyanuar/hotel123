<?php
session_start();
require 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT password FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $username;
            header('Location: home.php');
            exit();
        } else {
            echo "<script>alert('Username atau password salah.'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Akun tidak ditemukan. Silakan daftar terlebih dahulu.'); window.location.href='index.php';</script>";
    }

    $stmt->close();
}

if (isset($_GET['registered']) && $_GET['registered'] === 'success') {
    echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location.href='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Hotel Aston</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="brand">SalesHotelAston</div>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#profile">Profile</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <!-- Content -->
    <div class="content">
        <h1>Selamat Datang, <?php echo $_SESSION['username']; ?>!</h1>
        <p>Ini adalah halaman utama setelah login.</p>
    </div>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
            position: fixed;
            top: 0;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .navbar .brand {
            color: white;
            font-size: 24px;
            font-weight: bold;
            font-family: 'Verdana', sans-serif;
        }

        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar ul li {
            padding: 14px 20px;
        }

        .navbar ul li a {
            color: white;
            text-decoration: none;
            display: block;
        }

        .navbar ul li a:hover {
            background-color: #575757;
        }

        .content {
            padding: 80px 20px; /* Space for fixed navbar */
            text-align: center;
        }
    </style>
</body>
</html>
