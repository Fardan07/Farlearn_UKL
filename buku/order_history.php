<?php
include 'db.php';

$query = "
    SELECT o.id AS order_id, o.full_name, o.payment_method, o.order_date,
           b.title, b.image, oi.price, oi.quantity
    FROM orders o
    JOIN order_items oi ON o.id = oi.order_id
    JOIN books b ON b.id = oi.book_id
    ORDER BY o.order_date DESC
";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Pembelian</title>
    <link rel="stylesheet" href="order_history.css">
    <style>
        img.cover {
            width: 50px;
            height: auto;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Riwayat Pembelian Buku</h2>
        <table>
            <thead>
                <tr>
                    <th>Cover</th>
                    <th>Judul Buku</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Tanggal Pembelian</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><img class="cover" src="../images/<?= $row['image'] ?>" alt="<?= $row['title'] ?>"></td>
                            <td><?= htmlspecialchars($row["title"]) ?></td>
                            <td><?= $row["quantity"] ?></td>
                            <td>Rp <?= number_format($row["price"] * $row["quantity"], 3, ',', '.') ?></td>
                            <td><?= date("d-m-Y H:i", strtotime($row["order_date"])) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="empty-msg">Belum ada pembelian.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="books.php" class="back-btn">← Kembali ke Beranda</a>
    </div>
</body>
</html>
