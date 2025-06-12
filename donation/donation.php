<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../Login_page/akses_ditolak.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Donasi</title>
    <link rel="stylesheet" href="donation.css">
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
<div class="container">
    <form action="donasi_berhasil.php" method="POST" class="donation-form">
        <h2>Donasi Sekarang</h2>


        <input type="text" name="name" placeholder="Nama" required>

        <input type="email" name="email" placeholder="Email" required>

        <textarea name="message" placeholder="Pesan (opsional)" rows="3"></textarea>

        <p><strong>Pilih Jumlah Donasi:</strong></p>
        <div class="card-options">
            <input type="radio" name="amount" id="amt1" value="5000" required>
            <label for="amt1" class="card">Rp5.000</label>

            <input type="radio" name="amount" id="amt2" value="10000">
            <label for="amt2" class="card">Rp10.000</label>

            <input type="radio" name="amount" id="amt3" value="25000">
            <label for="amt3" class="card">Rp25.000</label>

            <input type="radio" name="amount" id="amt4" value="">
            <label for="amt4" class="card">
                Lainnya:<br>
                <input type="number" name="custom_amount" placeholder="Masukkan jumlah" min="1000">
            </label>
        </div>

        <!-- Pilih Metode Pembayaran -->
        <p><strong>Metode Pembayaran:</strong></p>
        <div class="card-options">
            <input type="radio" name="payment_method" id="pay1" value="Transfer Bank" required>
            <label for="pay1" class="card">Transfer Bank</label>

            <input type="radio" name="payment_method" id="pay2" value="OVO">
            <label for="pay2" class="card">OVO</label>

            <input type="radio" name="payment_method" id="pay3" value="GoPay">
            <label for="pay3" class="card">GoPay</label>

            <input type="radio" name="payment_method" id="pay4" value="Dana">
            <label for="pay4" class="card">Dana</label>
        </div>

        <button type="submit" class="btn btn-donate">Donasi</button>
        <br>
        <a href="donation_history.php" class="btn btn-back">History Donaasi</a>
        <br>
        <a href="http://localhost/farlearn/UKL/ukl.php" class="btn btn-back">Kembali</a>
    </form>
</div>
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
