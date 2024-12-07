<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori - DigiMart</title>
    <link rel="stylesheet" href="css/kategori.css">
</head>

<body>
    <a href="#" class="button-add">Tambah Data</a>

    <!-- Form Tambah Data -->
    <h2>Tambah Kategori</h2>
    <form action="kategori.php" method="POST" enctype="multipart/form-data">
        <label for="photo">Gambar</label>
        <input type="file" name="photo" required>

        <label for="categories">Kategori</label>
        <input type="text" name="categories" required>

        <label for="description">Deskripsi</label>
        <textarea name="description" required></textarea>

        <label for="price">Harga</label>
        <input type="number" name="price" required>

        <button type="submit" name="addCategory">Tambah Kategori</button>
    </form>

    <table>
        <tr>
            <th>Photo</th>
            <th>Categories</th>
            <th>Description</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <?php
        // Ambil dan tampilkan data kategori
        include 'config.php'; // Pastikan koneksi database sudah terhubung

        // Proses Tambah Kategori
        if (isset($_POST['addCategory'])) {
            $photo = $_FILES['photo']['name'];
            $categories = $_POST['categories'];
            $description = $_POST['description'];
            $price = $_POST['price'];

            // Upload file gambar
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($photo);
            move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile);

            // Query untuk menambah kategori
            $sql = "INSERT INTO tb_categories (photo, categories, description, price) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $photo, $categories, $description, $price);

            if ($stmt->execute()) {
                echo "<script>alert('Kategori berhasil ditambahkan'); window.location.href = 'kategori.php';</script>";
            } else {
                echo "Error: " . $stmt->error;
            }
        }

        // Tampilkan data kategori
        $sql = "SELECT * FROM tb_categories";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><img src='uploads/" . $row['photo'] . "' alt='" . $row['categories'] . "' style='max-width: 100px; border-radius: 10px;'></td>";
                echo "<td>" . $row['categories'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>
                        <a href='kategori.php?delete=" . $row['id'] . "' class='action-btn delete-btn'>Hapus</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data kategori.</td></tr>";
        }
        ?>
    </table>
</body>

</html>