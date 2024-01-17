-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Des 2023 pada 04.43
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `damnz_cafe`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `address`, `phone_number`, `email`, `password`, `level`) VALUES
(23, 'miqdad007', 'cikusksqiw', '081291122334', 'mmiqdad700@gmail.com', '$2y$10$rbpVHtGwLyeToKJ2MRagf./yLbcumVM1rbdjsw2y0.ShtGisd3xea', 2),
(24, 'miqdad3210', 'uhewbnicewo', '5417121219', 'mmiqdad3210@gmail.com', '$2y$10$x7MeFAxkyGwgTNvSs4N7xOxZfmJ1pktPuNrxh.EwO40f2f8pvRS/.', 1),
(25, 'Muhammad Zhafran Ganteng', 'Bandung Di lengkong', '081203129312', 'zhafran@gmail.com', '$2y$10$wz5EaqIMXfZRXvKQK1SXq.4duAtijoJb.4mTkXRw7Pr1vfbQAi5cu', 1),
(26, 'Miqdad Ganteng', 'Soekarno Hatta Jakarta', '0812345678', 'mmiqdad007@gmail.com', '$2y$10$vKiP5zY8OmP3nUiTK2/qouegOZTqlkDDLPePtOiewawQf4QUbJu52', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_method` varchar(40) NOT NULL,
  `total_payment` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payment`
--

INSERT INTO `payment` (`payment_id`, `customer_id`, `payment_method`, `total_payment`) VALUES
(1, 25, 'Gopay', 273000),
(2, 25, 'Mobile Banking', 273000),
(3, 25, 'Dana', 273000),
(4, 25, 'Gopay', 273000),
(5, 25, 'Dana', 201000),
(6, 25, 'Mobile Banking', 92000),
(7, 25, 'Dana', 38000),
(8, 25, 'Gopay', 36000),
(9, 25, 'Mobile Banking', 38000),
(10, 25, 'Mobile Banking', 240000),
(11, 25, 'Gopay', 60000),
(12, 25, 'Gopay', 240000),
(13, 25, 'Gopay', 228000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `image`, `price`, `stock`) VALUES
(1, 'Es Kopi Susu', 'kopisusu.png', 18000, 5),
(2, 'Es Matcha Latte', 'matcha.png', 19000, 10),
(3, 'Es Caramel Machiatto', 'caramel.png', 20000, 10),
(4, 'Soda Gembira', 'sodagembira.png', 16000, 15),
(5, 'Taro Boba', 'taro.png', 14000, 20),
(6, 'Lemon Tea', 'lemontea.png', 18000, 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_quantity` int(5) NOT NULL,
  `sub_total` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `customer_id`, `product_id`, `transaction_date`, `product_quantity`, `sub_total`) VALUES
(1, 25, 1, '2023-12-03 18:21:11', 1, 18000),
(2, 25, 2, '2023-12-03 18:28:15', 2, 38000),
(3, 25, 6, '2023-12-03 18:09:34', 2, 36000),
(4, 25, 3, '2023-12-03 18:20:35', 1, 20000),
(5, 25, 4, '2023-12-03 18:23:25', 3, 48000),
(6, 25, 5, '2023-12-03 18:35:02', 3, 42000),
(7, 25, 1, '2023-12-03 18:37:32', 2, 36000),
(8, 25, 2, '2023-12-03 18:37:41', 1, 19000),
(9, 25, 2, '2023-12-03 19:10:28', 2, 38000),
(10, 25, 1, '2023-12-03 19:32:14', 3, 54000),
(11, 25, 4, '2023-12-04 02:09:29', 0, 0),
(12, 25, 2, '2023-12-04 02:35:57', 2, 38000),
(13, 25, 1, '2023-12-04 02:43:46', 2, 36000),
(14, 25, 2, '2023-12-04 02:53:29', 2, 38000),
(15, 25, 3, '2023-12-04 02:55:12', 12, 240000),
(16, 25, 3, '2023-12-04 02:57:00', 3, 60000),
(17, 25, 3, '2023-12-04 02:57:15', 12, 240000),
(18, 25, 2, '2023-12-04 03:01:06', 12, 228000),
(19, 25, 1, '2023-12-04 03:03:25', 2, 36000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indeks untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indeks untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `Product_ID` (`product_id`),
  ADD KEY `transaction_ibfk_1` (`customer_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `transaction` (`customer_id`);

--
-- Ketidakleluasaan untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
