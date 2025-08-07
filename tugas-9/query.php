<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $required = ['name', 'harga', 'deskripsi', 'stok', 'kategori', 'image'];
    foreach ($required as $field) {
        if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
            echo "Error: Field $field harus diisi.";
            $conn->close();
            exit;
        }
    }
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $harga = (int)$_POST['harga'];
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $stok = (int)$_POST['stok'];
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);

    if ($harga < 0) {
        echo "Error: Harga harus angka positif.";
        $conn->close();
        exit;
    }
    if ($stok < 0) {
        echo "Error: Stok harus angka positif.";
        $conn->close();
        exit;
    }

    $sql = "INSERT INTO products (name, harga, deskripsi, stok, kategori, image) VALUES ('$name', $harga, '$deskripsi', $stok, '$kategori', '$image')";
    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
    exit;
}

$conn->close();
?>