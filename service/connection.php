<?php
$servername = "localhost"; // huruf kecil semua
$username   = "root";
$password   = "";
$dbname     = "data_sekolah"; // hanya nama database

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
