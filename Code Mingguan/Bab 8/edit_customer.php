<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tb_customers WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $customer = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateCustomer'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "UPDATE tb_customers SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $email, $phone, $address, $id);

    if ($stmt->execute()) {
        echo "Pelanggan berhasil diperbarui.";
    } else {
        echo "Gagal memperbarui pelanggan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggan</title>
</head>

<body>
    <h1>Edit Pelanggan</h1>
    <form action="edit_customer.php?id=<?php echo $id; ?>" method="POST">
        <label for="name">Nama</label>
        <input type="text" name="name" value="<?php echo $customer['name']; ?>" required>

        <label for="email">Email</label>
        <input type="email" name="email" value="<?php echo $customer['email']; ?>" required>

        <label for="phone">Telepon</label>
        <input type="text" name="phone" value="<?php echo $customer['phone']; ?>">

        <label for="address">Alamat</label>
        <textarea name="address"><?php echo $customer['address']; ?></textarea>

        <button type="submit" name="updateCustomer">Perbarui Pelanggan</button>
    </form>
</body>

</html>