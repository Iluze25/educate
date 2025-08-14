<?php 
session_start();
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
}

// Ambil data user berdasarkan username
$stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();

// Ambil hasil query
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Cek password tanpa hashing
    if ($password === $row['password']) {
        $_SESSION['login'] = true;
        header("Location: ./Example.php");
        exit;
    } else {
        echo "<p style='color:red;'>Password salah!</p>";
    }
} else {
    echo "<p style='color:red;'>Username tidak ditemukan!</p>";
}

$stmt->close();
$conn->close();
?>
