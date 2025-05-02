<?php
// Cek apakah form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Deklarasi variabel dari input form
    $nama = $_POST['nama'] ?? '';
    $harga = $_POST['harga'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';

    // Validasi sederhana: cek apakah ada input kosong
    if (empty($nama) || empty($harga) || empty($deskripsi)) {
        echo "Data tidak boleh kosong!";
    } else {
        // Proses data (misal simpan ke database, tapi di sini hanya tampilkan)
        echo "Produk berhasil ditambahkan:<br>";
        echo "Nama: " . htmlspecialchars($nama) . "<br>";
        echo "Harga: " . htmlspecialchars($harga) . "<br>";
        echo "Deskripsi: " . htmlspecialchars($deskripsi) . "<br>";
    }
} else {
    echo "Form belum disubmit.";
}
?>
