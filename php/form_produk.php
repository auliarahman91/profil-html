<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Tambah Produk</title>
</head>
<body>
    <h2>Tambah Produk Baru</h2>
    <form action="proses.php" method="POST">
        <label for="nama">Nama Produk:</label><br>
        <input type="text" id="nama" name="nama"><br><br>

        <label for="harga">Harga:</label><br>
        <input type="number" id="harga" name="harga"><br><br>

        <label for="deskripsi">Deskripsi:</label><br>
        <textarea id="deskripsi" name="deskripsi"></textarea><br><br>

        <input type="submit" value="Tambah Produk">
    </form>
</body>
</html>
