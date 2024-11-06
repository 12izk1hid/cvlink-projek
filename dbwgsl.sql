-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 06, 2024 at 06:31 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbwgsl`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` tinytext NOT NULL,
  `merk` tinytext NOT NULL,
  `harga` int(11) NOT NULL,
  `besaran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `merk`, `harga`, `besaran`) VALUES
(1, 'CCTV', 'AXON', 1000000, 'pcs'),
(2, 'Selang', 'Rucikson', 4000, 'meter'),
(3, 'Kabel Listrik', 'Politron', 20000, 'meter'),
(4, 'Kabel UTP Paket Lengkap', 'Larion', 10000, 'meter'),
(5, 'Pipa 1 inch', 'Rucika', 55000, 'Batang'),
(6, 'Pompa Air (Submersible 0.5hp)', 'Paloma', 2500000, 'pcs'),
(7, 'Panel Surya 100 wp', 'Solana', 1500000, 'keping'),
(8, 'Tower Triangle', '...', 2000000, 'batang'),
(9, 'Baterai Lipo 100 AH ', 'ICA', 1600000, 'pcs'),
(10, 'Solar Charge Control (SCC) 50A, 24V', 'ICA Solar', 1000000, 'unit'),
(11, 'Biaya Kendala', '-', 1250000, '/ projek'),
(12, 'LHG LTE', 'Mikrotik', 7000000, 'unit'),
(13, 'Router', 'Mi Router', 1000000, 'unit');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_survei`
--

