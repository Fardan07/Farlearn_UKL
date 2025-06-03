Proses Update User
<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_user'])) {
    $id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $conn->query("UPDATE users SET name='$name', email='$email' role='$role' WHERE id=$id");
    header("Location: users.php");
}
?>