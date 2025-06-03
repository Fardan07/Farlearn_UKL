<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "project_ukl_ku";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];

    $query = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: users.php");
        exit();
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($conn);
    }
}
?>
