<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiMart Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="login-container">
        <h1 class="logo">DigiMart</h1>
        <p>Welcome back !!!</p>
        <h2>Sign in</h2>

        <?php
session_start();
include 'config.php'; // Hubungkan ke file koneksi database

$error = ""; // Variabel untuk pesan error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mendapatkan data admin berdasarkan email
    $sql = "SELECT * FROM tb_admin WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin'] = $admin['username']; // Simpan sesi nama pengguna
            header("Location: dasboard.php"); // Redirect ke dashboard
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email tidak ditemukan!";
    }
}
?>
        <!-- Form Login -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="loginForm">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <a href="#">Forgot Password?</a>
            <button type="submit" class="btn">SIGN IN ➔</button>
        </form>

        <!-- Pesan error jika login gagal -->
        <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <p class="signup">I don't have an account ? <a href="regis.php">Sign up</a></p>
    </div>

    <!-- Toast/Snackbar element -->
    <div id="toast"></div>

    <script>
    function showToast(message) {
        var toast = document.getElementById("toast");
        toast.textContent = message;
        toast.className = "show";
        setTimeout(function() {
            toast.className = toast.className.replace("show", "");
        }, 3000);
    }

    // Menampilkan toast jika ada error
    <?php if ($error): ?>
    showToast("<?php echo $error; ?>");
    <?php endif; ?>
    </script>
</body>

</html>