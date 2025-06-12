<?php
session_start(); 
?>

<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FarLearn - Portal Artikel Dan Jurnal Edukasi Lingkungan</title>
<link rel="stylesheet" href="ukl.css">
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
    <header id="beranda">
        <div class="hero-text">
            <h1>FarLearn</h1>
            <p>Artikel, jurnal, dan buku seputar lingkungan & sumber daya alam, semua dalam satu portal edukatif.</p>
        </div>
    </header>

<main>
<section id="artikel" class="section">
<h2 class="section-title">Artikel Dan Jurnal Terbaru</h2>
<div class="cards-container">
<?php 
include('../crud/db.php');
$no = 1;
$query = mysqli_query($conn,"SELECT * FROM articles");
while($row = mysqli_fetch_array($query)){
?>

<div class="card">
  <div class="card-image">
    <img src="../foto_background/<?php echo $row['image']?>" alt="Gambar Artikel">
    <div class="card-category"><?php echo $row['tags'] ?></div>
  </div>
  <div class="card-content">
    <div class="card-meta">
      <span><?php echo $row['reading_time'] ?></span>
    </div>
    <h3><?php echo $row['title'] ?></h3>
    <p class="card-excerpt"><?php echo $row['description'] ?></p>
    <div class="card-excerpt"><?php echo $row['text'] ?></div>
    <div class="source"><?php echo $row['source'] ?></div>

    <a href="<?php echo $row['url'] ?>" class="read-more">Baca Selengkapnya</a>
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



    </main>
</body>
</html>
