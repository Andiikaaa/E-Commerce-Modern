<?php
session_start();

include 'config.php';  // Pastikan jalur file config.php benar


// Cek apakah pengguna sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Ambil jumlah data pelanggan
$sql = "SELECT COUNT(*) FROM tb_customers";
$result = $conn->query($sql);

// Cek apakah query berhasil
if ($result) {
    // Cek apakah ada hasil
    $totalCustomers = $result->fetch_row()[0] ?? 0;  // Jika tidak ada hasil, set 0 sebagai default
} else {
    // Jika query gagal, tampilkan pesan error
    echo "Error: " . $conn->error;
    $totalCustomers = 0;  // Set default 0 jika terjadi error
}

// Ambil nama pengguna dari sesi
$username = $_SESSION['admin'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiMart</title>
    <link rel="stylesheet" href="css/dasboard.css">
    <link rel="stylesheet" href="css/popup.css">
</head>

<body>
    <div class="header">
        <h1>DigiMart</h1>
        <p>Selamat datang, <strong><?php echo $username; ?></strong>!</p>
    </div>
    <div class="widget">
        <h3>Total Pelanggan</h3>
        <p><?php echo $totalCustomers; ?></p>
    </div>
    <nav class="nav">
        <a href="#">Home</a>
        <a href="#">Profil</a>
        <a href="#">Contact</a>
        <a href="kategori.php">Kategori</a>
        <a href="logout.php">Logout</a>
        <a href="generate_pdf.php">Unduh Daftar Pelanggan dalam Format PDF</a>
    </nav>
    <div class="banner">
        <img src="1.jpg" alt="Akulaku Promotion">
    </div>
    <div class="products">
        <?php
        // Daftar produk
        $products = [
            ["title" => "Samsung Galaxy A05s", "image" => "55.jpg"],
            ["title" => "Oppo Reno 12 Pro 5G", "image" => "3.jpg"],
            ["title" => "Vivo V30e", "image" => "4.jpg"]
        ];

        // Looping untuk menampilkan setiap produk
        foreach ($products as $product) {
            echo '<div class="product" onclick="showPopupAsync(\'' . $product['title'] . '\', \'' . $product['image'] . '\')">';
            echo '<img src="' . $product['image'] . '" alt="' . $product['title'] . '">';
            echo '<div class="tags">
                    <span>Gratis Ongkir</span>
                    <span>Extra Garansi</span>
                  </div>';
            echo '</div>';
        }
        ?>
    </div>

    <!-- Popup box -->
    <div id="popup-overlay" class="popup-overlay">
        <div class="popup-box">
            <span class="close-btn" onclick="hidePopup()">×</span>
            <h2 id="popup-title">Loading...</h2>
            <img id="popup-image" src="" alt="Product Image">
            <p id="popup-details">Sedang memuat detail produk...</p>
        </div>
    </div>

    <script>
    // Fungsi untuk menampilkan popup dengan data produk yang didapat secara asinkron
    async function showPopupAsync(title, imageSrc) {
        document.getElementById("popup-title").textContent = "Loading...";
        document.getElementById("popup-image").src = "";
        document.getElementById("popup-details").textContent = "Sedang memuat detail produk...";
        document.getElementById("popup-overlay").style.display = "flex";

        try {
            const productDetails = await fetchProductDetails(title, imageSrc);

            document.getElementById("popup-title").textContent = productDetails.title;
            document.getElementById("popup-image").src = productDetails.imageSrc;
            document.getElementById("popup-details").textContent = productDetails.details;
        } catch (error) {
            document.getElementById("popup-details").textContent = "Gagal memuat detail produk.";
        }
    }

    function fetchProductDetails(title, imageSrc) {
        return new Promise((resolve) => {
            setTimeout(() => {
                resolve({
                    title: title,
                    imageSrc: imageSrc,
                    details: "Detail lengkap untuk " + title + "."
                });
            }, 1000);
        });
    }

    function hidePopup() {
        document.getElementById("popup-overlay").style.display = "none";
    }
    </script>
</body>

</html>
</body>

</html>