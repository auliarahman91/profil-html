<?php
include 'koneksi.php'; // file koneksi database

// Ambil kategori dari URL, default 'all'
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'all';

// Ambil daftar kategori unik dari database
$kategoriResult = $conn->query("SELECT DISTINCT kategori FROM products");

// Siapkan query produk sesuai filter kategori
if ($kategori == 'all') {
    $sql = "SELECT * FROM products";
    $stmt = $conn->prepare($sql);
} else {
    $sql = "SELECT * FROM products WHERE kategori = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $kategori);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Daftar Produk dengan Filter Kategori</title>
</head>
<body>

<h1>Daftar Produk</h1>

<form method="GET" action="produk_filter.php">
    <label for="kategori">Filter Kategori:</label>
    <select name="kategori" id="kategori" onchange="this.form.submit()">
        <option value="all" <?= $kategori == 'all' ? 'selected' : '' ?>>Semua</option>
        <?php while ($row = $kategoriResult->fetch_assoc()): ?>
            <option value="<?= htmlspecialchars($row['kategori']) ?>" <?= $kategori == $row['kategori'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($row['kategori']) ?>
            </option>
        <?php endwhile; ?>
    </select>
</form>

<div>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($produk = $result->fetch_assoc()): ?>
            <div style="border:1px solid #ccc; padding:10px; margin:10px 0;">
                <h3><?= htmlspecialchars($produk['nama_produk']) ?></h3>
                <p>Harga: Rp <?= number_format($produk['harga'], 0, ',', '.') ?></p>
                <p>Deskripsi: <?= htmlspecialchars($produk['deskripsi']) ?></p>
                <p>Kategori: <?= htmlspecialchars($produk['kategori']) ?></p>
                <p>Stok: <?= $produk['stok'] ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Produk tidak ditemukan.</p>
    <?php endif; ?>
</div>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
