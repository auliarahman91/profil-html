<?php
$host = "localhost";
$user = "root"; // sesuaikan dengan user database Anda
$password = "rahman123"; // sesuaikan dengan password database Anda
$dbname = "ecommerce_db"; // ganti dengan nama database Anda

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
