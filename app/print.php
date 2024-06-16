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
		<h1>SISTEM INFORMASI PENDATAAN STOK</h1>
		
        <br>
        <h2>Laporan Pembelian Barang Periode (<?= date("d/M, Y", strtotime(date('Y-m-d'))) ?>)</h2>
		<table class="table table-bordered mt-5">
			<thead>
			    <tr>
			        <th>No.</th>
                    <th>Kode.</th>
                    <th>Bahan</th>
                    <th>total beli</th>
                    <th>harga satuan</th>
                    <th>total harga</th>
                    <th>supplier</th>
                    <th>tanggal</th>
			    </tr>
			</thead>
			<tbody>
			    <?php $no = 1; 
			    	// $SQLTampilDataJadwal = mysqli_query($koneksi, "SELECT * FROM jadwal_kuliah, dosen, mata_kuliah WHERE jadwal_kuliah.id_dosen = dosen.id_dosen AND jadwal_kuliah.id_matakuliah = mata_kuliah.id_matakuliah AND tanggal_entri BETWEEN '".$_POST['inputan_tgl_mulai']."' AND '".$_POST['inputan_tgl_selesai']."' ORDER BY id_jadwalkuliah DESC");
			    	// while($data_jadwal = mysqli_fetch_array($SQLTampilDataJadwal)) 
                    $SQLtampildatapembelian = mysqli_query($koneksi, "SELECT pembelian.*, bahanbaku.nama AS barangbeli, supplier.nama AS namasupplier 
                    FROM pembelian 
                    JOIN bahanbaku ON pembelian.id_bahanbaku = bahanbaku.id 
                    JOIN supplier ON pembelian.id_supplier = supplier.id 
                    ORDER BY pembelian.id DESC");
                    while($data_pembelian = mysqli_fetch_array($SQLtampildatapembelian)) 
                    { 
                    $totalharga = $data_pembelian['total_beli']*$data_pembelian['harga_satuan'];
                    ?>
			    <tr style="font-size: smaller;">                 
                    <td><?= $no++ ?></td>
                    <td><?= $data_pembelian['kodepembelian']?></td>
                    <td><?= $data_pembelian['barangbeli'] ?></td>
                    <td><?= $data_pembelian['total_beli'] ?></td>
                    <td><?= $data_pembelian['harga_satuan'] ?></td>
                    <td><?= $totalharga?></td>
                    <td><?= $data_pembelian['namasupplier'] ?></td>
                    <td><?= $data_pembelian['tanggal_pembelian'] ?></td>
			    </tr>
			    <?php } ?>
			</tbody>
		</table>
	</div>

	<div style="height: 20px; width: 100%; background-color: black; position: absolute; bottom: 0;"></div>
</body>
</html>
<script type="text/javascript">
	window.print();
	window.onfocus = function(){ window.close(); }
</script>