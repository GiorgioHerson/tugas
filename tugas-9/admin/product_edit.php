<?php
include '../koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    echo "ID produk tidak valid.";
    exit;
}

// Ambil data produk
$query = "SELECT * FROM products WHERE id=$id";
$result = mysqli_query($conn, $query);
if (!$result || mysqli_num_rows($result) == 0) {
    echo "Produk tidak ditemukan.";
    exit;
}
$row = mysqli_fetch_assoc($result);

$success = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $harga = trim($_POST['harga'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $stok = trim($_POST['stok'] ?? '');
    $kategori = trim($_POST['kategori'] ?? '');
    $image = $row['image'];

    // Validasi
    if ($name === '' || $harga === '' || $deskripsi === '' || $stok === '' || $kategori === '') {
        $error = 'Semua field harus diisi.';
    } elseif (!is_numeric($harga) || $harga < 0) {
        $error = 'Harga harus berupa angka positif.';
    } elseif (!is_numeric($stok) || $stok < 0) {
        $error = 'Stok harus berupa angka positif.';
    } else {
        // Jika ada file baru diupload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
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
                    // Hapus gambar lama
                    if (!empty($row['image']) && file_exists('../images/' . $row['image'])) {
                        unlink('../images/' . $row['image']);
                    }
                    $image = $new_name;
                } else {
                    $error = 'Gagal upload gambar.';
                }
            }
        }
        if ($error === '') {
            $sql = "UPDATE products SET name='$name', harga=$harga, deskripsi='$deskripsi', stok=$stok, kategori='$kategori', image='$image' WHERE id=$id";
            if (mysqli_query($conn, $sql)) {
                $success = 'Produk berhasil diupdate!';
                // Refresh data
                $row = array_merge($row, [
                    'name' => $name,
                    'harga' => $harga,
                    'deskripsi' => $deskripsi,
                    'stok' => $stok,
                    'kategori' => $kategori,
                    'image' => $image
                ]);
            } else {
                $error = 'Gagal update produk: ' . $conn->error;
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
    <title>Edit Produk</title>
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
    <h2>Edit Produk</h2>
    <?php if ($success): ?>
        <div class="alert alert-success"> <?= $success ?> </div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert alert-danger"> <?= $error ?> </div>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data" class="mt-3">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name" required value="<?= htmlspecialchars($row['name']) ?>">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" required min="0" value="<?= htmlspecialchars($row['harga']) ?>">
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" required><?= htmlspecialchars($row['deskripsi']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" required min="0" value="<?= htmlspecialchars($row['stok']) ?>">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image Produk</label><br>
            <?php if (!empty($row['image'])): ?>
                <img src="../images/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" style="width:80px;height:80px;object-fit:contain;">
            <?php endif; ?>
            <input type="file" class="form-control mt-2" id="image" name="image" accept="image/*">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select class="form-select" id="kategori" name="kategori" required>
                <option value="Elektronik" <?= ($row['kategori'] == 'Elektronik') ? 'selected' : '' ?>>Elektronik</option>
                <option value="Pakaian" <?= ($row['kategori'] == 'Pakaian') ? 'selected' : '' ?>>Pakaian</option>
                <option value="Minuman" <?= ($row['kategori'] == 'Minuman') ? 'selected' : '' ?>>Minuman</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Produk</button>
        <a href="product_table.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
