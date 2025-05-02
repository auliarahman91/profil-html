<?php
include 'koneksi.php';

$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'all';

$kategoriResult = $conn->query("SELECT DISTINCT kategori FROM products");

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
    <title>Daftar Produk dengan Gambar dan Buy Now</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<div class="container my-4">
    <h1 class="mb-4">Daftar Produk</h1>

    <form method="GET" action="produk.php" class="mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="kategori" class="col-form-label">Filter Kategori:</label>
            </div>
            <div class="col-auto">
                <select name="kategori" id="kategori" class="form-select" onchange="this.form.submit()">
                    <option value="all" <?= $kategori == 'all' ? 'selected' : '' ?>>Semua</option>
                    <?php while ($row = $kategoriResult->fetch_assoc()): ?>
                        <option value="<?= htmlspecialchars($row['kategori']) ?>" <?= $kategori == $row['kategori'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($row['kategori']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
    </form>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($produk = $result->fetch_assoc()): ?>
                <div class="col">
                    <div class="card h-100">
                        <?php if (!empty($produk['gambar'])): ?>
                            <img src="uploads/<?= htmlspecialchars($produk['gambar']) ?>" class="card-img-top" alt="<?= htmlspecialchars($produk['nama_produk']) ?>">
                        <?php else: ?>
                            <img src="uploads/default.jpg" class="card-img-top" alt="No Image">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($produk['nama_produk']) ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></h6>
                            <p class="card-text"><?= htmlspecialchars($produk['deskripsi']) ?></p>
                            <a href="beli.php?id=<?= $produk['id'] ?>" class="btn btn-primary">Buy Now</a>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Kategori:</strong> <?= htmlspecialchars($produk['kategori']) ?></li>
                            <li class="list-group-item"><strong>Stok:</strong> <?= $produk['stok'] ?></li>
                        </ul>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Produk tidak ditemukan.</p>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
