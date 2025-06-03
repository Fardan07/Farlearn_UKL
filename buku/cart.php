<?php
session_start();
include 'db.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['add'])) {
    $book_id = (int) $_GET['add'];
    if (isset($_SESSION['cart'][$book_id])) {
        $_SESSION['cart'][$book_id]++;
    } else {
        $_SESSION['cart'][$book_id] = 1;
    }
    header("Location: cart.php");
    exit;
}

if (isset($_GET['remove'])) {
    $book_id = (int) $_GET['remove'];
    unset($_SESSION['cart'][$book_id]);
    header("Location: cart.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Belanja</title>
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
    <h2>Keranjang Belanja</h2>
    <?php if (empty($_SESSION['cart'])): ?>
        <p class="empty-msg">Keranjang kosong.</p>
    <?php else: ?>
        <form action="checkout.php" method="post">
            <table>
                <thead>
                    <tr>
                        <th>Cover</th>
                        <th>Judul</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($_SESSION['cart'] as $book_id => $qty):
                    $result = mysqli_query($koneksi, "SELECT * FROM books WHERE id = $book_id");
                    $book = mysqli_fetch_assoc($result);
                ?>
                    <tr>
                        <td><img class="cover" src="../images/<?= $book['image'] ?>" alt="<?= $book['title'] ?>"></td>
                        <td><?= htmlspecialchars($book['title']) ?></td>
                        <td><?= $qty ?></td>
                        <td><a class="back-btn" href="cart.php?remove=<?= $book_id ?>">Hapus</a></td>
                    </tr>
                    <input type="hidden" name="book_ids[<?= $book_id ?>]" value="<?= $qty ?>">
                <?php endforeach; ?>
                </tbody>
            </table>
            <button class="back-btn" type="submit">Checkout</button>
        </form>
    <?php endif; ?>
                    <a href="books.php" class="back-btn">← Kembali</a>
</body>
</html>