<?php 
session_start();
require '../Login_Page/config.php';

// Cek apakah user sudah login
if (!isset($_SESSION['email'])) {
    header("Location: ../Login_Page/login.php");
    exit();
}

$pesan = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $full_name = htmlspecialchars($_POST['nama']);
    $address = htmlspecialchars($_POST['alamat']);
    $phone = htmlspecialchars($_POST['nomor_hp']);
    $city = htmlspecialchars($_POST['kota']); // Tambahan
    $postal_code = htmlspecialchars($_POST['kode_pos']);
    $email = $_SESSION['email'];

    // Ambil user_id dari tabel users berdasarkan email
    $stmt_user = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt_user->bind_param("s", $email);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();

    if ($result_user->num_rows > 0) {
        $row = $result_user->fetch_assoc();
        $user_id = $row['user_id'];

        // Simpan data ke tabel checkout_presets
        $query = "INSERT INTO checkout_presets (user_id, full_name, phone, city, address, postal_code) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isssss", $user_id, $full_name, $phone, $city, $address, $postal_code);

        if ($stmt->execute()) {
            $pesan = "✅ Data preset berhasil disimpan.";
        } else {
            $pesan = "❌ Gagal menyimpan data preset.";
        }
    } else {
        $pesan = "❌ Pengguna tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Isi Data Checkout Otomatis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn:hover {
            background: #2980b9;
        }
        .message {
            text-align: center;
            margin-top: 10px;
            color: green;
        }
        .back-btn {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #3498db;
        }
        .back-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Isi Data Checkout Otomatis</h2>
    <form action="" method="post">
        <input type="text" name="nama" placeholder="Nama Lengkap" required>
        <textarea name="alamat" placeholder="Alamat Lengkap" required></textarea>
        <input type="text" name="nomor_hp" placeholder="Nomor HP" required>
        <input type="text" name="kota" placeholder="Kota" required> <!-- Tambahan -->
        <input type="text" name="kode_pos" placeholder="Kode Pos" required>
        <button type="submit" class="btn">Simpan Data Preset</button>
    </form>
    <?php if (!empty($pesan)) echo "<div class='message'>$pesan</div>"; ?>
    <a href="../Login_Page/dashboard.php" class="back-btn">← Kembali ke Dashboard</a>
</div>
</body>
</html>
