<?php
include 'db.php'; // Pastikan path ke config.php benar

$id = $_GET['id'];

// Hapus dulu semua orders yang terkait dengan user ini
mysqli_query($conn, "DELETE FROM orders WHERE user_id = '$id'");

// Setelah itu baru hapus user-nya
mysqli_query($conn, "DELETE FROM users WHERE user_id = '$id'");

// Kembali ke halaman daftar user
header("Location: users.php");
?>
