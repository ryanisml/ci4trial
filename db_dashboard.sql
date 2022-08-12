-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2021 at 05:37 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `kode_barang` varchar(10) NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_satuan` double NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(20) DEFAULT NULL,
  `id_satuan` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`kode_barang`, `barcode`, `nama_barang`, `harga_satuan`, `stok`, `created_at`, `created_by`, `updated_at`, `updated_by`, `id_satuan`, `id_kategori`, `status`) VALUES
('BRG0001', '1234567890', 'Penggaris', 10000, 189, '2021-08-19 14:54:56', 'admin', '2021-08-21 01:01:54', 'admin', 1, 1, 1),
('BRG0002', '1234567891', 'Tinta Spidol', 12500, 38, '2021-08-20 15:47:29', 'admin', '2021-08-21 01:05:02', 'admin', 1, 1, 1),
('BRG0003', '0987654321', 'Spidol', 15000, 39, '2021-08-20 16:04:26', 'admin', '2021-08-21 01:07:29', 'admin', 1, 1, 1),
('BRG0004', '9882387123', 'Buku Tulis', 4000, 141, '2021-08-20 18:20:03', 'admin', '2021-08-21 01:04:41', 'admin', 1, 1, 1),
('BRG0005', '354312323', 'Papan LJK', 140000, 98, '2021-08-20 18:20:28', 'admin', '2021-08-21 01:01:54', 'admin', 1, 1, 1),
('BRG0006', '9828937', 'Pulpen Pilot', 4000, 145, '2021-08-20 18:21:23', 'admin', '2021-08-21 06:29:28', 'admin', 1, 1, 1),
('BRG0007', '897231827', 'Pensil 2B', 2500, 195, '2021-08-20 18:21:48', 'admin', '2021-08-21 01:04:03', 'admin', 1, 1, 1),
('BRG0008', '283718237', 'Kalkulator', 20000, 95, '2021-08-20 18:23:24', 'admin', '2021-08-21 01:05:21', 'admin', 1, 1, 1),
('BRG0009', '009783241', 'Batrai', 15000, 109, '2021-08-20 18:23:55', 'admin', '2021-08-21 01:09:06', 'admin', 1, 1, 1),
('BRG0010', '235265321', 'Gunting', 5000, 176, '2021-08-20 18:24:34', 'admin', '2021-08-21 06:29:28', 'admin', 1, 1, 1),
('BRG0011', '7647561234', 'Penghapus', 1500, 88, '2021-08-20 18:37:40', 'admin', '2021-08-21 01:04:23', 'admin', 1, 1, 1),
('BRG0012', '343123123123', 'Kertas HVS', 120000, 9, '2021-08-21 11:14:50', 'admin', '2021-08-21 11:16:25', 'admin', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_dtl_penjualan`
--

