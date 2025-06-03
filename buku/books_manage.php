<?php
include 'db.php';

$id = $title = $author = $price = $description = $image = '';
$edit_mode = false;

if (isset($_GET['edit'])) {
    $edit_mode = true;
    $id = $_GET['edit'];
    $res = mysqli_query($koneksi, "SELECT * FROM books WHERE id=$id");
    $book = mysqli_fetch_assoc($res);
    $title = $book['title'];
    $author = $book['author'];
    $price = $book['price'];
    $description = $book['description'];
    $image = $book['image'];
}

if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "images/books/$image");
    } else {
        $image = $_POST['existing_image'] ?? '';
    }

    if ($_POST['id']) {
        $id = $_POST['id'];
        mysqli_query($koneksi, "UPDATE books SET title='$title', author='$author', price='$price', description='$description', image='$image' WHERE id=$id");
    } else {
        mysqli_query($koneksi, "INSERT INTO books (title, author, price, description, image) VALUES ('$title', '$author', '$price', '$description', '$image')");
    }

    header("Location: books_manage.php");
    exit;
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($koneksi, "DELETE FROM books WHERE id=$id");
    header("Location: books_manage.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Buku</title>
    <link rel="stylesheet" href="crud.css">
</head>
<body>
    <div class="container">
        <h2><?= $edit_mode ? 'Edit Buku' : 'Tambah Buku' ?></h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="existing_image" value="<?= $image ?>">

            <input type="text" name="title" placeholder="Judul Buku" value="<?= $title ?>" required>
            <input type="text" name="author" placeholder="Penulis" value="<?= $author ?>" required>
            <input type="text" name="price" placeholder="Harga" value="<?= $price ?>" required>
            <input type="text" name="description" placeholder="Deskripsi" value="<?= $description ?>" required>
            <input type="file" name="image" <?= $edit_mode ? '' : 'required' ?>>

            <button type="submit" name="save"><?= $edit_mode ? 'Update Buku' : 'Tambah Buku' ?></button>
        </form>

        <h2>Daftar Buku</h2>
        <table>
            <tr>
                <th>Cover</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
            <?php
            $result = mysqli_query($koneksi, "SELECT * FROM books ORDER BY id DESC");
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td>
                    <?php if ($row['image']) : ?>
                        <img src="../images/<?= $row['image'] ?>" width="60">
                    <?php endif; ?>
                </td>
                <td><?= $row['title'] ?></td>
                <td><?= $row['author'] ?></td>
                <td>Rp<?= number_format($row['price'], 3, ',', '.') ?></td>
                <td>
                    <a href="?edit=<?= $row['id'] ?>">Edit</a> |
                    <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Hapus buku ini?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
          <a href="../dashboard_admin/dashboard.php"><---Kembali</a>
    </div>
</body>
</html>
