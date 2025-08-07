<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    // Ambil data image untuk hapus file fisik
    $get = mysqli_query($conn, "SELECT image FROM products WHERE id=$id");
    $row = mysqli_fetch_assoc($get);
    if ($row && !empty($row['image']) && file_exists('../images/' . $row['image'])) {
        unlink('../images/' . $row['image']);
    }
    // Hapus data dari database
    $delete = mysqli_query($conn, "DELETE FROM products WHERE id=$id");
    if ($delete) {
        header('Location: product_table.php?msg=deleted');
        exit;
    } else {
        echo "Gagal menghapus produk: " . $conn->error;
    }
} else {
    echo "ID produk tidak ditemukan.";
}
$conn->close();
?>
