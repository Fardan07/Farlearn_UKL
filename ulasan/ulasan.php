<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../Login_page/akses_ditolak.php");
    exit;
}
?>
<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FarLearn - Ulasan Web</title>
<link rel="stylesheet" href="../UKL/ukl.css">
</head>
<body>

    <nav>
        <div class="logo">
        <img src="../front_web/farlearn.png" alt="Logo">
        </div>
        <ul>
             <li><a href="#beranda">Beranda</a></li>
        <li><a href="http://localhost/farlearn/UKL/ukl.php">Artikel</a></li>
        <li><a href="#kontak">Kontak</a></li>
        <li><a href="http://localhost/farlearn/Profil/about_farlearn.php">Tentang Website</a></li>
        <li><a href="../donation/donation.php">Dukung Kami</a></li>
        <li><a href="../buku/books.php">Beli Buku</a></li>
        </ul>
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

<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $komentar = $_POST['komentar'];
    $rating = $_POST['rating'];
    mysqli_query($conn, "INSERT INTO ulasan_web (nama, komentar, rating) VALUES ('$nama', '$komentar', $rating)");
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM ulasan_web WHERE id = $id");
    header("Location: ulasan.php");
}


if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $komentar = $_POST['komentar'];
    $rating = $_POST['rating'];
    mysqli_query($conn, "UPDATE ulasan_web SET nama='$nama', komentar='$komentar', rating=$rating WHERE id=$id");
    header("Location: ulasan.php");
}


$ulasan = mysqli_query($conn, "SELECT * FROM ulasan_web");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>FarLearn</title>
    <link rel="stylesheet" href="../UKL/ukl.css">
</head>
<body>

    <h1 style="text-align: center; margin-top: 40px;">Selamat datang di Ulasan WebFarLearn</h1>


    <section class="section" id="ulasan">
        <h2 class="section-title">Ulasan Pengguna</h2>

        <form method="POST" style="max-width: 600px; margin: 0 auto 30px;">
            <input type="text" name="nama" placeholder="Nama Anda" required style="width: 100%; padding: 10px; margin-bottom: 10px; border-radius: 8px; border: 1px solid #ccc;">
            <textarea name="komentar" placeholder="Tulis ulasan..." required style="width: 100%; padding: 10px; margin-bottom: 10px; border-radius: 8px; border: 1px solid #ccc;"></textarea>

            <!-- Rating Bintang -->
            <div style="text-align: center; margin-bottom: 10px;">
                <label style="display: block; margin-bottom: 5px;">Rating:</label>
                <div id="starContainer">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <span class="star" data-value="<?= $i ?>" style="font-size: 24px; cursor: pointer; color: #ccc;">&#9733;</span>
                    <?php endfor; ?>
                </div>
                <input type="hidden" name="rating" id="ratingInput" required>
            </div>

            <div style="text-align: center;">
                <button type="submit" name="submit" class="cta-button">Kirim Ulasan</button>
            </div>
        </form>

        <div style="max-width: 700px; margin: auto;">
            <?php while ($row = mysqli_fetch_assoc($ulasan)) : ?>
                <div style="background: white; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); padding: 20px; margin-bottom: 20px;">
                    <strong style="color: #2ecc71; font-size: 1.2rem;"><?= htmlspecialchars($row['nama']) ?></strong>
                    <div style="color: gold; font-size: 20px; margin: 5px 0;">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <?= $i <= $row['rating'] ? '★' : '☆' ?>
                        <?php endfor; ?>
                    </div>
                    <p style="margin-bottom: 15px;"><?= nl2br(htmlspecialchars($row['komentar'])) ?></p>

              
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="text" name="nama" value="<?= htmlspecialchars($row['nama']) ?>" required style="width: 100%; padding: 8px; border-radius: 5px; margin-bottom: 8px;">
                        <textarea name="komentar" required style="width: 100%; padding: 8px; border-radius: 5px; margin-bottom: 8px;"><?= htmlspecialchars($row['komentar']) ?></textarea>
                        <input type="number" name="rating" min="1" max="5" value="<?= $row['rating'] ?>" required style="width: 80px; padding: 5px; margin-bottom: 10px;">

                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <button type="submit" name="update" class="cta-button" style="padding: 6px 12px;">Update</button>
                            <a href="ulasan.php?delete=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus ulasan ini?')" style="color: #e74c3c; text-decoration: none;">Hapus</a>
                        </div>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <!-- JavaScript: Bintang Interaktif -->
    <script>
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('ratingInput');

        stars.forEach(star => {
            star.addEventListener('click', function () {
                const rating = this.getAttribute('data-value');
                ratingInput.value = rating;

                stars.forEach(s => {
                    s.style.color = s.getAttribute('data-value') <= rating ? '#f1c40f' : '#ccc';
                });
            });
        });
    </script>

</body>
</html>



        <footer>
            <div class="footer-content" id="kontak">
                <div class="footer-section">
                    <h4>Tentang FarLearn</h4>
                    <p>Platform edukasi berbasis penelitian untuk pelestarian lingkungan dan sumber daya alam Indonesia.</p>
                </div>
                <div class="footer-section">
                    <h4>Hubungi Kami</h4>
                    <ul>
                        <li>Email: mafrdhan@gmail.com</li>
                        <li>Telepon: +62-813-3409-7813</li>
                        <li>Alamat: Sedati, Indonesia</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 FarLearn. Hak Cipta Dilindungi.</p>
            </div>
        </footer>
    </main>
</body>
</html>
