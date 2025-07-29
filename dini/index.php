<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - moodEmon Skincare</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #ffe6f0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Navbar Styles */
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

        /* Hero Section */
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
        }

        /* Description Section */
        .description {
            padding: 20px;
            text-align: center;
            color: #333;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 40px 15%;
            border-radius: 10px;
        }
        .description h2 {
            font-size: 2em;
            margin-bottom: 15px;
        }

        /* Map Section */
        .map {
            width: 70%;
            height: 400px;
            margin: 40px auto;
            border: 1px solid #ddd;
        }

        /* Product Grid Section */
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

        /* Footer Section */
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

    <!-- Navbar Section -->
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

    <!-- Description Section -->
    <div class="description">
        <p>moodEmon Skincare adalah toko online yang menyediakan berbagai produk skincare berkualitas dengan harga terjangkau. Kami menawarkan produk skincare yang dapat membantu Anda merawat kulit wajah agar tetap sehat, cerah, dan terjaga kelembapannya. Dengan pengalaman bertahun-tahun, kami menjamin kualitas setiap produk yang kami jual.</p>
    </div>
    <div class="description">
        <h2>- Toko Resmi -</h2>
    </div>

    <!-- Map Section -->
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.677851587721!2d112.03947717500765!3d-8.032112091994719!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78faab8b82450f%3A0x64af70129ababf31!2sPesantren%20tahfidz%20fathul%20huda!5e0!3m2!1sid!2sid!4v1737278972806!5m2!1sid!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <!-- Product Section -->
    <div class="description">
        <h2>- Produk Kami -</h2>
    </div>
    <div class="product-grid">
    <?php
        include "koneksi.php";
        $conn = mysqli_connect($server, $username, $password, $database);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT id_produk, nama, harga, deskripsi, foto FROM produk ORDER BY id_produk DESC LIMIT 4";
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
            echo "<p>No products available</p>";
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
