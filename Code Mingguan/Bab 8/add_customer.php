<?php
    include 'config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addCustomer'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        // Query untuk menambah data pelanggan
        $sql = "INSERT INTO tb_customers (name, email, phone, address) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $phone, $address);

        if ($stmt->execute()) {
            echo "Pelanggan berhasil ditambahkan.";
        } else {
            echo "Gagal menambah pelanggan.";
        }
    }
    ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan</title>
</head>

<body>
    <h1>Tambah Pelanggan</h1>
    <form action="add_customer.php" method="POST">
        <label for="name">Nama</label>
        <input type="text" name="name" required>

        <label for="email">Email</label>
        <input type="email" name="email" required>

        <label for="phone">Telepon</label>
        <input type="text" name="phone">

        <label for="address">Alamat</label>
        <textarea name="address"></textarea>

        <button type="submit" name="addCustomer">Tambah Pelanggan</button>
    </form>
</body>

</html>