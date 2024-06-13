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
CREATE DATABASE IF NOT EXISTS `pw_uas` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pw_uas`;

-- Dumping structure for table pw_uas.bahanbaku
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

-- Data exporting was unselected.

-- Dumping structure for table pw_uas.detailpembelian
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

-- Data exporting was unselected.

-- Dumping structure for table pw_uas.dosen
CREATE TABLE IF NOT EXISTS `dosen` (
  `id_dosen` int NOT NULL AUTO_INCREMENT,
  `nidn_dosen` bigint NOT NULL,
  `nama_dosen` varchar(100) NOT NULL,
  `jk_dosen` enum('Pria','Wanita') NOT NULL,
  `alamat_dosen` text NOT NULL,
  `foto_dosen` text NOT NULL,
  PRIMARY KEY (`id_dosen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table pw_uas.jadwal_kuliah
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

-- Data exporting was unselected.

-- Dumping structure for table pw_uas.kategoribahanbaku
CREATE TABLE IF NOT EXISTS `kategoribahanbaku` (
  `id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'AUTO_INCREMENT',
  `nama` text COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table pw_uas.mata_kuliah
CREATE TABLE IF NOT EXISTS `mata_kuliah` (
  `id_matakuliah` int NOT NULL AUTO_INCREMENT,
  `mata_kuliah` text NOT NULL,
  PRIMARY KEY (`id_matakuliah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table pw_uas.pembelian
CREATE TABLE IF NOT EXISTS `pembelian` (
  `id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'AUTO_INCREMENT',
  `id_supplier` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_pembelian` datetime NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_pembelian_supplier` (`id_supplier`),
  CONSTRAINT `FK_pembelian_supplier` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table pw_uas.supplier
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

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
