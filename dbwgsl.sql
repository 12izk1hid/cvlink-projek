-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 18, 2024 at 05:40 PM
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
(1, 1, '2024-10-05', 'Instalasi Listrik', 'Kabel 4m, 1 unit saklar', '3 hari', 'Semua material tersedia'),
(2, 2, '2024-10-10', 'Pengeboran', '1 unit bor, 2 unit cangkul', '6 hari', 'Sumber air sudah ditemukan'),
(3, 3, '2024-10-19', 'Instalasi CCTV', '5 unit cctv', '1 hari', 'Material masih kurang'),
(6, 7, '2024-10-20', 'xxx', 'xxx', 'xxx', 'xxx');

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
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jasa`
--

INSERT INTO `jasa` (`id`, `nama_item`, `type`, `min_harga`, `max_harga`, `created_at`, `updated_at`) VALUES
(1, 'jsjjsjs', 'barang', '67000', '89000', '2024-10-09', '2024-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accountname`
--

CREATE TABLE `tbl_accountname` (
  `acc_no` varchar(10) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `tgl_create` datetime NOT NULL DEFAULT current_timestamp(),
  `usercreate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_accountname`
--

INSERT INTO `tbl_accountname` (`acc_no`, `account_name`, `tgl_create`, `usercreate`) VALUES
('1001', 'Salary Direktur Utama', '2023-08-05 20:57:43', 'admin12345'),
('1002', 'Salary Direktur ', '2023-08-05 20:57:43', 'admin12345'),
('1003', 'Salary Direktur Keuangan', '2023-08-05 20:57:43', 'admin12345'),
('1004', 'Salary Komisaris', '2023-08-05 20:57:43', 'admin12345'),
('1005', 'Salary Manager', '2023-08-05 20:57:43', 'admin12345'),
('1006', 'Salary Staff', '2023-08-05 20:57:43', 'admin12345'),
('1007', 'Salary Worker', '2023-08-05 20:57:43', 'admin12345'),
('1008', 'Salary Subcont', '2023-08-05 20:57:43', 'admin12345'),
('1009', 'Bonus Direktur Utama', '2023-08-05 20:57:43', 'admin12345'),
('1010', 'Bonus Direktur', '2023-08-05 20:57:43', 'admin12345'),
('1011', 'Bonus Direktur Keuangan', '2023-08-05 20:57:43', 'admin12345'),
('1012', 'Bonus Komisaris', '2023-08-05 20:57:43', 'admin12345'),
('1013', 'Bonus Manager', '2023-08-05 20:57:43', 'admin12345'),
('1014', 'Bonus Staff', '2023-08-05 20:57:43', 'admin12345'),
('1015', 'Bonus Worker', '2023-08-05 20:57:43', 'admin12345'),
('1016', 'Bonus Subcont', '2023-08-05 20:57:43', 'admin12345'),
('1017', 'THR Direktur Utama', '2023-08-05 20:57:43', 'admin12345'),
('1018', 'THR Direktur ', '2023-08-05 20:57:43', 'admin12345'),
('1019', 'THR Direktur Keuangan', '2023-08-05 20:57:43', 'admin12345'),
('1020', 'THR Komisaris', '2023-08-05 20:57:43', 'admin12345'),
('1021', 'THR Manager', '2023-08-05 20:57:43', 'admin12345'),
('1022', 'THR Staff', '2023-08-05 20:57:43', 'admin12345'),
('1023', 'THR Worker', '2023-08-05 20:57:43', 'admin12345'),
('1024', 'Advertising Expenses', '2023-08-05 20:57:43', 'admin12345'),
('1025', 'Auditor', '2023-08-05 20:57:43', 'admin12345'),
('1026', 'Office Supplies', '2023-08-05 20:57:43', 'admin12345'),
('1027', 'Maintenace', '2023-08-05 20:57:43', 'admin12345'),
('1028', 'Bank Commision Charge', '2023-08-05 20:57:43', 'admin12345'),
('1029', 'Bank Transfer Charge', '2023-08-05 20:57:43', 'admin12345'),
('1030', 'Programmer Charge', '2023-08-05 20:57:43', 'admin12345'),
('1031', 'Building (Fire) Insurrance', '2023-08-05 20:57:43', 'admin12345'),
('1032', 'Commissions Other', '2023-08-05 20:57:43', 'admin12345'),
('1033', 'Company\'s Form (Envelope) etc', '2023-08-05 20:57:43', 'admin12345'),
('1034', 'Consultant Expenses', '2023-08-05 20:57:43', 'admin12345'),
('1035', 'Courrier & Post Office Charge', '2023-08-05 20:57:43', 'admin12345'),
('1036', 'Donation', '2023-08-05 20:57:43', 'admin12345'),
('1037', 'Entertaiment Other', '2023-08-05 20:57:43', 'admin12345'),
('1038', 'Escort Service', '2023-08-05 20:57:43', 'admin12345'),
('1039', 'Expatriated Document Fee', '2023-08-05 20:57:43', 'admin12345'),
('1040', 'Gasoline fee direktur', '2023-08-05 20:57:43', 'admin12345'),
('1041', 'General Consultant', '2023-08-05 20:57:43', 'admin12345'),
('1042', 'General Liability Insurance', '2023-08-05 20:57:43', 'admin12345'),
('1043', 'Transportation charge', '2023-08-05 20:57:43', 'admin12345'),
('1044', 'Insurance Other', '2023-08-05 20:57:43', 'admin12345'),
('1045', 'Internet Provider', '2023-08-05 20:57:43', 'admin12345'),
('1046', 'Jamsostek Expenses', '2023-08-05 20:57:43', 'admin12345'),
('1047', 'Land & Building Tax', '2023-08-05 20:57:43', 'admin12345'),
('1048', 'Legal Welfare Tax', '2023-08-05 20:57:43', 'admin12345'),
('1049', 'License', '2023-08-05 20:57:43', 'admin12345'),
('1050', 'Meal & Drinking', '2023-08-05 20:57:43', 'admin12345'),
('1051', 'Overtime', '2023-08-05 20:57:43', 'admin12345'),
('1052', 'Medical Fee', '2023-08-05 20:57:43', 'admin12345'),
('1053', 'Membership Expenses', '2023-08-05 20:57:43', 'admin12345'),
('1054', 'Notaris', '2023-08-05 20:57:43', 'admin12345'),
('1055', 'Misscellaneous Expenses', '2023-08-05 20:57:43', 'admin12345'),
('1056', 'Outsourching Expenses', '2023-08-05 20:57:43', 'admin12345'),
('1057', 'Paid Insufficiency Retirement', '2023-08-05 20:57:43', 'admin12345'),
('1058', 'Rental Other', '2023-08-05 20:57:43', 'admin12345'),
('1059', 'Rental Office & Warehouse', '2023-08-05 20:57:43', 'admin12345'),
('1060', 'Security Fee', '2023-08-05 20:57:43', 'admin12345'),
('1061', 'Stamp Duty', '2023-08-05 20:57:43', 'admin12345'),
('1062', 'Stationary', '2023-08-05 20:57:43', 'admin12345'),
('1063', 'Tax Consultant', '2023-08-05 20:57:43', 'admin12345'),
('1064', 'Taxes & Public dues', '2023-08-05 20:57:43', 'admin12345'),
('1065', 'Thanks Giving Congratulation', '2023-08-05 20:57:43', 'admin12345'),
('1066', 'Toll & Parking fee', '2023-08-05 20:57:43', 'admin12345'),
('1067', 'Travel Expenses & Accomodation domestic', '2023-08-05 20:57:43', 'admin12345'),
('1068', 'Travel Expenses & Accomodation overseas', '2023-08-05 20:57:43', 'admin12345'),
('1069', 'Travel Expenses & Car Fare Others', '2023-08-05 20:57:43', 'admin12345'),
('1070', 'Vehicle Insurrance', '2023-08-05 20:57:43', 'admin12345'),
('1071', 'Welfare Other', '2023-08-05 20:57:43', 'admin12345');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `id` int(11) NOT NULL,
  `penerima` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `notelp` varchar(20) NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tgl_diterima` datetime NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1. buat, 2. sisa, 3.lunas',
  `userupdate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`id`, `penerima`, `alamat`, `notelp`, `tgl_dibuat`, `tgl_diterima`, `jumlah`, `status`, `userupdate`) VALUES
