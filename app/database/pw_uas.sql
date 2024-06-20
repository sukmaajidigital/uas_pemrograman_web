
CREATE TABLE IF NOT EXISTS `kategoribahanbaku` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kodekategori` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3;

INSERT INTO `kategoribahanbaku` (`id`, `kodekategori`, `nama`, `deskripsi`) VALUES
	(34, 'KB001', 'kain', 'kain batik'),
	(35, 'KB002', 'lilin', 'lilin wax malam'),
	(36, 'KB003', 'canting', 'canting batik'),
	(37, 'KB004', 'warna', 'warna batik');

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

INSERT INTO `bahanbaku` (`id`, `kodebahan`, `nama`, `satuan`, `stok_tersedia`, `tanggal_ditambahkan`, `id_kategori`) VALUES
	(4, 'BH002', 'lilin A1', 'kg', 0.00, '2024-06-16', 35),
	(5, 'BH003', 'lilin A2', 'kg', 100.00, '2024-06-17', 35),
	(7, 'BH004', 'katun primisima', 'yard', 5.00, '2024-06-16', 34);


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

INSERT INTO `supplier` (`id`, `kodesupplier`, `nama`, `alamat`, `no_telepon`, `email`, `kontak_person`, `logosupplier`) VALUES
	(10, 'SUP006', 'CV. Sejahtera Makmur', 'Jl. Pahlawan No. 34, Semarang', '024-5678901', 'info@sejahteramakmur.co.id', 'Linda Susanti', NULL),
	(11, 'SUP007', 'PT. Gemilang Abadi', 'Jl. A.Yani No. 78, Palembang', '0711-234567', 'info@gemilangabadi.com', 'Ahmad Rizal', NULL),
	(12, 'SUP008', 'UD. Barokah Indah', 'Jl. Merak No. 12, Makassar', '0411-789012', 'info@barokahindah.co.id', 'Siti Rahayu', NULL),
	(13, 'SUP009', 'PT. Berkah Sukses', 'Jl. Wahid Hasyim No. 90, Samarinda', '0541-345678', 'info@berkahsukses.co.id', 'Hendri Kusuma', NULL),
	(14, 'SUP010', 'CV. Makmur Jaya', 'Jl. Gatot Subroto No. 56, Pontianak', '0561-567890', 'info@makmurjaya.co.id', 'Lina Fitriani', NULL);

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

INSERT INTO `pembelian` (`id`, `kodepembelian`, `harga_satuan`, `total_beli`, `tanggal_pembelian`, `id_supplier`, `id_bahanbaku`) VALUES
	(12, 'P001', 1222.00, 100.00, '2024-06-11', 11, 5);

