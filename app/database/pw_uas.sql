
CREATE TABLE IF NOT EXISTS `kategoribahanbaku` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kodekategori` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3;

INSERT INTO `kategoribahanbaku` (`id`, `kodekategori`, `nama`, `deskripsi`) VALUES

CREATE TABLE IF NOT EXISTS `bahanbaku` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kodebahan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `satuan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stok_tersedia` decimal(10,2) NOT NULL,
  `tanggal_ditambahkan` date NOT NULL,
  `id_kategori` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_bahanbaku_kategori` (`id_kategori`),
  CONSTRAINT `FK_bahanbaku_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategoribahanbaku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;



CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kodesupplier` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `no_telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kontak_person` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `logosupplier` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3;

CREATE TABLE IF NOT EXISTS `pembelian` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kodepembelian` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL,
  `total_beli` decimal(10,2) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `id_supplier` int DEFAULT NULL,
  `id_bahanbaku` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_pembelian_supplier` (`id_supplier`),
  KEY `FK_pembelian_bahanbaku` (`id_bahanbaku`),
  CONSTRAINT `FK_pembelian_bahanbaku` FOREIGN KEY (`id_bahanbaku`) REFERENCES `bahanbaku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_pembelian_supplier` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

