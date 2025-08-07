<?php
session_start();
include 'koneksi.php';

// Inisialisasi cart jika belum ada
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Proses hapus satu produk dari cart
if (isset($_GET['remove']) && isset($_SESSION['cart'][$_GET['remove']])) {
    unset($_SESSION['cart'][$_GET['remove']]);
    header('Location: cart.php');
    exit;
}

// Proses kosongkan cart
if (isset($_GET['clear'])) {
    $_SESSION['cart'] = [];
    header('Location: cart.php');
    exit;
}

// Proses checkout
$show_checkout_form = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    $show_checkout_form = true;
}

// Proses submit form customer dan redirect ke WhatsApp
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['do_checkout'])) {
    $nama = trim($_POST['nama'] ?? '');
    $nomor = trim($_POST['nomor'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');
    $wa = preg_replace('/[^0-9]/', '', $nomor);
    $wa = ltrim($wa, '0');
    if (substr($wa, 0, 2) === '62') {
        $wa = $wa;
    } else {
        $wa = '62' . $wa;
    }
    $wa_target = $wa; // Nomor customer, bisa diganti ke admin jika perlu


    // Simpan cart sebelum dikosongkan
    $cart_checkout = $_SESSION['cart'];

    // Ambil ulang data produk untuk cart_checkout
    $products_checkout = [];
    if (!empty($cart_checkout)) {
        $conn_checkout = $conn; // sudah include koneksi
        $names_checkout = array_map(function($name) use ($conn_checkout) {
            return "'" . mysqli_real_escape_string($conn_checkout, $name) . "'";
        }, array_keys($cart_checkout));
        $sql_checkout = "SELECT name, harga FROM products WHERE name IN (" . implode(',', $names_checkout) . ")";
        $result_checkout = mysqli_query($conn_checkout, $sql_checkout);
        while ($row = mysqli_fetch_assoc($result_checkout)) {
            $products_checkout[$row['name']] = $row;
        }
    }

    // Update stok produk di database
    if (!empty($cart_checkout)) {
        foreach ($cart_checkout as $name => $qty) {
            if (isset($products_checkout[$name])) {
                $safe_name = mysqli_real_escape_string($conn, $name);
                $safe_qty = (int)$qty;
                $update_sql = "UPDATE products SET stok = GREATEST(stok - $safe_qty, 0) WHERE name = '$safe_name'";
                mysqli_query($conn, $update_sql);
            }
        }
    }

    // Buat pesan WhatsApp
    $pesan = "*Checkout Pesanan*\n";
    $pesan .= "Nama: $nama\n";
    $pesan .= "No HP: $nomor\n";
    $pesan .= "Alamat: $alamat\n";
    $pesan .= "\n*Daftar Pesanan:*\n";
    $total = 0;
    if (!empty($cart_checkout)) {
        foreach ($cart_checkout as $name => $qty) {
            if (isset($products_checkout[$name])) {
                $harga = $products_checkout[$name]['harga'];
                $subtotal = $harga * $qty;
                $pesan .= "- $name x$qty (Rp" . number_format($harga, 0, ',', '.') . ") = Rp" . number_format($subtotal, 0, ',', '.') . "\n";
                $total += $subtotal;
            }
        }
        $pesan .= "\nTotal: Rp" . number_format($total, 0, ',', '.') . "\n";
    } else {
        $pesan .= "(Keranjang kosong)\n";
    }
    $pesan .= "\nTerima kasih!";

    $pesan_url = urlencode($pesan);
    // Ganti nomor berikut dengan nomor admin jika ingin ke admin, contoh: 6281234567890
    $wa_admin = '6281234567890';
    $wa_link = "https://wa.me/$wa_admin?text=$pesan_url";

    // Kosongkan cart setelah checkout
    $_SESSION['cart'] = [];
    header("Location: $wa_link");
    exit;
}

$cart = $_SESSION['cart'];
$products = [];
$total = 0;

if (!empty($cart)) {
    // Ambil detail produk berdasarkan nama (product_id = name)
    $names = array_map(function($name) use ($conn) {
        return "'" . mysqli_real_escape_string($conn, $name) . "'";
    }, array_keys($cart));
    $sql = "SELECT name, harga, image FROM products WHERE name IN (" . implode(',', $names) . ")";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $products[$row['name']] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="product.php">Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="product.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="cart.php">Cart</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-5">
    <h2 class="mb-4">Keranjang Belanja</h2>
    <?php if (empty($cart) && !$show_checkout_form): ?>
        <div class="alert alert-info">Keranjang belanja kosong.</div>
    <?php elseif ($show_checkout_form): ?>
        <div class="card mb-4">
            <div class="card-header bg-success text-white">Formulir Checkout</div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="nomor" class="form-label">Nomor HP</label>
                        <input type="tel" class="form-control" id="nomor" name="nomor" pattern="^[0-9]{8,15}$" inputmode="numeric" minlength="8" maxlength="15" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                    </div>
                    <button type="submit" name="do_checkout" class="btn btn-success">Kirim ke WhatsApp</button>
                    <a href="cart.php" class="btn btn-secondary ms-2">Batal</a>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $name => $qty): ?>
                        <?php if (isset($products[$name])): ?>
                            <?php $subtotal = $products[$name]['harga'] * $qty; $total += $subtotal; ?>
                            <tr>
                                <td style="width:120px">
                                    <?php if (!empty($products[$name]['image'])): ?>
                                        <img src="images/<?= htmlspecialchars($products[$name]['image']) ?>" alt="<?= htmlspecialchars($name) ?>" style="width:100px;height:70px;object-fit:cover;">
                                    <?php else: ?>
                                        <img src="https://via.placeholder.com/100x70?text=No+Image" alt="No Image">
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($name) ?></td>
                                <td>Rp<?= number_format($products[$name]['harga'], 0, ',', '.') ?></td>
                                <td><?= $qty ?></td>
                                <td>Rp<?= number_format($subtotal, 0, ',', '.') ?></td>
                                <td>
                                    <a href="cart.php?remove=<?= urlencode($name) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini dari cart?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Total</th>
                        <th colspan="2">Rp<?= number_format($total, 0, ',', '.') ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <form method="post" class="d-inline">
            <button type="submit" name="checkout" class="btn btn-success">Checkout</button>
        </form>
        <a href="cart.php?clear=1" class="btn btn-warning" onclick="return confirm('Kosongkan keranjang?')">Kosongkan Cart</a>
        <a href="product.php" class="btn btn-secondary">Lanjut Belanja</a>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
