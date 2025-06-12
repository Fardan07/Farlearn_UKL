<?php
session_start();
include '../Login_Page/config.php';

// Cek apakah user sudah login
if (!isset($_SESSION['email'])) {
    header('Location: ../Login_Page/login.php');
    exit();
}

// Ambil user_id dari database berdasarkan email
$email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$user_id = $row['user_id'] ?? null;

if (!$user_id) {
    die("User tidak ditemukan.");
}

// Ambil riwayat order user berdasarkan user_id
$query = "
    SELECT o.id AS order_id, o.full_name, o.payment_method, o.order_date,
           b.title, b.image, oi.price, oi.quantity
    FROM orders o
    JOIN order_items oi ON o.id = oi.order_id
    JOIN books b ON b.id = oi.book_id
    WHERE o.user_id = ?
    ORDER BY o.order_date DESC
";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
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
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><img class="cover" src="../images/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>"></td>
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
