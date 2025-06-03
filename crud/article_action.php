<?php
include 'db.php';

if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $tags = $_POST['tags'];
    $url = $_POST['url'];
    $text = $_POST['text'];
    $source = $_POST['source'];
    $reading_time = $_POST['reading_time'];

    $image = '';
    if ($_FILES['image']['name']) {
        $image = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
    }

    mysqli_query($conn, "INSERT INTO articles (title, description, tags, url, text, source, reading_time, image)
        VALUES ('$title', '$description', '$tags', '$url', '$text', '$source', '$reading_time', '$image')");
    header("Location: articles.php");
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $tags = $_POST['tags'];
    $url = $_POST['url'];
    $text = $_POST['text'];
    $source = $_POST['source'];
    $reading_time = $_POST['reading_time'];

    if ($_FILES['image']['name']) {
        $image = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
        $query = "UPDATE articles SET title='$title', description='$description', tags='$tags', url='$url', text='$text', source='$source', reading_time='$reading_time', image='$image' WHERE id=$id";
    } else {
        $query = "UPDATE articles SET title='$title', description='$description', tags='$tags', url='$url', text='$text', source='$source', reading_time='$reading_time' WHERE id=$id";
    }
    mysqli_query($conn, $query);
    header("Location: articles.php");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM articles WHERE id=$id");
    header("Location: articles.php");
}
