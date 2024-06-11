-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2024 at 10:03 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2024_pw_uas`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(11) NOT NULL,
  `nidn_dosen` bigint(20) NOT NULL,
  `nama_dosen` varchar(100) NOT NULL,
  `jk_dosen` enum('Pria','Wanita') NOT NULL,
  `alamat_dosen` text NOT NULL,
  `foto_dosen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nidn_dosen`, `nama_dosen`, `jk_dosen`, `alamat_dosen`, `foto_dosen`) VALUES
(5, 2000021219829192801, 'Goo Young Joong, S.Kom, M.Kom.', 'Wanita', 'Kudus', '6665414214ed1.jpg'),
(6, 2000021219829192802, 'Zayn Malik, S.Kom, M.Kom', 'Pria', 'Kudus', '666560bc1211f.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kuliah`
--

CREATE TABLE `jadwal_kuliah` (
  `id_jadwalkuliah` int(11) NOT NULL,
  `tanggal_entri` date NOT NULL,
  `hari_kuliah` text NOT NULL,
  `jam_kuliah` text NOT NULL,
  `tempat_kuliah` text NOT NULL,
  `id_matakuliah` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_kuliah`
--

INSERT INTO `jadwal_kuliah` (`id_jadwalkuliah`, `tanggal_entri`, `hari_kuliah`, `jam_kuliah`, `tempat_kuliah`, `id_matakuliah`, `id_dosen`) VALUES
(3, '2024-06-09', 'Senin', '14:50 sampai 16:50', 'Lab. Pemrograman', 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id_matakuliah` int(11) NOT NULL,
  `mata_kuliah` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id_matakuliah`, `mata_kuliah`) VALUES
(2, 'Pemrogaman web'),
(3, 'Rekayasa Web'),
(4, 'Pemograman Mobile'),
(5, 'Pengembangan Aplikasi Mobile');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indexes for table `jadwal_kuliah`
--
ALTER TABLE `jadwal_kuliah`
  ADD PRIMARY KEY (`id_jadwalkuliah`),
  ADD KEY `id_mahasiswa` (`id_matakuliah`),
  ADD KEY `id_dosen` (`id_dosen`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id_matakuliah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jadwal_kuliah`
--
ALTER TABLE `jadwal_kuliah`
  MODIFY `id_jadwalkuliah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id_matakuliah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
