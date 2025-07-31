<?php
// Validasi dan ambil data dari POST
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST['nama']);
    $deskripsi = trim($_POST['deskripsi']);
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];

    // Validasi sederhana
    if (empty($nama)) {
        $errors[] = "Nama produk tidak boleh kosong.";
    }
    if (empty($deskripsi)) {
        $errors[] = "Deskripsi tidak boleh kosong.";
    }
    if (!is_numeric($harga) || $harga < 0) {
        $errors[] = "Harga harus berupa angka positif.";
    }
    if (empty($kategori)) {
        $errors[] = "Kategori harus dipilih.";
    }

    // Tampilkan hasil atau error
    if (empty($errors)) {
        echo "<h2>Data Produk Berhasil Disimpan:</h2>";
        echo "<ul>";
        echo "<li><strong>Nama:</strong> " . htmlspecialchars($nama) . "</li>";
        echo "<li><strong>Deskripsi:</strong> " . htmlspecialchars($deskripsi) . "</li>";
        echo "<li><strong>Harga:</strong> Rp " . number_format($harga, 0, ',', '.') . "</li>";
        echo "<li><strong>Kategori:</strong> " . htmlspecialchars($kategori) . "</li>";
        echo "</ul>";
    } else {
        echo "<h2>Terjadi Kesalahan:</h2><ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul><a href='javascript:history.back()'>Kembali</a>";
    }
}
?>
