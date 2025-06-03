Halaman Users
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data History</title>
    <link rel="stylesheet" type="text/css" href="crud.css">
</head>
<body>
    <div class="container">
        <h2>Login/Register History</h2>
        
<h2 class="section-title">Tambah Pengguna Baru</h2>

<form action="user_action.php" method="POST" class="user-form">
    <input type="text" name="name" placeholder="Nama" class="form-input" required>
    <input type="email" name="email" placeholder="Email" class="form-input" required>
    <input type="password" name="password" placeholder="Password" class="form-input" required>
    
    <select name="role" class="form-select" required>
        <option value="">-- Pilih Role --</option>
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select>

    <button type="submit" class="form-button">Tambah</button>
</form>

      <table border="1">
    <tr><th>ID</th><th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th></tr>
    <?php
    $result = $conn->query("SELECT * FROM users");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['user_id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['role']}</td>
                <td>
                    <a href='user_edit.php?id={$row['user_id']}'>Edit</a> 
                    <a href='user_delete.php?id={$row['user_id']}' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                </td>
              </tr>";
    }
    ?>
</table>

        <br>
         <a href="../dashboard_admin/dashboard.php"><---Kembali</a>
    </div>
</body>
</html>