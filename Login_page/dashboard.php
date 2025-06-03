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
    <title>Dashboard Profil</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #2ecc71, #acb6e5);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .dashboard {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
            transition: transform 0.3s;
        }

        .dashboard:hover {
            transform: scale(1.03);
        }

        h1 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .info {
            margin: 15px 0;
            color: #555;
            font-size: 18px;
        }

        .button, .logout {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background: #2ecc71;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .button:hover, .logout:hover {
            background: #27ae60;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>Halo, <?= htmlspecialchars($name) ?>!</h1>
        <div class="info">Email: <?= htmlspecialchars($email) ?></div>
        <div class="info">Status: Login berhasil ✅</div>


        <a href="../Login_page/logout.php" class="logout">Logout</a>
        <br>

 
        <a href="http://localhost/farlearn/UKL/ukl.php" class="button">Beranda</a>

  
        <?php if ($role === 'admin'): ?>
            <br>
            <a href="../dashboard_admin/dashboard.php" class="button">Dashboard Admin</a>
        <?php endif; ?>
        <br>
         <a href="http://localhost/farlearn/buku/order_history.php" class="button">Histori Pembelian Buku</a>
    </div>
</body>
</html>

