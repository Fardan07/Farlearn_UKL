

<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_to_cart"])) {
    $book_id = (int) $_POST["book_id"];
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }
    if (isset($_SESSION['cart'][$book_id])) {
        $_SESSION['cart'][$book_id]++;
    } else {
        $_SESSION['cart'][$book_id] = 1;
    }
    header("Location: books.php");
    exit();
}

if (!isset($_SESSION['email'])) {
    header("Location: ../Login_page/akses_ditolak.php");
    exit;
}

$result = mysqli_query($koneksi, "SELECT * FROM books");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FarLearn Books</title>
    <link rel="stylesheet" href="../UKL/ukl.css">
</head>
<body>
    <nav>
        <div class="logo">
            <img src="../front_web/farlearn.png" alt="Logo">
        </div>
        <ul>
            <li><a href="#beranda">Beranda</a></li>
            <li><a href="../UKL/ukl.php">Artikel</a></li>
            <li><a href="#kontak">Kontak</a></li>
            <li><a href="http://localhost/farlearn/Profil/about_farlearn.php">Tentang Website</a></li>
            <li><a href="../donation/donation.php">Dukung Kami</a></li>
            <li><a href="../ulasan/ulasan.php">Ulasan Tentang Web</a></li>
        </ul>
         <div class="nav-icons">
  <a href="http://localhost/farlearn/buku/cart.php" class="icon-link">
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

    <header id="beranda">
        <div class="hero-text">
            <h1>FarLearn</h1>
            <p>Buku dan referensi lingkungan lengkap dalam satu portal edukatif. Bantu kamu lebih peduli dan siap bertindak!</p>
        </div>
    </header>

    <section class="section">
        <h2 class="section-title">Toko Buku FarLearn</h2>
        <div class="cards-container">
            <?php while ($book = mysqli_fetch_assoc($result)) { ?>
                <div class="card">
                    <div class="card-image">
                        <img src="../images/<?= $book['image'] ?>" alt="<?= $book['title'] ?>">
                    </div>
                    <div class="card-content">
                        <h3><?= $book['title'] ?></h3>
                        <p class="author"><?= $book['author'] ?></p>
                        <p class="description"><?= $book['description'] ?></p>
                        <p><strong>Rp<?= number_format($book['price'], 3, ',', '.') ?></strong></p>
                        <form method="POST" onsubmit="return confirm('Tambah buku ini ke keranjang?')">
                            <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                            <button class="cta-button" type="submit" name="add_to_cart">+ Keranjang</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

<footer>
    <section id="kontak" class="section">
        <div class="footer-content">
            <div class="footer-section">
                <h4>Kontak</h4>
                <ul>
                    <li>Email: <a href="mailto:mafrdhan@gmail.com">mafrdhan@gmail.com</a></li>
                    <li>Telepon: <a href="tel:+6281334097813">+62-813-3409-7813</a></li>
                    <li>WhatsApp: <a href="https://wa.me/6281334097813" target="_blank">Chat di WhatsApp</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Alamat</h4>
                <ul>
                    <li>
                        <a href="https://www.google.com/maps/place/Sedati,+Sidoarjo,+Jawa+Timur" target="_blank">
                            Jl. Raya Juanda No.17<br>
                            Sedati, Sidoarjo, Jawa Timur
                        </a>
                    </li>
                    <li>Indonesia</li>
                    <li>Jam Operasional: Senin - Jumat, 08.00 - 17.00 WIB</li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Media Sosial</h4>
                <ul>
                    <li><a href="https://instagram.com/farlearn.id" target="_blank">Instagram: @farlearn.id</a></li>
                    <li><a href="https://facebook.com/farlearnindonesia" target="_blank">Facebook: FarLearn Indonesia</a></li>
                    <li><a href="https://linkedin.com/company/farlearn" target="_blank">LinkedIn: FarLearn Official</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 FarLearn. Hak Cipta Dilindungi.</p>
        </div>
    </section>
</footer>

</body>
</html>