CREATE TABLE `hasil_survei` (
  `id` int(11) NOT NULL,
  `id_surveyors` int(11) DEFAULT NULL,
  `Tanggal_survei` date NOT NULL,
  `Jenis_instalasi` varchar(100) NOT NULL,
  `kebutuhan_material` text NOT NULL,
  `estimasi_waktu` varchar(15) NOT NULL,
  `catatan_hasil_survei` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil_survei`
--

INSERT INTO `hasil_survei` (`id`, `id_surveyors`, `Tanggal_survei`, `Jenis_instalasi`, `kebutuhan_material`, `estimasi_waktu`, `catatan_hasil_survei`) VALUES
(1, 7, '2024-10-05', 'Instalasi Listrik', 'Kabel 4m, 1 unit saklar', '3 hari', 'Semua material tersedia'),
(2, 7, '2024-10-10', 'Pengeboran', '1 unit bor, 2 unit cangkul', '6 hari', 'Sumber air sudah ditemukan'),
(3, 8, '2024-10-19', 'Instalasi CCTV', '5 unit cctv', '1 hari', 'Material masih kurang'),
(8, 7, '2024-10-28', 'fffx', 'fffx', 'fffx', 'fffx'),
(9, 16, '2024-10-31', 'listrik', 'kabel', '3 hari', 'tidak ada masalah');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `user_username` int(11) NOT NULL,
  `tanggal_pemesanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jasa`
--

CREATE TABLE `jasa` (
  `id` int(10) NOT NULL,
  `nama_item` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `min_harga` varchar(20) NOT NULL,
  `max_harga` varchar(20) NOT NULL,
  `photo_url` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jasa`
--

INSERT INTO `jasa` (`id`, `nama_item`, `type`, `min_harga`, `max_harga`, `photo_url`, `created_at`, `updated_at`) VALUES
(1, 'CCTV', 'barang', '67000', '89000', '', '2024-10-09', '2024-10-29'),
(10, 'Pengeboran Sumur', 'jasa', '45000', '50000', '', '2024-10-29', '2024-10-29'),
(11, 'Kabel', 'barang', '20000', '30000', '', '2024-10-30', '2024-10-30'),
(12, 'Selang', 'barang', '5000', '8000', '', '2024-10-30', '2024-10-30'),
(13, 'Pemasangan Wi-Fi', 'jasa', '67000', '80000', '', '2024-11-03', '2024-11-03'),
(21, 'mesin bor air', 'barang', '150000', '200000', 'pengeboran.jpg', '2024-11-04', '2024-11-04');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_paket_layanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kontrak`
--

CREATE TABLE `kontrak` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_tagihan` int(11) NOT NULL,
  `id_jasa` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kontrak`
--

INSERT INTO `kontrak` (`id`, `id_tagihan`, `id_jasa`, `deskripsi`, `harga`) VALUES
(40, 46, 10, '', 0),
(41, 46, 11, '', 0),
(42, 46, 12, '', 0),
(43, 47, 13, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `paket_layanan`
--

CREATE TABLE `paket_layanan` (
  `id` int(11) NOT NULL,
  `id_services` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `besar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket_layanan`
--

INSERT INTO `paket_layanan` (`id`, `id_services`, `id_barang`, `besar`) VALUES
(1, 1, 4, 20),
(2, 1, 3, 5),
(5, 1, 1, 1),
(6, 2, 4, 20),
(7, 2, 3, 20),
(8, 2, 1, 7),
(9, 3, 5, 10),
(10, 3, 6, 1),
(11, 1, 7, 2),
(12, 1, 8, 4),
(13, 1, 9, 2),
(14, 1, 10, 1),
(15, 1, 11, 1),
(16, 1, 12, 1),
(17, 1, 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pemasangan`
--

CREATE TABLE `pemasangan` (
  `id` int(11) NOT NULL,
  `id_kontrak` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status_pemasangan` varchar(100) NOT NULL,
  `id_teknisi` int(11) NOT NULL,
  `catatan_pemasangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemasangan`
--

INSERT INTO `pemasangan` (`id`, `id_kontrak`, `tanggal_mulai`, `tanggal_selesai`, `status_pemasangan`, `id_teknisi`, `catatan_pemasangan`) VALUES
(8, 15, '2024-10-01', '2024-10-25', 'Belum Ada Pengerjaan', 13, 'zxc'),
(9, 3, '2024-10-31', '2024-10-31', 'Selesai', 12, 'zzzc'),
(10, 40, '2024-11-06', '2024-11-28', 'Belum Ada Pengerjaan', 27, 'pipa 2');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `nama` tinytext NOT NULL,
  `deskripsi` text NOT NULL,
  `img_url` tinytext NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `nama`, `deskripsi`, `img_url`, `harga`) VALUES
(1, 'Pemasangan WiFi RT', 'Kecepatan 670 mb/s', 'jaringan.jpg', 20000000),
(2, 'Pemasangan Wifi Kantor', 'Ini adalah pemasangan wifi di daerah kantor', 'jaringan.jpg', 0),
(3, 'Pengeboran Air', 'Ini adalah pengeboran air', 'pengeboran.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` int(20) NOT NULL,
  `role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `alamat`, `email`, `no_hp`, `role`) VALUES
(14, 'Heri Sanjaya', 'jaya', '25d55ad283aa400af464c76d713c07ad', 'Jlh. Prof.  T. Zulkarnaen No.9', 'gintingherisanjaya@gmail.com', 2147483647, 'admin'),
(15, 'Rizki Hidayah', 'rizki', '25d55ad283aa400af464c76d713c07ad', 'Jl. STN MHD ARIF', 'hidayahrizki349@gmail.com', 2147483647, 'klien'),
(16, 'Dita Rouli', 'dita', '25d55ad283aa400af464c76d713c07ad', 'Jl. STN MHD ARIF', 'dita@mail.com', 87654, 'surveyor'),
(17, 'rangga', 'rangga', '25d55ad283aa400af464c76d713c07ad', 'jl rangga', 'rangga@gmail.com', 8666333, 'klien'),
(18, 'agus', 'agus', '25d55ad283aa400af464c76d713c07ad', 'Jl. Agus', 'agus@gmail.com', 85432837, 'klien'),
(19, 'saya', 'saya', '25d55ad283aa400af464c76d713c07ad', 'Jl saya', 'saya@gmail.com', 859363828, 'klien'),
(20, 'Rikky', 'rikky', '25d55ad283aa400af464c76d713c07ad', 'Jln. ppppp', 'hjdkd@mail.com', 99999, 'klien'),
(21, 'Rexeky', 'rexeky', '$2y$10$PQjiyRfKTEcE9fkGC.fMw.dWb9efAfNZvqzCv66Ef3p', 'r', 'r@mail.com', 8, 'klien'),
(24, '8', '8', 'c9f0f895fb98ab9159f51fd0297e236d', '8', '8@MAIL.COM', 7, 'klien'),
(26, 'w', 'w', 'f1290186a5d0b1ceab27f4e77c0c5d68', 'w', 'w@gmail.com', 864433, 'klien'),
(27, 'Ichan Lingga', 'ichan', '25d55ad283aa400af464c76d713c07ad', 'jln kdkkd', 'jjj@mail.com', 88776666, 'teknisi'),
(28, 'Firja', 'firja', '25d55ad283aa400af464c76d713c07ad', 'jjj', 'jjj@mail.com', 8888, 'klien'),
(29, 'jsjsj', 'aya', '25d55ad283aa400af464c76d713c07ad', 'hhh', 'hhh@mail.com', 9999, 'klien'),
(30, 'doli', 'doli', '25d55ad283aa400af464c76d713c07ad', 'jl doli', 'doli@gmail.com', 865444, 'surveyor'),
(31, 'nisa sarbina', 'nisa123', '$2y$10$6YWiSxyMAxlN756zlnAzgOFqy32LIKFnQX.XkfbJV.8', 'Jl. STN MHD ARIF', 'nisa@gmail.com', 2147483647, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil_survei`
--
ALTER TABLE `hasil_survei`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontrak`
--
ALTER TABLE `kontrak`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_kontrak` (`id_tagihan`,`id_jasa`);

--
-- Indexes for table `paket_layanan`
--
ALTER TABLE `paket_layanan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_barang_packeting` (`id_services`,`id_barang`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `pemasangan`
--
ALTER TABLE `pemasangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
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
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `hasil_survei`
--
ALTER TABLE `hasil_survei`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kontrak`
--
ALTER TABLE `kontrak`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `paket_layanan`
--
ALTER TABLE `paket_layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pemasangan`
--
ALTER TABLE `pemasangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `paket_layanan`
--
ALTER TABLE `paket_layanan`
  ADD CONSTRAINT `paket_layanan_ibfk_1` FOREIGN KEY (`id_services`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `paket_layanan_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
