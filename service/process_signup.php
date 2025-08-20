<?php
session_start();
require 'connection.php';

// Ambil data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name       = trim($_POST['name']);
    $username   = trim($_POST['username']);
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password
    $premission = trim($_POST['premission']);

    // Cek apakah username sudah ada
    $check = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Username sudah dipakai
        echo "<script>
                alert('Username sudah terdaftar, silakan pilih yang lain!');
                window.location.href = './signup.php';
              </script>";
        exit;
    }
    $check->close();

    // Kalau belum ada, insert user baru
    $stmt = $conn->prepare("INSERT INTO users (name, username, password, premission, create_at) 
                            VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $name, $username, $password, $premission);

    if ($stmt->execute()) {
        // Ambil ID user yang baru dibuat
        $user_id = $stmt->insert_id;

        // Simpan ke session (anggap user langsung login)
        $_SESSION['id']        = $user_id;
        $_SESSION['name']      = $name;
        $_SESSION['username']  = $username;
        $_SESSION['premission'] = $premission;

        // Redirect ke dashboard
        header("Location: ./index.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
