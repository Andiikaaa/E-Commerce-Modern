<?php
// Include autoloader dari DOMPDF
require_once 'dompdf/autoload.inc.php';  // Mengarah ke folder parent
// require_once 'dompdf/autoload.inc.php'; // Jika tidak menggunakan Composer

use Dompdf\Dompdf;
use Dompdf\Options;

include 'config.php';

// Ambil Data Pelanggan dari database
$sql = "SELECT * FROM tb_customers";
$result = $conn->query($sql);

// Membuat konten HTML untuk PDF
$html = '<h1>Daftar Pelanggan</h1>';
$html .= '<table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>';

while ($row = $result->fetch_assoc()) {
    $html .= '<tr>';
    $html .= '<td>' . $row['name'] . '</td>';
    $html .= '<td>' . $row['email'] . '</td>';
    $html .= '<td>' . $row['phone'] . '</td>';
    $html .= '<td>' . $row['address'] . '</td>';
    $html .= '</tr>';
}

$html .= '</tbody></table>';

// Inisialisasi DOMPDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);

$dompdf = new Dompdf($options);

// Memuat HTML ke DOMPDF
$dompdf->loadHtml($html);

// Set ukuran halaman (A4 adalah ukuran default)
$dompdf->setPaper('A4', 'portrait');

// Render PDF (membuat PDF dari HTML)
$dompdf->render();

// Menyimpan atau mengirim PDF ke browser
$dompdf->stream("daftar_pelanggan.pdf", array("Attachment" => 0)); // 0 = tampilkan di browser, 1 = unduh