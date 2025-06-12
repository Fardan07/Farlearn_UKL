<?php
include 'db.php';
$id = intval($_GET['id']); // sanitasi sederhana

// Hapus dulu data di tabel anak
$conn->query("DELETE FROM checkout_presets WHERE user_id = $id");

// Baru hapus user
$conn->query("DELETE FROM users WHERE user_id = $id");

header("location:users.php");
?>
