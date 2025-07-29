<?php
session_start();
include "koneksi.php";

// Validasi sesi
if (!isset($_SESSION['id_admin'])) {
    die("Session id_admin tidak ditemukan.");
}

// Gunakan prepared statement untuk mendapatkan data admin
$id_admin = $_SESSION['id_admin'];
$admin_sql = "SELECT * FROM admin WHERE id_admin = ?";
$admin_stmt = $conn->prepare($admin_sql);
$admin_stmt->bind_param("i", $id_admin);
$admin_stmt->execute();
$admin_result = $admin_stmt->get_result();
$admin = $admin_result->fetch_assoc();
$admin_stmt->close();

// Ambil data produk
$produk_sql = "SELECT * FROM produk";
$produk_result = $conn->query($produk_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dasbor Admin - moodEmon Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS Styling */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }
        .sidebar {
            height: 100vh;
            background-color: #6c757d;
            padding-top: 20px;
            box-shadow: 4px 0 6px rgba(0, 0, 0, 0.1);
        }
        .sidebar a {
            color: #ffffff;
            display: block;
            padding: 15px 20px;
            text-decoration: none;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #495057;
            border-radius: 5px;
        }
        .sidebar img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 3px solid #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }
        .sidebar h4 {
            color: #ffffff;
            margin-top: 10px;
        }
        .dashboard-content {
            padding: 40px;
            flex-grow: 1;
        }
        .dashboard-content h3 {
            color: #343a40;
            margin-bottom: 30px;
            border-bottom: 2px solid #6c757d;
            padding-bottom: 10px;
        }
        .product-table {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .product-table th {
            background-color: #6c757d;
            color: #ffffff;
            text-align: center;
        }
        .product-table td {
            text-align: center;
        }
        .product-table img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            cursor: pointer;
        }
        .modal-body img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .btn-primary {
            background-color: #6c757d;
            border: none;
        }
        .btn-primary:hover {
            background-color: #495057;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar d-flex flex-column align-items-center">
            <img src="img/admin/<?php echo htmlspecialchars($admin['foto_admin']); ?>" alt="Foto Admin">
            <h4 class="mt-2"><?php echo htmlspecialchars($admin['nama_admin']); ?></h4>
            <a href="dashboard.php">Data Skincare</a>
            <a href="logout.php">Log Out</a>
        </div>

        <!-- Content -->
        <div class="dashboard-content flex-grow-1">
            <h3>Data Skincare</h3>
            <div class="table-responsive">
                <table class="table table-bordered product-table">
                    <thead>
                        <tr>
                            <th>ID Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($produk = $produk_result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($produk['id_produk']); ?></td>
                            <td><?php echo htmlspecialchars($produk['nama']); ?></td>
                            <td><?php echo "Rp " . number_format($produk['harga'], 0, ',', '.'); ?></td>
                            <td><?php echo htmlspecialchars($produk['stok']); ?></td>
                            <td>
                                <img src="img/produk/<?php echo htmlspecialchars($produk['foto']); ?>" alt="Foto Produk" data-bs-toggle="modal" data-bs-target="#modal<?php echo $produk['id_produk']; ?>">
                            </td>
                            <td>
                                <a href="editproduk.php?id_produk=<?php echo $produk['id_produk']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapusproduk.php?id_produk=<?php echo $produk['id_produk']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>

                        <!-- Modal for enlarging image -->
                        <div class="modal fade" id="modal<?php echo $produk['id_produk']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Foto Produk: <?php echo htmlspecialchars($produk['nama']); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="img/produk/<?php echo htmlspecialchars($produk['foto']); ?>" alt="Foto Produk">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <a href="tambahproduk.php" class="btn btn-primary">Tambah Produk</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