CREATE TABLE `tb_dtl_penjualan` (
  `id_detail` int(11) NOT NULL,
  `kode_penjualan` varchar(10) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_satuan_beli` double NOT NULL,
  `jumlah_beli` double NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_dtl_penjualan`
--

INSERT INTO `tb_dtl_penjualan` (`id_detail`, `kode_penjualan`, `kode_barang`, `nama_barang`, `harga_satuan_beli`, `jumlah_beli`, `created_at`, `created_by`, `status`) VALUES
(1, 'JL0000001', 'BRG0001', 'Penggaris', 10000, 2, '2021-08-21 00:42:14', 'admin', 1),
(2, 'JL0000001', 'BRG0002', 'Tinta Spidol', 12500, 2, '2021-08-21 00:42:14', 'admin', 1),
(3, 'JL0000002', 'BRG0003', 'Spidol', 15000, 2, '2021-08-21 00:56:49', 'admin', 1),
(4, 'JL0000002', 'BRG0004', 'Buku Tulis', 4000, 1, '2021-08-21 00:56:49', 'admin', 1),
(5, 'JL0000003', 'BRG0004', 'Buku Tulis', 4000, 2, '2021-08-21 00:57:26', 'admin', 1),
(6, 'JL0000003', 'BRG0005', 'Papan LJK', 140000, 1, '2021-08-21 00:57:26', 'admin', 1),
(7, 'JL0000004', 'BRG0007', 'Pensil 2B', 2500, 5, '2021-08-21 00:59:19', 'admin', 1),
(8, 'JL0000004', 'BRG0008', 'Kalkulator', 20000, 1, '2021-08-21 00:59:19', 'admin', 1),
(9, 'JL0000005', 'BRG0008', 'Kalkulator', 20000, 3, '2021-08-21 00:59:53', 'admin', 1),
(10, 'JL0000005', 'BRG0009', 'Batrai', 15000, 2, '2021-08-21 00:59:53', 'admin', 1),
(11, 'JL0000005', 'BRG0010', 'Gunting', 5000, 5, '2021-08-21 00:59:53', 'admin', 1),
(12, 'JL0000006', 'BRG0011', 'Penghapus', 1500, 10, '2021-08-21 01:00:15', 'admin', 1),
(13, 'JL0000006', 'BRG0010', 'Gunting', 5000, 5, '2021-08-21 01:00:15', 'admin', 1),
(14, 'JL0000006', 'BRG0001', 'Penggaris', 10000, 4, '2021-08-21 01:00:15', 'admin', 1),
(15, 'JL0000007', 'BRG0001', 'Penggaris', 10000, 5, '2021-08-21 01:01:54', 'admin', 1),
(16, 'JL0000007', 'BRG0002', 'Tinta Spidol', 12500, 4, '2021-08-21 01:01:54', 'admin', 1),
(17, 'JL0000007', 'BRG0003', 'Spidol', 15000, 2, '2021-08-21 01:01:54', 'admin', 1),
(18, 'JL0000007', 'BRG0004', 'Buku Tulis', 4000, 10, '2021-08-21 01:01:54', 'admin', 1),
(19, 'JL0000007', 'BRG0005', 'Papan LJK', 140000, 1, '2021-08-21 01:01:54', 'admin', 1),
(20, 'JL0000008', 'BRG0002', 'Tinta Spidol', 12500, 2, '2021-08-21 01:03:13', 'admin', 1),
(21, 'JL0000009', 'BRG0009', 'Batrai', 15000, 10, '2021-08-21 01:03:30', 'admin', 1),
(22, 'JL0000010', 'BRG0010', 'Gunting', 5000, 2, '2021-08-21 01:03:47', 'admin', 1),
(23, 'JL0000011', 'BRG0007', 'Pensil 2B', 2500, 10, '2021-08-21 01:04:03', 'admin', 1),
(24, 'JL0000012', 'BRG0011', 'Penghapus', 1500, 2, '2021-08-21 01:04:23', 'admin', 1),
(25, 'JL0000012', 'BRG0010', 'Gunting', 5000, 2, '2021-08-21 01:04:23', 'admin', 1),
(26, 'JL0000013', 'BRG0004', 'Buku Tulis', 4000, 6, '2021-08-21 01:04:41', 'admin', 1),
(27, 'JL0000014', 'BRG0002', 'Tinta Spidol', 12500, 4, '2021-08-21 01:05:02', 'admin', 1),
(28, 'JL0000015', 'BRG0008', 'Kalkulator', 20000, 1, '2021-08-21 01:05:21', 'admin', 1),
(29, 'JL0000016', 'BRG0003', 'Spidol', 15000, 2, '2021-08-21 01:07:29', 'admin', 1),
(30, 'JL0000017', 'BRG0009', 'Batrai', 15000, 2, '2021-08-21 01:09:06', 'admin', 1),
(31, 'JL0000018', 'BRG0006', 'Pulpen Pilot', 4000, 5, '2021-08-21 06:29:28', 'admin', 1),
(32, 'JL0000018', 'BRG0010', 'Gunting', 5000, 10, '2021-08-21 06:29:28', 'admin', 1),
(33, 'JL0000019', 'BRG0012', 'Kertas HVS', 120000, 1, '2021-08-21 11:16:25', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`, `status`) VALUES
(1, 'ATK', 1),
(2, 'Wastafel', 1),
(3, 'Semen', 1),
(4, 'Kayu', 1),
(5, 'Kaca', 1),
(6, 'Batu', 1),
(7, 'Besi', 1),
(8, 'Pipa', 1),
(9, 'Keramik', 1),
(10, 'Tandon Air', 1),
(11, 'Tools', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `kode_pembelian` varchar(10) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_beli_satuan` double NOT NULL,
  `tanggal_beli` date NOT NULL,
  `created_at` datetime NOT NULL,
  `nama_vendor` varchar(100) NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`kode_pembelian`, `kode_barang`, `jumlah`, `harga_beli_satuan`, `tanggal_beli`, `created_at`, `nama_vendor`, `created_by`, `status`) VALUES
('BL00001', 'BRG0001', 100, 10000, '2020-08-06', '2020-08-20 16:46:53', 'PT. ABC', 'admin', 1),
('BL00002', 'BRG0001', 100, 12000, '2021-05-03', '2021-08-20 19:01:21', 'PT. ABC', 'admin', 1),
('BL00003', 'BRG0002', 50, 8000, '2021-05-11', '2021-08-20 19:01:49', 'PT. CBA', 'admin', 1),
('BL00004', 'BRG0003', 25, 10000, '2021-08-11', '2021-08-20 19:02:28', 'PT. PPP', 'admin', 1),
('BL00005', 'BRG0004', 150, 2500, '2021-03-04', '2021-08-20 19:03:55', 'PT. ABC', 'admin', 1),
('BL00006', 'BRG0005', 100, 120000, '2021-07-03', '2021-08-20 19:04:26', 'PT. ABC', 'admin', 1),
('BL00007', 'BRG0006', 100, 1500, '2021-08-10', '2021-08-20 19:04:44', 'PT. ABC', 'admin', 1),
('BL00008', 'BRG0007', 200, 1500, '2021-07-13', '2021-08-20 19:05:14', 'PT. ABC', 'admin', 1),
('BL00009', 'BRG0008', 100, 15000, '2021-07-23', '2021-08-20 19:05:36', 'PT. ABC', 'admin', 1),
('BL00010', 'BRG0009', 100, 13000, '2021-08-10', '2021-08-20 19:06:16', 'PT. ABC', 'admin', 1),
('BL00011', 'BRG0010', 200, 3500, '2021-08-03', '2021-08-20 19:06:34', 'PT. ABC', 'admin', 1),
('BL00012', 'BRG0011', 100, 1000, '2021-05-30', '2021-08-20 19:06:54', 'PT. CBA', 'admin', 1),
('BL00013', 'BRG0006', 50, 2000, '2021-08-19', '2021-08-20 19:07:49', 'PT. CBA', 'admin', 1),
('BL00014', 'BRG0004', 10, 2500, '2021-08-12', '2021-08-20 19:08:15', 'PT. ABC', 'admin', 1),
('BL00015', 'BRG0003', 20, 10000, '2021-08-16', '2021-08-20 19:16:34', 'PT. CBA', 'admin', 1),
('BL00016', 'BRG0007', 10, 1500, '2021-07-18', '2021-08-20 19:18:58', 'PT. ABC', 'admin', 1),
('BL00017', 'BRG0009', 23, 12500, '2021-08-01', '2021-08-20 19:20:12', 'PT. ABC', 'admin', 1),
('BL00018', 'BRG0012', 10, 120000, '2021-08-21', '2021-08-21 11:15:26', 'PT. CBA', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `kode_penjualan` varchar(10) NOT NULL,
  `total_harga` double NOT NULL,
  `total_bayar` double NOT NULL,
  `tanggal_jual` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`kode_penjualan`, `total_harga`, `total_bayar`, `tanggal_jual`, `created_at`, `created_by`, `status`) VALUES
('JL0000001', 45000, 50000, '2021-02-02 00:55:29', '2021-08-21 00:42:14', 'admin', 1),
('JL0000002', 34000, 50000, '2021-03-03 01:05:33', '2021-08-21 00:56:49', 'admin', 1),
('JL0000003', 148000, 150000, '2021-04-07 01:08:27', '2021-08-21 00:57:26', 'admin', 1),
('JL0000004', 32500, 50000, '2021-05-05 01:08:22', '2021-08-21 00:59:19', 'admin', 1),
('JL0000005', 115000, 150000, '2021-06-01 01:08:19', '2021-08-21 00:59:53', 'admin', 1),
('JL0000006', 80000, 100000, '2021-07-08 01:08:15', '2021-08-21 01:00:15', 'admin', 1),
('JL0000007', 310000, 400000, '2021-07-21 01:08:11', '2021-08-21 01:01:54', 'admin', 1),
('JL0000008', 25000, 30000, '2021-07-31 01:07:59', '2021-08-21 01:03:13', 'admin', 1),
('JL0000009', 150000, 200000, '2021-08-01 01:07:57', '2021-08-21 01:03:30', 'admin', 1),
('JL0000010', 10000, 10000, '2021-08-03 01:07:55', '2021-08-21 01:03:47', 'admin', 1),
('JL0000011', 25000, 30000, '2021-08-06 01:07:53', '2021-08-21 01:04:03', 'admin', 1),
('JL0000012', 13000, 15000, '2021-08-08 01:07:49', '2021-08-21 01:04:23', 'admin', 1),
('JL0000013', 24000, 30000, '2021-08-10 01:07:46', '2021-08-21 01:04:41', 'admin', 1),
('JL0000014', 50000, 50000, '2021-08-12 01:07:42', '2021-08-21 01:05:02', 'admin', 1),
('JL0000015', 20000, 20000, '2021-08-18 01:07:34', '2021-08-21 01:05:21', 'admin', 1),
('JL0000016', 30000, 50000, '2021-08-21 01:07:00', '2021-08-21 01:07:29', 'admin', 1),
('JL0000017', 30000, 30000, '2021-01-01 01:08:00', '2021-08-21 01:09:06', 'admin', 1),
('JL0000018', 70000, 100000, '2021-08-21 06:29:00', '2021-08-21 06:29:28', 'admin', 1),
('JL0000019', 120000, 150000, '2021-08-21 11:15:00', '2021-08-21 11:16:25', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(100) NOT NULL,
  `status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_satuan`
--

INSERT INTO `tb_satuan` (`id_satuan`, `nama_satuan`, `status`) VALUES
(1, 'Pcs', 1),
(2, 'Rim', 1),
(3, 'Kilogram', 1),
(4, 'Meter', 1),
(5, 'Lusin', 1),
(6, 'Sak', 1),
(7, 'Dos', 1),
(8, 'Liter', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `email`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'ryanisml@gmail.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`kode_barang`),
  ADD KEY `id_satuan` (`id_satuan`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `tb_dtl_penjualan`
--
ALTER TABLE `tb_dtl_penjualan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `kode_penjualan` (`kode_penjualan`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`kode_pembelian`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`kode_penjualan`);

--
-- Indexes for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_dtl_penjualan`
--
ALTER TABLE `tb_dtl_penjualan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD CONSTRAINT `tb_barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`),
  ADD CONSTRAINT `tb_barang_ibfk_2` FOREIGN KEY (`id_satuan`) REFERENCES `tb_satuan` (`id_satuan`);

--
-- Constraints for table `tb_dtl_penjualan`
--
ALTER TABLE `tb_dtl_penjualan`
  ADD CONSTRAINT `tb_dtl_penjualan_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `tb_barang` (`kode_barang`),
  ADD CONSTRAINT `tb_dtl_penjualan_ibfk_2` FOREIGN KEY (`kode_penjualan`) REFERENCES `tb_penjualan` (`kode_penjualan`);

--
-- Constraints for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD CONSTRAINT `tb_pembelian_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `tb_barang` (`kode_barang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
