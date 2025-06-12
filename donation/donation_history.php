<?php
session_start();
include 'db.php'; // sesuai dengan login.php kamu

// Cek apakah user sudah login
if (!isset($_SESSION['email'])) {
    echo "Anda harus login untuk melihat riwayat donasi.";
    exit;
}


$email = $_SESSION['email'];


$sql_donation = "SELECT * FROM donations WHERE email = '$email'";
$result_donation = mysqli_query($conn, $sql_donation);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Donasi Anda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f8f5;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #2e8b57;
        }
        table {
            width: 60%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #2e8b57;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .back-button {
            display: block;
            width: 200px;
            margin: 30px auto 0;
            padding: 12px;
            background-color: #2e8b57;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .back-button:hover {
            background-color: #256d47;
        }
        table { border-collapse: collapse; width: 80%; margin: auto; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Riwayat Donasi Anda</h2>

    <table>
        <tr>
            <th>ID Donasi</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jumlah</th>
            <th>Pesan</th>
            <th>Tanggal</th>
        </tr>
        <?php if ($result_donation && mysqli_num_rows($result_donation) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result_donation)): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td>Rp <?= number_format($row['amount'], 0, ',', '.') ?></td>
                <td><?= htmlspecialchars($row['message']) ?></td>
                <td><?= htmlspecialchars($row['created_at']) ?></td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Belum ada donasi.</td>
            </tr>
        <?php endif; ?>
    </table>
        <a href="donation.php" class="back-button">← Kembali</a>
</body>
</html>
