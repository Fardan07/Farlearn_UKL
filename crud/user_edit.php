<?php
include 'db.php';

$user_id = $_GET['user_id'] ?? null;

if (!$user_id) {
    echo "User ID tidak ditemukan.";
    exit;
}

$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User tidak ditemukan.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = $_POST["name"];
    $email = $_POST["email"];
    $role  = $_POST["role"];

    $sql = "UPDATE users SET name = ?, email = ?, role = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $role, $user_id);

    if ($stmt->execute()) {
        header("Location: users.php");
        exit;
    } else {
        echo "Gagal memperbarui data.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="useredit.css">
</head>
<body>
<div class="container">
    <h2>Edit User</h2>
    <form method="post">
        <label for="name">Nama:</label><br>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br>

        <label for="role">Role:</label><br>
        <select id="role" name="role" required>
            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
        </select><br><br>

        <button type="submit">Update</button>
    </form>
</div>
</body>
</html>
