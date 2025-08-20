<?php
session_start();
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Ambil data user dari database
    $stmt = $conn->prepare("SELECT id, name, username, password, premission 
                            FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek apakah user ada
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Simpan ke session
            $_SESSION['id']         = $user['id'];
            $_SESSION['name']       = $user['name'];
            $_SESSION['username']   = $user['username'];
            $_SESSION['premission'] = $user['premission'];

            // Arahkan ke dashboard
            header("Location: ../index.php");
            exit;
        } else {
            echo "<script>
                    alert('Password salah!');
                    window.location.href = './login.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Username tidak ditemukan!');
                window.location.href = './login.php';
              </script>";
    }

    $stmt->close();
}
$conn->close();
?>
