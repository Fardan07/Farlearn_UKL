<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'user'; 

    if ($name && $email && $password) {
  
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $password, $role);

        if ($stmt->execute()) {
            header("Location: users.php"); 
            exit();
        } else {
            echo "Gagal menambahkan data: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Semua field wajib diisi.";
    }
} else {
    echo "Akses tidak valid.";
}
?>
