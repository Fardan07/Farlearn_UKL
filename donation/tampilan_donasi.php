<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "project_ukl_ku");

// Cek koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit;
}

// Ambil data dari tabel donation (bukan donations)
$query = "SELECT * FROM donations ORDER BY created_at DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Donasi</title>
    <link rel="stylesheet" href="../crud/crud.css"> 
</head>
<body>

<div class="container">
    <h2>Daftar Donasi</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Pesan</th>
                <th>Jumlah Donasi</th>
                <th>Metode Pembayaran</th>
                <th>Tanggal Donasi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
                <td><?= htmlspecialchars($row['message']); ?></td>
                <td>Rp <?= number_format($row['amount'], 0, ',', '.'); ?></td>
                <td><?= htmlspecialchars($row['payment_method']); ?></td>
                <td><?= $row['created_at']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
      <a href="../dashboard_admin/dashboard.php"><---Kembali</a>
</div>

</body>
</html>
