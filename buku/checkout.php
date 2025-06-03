<?php
session_start();
include 'db.php';

if (empty($_POST['book_ids'])) {
    echo "<p class='empty-msg'>Keranjang kosong atau akses tidak sah.</p>";
    exit;
}

$book_ids = $_POST['book_ids'];
$total_price = 0;
$book_details = [];

// Hitung total harga dan ambil detail buku
foreach ($book_ids as $id => $qty) {
    $result = mysqli_query($koneksi, "SELECT title, image, price FROM books WHERE id = $id");
    $book = mysqli_fetch_assoc($result);
    if ($book) {
        $subtotal = $book['price'] * $qty;
        $total_price += $subtotal;
        $book_details[] = [
            'id' => $id,
            'title' => $book['title'],
            'image' => $book['image'],
            'qty' => $qty
        ];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css">
</head>
<body>
    <h2>Checkout</h2>
    <table>
        <thead>
            <tr><th>Cover</th><th>Judul</th><th>Jumlah</th></tr>
        </thead>
        <tbody>
            <?php foreach ($book_details as $book): ?>
            <tr>
                <td><img class="cover" src="../images/<?= $book['image'] ?>" alt="<?= htmlspecialchars($book['title']) ?>"></td>
                <td><?= htmlspecialchars($book['title']) ?></td>
                <td><?= $book['qty'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="button-wrapper">
    <form class="form-container" action="process_checkout.php" method="post">
        <input type="text" name="full_name" placeholder="Nama Lengkap" required>
        <input type="email" name="user_email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="No. Telepon" required>
        <textarea name="address" placeholder="Alamat Lengkap" required></textarea>
        <input type="text" name="city" placeholder="Kota" required>
        <input type="text" name="postal_code" placeholder="Kode Pos" required>

        <!-- Total harga disini -->
        <input type="hidden" name="total_price" value="<?= $total_price ?>">

        <label>Metode Pembayaran:</label>
        <select name="payment_method" required>
            <option value="">-- Pilih Metode Pembayaran --</option>
            <option value="1">Transfer Bank</option>
            <option value="2">E-Wallet</option>
            <option value="3">COD</option>
        </select>

        <!-- Kirim kembali book_ids -->
        <?php foreach ($book_ids as $id => $qty): ?>
            <input type="hidden" name="book_ids[<?= $id ?>]" value="<?= $qty ?>">
        <?php endforeach; ?>

        <button class="back-btn" type="submit">Konfirmasi Pembelian</button>
        <br><br>
        <a href="cart.php" class="back-button">← Kembali</a>
    </form>
    </div>
</body>
</html>
