<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "project_ukl_ku";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>