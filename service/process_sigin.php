<?php 
    require 'connection.php'

    if (_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }

    // retrieve data based on user name
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    // password
    if ($stmt->num_rows > 0) {
        // retrieve the resulting password hash
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // check password
        if (password_verify($password, $hashed_password)) {
            // Login Success!
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            
             echo "<p style='color:green;'>Login berhasil!</p>";
            // Bisa diarahkan ke dashboard
            // header("Location: dashboard.php");
            header("Location: Example.html");
            exit;
        } else {
            echo "<p style='color:red;'>Password salah!</p>";
        }
    } else {
        echo "<p style='color:red;'>Username tidak ditemukan!</p>";
    }

    $stmt->close();
    }
    $conn->close();
?>