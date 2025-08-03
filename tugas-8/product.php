<?php
include 'koneksi.php';

// Ambil daftar kategori unik
$kategori_query = "SELECT DISTINCT kategori FROM products";
$kategori_result = mysqli_query($conn, $kategori_query);

$selected_kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

$sql = "SELECT name, harga, deskripsi, stok, kategori, image FROM products";
if ($selected_kategori) {
    $sql .= " WHERE kategori = '" . mysqli_real_escape_string($conn, $selected_kategori) . "'";
}
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<style>
    .product-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
</style>
<div class="container mt-5">
    <h2 class="mb-4">Daftar Produk</h2>
    <form method="get" class="mb-4">
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <label for="kategori" class="form-label mb-5"
            </div>
            <div class="col-auto">
                <select name="kategori" id="kategori" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    <?php if ($kategori_result && mysqli_num_rows($kategori_result) > 0): ?>
                        <?php while ($kat = mysqli_fetch_assoc($kategori_result)): ?>
                            <option value="<?= htmlspecialchars($kat['kategori']) ?>" <?= $selected_kategori == $kat['kategori'] ? 'selected' : '' ?>><?= htmlspecialchars($kat['kategori']) ?></option>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>
    </form>
    <div class="row">
        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                     <?php if (!empty($row['image'])): ?>
                         <img src="images/<?= htmlspecialchars($row['image']) ?>" class="card-img-top product-img" alt="<?= htmlspecialchars($row['name']) ?>">
                        <?php else: ?>
                        <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top product-img" alt="No Image">
                         <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                            <p class="card-text"><strong>Harga:</strong> Rp<?= number_format($row['harga'], 0, ',', '.') ?></p>
                            <p class="card-text"><strong>Deskripsi:</strong> <?= htmlspecialchars($row['deskripsi']) ?></p>
                            <p class="card-text"><strong>Stok:</strong> <?= htmlspecialchars($row['stok']) ?></p>
                            <p class="card-text"><strong>Kategori:</strong> <?= htmlspecialchars($row['kategori']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning">Tidak ada produk ditemukan.</div>
            </div>
        <?php endif; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
