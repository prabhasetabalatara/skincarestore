<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>moodEmon Skincare</title>
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
        .container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 20px;
            justify-content: center;
        }
        .product {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
        }
        .product img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
        .product-details {
            padding: 15px;
        }
        .product-details h3 {
            margin: 0;
            font-size: 1.2em;
            color: #333;
        }
        .product-details p {
            color: #777;
            font-size: 0.9em;
            margin: 10px 0;
        }
        .product-details .price {
            color: #e74c3c;
            font-weight: bold;
        }
        .product:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
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

    <h1 style="text-align:center; padding: 20px; color: #333;">moodEmon Skincare Products</h1>
    <div class="container">
        <?php
        include "koneksi.php";
        $conn = mysqli_connect($server, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT id_produk, nama, harga, deskripsi, foto FROM produk";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<a href="detail_produk.php?id=' . $row["id_produk"] . '" class="product">';
                echo '<img src="img/produk/' . $row["foto"] . '" alt="' . $row["nama"] . '">';
                echo '<div class="product-details">';
                echo '<h3>' . $row["nama"] . '</h3>';
                echo '<p class="price">Rp ' . number_format($row["harga"], 0, ',', '.') . '</p>';
                echo '<p>' . substr($row["deskripsi"], 0, 50) . '...</p>';
                echo '</div>';
                echo '</a>';
            }
        } else {
            echo "<p>No products available</p>";
        }

        $conn->close();
        ?>
    </div>

    <footer>
        Tugas Praktikum 5 Pemrograman Web oleh Elok Khur'Andini
    </footer>

</body>
</html>
