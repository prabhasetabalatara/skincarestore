<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - moodEmon Skincare</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ffe6f0;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #fff;
            padding: 15px;
            display: flex;
            justify-content: space-around;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .navbar a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            padding: 10px 15px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .navbar a:hover {
            background-color: #ffccd5;
            color: #e74c3c;
        }
        .product-card {
            width: 90%;
            max-width: 600px;
            margin: 40px auto;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            padding: 20px;
        }
        .product-card img {
            width: 100%;
            height: auto;
        }
        .product-card h3 {
            margin: 20px 0 10px;
            font-size: 1.5em;
            color: #333;
        }
        .product-card p {
            color: #777;
            font-size: 1em;
            margin: 10px 0;
            text-align: justify;
        }
        .product-card .price {
            color: #e74c3c;
            font-weight: bold;
            text-align: center;
            }
        .buy-button {
            background-color: #e74c3c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .buy-button:hover {
            background-color: #c0392b;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            color: #333;
            position: relative;
            width: 100%;
            margin-top: 40px;
        }

    </style>
</head>
<body>

    <div class="navbar">
        <a href="index.php">Beranda</a>
        <a href="daftar_produk.php">Daftar Produk</a>
        <a href="cari.php">Pencarian</a>
        <a href="login.php">Login</a>
    </div>

    <div class="product-card">
    <?php
        include "koneksi.php";
        $conn = mysqli_connect($server, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_GET['id'];
    $sql = "SELECT nama, stok, harga, deskripsi, foto FROM produk WHERE id_produk=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<img src="img/produk/' . $row["foto"] . '" alt="' . $row["nama"] . '">';
            echo '<h3>' . $row["nama"] . '</h3>';
            echo '<p class="price">Rp ' . number_format($row["harga"], 0, ',', '.') . '</p>';
            echo '<p>Stok: ' . $row["stok"] . '</p>';
            // Menggunakan nl2br untuk menampilkan paragraf dengan baik
            echo '<p>' . nl2br($row["deskripsi"]) . '</p>';
            echo '<button class="buy-button" onclick="showPopup()">Beli</button>';
        }
    } else {
        echo "<p>Produk tidak ditemukan</p>";
    }

    $stmt->close();
    $conn->close();
    ?>

    </div>

    <script>
        function showPopup() {
            alert("Terima Kasih atas pembelian anda, Produk akan dikirim ke rumah anda dalam 3 hari");
        }
    </script>
    <footer>
        Tugas Praktikum 5 Pemrograman Web oleh Elok Khur'Andini
    </footer>
</body>
</html>
