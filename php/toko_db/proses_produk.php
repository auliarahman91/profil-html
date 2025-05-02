<?php
include 'koneksi.php';

// Fungsi untuk generate nama file unik
function generateFileName($originalName) {
    $ext = pathinfo($originalName, PATHINFO_EXTENSION);
    return uniqid() . '.' . $ext;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = trim($_POST['nama']);
    $harga = trim($_POST['harga']);
    $deskripsi = trim($_POST['deskripsi']);
    $kategori = trim($_POST['kategori']);
    $stok = trim($_POST['stok']);

    // Validasi sederhana
    if (empty($nama) || empty($harga) || empty($deskripsi) || empty($kategori) || empty($stok)) {
        die("Semua field harus diisi!");
    }

    // Proses upload gambar
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = $_FILES['gambar']['type'];

        if (!in_array($fileType, $allowedTypes)) {
            die("Format gambar tidak didukung. Gunakan JPG, PNG, atau GIF.");
        }

        $uploadDir = 'uploads/'; // Pastikan folder ini sudah ada dan bisa ditulis
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileName = generateFileName($_FILES['gambar']['name']);
        $uploadFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadFile)) {
            // Simpan data ke database
            $stmt = $conn->prepare("INSERT INTO products (nama_produk, harga, deskripsi, kategori, stok, gambar) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sissis", $nama, $harga, $deskripsi, $kategori, $stok, $fileName);

            if ($stmt->execute()) {
                echo "Produk berhasil ditambahkan! <a href='produk.php'>Lihat Produk</a>";
            } else {
                echo "Error saat menyimpan data: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Gagal mengupload gambar.";
        }
    } else {
        echo "Gambar harus diupload.";
    }

    $conn->close();
} else {
    echo "Metode request tidak valid.";
}
?>
