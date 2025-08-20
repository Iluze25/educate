<?php
session_start();
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name        = trim($_POST['name']);
    $username    = trim($_POST['username']);
    $password    = $_POST['password'];
    $confirm     = $_POST['confirm_password']; // ambil konfirmasi password
    $premission  = trim($_POST['premission']);

    // === VALIDASI ===
    // cek panjang name
    if (strlen($name) < 4) {
        echo "<script>alert('Nama minimal 8 karakter!'); window.location.href='../signup.php';</script>";
        exit;
    }



    

    

    // cek apakah username sudah ada
    $check = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username sudah terdaftar, silakan pilih yang lain!'); window.location.href='../signup.php';</script>";
        exit;
    }
// cek panjang password
    if (strlen($password) < 8) {
        echo "<script>alert('Password minimal 8 karakter!'); window.location.href='../signup.php';</script>";
        exit;
    }
    // cek password == confirm
    if ($password !== $confirm) {
        echo "<script>alert('Konfirmasi password tidak sama!'); window.location.href='../signup.php';</script>";
        exit;
    }
    $check->close();

    // kalau lolos validasi → hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // simpan user baru
    $stmt = $conn->prepare("INSERT INTO users (name, username, password, premission, create_at) 
                            VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $name, $username, $hashed_password, $premission);

    if ($stmt->execute()) {
        // simpan session
        $_SESSION['id']         = $stmt->insert_id;
        $_SESSION['name']       = $name;
        $_SESSION['username']   = $username;
        $_SESSION['premission'] = $premission;

        header("Location: ../index.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
