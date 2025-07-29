<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['id_admin'])) {
    die("Session id_admin tidak ditemukan.");
}

$id_admin = $_SESSION['id_admin'];
$admin_sql = "SELECT * FROM admin WHERE id_admin = ?";
$admin_stmt = $conn->prepare($admin_sql);
$admin_stmt->bind_param("i", $id_admin);
$admin_stmt->execute();
$admin_result = $admin_stmt->get_result();
$admin = $admin_result->fetch_assoc();
$admin_stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = htmlspecialchars($_POST['nama']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $harga = (int) $_POST['harga'];
    $stok = (int) $_POST['stok'];
    $foto = $_FILES['foto'];

    $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
    if (!in_array($foto['type'], $allowed_types)) {
        $error = "Format file tidak valid. Gunakan JPG atau PNG.";
    } elseif ($foto['size'] > 2000000) {
        $error = "Ukuran file terlalu besar. Maksimum 2MB.";
    } else {
        $foto_name = uniqid() . '_' . basename($foto['name']);
        $target_dir = "img/produk/";
        $target_file = $target_dir . $foto_name;

        if (move_uploaded_file($foto['tmp_name'], $target_file)) {
            // Simpan data ke database
            $sql = "INSERT INTO produk (nama, deskripsi, harga, stok, foto) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdis", $nama, $deskripsi, $harga, $stok, $foto_name);

            if ($stmt->execute()) {
                echo "<script>
                    alert('Produk berhasil ditambahkan!');
                    setTimeout(() => {
                        window.location.href = 'dashboard.php';
                    }, 2000);
                </script>";
                exit; // Menghentikan eksekusi setelah mengarahkan pengguna
            } else {
                $error = "Gagal menambahkan produk. Silakan coba lagi.";
            }

            $stmt->close();
        } else {
            $error = "Gagal mengupload foto.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Produk - moodEmon Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
        .form-container {
            max-width: 800px;
            margin: 50px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #6c757d;
            border-bottom: 2px solid #6c757d;
            padding-bottom: 10px;
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
        <div class="form-container flex-grow-1">
            <h3>Tambah Produk</h3>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="tambahproduk.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Produk</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                    <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Produk</label>
                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Simpan</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
