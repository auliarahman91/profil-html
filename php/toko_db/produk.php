<?php
include 'koneksi.php';

// Ambil kategori dari URL jika ada
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'all';

// Query untuk mengambil kategori unik dari produk
$kategoriResult = $conn->query("SELECT DISTINCT kategori FROM products");

// Query untuk mengambil produk sesuai filter kategori
if ($kategori == 'all') {
    $sql = "SELECT * FROM products";
} else {
    $sql = "SELECT * FROM products WHERE kategori = ?";
}

$stmt = $conn->prepare($sql);
if ($kategori != 'all') {
    $stmt->bind_param("s", $kategori);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Daftar Produk</title>
</head>
<body>

<h1>Daftar Produk</h1>

<!-- Filter Kategori -->
<form method="GET" action="produk.php">
    <label for="kategori">Filter Kategori:</label>
    <select name="kategori" id="kategori" onchange="this.form.submit()">
        <option value="all" <?php if($kategori == 'all') echo 'selected'; ?>>Semua</option>
        <?php while($row = $kategoriResult->fetch_assoc()): ?>
            <option value="<?= $row['kategori'] ?>" <?php if($kategori == $row['kategori']) echo 'selected'; ?>>
                <?= htmlspecialchars($row['kategori']) ?>
            </option>
        <?php endwhile; ?>
    </select>
</form>

<!-- Daftar Produk -->
<div>
    <?php if ($result->num_rows > 0): ?>
        <?php while($produk = $result->fetch_assoc()): ?>
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
