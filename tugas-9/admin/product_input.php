<?php
include '../koneksi.php';
$success = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $harga = trim($_POST['harga'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $stok = trim($_POST['stok'] ?? '');
    $kategori = trim($_POST['kategori'] ?? '');
    $image = '';

    // Validasi
    if ($name === '' || $harga === '' || $deskripsi === '' || $stok === '' || $kategori === '') {
        $error = 'Semua field harus diisi.';
    } elseif (!is_numeric($harga) || $harga < 0) {
        $error = 'Harga harus berupa angka positif.';
    } elseif (!is_numeric($stok) || $stok < 0) {
        $error = 'Stok harus berupa angka positif.';
    } elseif (!isset($_FILES['image']) || $_FILES['image']['error'] != 0) {
        $error = 'Gambar produk harus dipilih.';
    } else {
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = mime_content_type($file_tmp);
        if (strpos($file_type, 'image/') !== 0) {
            $error = 'File yang diupload harus berupa gambar.';
        } else {
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $new_name = uniqid('img_', true) . '.' . $file_ext;
            $target_dir = '../images/' . $new_name;
            if (move_uploaded_file($file_tmp, $target_dir)) {
                $image = $new_name;
                // Kirim data ke query.php menggunakan cURL
                $data = http_build_query([
                    'name' => $name,
                    'harga' => $harga,
                    'deskripsi' => $deskripsi,
                    'stok' => $stok,
                    'kategori' => $kategori,
                    'image' => $image
                ]);
                $ch = curl_init('http://localhost/tugas-8/query.php');
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                if (strpos($response, 'success') !== false || strpos(strtolower($response), 'berhasil') !== false) {
                    $success = 'Produk berhasil disimpan!';
                } else {
                    $error = 'Gagal menyimpan produk: ' . $response;
                }
            } else {
                $error = 'Gagal upload gambar.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="product_table.php">Tabel Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="product_input.php">Daftar Products</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-5">
    <h2>Form Input Produk</h2>
    <?php if ($success): ?>
        <div class="alert alert-success"> <?= $success ?> </div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert alert-danger"> <?= $error ?> </div>
    <?php endif; ?>
    <form method="post" class="mt-3" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" required min="0" value="<?= htmlspecialchars($_POST['harga'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" required><?= htmlspecialchars($_POST['deskripsi'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" required min="0" value="<?= htmlspecialchars($_POST['stok'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image Produk</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select class="form-select" id="kategori" name="kategori" required>
                <option value="">Pilih Kategori</option>
                <option value="Elektronik" <?= (($_POST['kategori'] ?? '') == 'Elektronik') ? 'selected' : '' ?>>Elektronik</option>
                <option value="Pakaian" <?= (($_POST['kategori'] ?? '') == 'Pakaian') ? 'selected' : '' ?>>Pakaian</option>
                <option value="Minuman" <?= (($_POST['kategori'] ?? '') == 'Minuman') ? 'selected' : '' ?>>Minuman</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Produk</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
