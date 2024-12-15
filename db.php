<?php
// db.php: File untuk koneksi database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'hotel1';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die('Koneksi ke database gagal: ' . $conn->connect_error);
}
?>
