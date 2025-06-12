<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'project_ukl_ku';

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}

if (!isset($_GET['id'])) {
    die('ID pesanan tidak ditemukan.');
}

$order_id = intval($_GET['id']);

$orderQuery = $conn->prepare("SELECT * FROM orders WHERE id = ?");
$orderQuery->bind_param("i", $order_id);
$orderQuery->execute();
$orderResult = $orderQuery->get_result();
$order = $orderResult->fetch_assoc();

if (!$order) {
    die('Pesanan tidak ditemukan.');
}

$itemQuery = $conn->prepare("
    SELECT oi.quantity, oi.price, b.title 
    FROM order_items oi
    JOIN books b ON oi.book_id = b.id
    WHERE oi.order_id = ?
");
$itemQuery->bind_param("i", $order_id);
$itemQuery->execute();
$items = $itemQuery->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Detail Pesanan</title>
    <link rel="stylesheet" href="admin_order.css">
</head>
<body>
    <div class="container">

        <h1>Detail Pesanan #<?= $order['id']; ?></h1>
        <p><strong>Nama:</strong> <?= htmlspecialchars($order['full_name']); ?></p>
        <p><strong>Telepon:</strong> <?= htmlspecialchars($order['phone']); ?></p>
        <p><strong>Alamat:</strong> <?= htmlspecialchars($order['address']); ?>, <?= $order['city']; ?>, <?= $order['postal_code']; ?></p>
        <p><strong>Tanggal:</strong> <?= $order['order_date']; ?></p>
        <p><strong>Metode Pembayaran:</strong> <?= $order['payment_method']; ?></p>
        <p><strong>Total:</strong> Rp <?= number_format($order['total_price'], 3, ',', '.'); ?></p>

        <h2>Item Pesanan</h2>
        <table>
            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = $items->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars($item['title']); ?></td>
                        <td><?= $item['quantity']; ?></td>
                        <td>Rp <?= number_format($item['price'], 3, ',', '.'); ?></td>
                        <td>Rp <?= number_format($item['quantity'] * $item['price'], 3, ',', '.'); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="admin_orders.php" class="btn back">← Kembali ke Daftar Pesanan</a>
    </div>
</body>
</html>
