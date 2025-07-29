<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Produk - moodEmon Skincare</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ffe6f0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
        .hero {
            background-image: url('img/bg.jpg');
            background-size: cover;
            background-position: center;
            text-align: center;
            color: white;
            padding: 100px 0;
        }
        .hero h1 {
            font-size: 3em;
            margin-bottom: 10px;
            color: #ff6347;
        }
        .hero p {
            font-size: 1.5em;
            color: #fff;
        }
        .search-container {
            text-align: center;
            margin: 20px 0;
        }
        .search-container input {
            padding: 10px;
            width: 60%;
            font-size: 1.2em;
            border: 2px solid #e74c3c;
            border-radius: 5px;
        }
        .search-container button {
            padding: 10px 20px;
            background-color: #e74c3c;
            color: white;
            font-size: 1.2em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }
        .search-container button:hover {
            background-color: #ff6347;
        }
        .product-grid {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }
        .product {
            width: 250px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            padding: 15px;
            text-decoration: none;
        }
        .product img {
            width: 100%;
            height: auto;
            border-bottom: 2px solid #eee;
        }
        .product h3 {
            margin: 10px 0;
            font-size: 1.2em;
        }
        .product .price {
            color: #e74c3c;
            font-weight: bold;
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            color: #333;
            margin-top: auto;
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

    <!-- Hero Section -->
    <div class="hero">
        <h1>moodEmon SkinCare Store</h1>
        <p>Toko Skincare Murah dan Berkualitas</p>
    </div>

    <!-- Search Section -->
    <div class="search-container">
        <form method="GET" action="cari.php">
            <input type="text" name="query" placeholder="Cari produk skincare..." value="<?php echo isset($_GET['query']) ? $_GET['query'] : ''; ?>">
            <button type="submit">Cari</button>
        </form>
    </div>

    <!-- Products Section -->
    <div class="product-grid">
        <?php
        include "koneksi.php";
        $conn = mysqli_connect($server, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $query = isset($_GET['query']) ? $_GET['query'] : '';
        $sql = "SELECT id_produk, nama, harga, deskripsi, foto FROM produk WHERE nama LIKE '%$query%' ORDER BY id_produk DESC LIMIT 4";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<a href="detail_produk.php?id=' . $row["id_produk"] . '" class="product">';
                echo '<img src="img/produk/' . $row["foto"] . '" alt="' . $row["nama"] . '">';
                echo '<h3>' . $row["nama"] . '</h3>';
                echo '<p class="price">Rp ' . number_format($row["harga"], 0, ',', '.') . '</p>';
                echo '<p>' . substr($row["deskripsi"], 0, 50) . '...</p>';
                echo '</a>';
            }
        } else {
            echo "<p>Tidak ada produk yang ditemukan</p>";
        }

        $conn->close();
        ?>
    </div>

    <!-- Footer Section -->
    <footer>
        Tugas Praktikum 5 Pemrograman Web oleh Elok Khur'Andini
    </footer>

</body>
</html>
