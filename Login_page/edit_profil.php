<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: ../Login_page/login.php");
    exit();
}

require 'config.php';

$email_session = $_SESSION["email"];
$pesan = "";

// Ambil data user dari DB berdasarkan session email
$query = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email_session);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_name = htmlspecialchars($_POST["name"]);
    $new_email = htmlspecialchars($_POST["email"]);

    // Cek jika email baru sudah dipakai user lain
    $cek_email = "SELECT * FROM users WHERE email = ? AND email != ?";
    $stmt_cek = $conn->prepare($cek_email);
    $stmt_cek->bind_param("ss", $new_email, $email_session);
    $stmt_cek->execute();
    $result_cek = $stmt_cek->get_result();

    if ($result_cek->num_rows > 0) {
        $pesan = "❌ Email sudah digunakan oleh pengguna lain!";
    } else {
        // Update data
        $update = "UPDATE users SET name = ?, email = ? WHERE email = ?";
        $stmt_update = $conn->prepare($update);
        $stmt_update->bind_param("sss", $new_name, $new_email, $email_session);
        if ($stmt_update->execute()) {
            $_SESSION["name"] = $new_name;
            $_SESSION["email"] = $new_email;
            $pesan = "✅ Profil berhasil diperbarui! Silakan logout dan login ulang menggunakan email baru.";
        } else {
            $pesan = "❌ Gagal memperbarui profil.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    background: linear-gradient(to right, #4facfe, #00f2fe);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background: white;
    padding: 30px 40px;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    width: 100%;
    max-width: 400px;
    box-sizing: border-box;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

input[type="text"], input[type="email"] {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 6px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

.btn {
    background: #2ecc71;
    color: white;
    border: none;
    padding: 10px 20px;
    margin-top: 10px;
    width: 100%;
    border-radius: 6px;
    cursor: pointer;
}

.btn:hover {
    background: #27ae60;
}

.back {
    display: block;
    margin-top: 15px;
    text-align: center;
    color: #3498db;
    text-decoration: none;
}

.message {
    text-align: center;
    color: #e74c3c;
    margin-top: 10px;
}

.message.success {
    color: #2ecc71;
}

    </style>
</head>
<body>
<div class="container">
    <h2>Edit Profil</h2>
    <form action="" method="post">
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" placeholder="Nama" required>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" placeholder="Email" required>
        <button type="submit" class="btn">Simpan Perubahan</button>
    </form>
    <a href="dashboard.php" class="back">← Kembali ke Dashboard</a>
    <?php if (!empty($pesan)): ?>
        <div class="message <?= strpos($pesan, 'berhasil') !== false ? 'success' : '' ?>">
            <?= $pesan ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
