<?php
$koneksi = new mysqli("localhost"
, "root"
, "",
 "project_ukl_ku");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
