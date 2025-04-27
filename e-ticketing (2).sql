-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2025 at 10:07 AM
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
-- Database: `e-ticketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_penerbangan`
--

CREATE TABLE `jadwal_penerbangan` (
  `id_jadwal` int(11) NOT NULL,
  `id_rute` int(11) NOT NULL,
  `waktu_berangkat` time NOT NULL,
  `waktu_tiba` time NOT NULL,
  `harga` int(11) NOT NULL,
  `kapasitas_kursi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_penerbangan`
--

INSERT INTO `jadwal_penerbangan` (`id_jadwal`, `id_rute`, `waktu_berangkat`, `waktu_tiba`, `harga`, `kapasitas_kursi`) VALUES
(15, 1, '10:11:00', '12:30:00', 300000, 0),
(17, 15, '20:00:00', '01:00:00', 1000000, 42),
(18, 8, '06:00:00', '12:00:00', 500000, 0),
(19, 7, '03:00:00', '05:00:00', 300000, 12);

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id_kota` int(11) NOT NULL,
  `nama_kota` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id_kota`, `nama_kota`) VALUES
(1, 'Jakarta'),
(2, 'Bali'),
(3, 'Surabaya'),
(4, 'Yogyakarta'),
(5, 'Bengkulu'),
(6, 'Lombok'),
(7, 'Aceh'),
(8, 'Banten'),
(10, 'Medan'),
(12, 'sunda');

-- --------------------------------------------------------

--
-- Table structure for table `maskapai`
--

