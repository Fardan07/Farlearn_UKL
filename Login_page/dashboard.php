<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: ../Login_page/login.php");
    exit();
}

$name = $_SESSION["name"];
$role = $_SESSION["role"];
$email = $_SESSION["email"];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pengguna</title>
    <style>
        :root {
            --primary: #4CAF50;
            --secondary: #2ecc71;
            --dark: #2c3e50;
            --light: #ecf0f1;
            --shadow: rgba(0, 0, 0, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            width: 450px;
            box-shadow: 0 10px 25px var(--shadow);
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .profile-img {
            width: 100px;
            height: 100px;
            background: var(--secondary);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: white;
            font-weight: bold;
        }

        h2 {
            text-align: center;
            color: var(--dark);
            margin-bottom: 10px;
        }

        .info {
            text-align: center;
            font-size: 16px;
            color: #555;
            margin-bottom: 25px;
        }

        .buttons {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .buttons a {
            text-decoration: none;
            background: var(--primary);
            color: white;
            padding: 12px;
            border-radius: 10px;
            text-align: center;
            transition: background 0.3s ease;
        }

        .buttons a:hover {
            background: #388E3C;
        }

        .admin {
            margin-top: 15px;
            font-size: 14px;
            color: var(--dark);
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="profile-img">
            <?= strtoupper(substr($name, 0, 1)) ?>
        </div>
        <h2><?= htmlspecialchars($name) ?></h2>
        <div class="info">
            <div><strong>Email:</strong> <?= htmlspecialchars($email) ?></div>
            <div><strong>Status:</strong> Login berhasil ✅</div>
        </div>

        <div class="buttons">
    <a href="http://localhost/farlearn/UKL/ukl.php">🏠 Beranda</a>
    <a href="http://localhost/farlearn/buku/order_history.php">📚 Riwayat Pembelian</a>
    
    <?php if ($role === 'admin'): ?>
        <a href="../dashboard_admin/dashboard.php">🛠 Dashboard Admin</a>
    <?php endif; ?>

    <a href="edit_profil.php">✏️ Edit Profil</a>
    <a href="../Login_page/logout.php">🚪 Logout</a>
     <a href="../buku/checkout_preset.php"> Tambahkan Form Data Checkout Otomatis</a>
</div>

</body>
</html>
