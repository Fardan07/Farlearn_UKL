<?php
include 'db.php';

$id = '';
$title = '';
$description = '';
$tags = '';
$url = '';
$text = '';
$source = '';
$reading_time = '';

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit = mysqli_query($conn, "SELECT * FROM articles WHERE id=$id");
    $row = mysqli_fetch_assoc($edit);
    $title = $row['title'];
    $description = $row['description'];
    $tags = $row['tags'];
    $url = $row['url'];
    $text = $row['text'];
    $source = $row['source'];
    $reading_time = $row['reading_time'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Manajemen Artikel</title>
    <link rel="stylesheet" href="crud.css">
</head>
<body>

<div class="container">
    <h2><?= $id ? 'Edit Artikel' : 'Tambah Artikel' ?></h2>
    <form method="POST" action="article_action.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="text" name="title" placeholder="Judul Artikel" value="<?= $title ?>"><br>
        <textarea name="description" placeholder="Deskripsi Artikel"><?= $description ?></textarea><br>
        <input type="file" name="image"><br>
        <input type="text" name="tags" placeholder="Tag" value="<?= $tags ?>"><br>
        <input type="text" name="url" placeholder="URL" value="<?= $url ?>"><br>
        <textarea name="text" placeholder="Isi Artikel Lengkap"><?= $text ?></textarea><br>
        <input type="text" name="source" placeholder="Sumber" value="<?= $source ?>"><br>
        <input type="text" name="reading_time" placeholder="Estimasi Waktu Baca" value="<?= $reading_time ?>"><br>
        <button type="submit" name="<?= $id ? 'update' : 'create' ?>">Simpan</button>
    </form>
   

    <h2>Daftar Artikel</h2>
    <table>
        <tr>
            <th>Judul</th>
            <th>Tag</th>
            <th>Sumber</th>
            <th>Aksi</th>
        </tr>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM articles");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['title']}</td>
                    <td>{$row['tags']}</td>
                    <td>{$row['source']}</td>
                    <td>
                        <a href='?edit={$row['id']}'>Edit</a> |
                        <a href='article_action.php?delete={$row['id']}' onclick='return confirm(\"Hapus artikel ini?\")'>Hapus</a>
                    </td>
                  </tr>";
        }
        ?>
    </table>
      <a href="../dashboard_admin/dashboard.php"><---Kembali</a>
</div>
</body>
</html>