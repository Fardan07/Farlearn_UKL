<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'] ?? null;
    $user_email = $_POST['user_email'];
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postal_code = $_POST['postal_code'];
    $payment_method = $_POST['payment_method'];

    // Validasi total_price
    if (!isset($_POST['total_price']) || !is_numeric($_POST['total_price'])) {
        die("Total harga tidak valid.");
    }
    $total_price = floatval($_POST['total_price']);

    // Validasi book_ids
    if (!isset($_POST['book_ids']) || !is_array($_POST['book_ids'])) {
        die("Data buku tidak valid.");
    }

    // Simpan ke tabel orders
    $query = "INSERT INTO orders (user_id, user_email, full_name, phone, address, city, postal_code, payment_method, total_price, order_date)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param(
        "issssssis",
        $user_id,
        $user_email,
        $full_name,
        $phone,
        $address,
        $city,
        $postal_code,
        $payment_method,
        $total_price
    );

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;

        // Masukkan detail buku dari $_POST['book_ids']
        foreach ($_POST['book_ids'] as $book_id => $qty) {
            $book_id = intval($book_id);
            $qty = intval($qty);
            if ($qty <= 0) continue;

            // Ambil harga dari database
            $result = mysqli_query($koneksi, "SELECT price FROM books WHERE id = $book_id");
            $book = mysqli_fetch_assoc($result);
            if (!$book) continue;

            $price = floatval($book['price']);

            $query_item = "INSERT INTO order_items (order_id, book_id, quantity, price)
                           VALUES (?, ?, ?, ?)";
            $stmt_item = $koneksi->prepare($query_item);
            $stmt_item->bind_param("iiid", $order_id, $book_id, $qty, $price);
            $stmt_item->execute();
        }

        // Kosongkan keranjang di session kalau ada
        unset($_SESSION['cart']);

        header("Location: thanks.php");
        exit();
    } else {
        echo "Gagal melakukan checkout: " . $stmt->error;
    }

    $stmt->close();
}
$koneksi->close();
?>
