<?php
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    $amount = floatval($_POST['amount']);
    $payment_method = htmlspecialchars($_POST['payment_method']);
    $created_at = date("Y-m-d H:i:s");

    $query = "INSERT INTO donations (name, email, message, amount, payment_method, created_at) 
              VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssiss", $name, $email, $message, $amount, $payment_method, $created_at);

    if ($stmt->execute()) {
        header("Location: donasi_berhasil.php");
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Permintaan tidak valid.";
}
?>
