<!-- membuat koneksi database -->
<?php
    include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cetak - Laporan Jadwal Kuliah</title>
	<!-- data tables css -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
</head>
<body>
	<div style="height: 20px; width: 100%; background-color: green;"></div>
	<div class="m-5">
		<h1>LAPORAN SISTEM PENDATAAN STOK BAHAN BAKU</h1>

        <h2>Laporan Pembelian Barang Periode (<?= date("d/M, Y", strtotime(date('Y-m-d'))) ?>)</h2>
		<?php
        include 'component/table/tablePembelian.php'
        ?>
		<div class="row mt-5">
			<div class="col-5">
				<h2>Kategori bahan baku</h2>
				<?php include 'component/table/tableKategori.php' ?>
			</div>
			<div class="col-7">
				<h2>Bahan Baku & Stok tersedia</h2>
				<?php include 'component/table/tableBahanbaku.php' ?>
			</div>
		</div>
		<h2>Supplier</h2>
		<?php include 'component/table/tableSupplier.php' ?>
	</div>

	<div style="height: 20px; width: 100%; background-color: black; position: absolute; bottom: 0;"></div>
</body>
</html>
<script type="text/javascript">
	window.print();
	window.onfocus = function(){ window.close(); }
</script>