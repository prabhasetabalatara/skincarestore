-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jan 2025 pada 17.55
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_skincare`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(4) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `foto_admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`, `foto_admin`) VALUES
(1, 'ELOK KHUR’ANDINI', 'dini', 'dini', 'dini.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(4) NOT NULL,
  `nama` text NOT NULL,
  `stok` int(5) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama`, `stok`, `harga`, `deskripsi`, `foto`) VALUES
(1, 'Glad2Glow Paket Skincare Moisturizer Toner', 1111, 143000, 'Moisturizer dengan ekstrak blueberry dan ceramide untuk merawat kemerahan dan kulit sensitif. Tekstur gel ringan, mudah meresap, melembabkan, dan memberikan sensasi cooling dengan aroma blueberry. Cocok untuk semua jenis kulit.\r\n\r\nManfaat:\r\n\r\n1. Menjaga skin barrier\r\n2. Merawat kulit sensitif\r\n3. Menyejukkan kulit teriritasi ringan\r\n4. Menjaga hidrasi dan kelembapan\r\n\r\nUkuran: 30 gr\r\nNo BPOM: NA11220100364', '1.jpg'),
(2, 'SK-II PITERA™ Youth Essentials', 1000, 1295000, 'SK-II PITERA™ YOUTH ESSENTIALS\r\n\r\nRasakan kekuatan PITERA™ dan SKINPOWER Adv dengan rangkaian 3 langkah. Dalam kemasan : Facial Treatment Essence (75ml), Facial Treatment Cleanser (20g), SKINPOWER Advanced Airy Cream (15g). \r\n\r\nFacial Treatment Essence (75ml): Essence ikonik kami untuk Kulit Tampak Sebening Kristal dengan lebih dari 90% PITERA™, dicintai oleh jutaan orang karena kemampuannya yang menakjubkan dalam mempercantik kulit.\r\n\r\nFacial Treatment Gentle Cleanser (20g: Pembersih berbusa yang membersihkan kotoran dengan lembut dan diformulasikan dengan PITERA™, dan bahan-bahan pembersih kulit lainnya untuk membersihkan kulitmu.\r\n\r\nSKINPOWER Advanced Airy Cream (15g): Pelembab ringan yang memberikan kekuatan ekstra* pada kulit Anda agar tampak muda dan sehat.', '2.png'),
(3, 'Kahf Paket Lengkap Skincare Pria Full Set | Skinca', 1000, 238500, '- Brightening Face Wash 100 ml\r\n- Triple+ Protection Sunscreen Moisturizer SPF 30 PA+++ 30 ml\r\n- Brightening and Texture Refining Face Serum 35 ml ', '3.png'),
(4, 'CLAED Set produk perawatan Wajah', 1000, 178888, '1. Bersihkan wajah dan leher dengan menggunakan Facial Wash, lalu keringkan dengan handuk bersih\r\n2. Tuang Toner secukupnya dengan menggunakan kapas usapkan ke wajah dan leher secara merata\r\n3. Tuang Serum secukupnya oleskan ke wajah dan leher secara merata\r\n4. Jika pagi hari gunakan Day Cream ke area wajah dan leher usap secara merata\r\n5 Jika malam hari gunakan Night Cream ke area wajah dan leher usap secara merata\r\n', '4.jpg'),
(5, 'Skin Care Giza Beauty', 1000, 160000, '1 Paket Lengkap Skin Care Giza Beauty\r\nTerdiri dari 5 Produk, meliputi :\r\n\r\n- Sabun Kolagen Le Emerald (POM NA18220500506)\r\n\r\n- Galangal Fresh Toner (POM NA18231204031)\r\n\r\n- Skin Barrier Moisturizer (POM NA18230107294)\r\n\r\n- Krim Siang Galangal Day Cream (POM NA18230107293)\r\n\r\n- Krim Malam Galangal Night Cream (POM NA18230105993)\r\n\r\n\r\nSemua Produk Sudah BPOM, Non SLS, Non Alcohol \r\n\r\nCocok untuk semua jenis kulit, aman untuk ibu hamil dan menyusui\r\n\r\n\r\n# MANFAAT : \r\n\r\n- Membantu merawat kulit wajah agar tetap halus, lembut dan tidak kering\r\n\r\n- Membantu menjaga kelembaban kulit wajah\r\n\r\n- Kandungan Vit. C pada Lengkuas Membantu meremajakan kulit Wajah\r\n\r\n- Kandungan Vit. E mengurangi peradangan, \r\n\r\n- Membantu pembentukan kolagen\r\n\r\n- Meningkatkan kelembapan dan elastisitas kulit\r\n\r\n- Membantu Kulit Wajah dari Infeksi\r\n\r\n- Mengatasi bakteri penyebab jerawat atau Propionibacterium acne\r\n\r\n- Membantu melindungi sel-sel kulit wajah dari kerusakan akibat paparan radikal bebas\r\n\r\n- Membantu mengurangi tanda-tanda penuaan dini, seperti flek hitam\r\n\r\n- Membuat penampilan kulit wajah menjadi lebih sehat', '5.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
