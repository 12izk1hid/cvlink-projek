-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 03, 2024 at 02:37 PM
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
  `username` varchar(30) DEFAULT NULL,
  `id_surveyor` varchar(50) NOT NULL DEFAULT '',
  `id_teknisi` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `request_description` text NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `username`, `id_surveyor`, `id_teknisi`, `harga`, `request_description`, `Status`) VALUES
(46, 'rizki', '', '', '0', '10', 'unsurveyed'),
(47, 'rizki', '', '', '0', '13', 'unsurveyed');

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
(13, 'Pemasangan Wi-Fi', 'jasa', '67000', '80000', '', '2024-11-03', '2024-11-03');

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
(38, 25, 11, '', 0),
(39, 25, 12, '', 0);

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
(9, 3, '2024-10-31', '2024-10-31', 'Selesai', 12, 'zzzc');

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
(29, 'jsjsj', 'aya', '25d55ad283aa400af464c76d713c07ad', 'hhh', 'hhh@mail.com', 9999, 'klien');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `kontrak`
--
ALTER TABLE `kontrak`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_kontrak` (`id_tagihan`,`id_jasa`);

--
-- Indexes for table `pemasangan`
--
ALTER TABLE `pemasangan`
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
-- AUTO_INCREMENT for table `hasil_survei`
--
ALTER TABLE `hasil_survei`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kontrak`
--
ALTER TABLE `kontrak`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `pemasangan`
--
ALTER TABLE `pemasangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
