<?php
session_start();
include "koneksi.php";

// Validasi sesi
if (!isset($_SESSION['id_admin'])) {
    die("Session id_admin tidak ditemukan.");
}

// Validasi ID produk
if (!isset($_GET['id_produk'])) {
    die("ID produk tidak ditemukan.");
}
$id_produk = $_GET['id_produk'];

// Ambil data produk
$produk_sql = "SELECT foto FROM produk WHERE id_produk = ?";
$produk_stmt = $conn->prepare($produk_sql);
$produk_stmt->bind_param("i", $id_produk);
$produk_stmt->execute();
$produk_result = $produk_stmt->get_result();
$produk = $produk_result->fetch_assoc();
$produk_stmt->close();

if (!$produk) {
    die("Produk tidak ditemukan.");
}

// Hapus file foto jika ada
if (!empty($produk['foto']) && file_exists("img/produk/" . $produk['foto'])) {
    unlink("img/produk/" . $produk['foto']);
}

// Hapus data produk dari database
$delete_sql = "DELETE FROM produk WHERE id_produk = ?";
$delete_stmt = $conn->prepare($delete_sql);
$delete_stmt->bind_param("i", $id_produk);

if ($delete_stmt->execute()) {
    echo "<script>
        alert('Produk berhasil dihapus!');
        setTimeout(() => {
            window.location.href = 'dashboard.php';
        }, 2000);
    </script>";
} else {
    echo "<script>
        alert('Gagal menghapus produk. Silakan coba lagi.');
        window.location.href = 'dashboard.php';
    </script>";
}

$delete_stmt->close();
$conn->close();
?>
