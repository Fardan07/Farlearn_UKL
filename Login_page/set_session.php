<?php
session_start();
include "../donation/db.php";

// Cek apakah user sedang login
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    if (mysqli_num_rows($query) == 1) {
        $user = mysqli_fetch_assoc($query);

        // Simpan session
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        header("Location: dashboard.php");
        exit;
    } else {
        echo "Login gagal, silakan kembali ke <a href='login.php'>login</a>";
    }
} else {
    echo "Data tidak lengkap.";
}
