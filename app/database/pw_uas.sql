-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 05:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pw_uas`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahanbaku`
--

CREATE TABLE `bahanbaku` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `harga_per_satuan` decimal(10,2) NOT NULL,
  `stok_tersedia` decimal(10,2) NOT NULL,
  `tanggal_ditambahkan` datetime NOT NULL,
  `id_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bahanbaku`
--

INSERT INTO `bahanbaku` (`id`, `nama`, `deskripsi`, `satuan`, `harga_per_satuan`, `stok_tersedia`, `tanggal_ditambahkan`, `id_kategori`) VALUES
(1, 'Kain Mori', 'Kain mori kualitas tinggi', 'yard', 150.00, 100.00, '2023-06-01 10:00:00', 1),
(2, 'Lilin Malam Kualitas A', 'Lilin malam kualitas terbaik', 'kg', 50.00, 200.00, '2023-06-02 11:00:00', 2),
(3, 'Pewarna Merah', 'Pewarna batik warna merah', 'g', 5.00, 5000.00, '2023-06-03 12:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `detailpembelian`
--

CREATE TABLE `detailpembelian` (
  `id` int(11) NOT NULL,
  `id_pembelian` int(11) DEFAULT NULL,
  `id_bahan_baku` int(11) DEFAULT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `harga_per_satuan` decimal(10,2) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detailpembelian`
--

INSERT INTO `detailpembelian` (`id`, `id_pembelian`, `id_bahan_baku`, `jumlah`, `harga_per_satuan`, `sub_total`) VALUES
(1, 1, 1, 10.00, 150.00, 1500.00),
(2, 2, 2, 50.00, 50.00, 2500.00),
(3, 3, 3, 5000.00, 5.00, 25000.00);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jadwal_kuliah`
--

INSERT INTO `jadwal_kuliah` (`id_jadwalkuliah`, `tanggal_entri`, `hari_kuliah`, `jam_kuliah`, `tempat_kuliah`, `id_matakuliah`, `id_dosen`) VALUES
(3, '2024-06-09', 'Senin', '14:50 sampai 16:50', 'Lab. Pemrograman', 2, 6),
(4, '2024-06-13', 'Rabu', '18:01 sampai 19:04', 'lab2', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `kategoribahanbaku`
--

CREATE TABLE `kategoribahanbaku` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategoribahanbaku`
--

INSERT INTO `kategoribahanbaku` (`id`, `nama`, `deskripsi`) VALUES
(1, 'Kain', 'Bahan baku kain untuk batik, satuan yard'),
(2, 'Lilin Malam', 'Bahan baku lilin malam untuk batik, satuan kg'),
(3, 'warna', 'Bahan baku warna untuk batik, satuan gram');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id_matakuliah` int(11) NOT NULL,
  `mata_kuliah` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id_matakuliah`, `mata_kuliah`) VALUES
(2, 'Pemrogaman web'),
(3, 'Rekayasa Web'),
(4, 'Pemograman Mobile');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `tanggal_pembelian` datetime NOT NULL,
  `total_harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `id_supplier`, `tanggal_pembelian`, `total_harga`) VALUES
(1, 1, '2023-06-04 13:00:00', 1500.00),
(2, 2, '2023-06-05 14:00:00', 2500.00),
(3, 3, '2023-06-06 15:00:00', 25000.00);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `kontak_person` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `alamat`, `no_telepon`, `email`, `kontak_person`) VALUES
(1, 'Supplier Kain', 'Jl. Kain No. 1, Yogyakarta', '081234567890', 'supplierkain@example.com', 'Budi Setiawan'),
(2, 'Supplier Lilin', 'Jl. Lilin No. 2, Surakarta', '081234567891', 'supplierlilin@example.com', 'Siti Aminah'),
(3, 'Supplier Warna', 'Jl. Warna No. 3, Semarang', '081234567892', 'supplierwarna@example.com', 'Andi Pratama');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahanbaku`
--
ALTER TABLE `bahanbaku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `detailpembelian`
--
ALTER TABLE `detailpembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pembelian` (`id_pembelian`),
  ADD KEY `id_bahan_baku` (`id_bahan_baku`);

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
-- Indexes for table `kategoribahanbaku`
--
ALTER TABLE `kategoribahanbaku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id_matakuliah`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahanbaku`
--
ALTER TABLE `bahanbaku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detailpembelian`
--
ALTER TABLE `detailpembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jadwal_kuliah`
--
ALTER TABLE `jadwal_kuliah`
  MODIFY `id_jadwalkuliah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategoribahanbaku`
--
ALTER TABLE `kategoribahanbaku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id_matakuliah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bahanbaku`
--
ALTER TABLE `bahanbaku`
  ADD CONSTRAINT `bahanbaku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategoribahanbaku` (`id`);

--
-- Constraints for table `detailpembelian`
--
ALTER TABLE `detailpembelian`
  ADD CONSTRAINT `detailpembelian_ibfk_1` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id`),
  ADD CONSTRAINT `detailpembelian_ibfk_2` FOREIGN KEY (`id_bahan_baku`) REFERENCES `bahanbaku` (`id`);

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

