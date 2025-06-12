<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'project_ukl_ku';

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}

$query = "SELECT * FROM orders ORDER BY order_date DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Pesanan</title>
    <link rel="stylesheet" href="admin_order.css">
</head>
<body>
    <div class="container">
        <h1>Data Pesanan</h1>
        <table>
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Nama Pemesan</th>
                    <th>Tanggal Pesanan</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $order['id']; ?></td>
                        <td><?= htmlspecialchars($order['full_name']); ?></td>
                        <td><?= $order['order_date']; ?></td>
                        <td>Rp <?= number_format($order['total_price'], 3, ',', '.'); ?></td>
                        <td><a href="admin_order_detail.php?id=<?= $order['id']; ?>" class="btn">Lihat Detail</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="dashboard.php" class="btn back">← Kembali ke Dashboard</a>
    </div>
</body>
</html>
