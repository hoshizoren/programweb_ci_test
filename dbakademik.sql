-- phpMyAdmin SQL Dump
-- version 5.2.1-2.fc39
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 24, 2024 at 01:41 PM
-- Server version: 10.5.23-MariaDB
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbakademik`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbjurusan`
--

CREATE TABLE `tbjurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbjurusan`
--

INSERT INTO `tbjurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(1, 'TEKNIK ELEKTRO'),
(2, 'TEKNIK INFORMATIKA DAN KOMPUTER'),
(3, 'AKUNTASI'),
(4, 'ADMINISTRASI NIAGA'),
(5, 'TEKNIK SIPIL'),
(6, 'TEKNIK MESIN');

-- --------------------------------------------------------

--
-- Table structure for table `tbmahasiswa`
--

CREATE TABLE `tbmahasiswa` (
  `nim` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `jenkel` varchar(12) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `kode_prodi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbmahasiswa`
--

INSERT INTO `tbmahasiswa` (`nim`, `nama`, `alamat`, `jenkel`, `id_jurusan`, `kode_prodi`) VALUES
('0011', 'Barfold', 'London', 'Pria', 5, 22302),
('0015', 'Henry', 'Medan, Sumatera Utara', 'Pria', 1, 20303),
('0314', 'Hayase Yuuka', 'Kivotos', 'Wanita', 3, 61406),
('111233', 'Misono Mika', 'Japan', 'Wanita', 4, 93301),
('12321', 'Sumire Heanna', 'Japan', 'Wanita', 3, 62303),
('1235', 'Hazuki Ren', 'Japan', 'Wanita', 2, 90346),
('2221', 'Shibuya Kanon', 'Japan', 'Wanita', 3, 57182),
('31111', 'Ushio Noa', 'Japan', 'Wanita', 4, 63411),
('3311111', 'Muhammad Thariq', 'Medan, Sumatera Utara', 'Pria', 2, 58302),
('76551', 'Matsuura Kanan', 'Japan', 'Wanita', 4, 63411),
('8282828282', 'Thariq', 'JL Iskandar Muda 3 E-F, Medan, 20153', 'Pria', 2, 56401),
('98833', 'Tom', 'Medan, Sumatera Utara', 'Pria', 6, 36303);

-- --------------------------------------------------------

--
-- Table structure for table `tbprodi`
--

CREATE TABLE `tbprodi` (
  `kode_prodi` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `nama_prodi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbprodi`
--

INSERT INTO `tbprodi` (`kode_prodi`, `id_jurusan`, `nama_prodi`) VALUES
(20303, 1, 'Teknologi Rekayasa Instalasi Listrik'),
(20304, 1, 'Teknologi Rekayasa Jaringan Telekomunikasi'),
(20401, 1, 'Elektronika'),
(20402, 1, 'Teknik Telekomunikasi'),
(20403, 1, 'Teknik Listrik'),
(21401, 6, 'Teknik Mesin'),
(21406, 6, 'Teknik Konversi Energi'),
(22301, 5, 'Teknik Rekayasa Jalan Dan Jembatan'),
(22302, 5, 'Manajemen Rekayasa Konstruksi Gedung'),
(22401, 5, 'Teknik Sipil'),
(36303, 6, 'Teknologi Rekayasa Pengelasan dan Fabrikasi'),
(56401, 2, 'Teknik Komputer'),
(57182, 3, 'Sistem Informasi Akuntansi'),
(57401, 2, 'Manajemen Informatika'),
(58302, 2, 'Teknologi Rekayasa Perangkat Lunak'),
(60304, 3, 'Keuangan dan Perbankan Syariah'),
(61406, 3, 'Keuangan Dan Perbankan'),
(62303, 3, 'Akuntasi Keuangan Publik'),
(62401, 3, 'Akuntansi'),
(63311, 4, 'Manajemen Bisnis'),
(63411, 4, 'Administrasi Bisnis'),
(90346, 2, 'Teknologi Rekayasa Multimedia Grafis'),
(93301, 4, 'Usaha Jasa Konvensi, Perjalanan Insentif dan Pameran');

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `nama` varchar(100) NOT NULL DEFAULT '',
  `level` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`username`, `password`, `nama`, `level`) VALUES
('admin', '1234', 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbjurusan`
--
ALTER TABLE `tbjurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `tbmahasiswa`
--
ALTER TABLE `tbmahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `FKidjurusan` (`id_jurusan`),
  ADD KEY `FKkodeprodi` (`kode_prodi`);

--
-- Indexes for table `tbprodi`
--
ALTER TABLE `tbprodi`
  ADD PRIMARY KEY (`kode_prodi`),
  ADD KEY `fk_id_jurusan` (`id_jurusan`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbjurusan`
--
ALTER TABLE `tbjurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbmahasiswa`
--
ALTER TABLE `tbmahasiswa`
  ADD CONSTRAINT `FKidjurusan` FOREIGN KEY (`id_jurusan`) REFERENCES `tbjurusan` (`id_jurusan`),
  ADD CONSTRAINT `FKkodeprodi` FOREIGN KEY (`kode_prodi`) REFERENCES `tbprodi` (`kode_prodi`);

--
-- Constraints for table `tbprodi`
--
ALTER TABLE `tbprodi`
  ADD CONSTRAINT `fk_id_jurusan` FOREIGN KEY (`id_jurusan`) REFERENCES `tbjurusan` (`id_jurusan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
