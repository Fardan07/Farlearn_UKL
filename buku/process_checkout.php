<?php
session_start();
require '../Login_Page/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data user dari form
    $user_id = $_POST['user_id'] ?? null;
    $email = $_POST['user_email'] ?? '';
    $full_name = $_POST['full_name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $city = $_POST['city'] ?? '';
    $postal_code = $_POST['postal_code'] ?? '';
    $payment_method = $_POST['payment_method'] ?? '';

    if (!$user_id || !$email || !$full_name || !$phone || !$address || !$city || !$postal_code || !$payment_method) {
        die("Semua data wajib diisi!");
    }

    // Ambil isi keranjang dari session
    $cart = $_SESSION['cart'] ?? [];

    if (empty($cart)) {
        die("Keranjang kosong, tidak bisa checkout.");
    }

    // Hitung total harga dari database agar tidak bisa dimanipulasi
    $book_ids = array_keys($cart);
    $total_price = 0;
    $items = [];

    if (!empty($book_ids)) {
        $ids_str = implode(',', array_map('intval', $book_ids));
        $query = $conn->query("SELECT * FROM books WHERE id IN ($ids_str)");

        while ($row = $query->fetch_assoc()) {
            $book_id = $row['id'];
            $qty = $cart[$book_id];
            $subtotal = $row['price'] * $qty;
            $total_price += $subtotal;

            $items[] = [
                'book_id' => $book_id,
                'quantity' => $qty,
                'price' => $row['price']
                // kolom subtotal dihapus dari sini
            ];
        }
    }

    // Simpan ke tabel orders
    $stmt_order = $conn->prepare("INSERT INTO orders (user_id, full_name, phone, address, city, postal_code, payment_method, total_price, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt_order->bind_param("issssssd", $user_id, $full_name, $phone, $address, $city, $postal_code, $payment_method, $total_price);

    if ($stmt_order->execute()) {
        $order_id = $stmt_order->insert_id;

        // Simpan item satu per satu ke order_items (tanpa kolom subtotal)
        $stmt_item = $conn->prepare("INSERT INTO order_items (order_id, book_id, quantity, price) VALUES (?, ?, ?, ?)");
        foreach ($items as $item) {
            $stmt_item->bind_param("iiid", $order_id, $item['book_id'], $item['quantity'], $item['price']);
            $stmt_item->execute();
        }

        // Hapus keranjang
        unset($_SESSION['cart']);

        // Redirect ke halaman sukses
        header("Location: thanks.php?order_id=" . $order_id);
        exit();
    } else {
        echo "Gagal menyimpan pesanan: " . $conn->error;
    }
} else {
    echo "Akses tidak valid.";
}
?>
