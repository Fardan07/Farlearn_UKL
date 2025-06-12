<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../Login_page/login.php');
    exit();
}

require '../Login_Page/config.php';
$email = $_SESSION['email'];

// Ambil user_id berdasarkan email
$stmt_user = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
$stmt_user->bind_param("s", $email);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$row_user = $result_user->fetch_assoc();
$user_id = $row_user['user_id'] ?? null;

if (!$user_id) {
    die("User ID tidak ditemukan.");
}

// Ambil data preset milik user
$query_preset = "SELECT * FROM checkout_presets WHERE user_id = ?";
$stmt = $conn->prepare($query_preset);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_preset = $stmt->get_result();

// Default data preset kosong
$preset_data = [
    'full_name' => '',
    'address' => '',
    'phone' => '',
    'city' => '',
    'postal_code' => ''
];

// Jika user memilih preset, ambil datanya
if (isset($_GET['preset_id'])) {
    $preset_id = $_GET['preset_id'];
    $get_preset = $conn->prepare("SELECT * FROM checkout_presets WHERE id = ? AND user_id = ?");
    $get_preset->bind_param("ii", $preset_id, $user_id);
    $get_preset->execute();
    $result = $get_preset->get_result();
    if ($result->num_rows > 0) {
        $preset_data = $result->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background: #f3f3f3;
        }
        .container {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin: 15px 0 5px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        .btn {
            margin-top: 20px;
            padding: 10px 20px;
            width: 100%;
            background-color: #2ecc71;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #27ae60;
        }
        .back-btn {
            display: inline-block;
            margin-top: 15px;
            text-align: center;
            padding: 8px 15px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        .back-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Checkout Buku</h2>

    <!-- Pilih data preset -->
    <form method="get" action="">
        <label for="preset_id">Pilih Data Checkout Tersimpan:</label>
        <select name="preset_id" id="preset_id" onchange="this.form.submit()">
            <option value="">-- Pilih Data Checkout --</option>
            <?php while ($preset = $result_preset->fetch_assoc()): ?>
                <option value="<?= $preset['id'] ?>" <?= (isset($_GET['preset_id']) && $_GET['preset_id'] == $preset['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($preset['full_name']) ?> - <?= htmlspecialchars($preset['city']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </form>

    <!-- Form checkout utama -->
    <form action="process_checkout.php" method="post">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id) ?>">
        <input type="hidden" name="user_email" value="<?= htmlspecialchars($email) ?>">

        <label for="full_name">Nama Penerima:</label>
        <input type="text" name="full_name" id="full_name" value="<?= htmlspecialchars($preset_data['full_name']) ?>" required>

        <label for="phone">No HP:</label>
        <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($preset_data['phone']) ?>" required>

        <label for="address">Alamat:</label>
        <input type="text" name="address" id="address" value="<?= htmlspecialchars($preset_data['address']) ?>" required>

        <label for="city">Kota:</label>
        <input type="text" name="city" id="city" value="<?= htmlspecialchars($preset_data['city']) ?>" required>

        <label for="postal_code">Kode Pos:</label>
        <input type="text" name="postal_code" id="postal_code" value="<?= htmlspecialchars($preset_data['postal_code']) ?>" required>

        <label for="payment_method">Metode Pembayaran:</label>
       <select name="payment_method" id="payment_method" required>
    <option value="">-- Pilih Metode Pembayaran --</option>
    <option value="1">Transfer Bank</option>
    <option value="2">COD (Bayar di Tempat)</option>
    <option value="3">E-Wallet</option>
    </select>


        <button type="submit" class="btn">Checkout Sekarang</button>
    </form>

    <a href="cart.php" class="back-btn">← Kembali ke Keranjang</a>
</div>
</body>
</html>
