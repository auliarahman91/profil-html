<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Tambah Produk dengan Gambar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container my-4">
    <h2>Tambah Produk Baru</h2>
    <form action="proses_produk.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Produk:</label>
            <input type="text" id="nama" name="nama" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga:</label>
            <input type="number" id="harga" name="harga" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori:</label>
            <input type="text" id="kategori" name="kategori" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok:</label>
            <input type="number" id="stok" name="stok" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Produk:</label>
            <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*" required />
        </div>
        <button type="submit" class="btn btn-primary">Tambah Produk</button>
    </form>
</div>
</body>
</html>
