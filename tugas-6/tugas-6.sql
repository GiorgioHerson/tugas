-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2025 at 10:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas-6`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `total`) VALUES
(1, 1, 1, 1, 15000000.00),
(2, 2, 2, 2, 500000.00),
(3, 3, 3, 3, 240000.00),
(4, 1, 4, 1, 5500000.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `kategori` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `harga`, `deskripsi`, `stok`, `kategori`, `image`) VALUES
(1, 'Laptop ASUS ROG', 15000000.00, 'Laptop gaming dengan performa tinggi.', 10, 'Elektronik', 'asus-rog.jpg'),
(2, 'Kemeja Pria Lengan Panjang', 250000.00, 'Kemeja formal cocok untuk kerja.', 25, 'Pakaian', 'kemeja-pria.jpg'),
(3, 'Kopi Arabika Gayo 250g', 80000.00, 'Kopi khas Aceh dengan aroma kuat.', 100, 'Minuman', 'kopi-gayo.jpg'),
(4, 'Smartphone Samsung Galaxy', 5500000.00, 'HP Android dengan kamera bagus.', 15, 'Elektronik', 'samsung-galaxy.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`) VALUES
(1, 'Benjamin Franklin', '$2y$10$VdUlO.u7sKk3VIj.nI47u.xpjMDQXm1.VMoXYQfxvcM8AN.EbcGmO'),
(2, 'John Doe', '$2y$10$K56iFgLX14sguE7.3g6dFucXRTew/sRNr5l7Ko0vywi5Lzuo.9k6W'),
(3, 'Alice Smith', '$2y$10$HIHAVbWCs4ja1uL0Xi/7B.6fu72W.idsDNIboY6wqEsbiz9iI/Cli');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- CREATE: Tambah 1 produk
INSERT INTO products (name, harga, deskripsi, stok, kategori, image)
VALUES ('Flashdisk 32GB', 50000, 'Flashdisk USB 3.0 cepat dan murah', 100, 'Elektronik', 'flashdisk.jpg');

-- READ: (tidak menampilkan apa-apa saat dieksekusi di file SQL, tapi tetap valid)
SELECT * FROM products;

-- UPDATE: Ubah harga dan stok produk dengan id = 1
UPDATE products
SET harga = 55000,
    stok = 120
WHERE id = 1;

-- DELETE: Hapus produk dengan id = 2
DELETE FROM products WHERE id = 2;
