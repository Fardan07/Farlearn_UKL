<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'project_ukl_ku';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$payment_method = $_POST['payment_method'];

// Gunakan input manual jika dipilih
$amount = $_POST['amount'];
if (empty($amount) && !empty($_POST['custom_amount'])) {
    $amount = $_POST['custom_amount'];
}

$stmt = $conn->prepare("INSERT INTO donations (name, email, message, amount, payment_method) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssds", $name, $email, $message, $amount, $payment_method);

if ($stmt->execute()) {
    echo "<div class='container'><div class='success-message'>
            <h1>Terima Kasih!</h1>
            <p>Donasi sebesar <strong>Rp" . number_format($amount, 3, ',', '.') . "</strong> telah berhasil dikirim.</p>
            <a href='donation.php' class='btn'>Donasi Lagi</a>
        </div></div>";
} else {
    echo "Gagal menyimpan data: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
<link rel="stylesheet" href="succes.css">