(2, 'Bapak Wilson Satiawan', 'Jl. XYZ. No. 300 Jakrata Pusat', '4546563434343', '2023-09-03 08:42:11', '2023-09-02 23:20:02', 7875000, 3, 'admin12345'),
(3, 'PT. Sejahtera Alam', 'Jl. Jalan x', '07536788', '2023-09-05 15:03:59', '2023-09-02 23:24:18', 225000, 3, 'admin12345'),
(4, 'PT. ABC', '-', '-', '2023-09-05 15:37:13', '2023-09-05 22:37:13', 4000000, 3, 'admin12345');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoicedetail`
--

CREATE TABLE `tbl_invoicedetail` (
  `id` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `pajak` double NOT NULL COMMENT 'dalam bent persen',
  `biaya` int(11) NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tgl_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_invoicedetail`
--

INSERT INTO `tbl_invoicedetail` (`id`, `id_invoice`, `keterangan`, `jumlah`, `pajak`, `biaya`, `tgl_dibuat`, `tgl_update`) VALUES
(18, 2, 'Sewa mobil Xenia  Bulan Agus 2023', '2', 5, 1500000, '2023-09-02 16:14:26', '2023-09-02 23:14:26'),
(19, 2, 'Sewa Mobile Avanza Bulan Agustus 23', '3', 5, 1500000, '2023-09-02 16:20:02', '2023-09-02 23:20:02'),
(20, 3, 'Biaya Pengiriman Paket Piala', '15', 0, 15000, '2023-09-02 16:24:18', '2023-09-02 23:24:18'),
(21, 4, 'Sewa Damtruk', '2', 0, 2000000, '2023-09-05 15:02:54', '2023-09-05 22:02:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jabatan`
--

CREATE TABLE `tbl_jabatan` (
  `id` int(11) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `tgl_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userupdate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_jabatan`
--

INSERT INTO `tbl_jabatan` (`id`, `jabatan`, `tgl_create`, `userupdate`) VALUES
(1, 'Direktur', '2023-07-14 08:08:06', 'admin12345'),
(2, 'Manager', '2023-07-14 08:07:46', 'admin12345'),
(3, 'Pegawai', '2023-08-05 13:04:40', 'admin12345'),
(4, 'Direktur Utama', '2023-08-05 13:04:51', 'admin12345');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jurnal`
--

CREATE TABLE `tbl_jurnal` (
  `id` int(11) NOT NULL,
  `tgltransaksi` datetime NOT NULL,
  `ket` text NOT NULL,
  `saldoawal` bigint(20) NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `referensi` varchar(15) NOT NULL,
  `usercreate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jurnalbank`
--

CREATE TABLE `tbl_jurnalbank` (
  `id` int(11) NOT NULL,
  `tgltransaksi` date NOT NULL,
  `ket` text NOT NULL,
  `saldoawal` bigint(20) NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `referensi` varchar(15) NOT NULL,
  `tglinput` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usercreate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_jurnalbank`
--

INSERT INTO `tbl_jurnalbank` (`id`, `tgltransaksi`, `ket`, `saldoawal`, `debet`, `kredit`, `referensi`, `tglinput`, `usercreate`) VALUES
(2, '2023-09-01', 'Setoran dari Bapak X', 0, 10000000, 0, 'Setoran', '2023-09-05 07:51:24', 'admin12345'),
(3, '2023-09-01', 'Setoran dari Pemilik Bapak ZYX', 0, 10000000, 0, 'Setoran', '2023-09-05 07:51:24', 'admin12345'),
(4, '2023-09-03', 'Penerimaan dari Invoice 2', 0, 7875000, 0, 'WGSL-INV-2023-2', '2023-09-05 07:51:24', 'admin12345'),
(5, '2023-09-03', 'Bayar Gaji Securiti bulan Agustus', 0, 0, 150000, '1060', '2023-09-05 07:51:24', 'admin12345'),
(6, '2023-09-05', 'Penerimaan invoice', 0, 225000, 0, 'WGSL-INV-2023-3', '2023-09-05 07:53:16', 'admin12345'),
(7, '2023-09-05', 'Bayar Tol dan parkir', 0, 0, 250000, '1066', '2023-09-05 14:22:52', 'admin12345'),
(9, '2023-10-01', 'Saldo Awal Bulan Oktober 2023', 27700000, 0, 0, '-', '2023-09-05 14:56:49', 'admin12345'),
(10, '2023-10-02', 'Bayar Gaji Security Bon September', 0, 0, 1500000, '1060', '2023-09-05 14:57:52', 'admin12345'),
(11, '2023-10-02', 'Bayar Tol dan parkeer', 0, 0, 1500000, '1066', '2023-09-05 14:58:53', 'admin12345'),
(12, '2023-10-03', 'Penerimaan dari invoice', 0, 4000000, 0, 'WGSL-INV-2023-4', '2023-09-05 15:37:13', 'admin12345');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kas`
--

CREATE TABLE `tbl_kas` (
  `id` int(11) NOT NULL,
  `kas` varchar(10) NOT NULL,
  `total` bigint(20) NOT NULL,
  `tgl_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_kas`
--

INSERT INTO `tbl_kas` (`id`, `kas`, `total`, `tgl_update`, `userid`) VALUES
(1, 'Kas', 0, '2023-08-28 01:27:37', 'admin12345'),
(2, 'bank', 28700000, '2023-09-05 15:37:13', 'admin12345');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id`, `kategori`) VALUES
(1, 'Umum');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leveluser`
--

CREATE TABLE `tbl_leveluser` (
  `id_level` int(11) NOT NULL,
  `level` varchar(20) NOT NULL,
  `userupdate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_leveluser`
--

INSERT INTO `tbl_leveluser` (`id_level`, `level`, `userupdate`) VALUES
(1, 'Administrator', 'admin12345');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pendapatan`
--

CREATE TABLE `tbl_pendapatan` (
  `id` int(11) NOT NULL,
  `tglpendapatan` date NOT NULL,
  `invoice_num` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usercreate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengeluaran`
--

CREATE TABLE `tbl_pengeluaran` (
  `id` int(11) NOT NULL,
  `tglpengeluaran` date NOT NULL,
  `acc_no` varchar(10) NOT NULL,
  `keterangan` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usercreate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `username` varchar(18) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `id_level` int(11) NOT NULL,
  `aktif` char(1) NOT NULL COMMENT 'Y/N',
  `idupdate` int(11) NOT NULL,
  `tgl_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tgl_update` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `nama`, `password`, `id_level`, `aktif`, `idupdate`, `tgl_create`, `tgl_update`) VALUES
(3, 'admin12345', 'Administrator', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'Y', 1, '2023-08-21 16:26:23', '2023-08-12 11:01:58');

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
(5, 'qwer', 'qwer', '$2y$10$.OhzZZC2iypPirOeOnker.wm7TpxAomhYGkfMIEBy56', 'jl. qwer', 'qwer@gmail.com', 82626269, 'admin'),
(7, 'arif', 'arif', '$2y$10$F241Fo6is/sQCCPTwdA.w.ZoV61AOVsvrWa2P.7cmlv', 'jl arif', 'arif@gmail.com', 8765, 'surveyor'),
(8, 'ccc', 'ccc', '$2y$10$x6hrd5zlTeD94AvCe8GEYuSfNvL2IqIY0rivP3xYM3i', 'jl.ccc', 'ccc@gmail.com', 87555, 'surveyor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hasil_survei`
--
ALTER TABLE `hasil_survei`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_accountname`
--
ALTER TABLE `tbl_accountname`
  ADD PRIMARY KEY (`acc_no`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_invoicedetail`
--
ALTER TABLE `tbl_invoicedetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jurnal`
--
ALTER TABLE `tbl_jurnal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jurnalbank`
--
ALTER TABLE `tbl_jurnalbank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kas`
--
ALTER TABLE `tbl_kas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_leveluser`
--
ALTER TABLE `tbl_leveluser`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `tbl_pendapatan`
--
ALTER TABLE `tbl_pendapatan`
  ADD PRIMARY KEY (`id`,`invoice_num`);

--
-- Indexes for table `tbl_pengeluaran`
--
ALTER TABLE `tbl_pengeluaran`
  ADD PRIMARY KEY (`id`,`acc_no`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_level` (`id_level`) USING BTREE;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_invoicedetail`
--
ALTER TABLE `tbl_invoicedetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_jurnal`
--
ALTER TABLE `tbl_jurnal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_jurnalbank`
--
ALTER TABLE `tbl_jurnalbank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_kas`
--
ALTER TABLE `tbl_kas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_leveluser`
--
ALTER TABLE `tbl_leveluser`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_pendapatan`
--
ALTER TABLE `tbl_pendapatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pengeluaran`
--
ALTER TABLE `tbl_pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
