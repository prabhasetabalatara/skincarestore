<?php
session_start();
include "koneksi.php"; // Menghubungkan dengan file koneksi

$error = ""; // Variabel untuk menyimpan pesan error

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validasi input
    if (empty($username) || empty($password)) {
        $error = "Username dan password harus diisi.";
    } else {
        // Query untuk memeriksa username dan password
        $sql = "SELECT id_admin, username FROM admin WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameter
            $stmt->bind_param("ss", $username, $password);

            // Eksekusi statement
            $stmt->execute();

            // Ambil hasil
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Ambil data admin dan set sesi
                $row = $result->fetch_assoc();
                $_SESSION['id_admin'] = $row['id_admin']; // Set id_admin ke sesi
                $_SESSION['username'] = $row['username']; // Set username ke sesi
                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Username atau password salah.";
            }

            // Tutup statement
            $stmt->close();
        } else {
            $error = "Terjadi kesalahan pada server. Silakan coba lagi.";
        }
    }

    // Tutup koneksi
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - moodEmon Skincare</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General Styles */
        body {
        font-family: Arial, sans-serif;
        background-image: url('img/bg.jpg');
        background-size: cover; /* Memastikan gambar sesuai dengan ukuran layar */
        background-repeat: no-repeat; /* Menghindari pengulangan gambar */
        background-position: center;
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

        /* Centering the Login Form */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* Login Form Styles */
        .login-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .login-form h2 {
            font-size: 1.8em;
            margin-bottom: 20px;
            color: #e74c3c;
        }
        .login-form input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            font-size: 1.2em;
            border: 2px solid #e74c3c;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .login-form button {
            padding: 12px;
            width: 100%;
            background-color: #e74c3c;
            color: white;
            font-size: 1.2em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .login-form button:hover {
            background-color: #ff6347;
        }
        .error-message {
            color: red;
            margin-top: 10px;
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

    <!-- Navbar Section -->
    <div class="navbar">
        <a href="index.php">Beranda</a>
        <a href="daftar_produk.php">Daftar Produk</a>
        <a href="cari.php">Pencarian</a>
        <a href="login.php">Login</a>
    </div>

    <!-- Login Form Section -->
    <div class="login-container">
        <form action="login.php" method="POST" class="login-form">
            <h2>Login</h2>

            <!-- Display error message if login fails -->
            <?php if (!empty($error)) { ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php } ?>

            <!-- Username Input -->
            <input type="text" name="username" placeholder="Username" required>

            <!-- Password Input -->
            <input type="password" name="password" placeholder="Password" required>

            <!-- Submit Button -->
            <button type="submit" name="submit">Login</button>
        </form>
    </div>

    <!-- Footer Section -->
    <footer>
        Tugas Praktikum 5 Pemrograman Web oleh Elok Khur'Andini
    </footer>

</body>
</html>
