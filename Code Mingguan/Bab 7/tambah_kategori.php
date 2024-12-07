<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $photo = $_POST['photo'];
    $categories = $_POST['categories'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "INSERT INTO tb_categories (photo, categories, description, price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $photo, $categories, $description, $price);
    if ($stmt->execute()) {
        header("Location: kategori.php");
        exit();
    } else {
        echo "Gagal menambah data.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
</head>

<body>
    <h1>Tambah Kategori</h1>
    <form action="" method="POST">
        <label for="photo">Photo</label>
        <input type="text" name="photo" id="photo" required>
        <label for="categories">Categories</label>
        <input type="text" name="categories" id="categories" required>
        <label for="description">Description</label>
        <textarea name="description" id="description" required></textarea>
        <label for="price">Price</label>
        <input type="number" name="price" id="price" required>
        <button type="submit">Tambah</button>
    </form>
</body>

</html>