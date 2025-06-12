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
      <nav>
    <div class="logo">
        <img src="../front_web/farlearn.png" alt="Logo">
    </div>
    <ul>
        <li><a href="#beranda">Beranda</a></li>
        <li><a href="#artikel">Artikel</a></li>
        <li><a href="#kontak">Kontak</a></li>
        <li><a href="http://localhost/farlearn/Profil/about_farlearn.php">Tentang Website</a></li>
        <li><a href="../donation/donation.php">Dukung Kami</a></li>
        <li><a href="../buku/books.php">Beli Buku</a></li>
        <li><a href="../ulasan/ulasan.php">Ulasan Tentang Web</a></li>
    </ul>

     <!-- Bagian icon profil/login paling kanan -->
  <div class="nav-icons">
  <a href="http://localhost/farlearn/buku/books.php" class="icon-link">
  <div class="icon-with-text">
    <img src="../front_web/cart.png" class="icon" alt="Keranjang">
    <span class="icon-text">Keranjang</span>
  </div>
</a>
  <?php if (isset($_SESSION['email'])): ?>
    <div class="icon-wrapper">
      <a href="http://localhost/farlearn/Login_page/dashboard.php">
        <img src="../front_web/profile.png" alt="Profil" class="icon">
      </a>
      <span class="icon-text">Dashboard</span>
    </div>
  <?php else: ?>
    <div class="icon-wrapper">
      <a href="http://localhost/farlearn/login_page/login.php">
        <img src="../front_web/login.png" alt="Login" class="icon">
      </a>
      <span class="icon-text">Login/Register</span>
    </div>
  <?php endif; ?>
</div>

</nav>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
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