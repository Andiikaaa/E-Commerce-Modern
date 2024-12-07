<?php
include 'config.php'; // Hubungkan ke file koneksi database

// Variabel untuk menampilkan pesan sukses atau error
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi data input
    if (!empty($email) && !empty($username) && !empty($password)) {
        // Enkripsi password sebelum disimpan ke database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Query untuk menyimpan data ke tb_admin
        $sql = "INSERT INTO tb_admin (email, username, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $username, $hashed_password);

        if ($stmt->execute()) {
            $message = "Pendaftaran berhasil! Silakan <a href='login.php'>login</a>.";
        } else {
            $message = "Gagal mendaftarkan akun. Silakan coba lagi.";
        }
    } else {
        $message = "Harap isi semua data dengan benar!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/regis.css">
</head>

<body>
    <div class="signup-container">
        <h1>Sign Up</h1>
        <!-- Form Registrasi -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" class="btn">SIGN UP ➔</button>
        </form>

        <!-- Pesan -->
        <?php if ($message): ?>
        <p style="color: green;"><?php echo $message; ?></p>
        <?php endif; ?>

        <p class="signin">Already have an account? <a href="login.php">Sign In</a></p>
    </div>
</body>

</html>