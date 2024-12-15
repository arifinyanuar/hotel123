<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $whatsapp = $_POST['whatsapp'];

    $stmt = $conn->prepare('INSERT INTO users (username, password, whatsapp) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $username, $password, $whatsapp);

    if ($stmt->execute()) {
        echo 'Registrasi berhasil. <a href="index.php">Login sekarang</a>.';
    } else {
        echo 'Username sudah terdaftar.';
    }

    $stmt->close();
}

?>
