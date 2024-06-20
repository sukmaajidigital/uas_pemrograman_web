
INSERT INTO `bahanbaku` (`id`, `kodebahan`, `nama`, `satuan`, `stok_tersedia`, `tanggal_ditambahkan`, `id_kategori`) VALUES
	(4, 'BH002', 'lilin A1', 'kg', 123164.00, '2024-06-16', 35),
	(5, 'BH003', 'lilin A2', 'kg', 65.00, '2024-06-17', 35),
	(7, 'BH004', 'katun primisima', 'yard', 0.00, '2024-06-16', 34);

INSERT INTO `kategoribahanbaku` (`id`, `kodekategori`, `nama`, `deskripsi`) VALUES
	(34, 'KB001', 'kain', 'kain batik'),
	(35, 'KB002', 'lilin', 'lilin wax malam'),
	(36, 'KB003', 'canting', 'canting batik'),
	(37, 'KB004', 'warna', 'warna batik');

INSERT INTO `pembelian` (`id`, `kodepembelian`, `harga_satuan`, `total_beli`, `tanggal_pembelian`, `id_supplier`, `id_bahanbaku`) VALUES
	(29, 'P001', 123123.00, 123123.00, '2024-06-18', 10, 4),
	(30, 'P002', 11.00, 22.00, '2024-06-06', 13, 5);

INSERT INTO `supplier` (`id`, `kodesupplier`, `nama`, `alamat`, `no_telepon`, `email`, `kontak_person`, `logosupplier`) VALUES
	(10, 'SUP006', 'CV. Sejahtera Makmur', 'Jl. Pahlawan No. 34, Semarang', '024-5678901', 'info@sejahteramakmur.co.id', 'Linda Susanti', '666eff901f8c3.png'),
	(11, 'SUP007', 'PT. Gemilang Abadi', 'Jl. A.Yani No. 78, Palembang', '0711-234567', 'info@gemilangabadi.com', 'Ahmad Rizal', '666eff871f3ec.jpg'),
	(12, 'SUP008', 'UD. Barokah Indah', 'Jl. Merak No. 12, Makassar', '0411-789012', 'info@barokahindah.co.id', 'Siti Rahayu', '666eff7c2f471.jpeg'),
	(13, 'SUP009', 'PT. Berkah Sukses', 'Jl. Wahid Hasyim No. 90, Samarinda', '0541-345678', 'info@berkahsukses.co.id', 'Hendri Kusuma', '666eff65b4644.jpg'),
	(14, 'SUP010', 'CV. Makmur Jaya', 'Jl. Gatot Subroto No. 56, Pontianak', '0561-567890', 'info@makmurjaya.co.id', 'Lina Fitriani', '666eff584e3be.png');
