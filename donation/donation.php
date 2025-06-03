<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../Login_page/akses_ditolak.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Donasi</title>
    <link rel="stylesheet" href="donation.css">
</head>
<body>
<div class="container">
    <form action="donasi_berhasil.php" method="POST" class="donation-form">
        <h2>Donasi Sekarang</h2>


        <input type="text" name="name" placeholder="Nama" required>

        <input type="email" name="email" placeholder="Email" required>

        <textarea name="message" placeholder="Pesan (opsional)" rows="3"></textarea>

        <p><strong>Pilih Jumlah Donasi:</strong></p>
        <div class="card-options">
            <input type="radio" name="amount" id="amt1" value="5000" required>
            <label for="amt1" class="card">Rp5.000</label>

            <input type="radio" name="amount" id="amt2" value="10000">
            <label for="amt2" class="card">Rp10.000</label>

            <input type="radio" name="amount" id="amt3" value="25000">
            <label for="amt3" class="card">Rp25.000</label>

            <input type="radio" name="amount" id="amt4" value="">
            <label for="amt4" class="card">
                Lainnya:<br>
                <input type="number" name="custom_amount" placeholder="Masukkan jumlah" min="1000">
            </label>
        </div>

        <!-- Pilih Metode Pembayaran -->
        <p><strong>Metode Pembayaran:</strong></p>
        <div class="card-options">
            <input type="radio" name="payment_method" id="pay1" value="Transfer Bank" required>
            <label for="pay1" class="card">Transfer Bank</label>

            <input type="radio" name="payment_method" id="pay2" value="OVO">
            <label for="pay2" class="card">OVO</label>

            <input type="radio" name="payment_method" id="pay3" value="GoPay">
            <label for="pay3" class="card">GoPay</label>

            <input type="radio" name="payment_method" id="pay4" value="Dana">
            <label for="pay4" class="card">Dana</label>
        </div>

        <button type="submit" class="btn btn-donate">Donasi</button>
        <br>
        <a href="donation_history.php" class="btn btn-back">History Donaasi</a>
        <br>
        <a href="http://localhost/farlearn/UKL/ukl.php" class="btn btn-back">Kembali</a>
    </form>
</div>
</body>
</html>
