<?php 
session_start();

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

require 'functions.php';

// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    // Cek username-nya
    if (mysqli_num_rows($result) === 1) {
        // Ambil data user dari database
        $row = mysqli_fetch_assoc($result);

        // Cek password-nya
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION["login"] = true;
            // Jika password benar, arahkan ke halaman index.php
            header("Location: index.php");
            exit;
        } else {
            // Jika password salah
            $error = true;
        }
    } else {
        // Jika username tidak ditemukan
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Halaman Login</h1>

    <?php if (isset($error)) : ?>
        <p style="color:red; font-style:italic;">Username atau Password Salah</p>
    <?php endif; ?>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </li>
            <li>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </li>
            <li>
                <button type="submit" name="login">Login</button>
            </li>
        </ul>
    </form>
</body>
</html>
