<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog_admin_db";

// Buat koneksi ke database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
