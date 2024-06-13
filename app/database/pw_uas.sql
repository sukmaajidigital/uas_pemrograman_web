-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for pw_uas
DROP DATABASE IF EXISTS `pw_uas`;
CREATE DATABASE IF NOT EXISTS `pw_uas` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pw_uas`;

-- Dumping structure for table pw_uas.bahanbaku
DROP TABLE IF EXISTS `bahanbaku`;
CREATE TABLE IF NOT EXISTS `bahanbaku` (
  `id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'AUTO_INCREMENT',
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  `satuan` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `harga_per_satuan` decimal(10,2) NOT NULL,
  `stok_tersedia` decimal(10,2) NOT NULL,
  `tanggal_ditambahkan` datetime NOT NULL,
  `id_kategori` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_bahanbaku_kategoribahanbaku` (`id_kategori`),
  CONSTRAINT `FK_bahanbaku_kategoribahanbaku` FOREIGN KEY (`id_kategori`) REFERENCES `kategoribahanbaku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pw_uas.bahanbaku: ~0 rows (approximately)
DELETE FROM `bahanbaku`;

-- Dumping structure for table pw_uas.detailpembelian
DROP TABLE IF EXISTS `detailpembelian`;
CREATE TABLE IF NOT EXISTS `detailpembelian` (
  `id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'AUTO_INCREMENT',
  `id_pembelian` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_bahan_baku` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `harga_per_satuan` decimal(10,2) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_detailpembelian_bahanbaku` (`id_bahan_baku`),
  KEY `FK_detailpembelian_pembelian` (`id_pembelian`),
  CONSTRAINT `FK_detailpembelian_bahanbaku` FOREIGN KEY (`id_bahan_baku`) REFERENCES `bahanbaku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_detailpembelian_pembelian` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pw_uas.detailpembelian: ~0 rows (approximately)
DELETE FROM `detailpembelian`;

-- Dumping structure for table pw_uas.dosen
DROP TABLE IF EXISTS `dosen`;
CREATE TABLE IF NOT EXISTS `dosen` (
  `id_dosen` int NOT NULL AUTO_INCREMENT,
  `nidn_dosen` bigint NOT NULL,
  `nama_dosen` varchar(100) NOT NULL,
  `jk_dosen` enum('Pria','Wanita') NOT NULL,
  `alamat_dosen` text NOT NULL,
  `foto_dosen` text NOT NULL,
  PRIMARY KEY (`id_dosen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pw_uas.dosen: ~2 rows (approximately)
DELETE FROM `dosen`;
INSERT INTO `dosen` (`id_dosen`, `nidn_dosen`, `nama_dosen`, `jk_dosen`, `alamat_dosen`, `foto_dosen`) VALUES
	(5, 2000021219829192801, 'Goo Young Joong, S.Kom, M.Kom.', 'Wanita', 'Kudus', '6665414214ed1.jpg'),
	(6, 2000021219829192802, 'Zayn Malik, S.Kom, M.Kom', 'Pria', 'Kudus', '666560bc1211f.jpg');

-- Dumping structure for table pw_uas.jadwal_kuliah
DROP TABLE IF EXISTS `jadwal_kuliah`;
CREATE TABLE IF NOT EXISTS `jadwal_kuliah` (
  `id_jadwalkuliah` int NOT NULL AUTO_INCREMENT,
  `tanggal_entri` date NOT NULL,
  `hari_kuliah` text NOT NULL,
  `jam_kuliah` text NOT NULL,
  `tempat_kuliah` text NOT NULL,
  `id_matakuliah` int NOT NULL,
  `id_dosen` int NOT NULL,
  PRIMARY KEY (`id_jadwalkuliah`),
  KEY `id_mahasiswa` (`id_matakuliah`),
  KEY `id_dosen` (`id_dosen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pw_uas.jadwal_kuliah: ~3 rows (approximately)
DELETE FROM `jadwal_kuliah`;
INSERT INTO `jadwal_kuliah` (`id_jadwalkuliah`, `tanggal_entri`, `hari_kuliah`, `jam_kuliah`, `tempat_kuliah`, `id_matakuliah`, `id_dosen`) VALUES
	(3, '2024-06-09', 'Senin', '14:50 sampai 16:50', 'Lab. Pemrograman', 2, 6),
	(4, '2024-06-13', 'Rabu', '18:01 sampai 19:04', 'lab2', 5, 5),
	(5, '2024-06-06', 'Selasa', '18:59 sampai 18:58', 'asdasdasd', 3, 6);

-- Dumping structure for table pw_uas.kategoribahanbaku
DROP TABLE IF EXISTS `kategoribahanbaku`;
CREATE TABLE IF NOT EXISTS `kategoribahanbaku` (
  `id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'AUTO_INCREMENT',
  `nama` text COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pw_uas.kategoribahanbaku: ~99 rows (approximately)
DELETE FROM `kategoribahanbaku`;
INSERT INTO `kategoribahanbaku` (`id`, `nama`, `deskripsi`) VALUES
	('KBB012', 'ASD', 'ASD'),
	('KBB013', 'ASD', 'ASD'),
	('KBB014', 'ASD', 'ASD'),
	('KBB015', 'ASD', 'ASD'),
	('KBB016', 'ASD', 'ASD'),
	('KBB017', 'ASD', 'ASD'),
	('KBB018', 'ASD', 'ASD'),
	('KBB019', 'ASD', 'ASD'),
	('KBB020', 'ASD', 'ASD'),
	('KBB021', 'ASD', 'ASD'),
	('KBB022', 'ASD', 'ASD'),
	('KBB023', 'ASD', 'ASD'),
	('KBB024', 'ASD', 'ASD'),
	('KBB025', 'ASD', 'ASD'),
	('KBB026', 'ASD', 'ASD'),
	('KBB027', 'ASD', 'ASD'),
	('KBB028', 'ASD', 'ASD'),
	('KBB029', 'ASD', 'ASD'),
	('KBB030', 'ASD', 'ASD'),
	('KBB031', 'ASD', 'ASD'),
	('KBB032', 'ASD', 'ASD'),
	('KBB033', 'ASD', 'ASD'),
	('KBB034', 'ASD', 'ASD'),
	('KBB035', 'ASD', 'ASD'),
	('KBB036', 'ASD', 'ASD'),
	('KBB037', 'ASD', 'ASD'),
	('KBB038', 'ASD', 'ASD'),
	('KBB039', 'ASD', 'ASD'),
	('KBB040', 'ASD', 'ASD'),
	('KBB041', 'ASD', 'ASD'),
	('KBB042', 'ASD', 'ASD'),
	('KBB043', 'ASD', 'ASD'),
	('KBB044', 'ASD', 'ASD'),
	('KBB045', 'ASD', 'ASD'),
	('KBB046', 'ASD', 'ASD'),
	('KBB047', 'ASD', 'ASD'),
	('KBB048', 'ASD', 'ASD'),
	('KBB049', 'ASD', 'ASD'),
	('KBB050', 'ASD', 'ASD'),
	('KBB051', 'ASD', 'ASD'),
	('KBB052', 'ASD', 'ASD'),
	('KBB053', 'ASD', 'ASD'),
	('KBB054', 'ASD', 'ASD'),
	('KBB055', 'ASD', 'ASD'),
	('KBB056', 'ASD', 'ASD'),
	('KBB057', 'ASD', 'ASD'),
	('KBB058', 'ASD', 'ASD'),
	('KBB059', 'ASD', 'ASD'),
	('KBB060', 'ASD', 'ASD'),
	('KBB061', 'ASD', 'ASD'),
	('KBB062', 'ASD', 'ASD'),
	('KBB063', 'ASD', 'ASD'),
	('KBB064', 'ASD', 'ASD'),
	('KBB065', 'ASD', 'ASD'),
	('KBB066', 'ASD', 'ASD'),
	('KBB067', 'ASD', 'ASD'),
	('KBB068', 'ASD', 'ASD'),
	('KBB069', 'ASD', 'ASD'),
	('KBB070', 'ASD', 'ASD'),
	('KBB071', 'ASD', 'ASD'),
	('KBB072', 'ASD', 'ASD'),
	('KBB073', 'ASD', 'ASD'),
	('KBB074', 'ASD', 'ASD'),
	('KBB075', 'ASD', 'ASD'),
	('KBB076', 'ASD', 'ASD'),
	('KBB077', 'ASD', 'ASD'),
	('KBB078', 'ASD', 'ASD'),
	('KBB079', 'ASD', 'ASD'),
	('KBB080', 'ASD', 'ASD'),
	('KBB081', 'ASD', 'ASD'),
	('KBB082', 'ASD', 'ASD'),
	('KBB083', 'ASD', 'ASD'),
	('KBB084', 'ASD', 'ASD'),
	('KBB085', 'ASD', 'ASD'),
	('KBB086', 'ASD', 'ASD'),
	('KBB087', 'ASD', 'ASD'),
	('KBB088', 'ASD', 'ASD'),
	('KBB089', 'ASD', 'ASD'),
	('KBB090', 'ASD', 'ASD'),
	('KBB091', 'ASD', 'ASD'),
	('KBB092', 'ASD', 'ASD'),
	('KBB093', 'ASD', 'ASD'),
	('KBB094', 'ASD', 'ASD'),
	('KBB095', 'ASD', 'ASD'),
	('KBB096', 'ASD', 'ASD'),
	('KBB097', 'ASD', 'ASD'),
	('KBB098', 'ASD', 'ASD'),
	('KBB099', 'ASD', 'ASD'),
	('KBB100', 'ASD', 'ASD'),
	('KBB101', 'ASD', 'ASD'),
	('KBB102', 'ASD', 'ASD'),
	('KBB103', 'ASD', 'ASD'),
	('KBB104', 'ASD', 'ASD'),
	('KBB105', 'ASD', 'ASD'),
	('KBB106', 'ASD', 'ASD'),
	('KBB107', 'ASD', 'ASD'),
	('KBB108', 'ASD', 'ASD'),
	('KBB109', 'ASD', 'ASD'),
	('KBB110', 'coba', NULL);

-- Dumping structure for table pw_uas.mata_kuliah
DROP TABLE IF EXISTS `mata_kuliah`;
CREATE TABLE IF NOT EXISTS `mata_kuliah` (
  `id_matakuliah` int NOT NULL AUTO_INCREMENT,
  `mata_kuliah` text NOT NULL,
  PRIMARY KEY (`id_matakuliah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pw_uas.mata_kuliah: ~4 rows (approximately)
DELETE FROM `mata_kuliah`;
INSERT INTO `mata_kuliah` (`id_matakuliah`, `mata_kuliah`) VALUES
	(2, 'Pemrogaman web'),
	(3, 'Rekayasa Web'),
	(4, 'Pemograman Mobiled'),
	(5, 'asdasd');

-- Dumping structure for table pw_uas.pembelian
DROP TABLE IF EXISTS `pembelian`;
CREATE TABLE IF NOT EXISTS `pembelian` (
  `id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'AUTO_INCREMENT',
  `id_supplier` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_pembelian` datetime NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_pembelian_supplier` (`id_supplier`),
  CONSTRAINT `FK_pembelian_supplier` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pw_uas.pembelian: ~3 rows (approximately)
DELETE FROM `pembelian`;
INSERT INTO `pembelian` (`id`, `id_supplier`, `tanggal_pembelian`, `total_harga`) VALUES
	('1', '1', '2023-06-04 13:00:00', 1500.00),
	('2', '2', '2023-06-05 14:00:00', 2500.00),
	('3', '3', '2023-06-06 15:00:00', 25000.00);

-- Dumping structure for table pw_uas.supplier
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'AUTO_INCREMENT',
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci,
  `no_telepon` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kontak_person` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `logosupplier` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pw_uas.supplier: ~3 rows (approximately)
DELETE FROM `supplier`;
INSERT INTO `supplier` (`id`, `nama`, `alamat`, `no_telepon`, `email`, `kontak_person`, `logosupplier`) VALUES
	('1', 'Supplier Kain', 'Jl. Kain No. 1, Yogyakarta', '081234567890', 'supplierkain@example.com', 'Budi Setiawan', NULL),
	('2', 'Supplier Lilin', 'Jl. Lilin No. 2, Surakarta', '081234567891', 'supplierlilin@example.com', 'Siti Aminah', NULL),
	('3', 'Supplier Warna', 'Jl. Warna No. 3, Semarang', '081234567892', 'supplierwarna@example.com', 'Andi Pratama', '666a91c57b18d.png');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
