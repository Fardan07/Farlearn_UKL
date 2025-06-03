<?php
$conn = mysqli_connect("localhost", "root", "", "project_ukl_ku");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