CREATE TABLE `maskapai` (
  `id_maskapai` int(11) NOT NULL,
  `logo_maskapai` text DEFAULT NULL,
  `nama_maskapai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maskapai`
--

INSERT INTO `maskapai` (`id_maskapai`, `logo_maskapai`, `nama_maskapai`) VALUES
(1, 'logo-garuda.jpg', 'Garuda Indonesia'),
(2, 'air-asia.png', 'Air Asia'),
(3, 'lion-air.png', 'Lion Air'),
(5, 'logo jp.jpeg', 'Jepewan'),
(6, 'Screenshot 2025-02-22 094318.png', 'Citilink'),
(8, 'logo jp.jpeg', 'Zhevepan'),
(10, 'pesawat.jpeg', 'airehh');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id_order_detail` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_penerbangan` int(11) NOT NULL,
  `id_order` varchar(20) NOT NULL,
  `jumlah_tiket` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id_order_detail`, `id_user`, `id_penerbangan`, `id_order`, `jumlah_tiket`, `total_harga`) VALUES
(121224, 43, 17, '67d90f23470e1', 1, 1000000),
(121225, 43, 18, '67d91429c3aad', 2, 1000000),
(121226, 34, 18, '67d91640e0954', 1, 500000),
(121227, 34, 18, '67d919487c504', 1, 500000),
(121228, 34, 19, '67d9199054c20', 20, 6000000),
(121229, 34, 17, '67d9199054c20', 5, 5000000),
(121230, 34, 18, '67d920e71db5a', 3, 1500000),
(121231, 34, 18, '67d9235d9b0b4', 4, 2000000),
(121232, 43, 17, '67d924313e967', 1, 1000000),
(121233, 43, 18, '67d92c58bf080', 9, 4500000),
(121234, 43, 17, '67d9346c44c26', 1, 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `order_tiket`
--

CREATE TABLE `order_tiket` (
  `id_order` varchar(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `struk` varchar(100) NOT NULL,
  `status` enum('verifikasi','proses') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_tiket`
--

INSERT INTO `order_tiket` (`id_order`, `tanggal_transaksi`, `struk`, `status`) VALUES
('67d90f23470e1', '2025-03-18', '06d2d1baf0f5bf149449', 'verifikasi'),
('67d91429c3aad', '2025-03-18', 'd731485fd6255c8773ef', 'verifikasi'),
('67d91640e0954', '2025-03-18', '5af83cc9cd1eb186ecd3', 'verifikasi'),
('67d919487c504', '2025-03-18', '34b7235b3744b24781af', 'verifikasi'),
('67d9199054c20', '2025-03-18', 'a5b8b834864c7695c07d', 'verifikasi'),
('67d920e71db5a', '2025-03-18', 'c94b10addf85a7e438c5', 'verifikasi'),
('67d9235d9b0b4', '2025-03-18', '8d7143b865459f30e216', 'verifikasi'),
('67d924313e967', '2025-03-18', '07f576d8758bddadee5d', 'verifikasi'),
('67d92c58bf080', '2025-03-18', '8d259a4be1a3b0e4a65a', 'verifikasi'),
('67d9346c44c26', '2025-03-18', '500d813e82f81181cb65', 'verifikasi');

-- --------------------------------------------------------

--
-- Table structure for table `rute`
--

CREATE TABLE `rute` (
  `id_rute` int(11) NOT NULL,
  `id_maskapai` int(11) NOT NULL,
  `rute_asal` varchar(100) NOT NULL,
  `rute_tujuan` varchar(100) NOT NULL,
  `tanggal_pergi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rute`
--

INSERT INTO `rute` (`id_rute`, `id_maskapai`, `rute_asal`, `rute_tujuan`, `tanggal_pergi`) VALUES
(1, 1, 'Aceh', 'Bali', '2024-02-24'),
(2, 2, 'Jakarta', 'Bali', '2024-02-25'),
(3, 3, 'Bali', 'Yogyakarta', '2024-02-24'),
(7, 3, 'Jakarta', 'Bali', '2024-02-24'),
(8, 2, 'Bali', 'Yogyakarta', '2024-02-24'),
(10, 6, 'Lombok', 'Banten', '0025-12-10'),
(11, 6, 'Bali', 'Jakarta', '2025-05-10'),
(14, 3, 'Bengkulu', 'Lombok', '2024-10-10'),
(15, 5, 'Surabaya', 'Jakarta', '2025-02-06'),
(16, 1, 'Aceh', 'Jakarta', '2024-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` enum('Admin','Petugas','Penumpang') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `roles`) VALUES
(25, 'Tarisyah', 'tarisyah@gmail.com', '123', 'Admin'),
(34, 'dzia', 'zi@gmail.com', '123', 'Penumpang'),
(35, 'andin', 'dindun@gmail.com', 'fatur', 'Penumpang'),
(37, 'nur', 'nur@gmail.com', '123', 'Penumpang'),
(42, 'bal', 'bal@gmail.com', '1', 'Penumpang'),
(43, 'wulling', 'ling@gmail.com', '123', 'Penumpang'),
(44, 'langit', 'ngit@gmail.com', '123', 'Penumpang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal_penerbangan`
--
ALTER TABLE `jadwal_penerbangan`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_rute` (`id_rute`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `maskapai`
--
ALTER TABLE `maskapai`
  ADD PRIMARY KEY (`id_maskapai`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id_order_detail`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_penerbangan` (`id_penerbangan`),
  ADD KEY `id_order` (`id_order`);

--
-- Indexes for table `order_tiket`
--
ALTER TABLE `order_tiket`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`id_rute`),
  ADD KEY `id_maskapai` (`id_maskapai`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal_penerbangan`
--
ALTER TABLE `jadwal_penerbangan`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `maskapai`
--
ALTER TABLE `maskapai`
  MODIFY `id_maskapai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id_order_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121235;

--
-- AUTO_INCREMENT for table `rute`
--
ALTER TABLE `rute`
  MODIFY `id_rute` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal_penerbangan`
--
ALTER TABLE `jadwal_penerbangan`
  ADD CONSTRAINT `jadwal_penerbangan_ibfk_1` FOREIGN KEY (`id_rute`) REFERENCES `rute` (`id_rute`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`id_penerbangan`) REFERENCES `jadwal_penerbangan` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_detail_ibfk_3` FOREIGN KEY (`id_order`) REFERENCES `order_tiket` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rute`
--
ALTER TABLE `rute`
  ADD CONSTRAINT `rute_ibfk_1` FOREIGN KEY (`id_maskapai`) REFERENCES `maskapai` (`id_maskapai`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
