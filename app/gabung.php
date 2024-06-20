<?php
$databaseServer='127.0.0.1';
$databaseUser='root';
$databasepass='';
$databaseName='pw_uas';

$koneksi = mysqli_connect($databaseServer,$databaseUser,$databasepass,$databaseName)
or 
die('koneksi gagal');
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendataan Stok Bahan Baku</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Komponen FontAwesome -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <!-- memasukkan/import Google Font ke halaman web-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');
    </style>

    
    <!-- Memuat Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Script PHP dan HTML seperti di atas -->

    <!-- Memuat Bootstrap JS (opsional, tergantung kebutuhan) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


</head>
<body>
    <!-- nama aplikasi -->
    <h1 style="font-family: 'Pacifico', sans-serif; color: green;" class="text-center container mt-5"> Pendataan Stok Bahan Baku</h1>
    <div class="container mt-5">
        <div class="nav">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                <a class="nav-link <?php echo ($_SESSION['active_tab'] == 'dashboard' ) ? 'active' : ''; ?>" data-toggle="tab" href="#dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php echo ($_SESSION['active_tab'] == 'pembelian') ? 'active' : ''; ?>" data-toggle="tab" href="#pembelian">Pembelian</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php echo ($_SESSION['active_tab'] == 'Kategori') ? 'active' : ''; ?>" data-toggle="tab" href="#kategori">Kategori</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php echo ($_SESSION['active_tab'] == 'bahanbaku') ? 'active' : ''; ?>" data-toggle="tab" href="#bahanbaku">bahan Baku</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php echo ($_SESSION['active_tab'] == 'supplier') ? 'active' : ''; ?>" data-toggle="tab" href="#supplier">Supplier</a>
                </li>
            </ul>
        </div>
    <div class="mt-5">
        <div class="tab-content mt-2">
        <div id="dashboard" class="container tab-pane <?php echo ($_SESSION['active_tab'] == 'dashboard') ? 'active' : ''; ?>">
            <h1> Dashboard</h1>
                <div class="row">
                  <div class="col-10">
                   
                    
                  </div>
                  <div class="col-2">
                      <div class="card">
                          <div class="card-header bg-secondary text-white"><b>Cetak Laporan</b></div>
                          <div class="card-body">
                              <table class="table">
                                      <form action="print.php" method="post" target="new">
                                              <button name="tombol_cetak" class="btn btn-success btn-block btn-lg"> <i class="fa fa-print"></i> Cetak</button>
                                      </form>
                              </table>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="row mt-5">
                    <div class="col-5">
                      <h2>Kategori bahan baku</h2>
                      <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <b>Tabel Data Kategori</b>
                            </div>
                            <div class="card-body">
                                <table class="table " id="tabel_data">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode.</th>
                                            <th>Kategori Barang</th>
                                            <th>Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; 
                                            $SQLtampildatakategori = mysqli_query($koneksi, "SELECT * FROM kategoribahanbaku ORDER BY id DESC");
                                            while($data_kategori = mysqli_fetch_array($SQLtampildatakategori)) { ?>
                                        <tr style="font-size: smaller;">
                                            <td><?= $no ++ ?></td>
                                            <td><?= $data_kategori['kodekategori'] ?></td>
                                            <td><?= $data_kategori['nama'] ?></td>
                                            <td><?= $data_kategori['deskripsi'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                      <h2>Bahan Baku & Stok tersedia</h2>
                      <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <b>Tabel Data bahanbaku</b>
                            </div>
                            <div class="card-body">
                                <table class="table " id="tabel_data">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode.</th>
                                            <th>bahan baku</th>
                                            <th>Satuan</th>
                                            <th>Stok</th>
                                            <th>Tanggal add</th>
                                            <th>kategori</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        <!-- disini saya baru tahu queri yang diajarkan pak eko ternyata berfungsi wkwk -->
                                        <?php $no = 1; 
                                            $SQLtampildatabahanbaku = mysqli_query($koneksi, "SELECT bahanbaku.*, kategoribahanbaku.nama AS nama_kategori FROM bahanbaku 
                                            JOIN kategoribahanbaku ON bahanbaku.id_kategori = kategoribahanbaku.id 
                                            ORDER BY bahanbaku.id DESC");;
                                            while($data_bahanbaku = mysqli_fetch_array($SQLtampildatabahanbaku)) 
                                            { 
                                               
                                            ?>
                                        <tr style="font-size: smaller;">
                                            <td><?= $no++ ?></td>
                                            <td><?= $data_bahanbaku['kodebahan']?></td>
                                            <td><?= $data_bahanbaku['nama'] ?></td>
                                            <td><?= $data_bahanbaku['satuan'] ?></td>
                                            <td><?= $data_bahanbaku['stok_tersedia'] ?></td>
                                            <td><?= $data_bahanbaku['tanggal_ditambahkan'] ?></td>
                                            <td><?= $data_bahanbaku['nama_kategori'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                  <h2>Supplier</h2>
                  <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <b>Tabel Data Supplier</b>
                            </div>
                            <div class="card-body">
                                <table class="table " id="tabel_data">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode.</th>
                                            <th>Nama Supplier</th>
                                            <th>Alamat</th>
                                            <th>Kontak</th>
                                            <th>Logo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; 
                                            $SQLtampildatasupplier = mysqli_query($koneksi, "SELECT * FROM supplier ORDER BY id DESC");
                                            while($data_supplier = mysqli_fetch_array($SQLtampildatasupplier)) { ?>
                                        <tr style="font-size: smaller;">
                                            <td><?= $no++ ?></td>
                                            <td><?= $data_supplier['kodesupplier']?></td>
                                            <td><?= $data_supplier['nama'] ?></td>
                                            <td><?= $data_supplier['alamat'] ?></td>
                                            <td>
                                                nomer Telepon   : <?= $data_supplier['no_telepon'] ?><br>
                                                Email           : <?= $data_supplier['email'] ?><br>
                                                Kontak Person   : <?= $data_supplier['kontak_person'] ?><br>
                                            </td>
                                            <td>
                                                <img src="<?= 'img/'.$data_supplier['logosupplier'] ?>" height="100%" width="70px">
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
</div>
<div id="pembelian" class="container tab-pane <?php echo ($_SESSION['active_tab'] == 'pembelian') ? 'active' : ''; ?>">
            <h3>Pembelian</h3>
            <p>Ini adalah menu untuk mengelola data pembelian.</p>
            <div class="row">
                <div class="col-4">
                        <div class="card">
                            <div class="card-header bg-secondary text-white"><b>Form Entri (Matakuliah)</b></div>
                            <div class="card-body">
                                <?php 
                                    //perintah untuk menampilkan data ke form entri saat melakukan ubah data
                                    if(@$_GET['aksi'] == 'ubah_pembelian') { 
                                        $SQLTampilDataUbahpembelian = mysqli_query($koneksi, "SELECT * FROM pembelian where id = '".$_GET['id']."' "); 
                                        $data_ubah_pembelian = mysqli_fetch_array($SQLTampilDataUbahpembelian);
                                    }
                                ?>

                                <form method="post" enctype="multipart/form-data" action="">
                                    <div class="row mb-2">
                                        <label class="col-4">Kode.</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" name="inputan_kode_pembelian" readonly value="<?php echo htmlspecialchars($idToShowpembelian);?>">
                                        </div>
                                        <!-- inputan tanggal -->
                                        <label class="col-4">Tanggal</label>
                                        <div class="col-8 mt-2">
                                            <input class="form-control" type="date" name="inputan_tanggal_pembelian" required value="<?= @$data_ubah_pembelian['tanggal_pembelian'] ?>">
                                        </div>
                                        <!-- pilihan supplier -->
                                        <label class="col-4">Supplier</label>
                                        <div class="col-8 mt-2">
                                            <select class="form-control" name="inputan_supplier_pembelian" required>
                                                <option value="">Pilih Supplier</option>
                                                <?php
                                                $query_supplier = mysqli_query($koneksi, "SELECT * FROM supplier");
                                                while ($supplier = mysqli_fetch_assoc($query_supplier)) {
                                                    $selected = ($supplier['id'] == @$data_ubah_pembelian['id_supplier']) ? 'selected' : '';
                                                    echo "<option value='".$supplier['id']."' $selected>".$supplier['nama']."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <!-- pilihan bahan baku -->
                                        <label class="col-4">Bahan Baku</label>
                                        <div class="col-8 mt-2">
                                            <select class="form-control" name="inputan_bahanbaku_pembelian" required>
                                                <option value="<?= @$data_ubah_pembelian['barangbeli'] ?>">Pilih Bahan Baku</option>
                                                <?php
                                                $query_bahan_baku = mysqli_query($koneksi, "SELECT * FROM bahanbaku");
                                                while ($bahan_baku = mysqli_fetch_assoc($query_bahan_baku)) {
                                                    $selected = ($bahan_baku['id'] == @$data_ubah_pembelian['id_bahanbaku']) ? 'selected' : '';
                                                    echo "<option value='".$bahan_baku['id']."' $selected>".$bahan_baku['nama']."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <!-- inputan harga satuan -->
                                        <label class="col-4">Harga Satuan</label>
                                        <div class="col-8 mt-2">
                                        <input class="form-control" type="number" name="inputan_harga_satuan_pembelian" required value="<?= @$data_ubah_pembelian['harga_satuan'] ?>">
                                        </div>
                                        <!-- inputan total beli -->
                                        <label class="col-4">Total Beli</label>
                                        <div class="col-8 mt-2">
                                        <input class="form-control" type="number" name="inputan_total_beli_pembelian" required value="<?= @$data_ubah_pembelian['total_beli'] ?>">
                                        </div>
                                    </div>
                                    <button name="tombol_simpan_pembelian" class="btn btn-success btn-block btn-lg"> <i class="fa fa-save"></i> Simpan</button>
                                    <a href="gabung.php" class="btn btn-danger btn-block"><i class="fa fa-refresh fa-spin"></i> Muat Ulang</a>
                                </form>   
                            </div>
                        </div>
                </div>
                <div class="col-4">
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <b>Tabel Data bahanbaku</b>
                            </div>
                            <div class="card-body">
                                <table class="table " id="tabel_data">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>bahan baku</th>
                                            <th>Satuan</th>
                                            <th>Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- disini saya baru tahu queri yang diajarkan pak eko ternyata berfungsi wkwk -->
                                        <?php $no = 1; 
                                            $SQLtampildatabahanbaku = mysqli_query($koneksi, "SELECT bahanbaku.*, kategoribahanbaku.nama AS nama_kategori FROM bahanbaku 
                                            JOIN kategoribahanbaku ON bahanbaku.id_kategori = kategoribahanbaku.id 
                                            ORDER BY bahanbaku.id DESC");;
                                            while($data_bahanbaku = mysqli_fetch_array($SQLtampildatabahanbaku)) 
                                            { 
                                               
                                            ?>
                                        <tr style="font-size: smaller;">
                                            <td><?= $no++ ?></td>
                                            <td><?= $data_bahanbaku['nama'] ?></td>
                                            <td><?= $data_bahanbaku['satuan'] ?></td>
                                            <td><?= $data_bahanbaku['stok_tersedia'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                <div class="col-4">
                                <div class="card">
                                    <div class="card-header bg-secondary text-white">
                                        <b>Tabel Data Supplier</b>
                                    </div>
                                    <div class="card-body">
                                        <table class="table " id="tabel_data">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama Supplier</th>
                                                    <th>Kontak Person</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; 
                                                    $SQLtampildatasupplier = mysqli_query($koneksi, "SELECT * FROM supplier ORDER BY id DESC");
                                                    while($data_supplier = mysqli_fetch_array($SQLtampildatasupplier)) { ?>
                                                <tr style="font-size: smaller;">
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $data_supplier['nama'] ?></td>
                                                    <td><?= $data_supplier['kontak_person'] ?><br></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>  
                                    </div>
                                </div>
                </div> 
            </div>
            <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <b>Tabel Data Pembelian</b>
                            </div>
                            <div class="card-body">
                                <table class="table " id="tabel_data">
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
                                            <th>opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; 
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
                                            <td>
                                                <a style="margin: 2px;" href="gabung.php?aksi=ubah_pembelian&id=<?= $data_pembelian['id'] ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                <a style="margin: 2px;" onclick="return confirm('Yakin hapus ?')" href="gabung.php?aksi=hapus_pembelian&id=<?= $data_pembelian['id'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        
                                        <?php } ?>
                                    </tbody>
                                </table>  
                            </div>
                        </div>
                </div>
                    
                                      
</div> 
<div id="kategori" class="container tab-pane <?php echo ($_SESSION['active_tab'] == 'kategori') ? 'active' : ''; ?>">
                    <h3>Kategori</h3>
                    <p>Ini adalah menu untuk mengelola data kategori.</p>
                    <div class="col-5">
                        <div class="card">
                            <div class="card-header bg-secondary text-white"><b>Form Entri (Matakuliah)</b></div>
                            <div class="card-body">
                                <?php 
                                    //perintah untuk menampilkan data ke form entri saat melakukan ubah data
                                    if(@$_GET['aksi'] == 'ubah_kategori') { 
                                        $SQLTampilDataUbahkategori = mysqli_query($koneksi, "SELECT * FROM kategoribahanbaku where id = '".$_GET['id']."' "); 
                                        $data_ubah_kategori = mysqli_fetch_array($SQLTampilDataUbahkategori);
                                        if ($SQLTampilDataUbahkategori->num_rows > 0) {
                                            $row = $SQLTampilDataUbahkategori->fetch_assoc();

                                        } else {
                                            echo "Data tidak ditemukan";
                                            exit;
                                        }
                                    }
                                     
                                ?> 
                                <!-- memanggil CRUD kategori -->
                                 

                                <form method="post" enctype="multipart/form-data" action="">
                                    
                                    <div class="row mb-2">
                                        <label class="col-4">Kode.</label>
                                        <div class="col-8"> 
                                            <input class="form-control" type="text" name="inputan_kode_kategori" readonly value="<?php echo htmlspecialchars($idToShowkategori); ?>">
                                        </div>
                                        <label class="col-4">Nama kategori</label>
                                        <div class="col-8"> 
                                            <input class="form-control" type="text" name="inputan_nama_kategori" required value="<?= @$data_ubah_kategori['nama'] ?>">
                                        </div>
                                        <label class="col-4">deskripsi</label>
                                        <div class="col-8">
                                            <textarea class="form-control" name="inputan_deskripsi_kategori" id=""><?= @$data_ubah_kategori['deskripsi'] ?></textarea>
                                        </div>
                                    </div>
                                    <button name="tombol_simpan_kategori" class="btn btn-success btn-block btn-lg"> <i class="fa fa-save"></i> Simpan</button>
                                    <a href="gabung.php" class="btn btn-danger btn-block"><i class="fa fa-refresh fa-spin"></i> Muat Ulang</a>
                                </form>   
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <b>Tabel Data Kategori</b>
                            </div>
                            <div class="card-body">
                                <table class="table " id="tabel_data">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode.</th>
                                            <th>Kategori Barang</th>
                                            <th>Deskripsi</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; 
                                            $SQLtampildatakategori = mysqli_query($koneksi, "SELECT * FROM kategoribahanbaku ORDER BY id DESC");
                                            while($data_kategori = mysqli_fetch_array($SQLtampildatakategori)) { ?>
                                        <tr style="font-size: smaller;">
                                            <td><?= $no ++ ?></td>
                                            <td><?= $data_kategori['kodekategori'] ?></td>
                                            <td><?= $data_kategori['nama'] ?></td>
                                            <td><?= $data_kategori['deskripsi'] ?></td>
                                            <td>
                                                <a style="margin: 2px;" href="gabung.php?aksi=ubah_kategori&id=<?= $data_kategori['id'] ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                <a style="margin: 2px;" onclick="return confirm('Yakin hapus ?')" href="gabung.php?aksi=hapus_kategori&id=<?= $data_kategori['id'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>                   
            </div> 
            <div id="bahanbaku" class="container tab-pane <?php echo ($_SESSION['active_tab'] == 'bahanbaku') ? 'active' : ''; ?>">
            <h3>Bahan Baku</h3>
            <p>Ini adalah menu untuk mengelola data bahan baku.</p>
                    <div class="col-5">
                        <div class="card">
                            <div class="card-header bg-secondary text-white"><b>Form Entri (Matakuliah)</b></div>
                            <div class="card-body">
                                <?php 
                                    //perintah untuk menampilkan data ke form entri saat melakukan ubah data
                                    if(@$_GET['aksi'] == 'ubah_bahanbaku') { 
                                        $SQLTampilDataUbahbahanbaku = mysqli_query($koneksi, "SELECT * FROM bahanbaku where id = '".$_GET['id']."' "); 
                                        $data_ubah_bahanbaku = mysqli_fetch_array($SQLTampilDataUbahbahanbaku);
                                    }
                                ?>
                         
                                <form method="post" enctype="multipart/form-data" action="">

                                    <input class="form-control" type="hidden" name="inputan_id_bahanbaku" value="<?= @$_GET['id'] ?>">
                                    <div class="row mb-2">
                                        <label class="col-4">Kode.</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" name="inputan_kode_bahanbaku" readonly value="<?php echo htmlspecialchars($idToShowbahanbaku); ?>">
                                        </div>
                                        <label class="col-4">Nama bahan baku</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" name="inputan_nama_bahanbaku" required value="<?= @$data_ubah_bahanbaku['nama'] ?>">
                                        </div>
                                        <label class="col-4">Satuan</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" name="inputan_satuan_bahanbaku" required value="<?= @$data_ubah_bahanbaku['satuan'] ?>">
                                        </div>
                                        <label class="col-4">Stok</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" name="inputan_stok_tersedia_bahanbaku" required value="<?= @$data_ubah_bahanbaku['stok_tersedia'] ?>">
                                        </div>
                                        <label class="col-4">Tanggal</label>
                                        <div class="col-8">
                                            <input class="form-control" type="date" name="inputan_tanggal_ditambahkan_bahanbaku" required value="<?= @$data_ubah_bahanbaku['tanggal_ditambahkan'] ?>">
                                        </div>
                                        <label class="col-4">Kategori</label>
                                        <div class="col-8">
                                        <select class="form-control" name="inputan_kategori_bahanbaku">
                                            <?php
                                                $SQLtampilkategori = mysqli_query($koneksi, "SELECT * FROM kategoribahanbaku");
                                                while($data_kategori = mysqli_fetch_array($SQLtampilkategori)) {
                                                    $selected = ($data_kategori['id'] == @$data_ubah_bahanbaku['id_kategori']) ? 'selected' : '';
                                                    echo "<option value='".$data_kategori['id']."' $selected>".$data_kategori['nama']."</option>";
                                                }
                                            ?>
                                        </select>
                                        </div>
                                        
                                    </div>
                                    <button name="tombol_simpan_bahanbaku" class="btn btn-success btn-block btn-lg"> <i class="fa fa-save"></i> Simpan</button>
                                    <a href="gabung.php" class="btn btn-danger btn-block"><i class="fa fa-refresh fa-spin"></i> Muat Ulang</a>

                                </form>   
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <b>Tabel Data bahanbaku</b>
                            </div>
                            <div class="card-body">
                                <table class="table " id="tabel_data">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode.</th>
                                            <th>bahan baku</th>
                                            <th>Satuan</th>
                                            <th>Stok</th>
                                            <th>Tanggal add</th>
                                            <th>kategori</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        <!-- disini saya baru tahu queri yang diajarkan pak eko ternyata berfungsi wkwk -->
                                        <?php $no = 1; 
                                            $SQLtampildatabahanbaku = mysqli_query($koneksi, "SELECT bahanbaku.*, kategoribahanbaku.nama AS nama_kategori FROM bahanbaku 
                                            JOIN kategoribahanbaku ON bahanbaku.id_kategori = kategoribahanbaku.id 
                                            ORDER BY bahanbaku.id DESC");;
                                            while($data_bahanbaku = mysqli_fetch_array($SQLtampildatabahanbaku)) 
                                            { 
                                               
                                            ?>
                                        <tr style="font-size: smaller;">
                                            <td><?= $no++ ?></td>
                                            <td><?= $data_bahanbaku['kodebahan']?></td>
                                            <td><?= $data_bahanbaku['nama'] ?></td>
                                            <td><?= $data_bahanbaku['satuan'] ?></td>
                                            <td><?= $data_bahanbaku['stok_tersedia'] ?></td>
                                            <td><?= $data_bahanbaku['tanggal_ditambahkan'] ?></td>
                                            <td><?= $data_bahanbaku['nama_kategori'] ?></td>
                                            <td>
                                                <a style="margin: 2px;" href="gabung.php?aksi=ubah_bahanbaku&id=<?= $data_bahanbaku['id'] ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                <a style="margin: 2px;" onclick="return confirm('Yakin hapus ?')" href="gabung.php?aksi=hapus_bahanbaku&id=<?= $data_bahanbaku['id'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>                   
            </div> 
            <div id="supplier" class="container tab-pane <?php echo ($_SESSION['active_tab'] == 'supplier') ? 'active' : ''; ?>">
                    <h3>supplier</h3>
                    <p>Ini adalah menu untuk mengelola data supplier.</p>
                    <div class="col-5">
                        <div class="card">
                            <div class="card-header bg-secondary text-white"><b>Form Entri (Matakuliah)</b></div>
                            <div class="card-body">
                                <?php 
                                    if(@$_GET['aksi'] == 'ubah_supplier') { 
                                        $SQLTampilDataUbahsupplier = mysqli_query($koneksi, "SELECT * FROM supplier where id = '".$_GET['id']."' "); 
                                        $data_ubah_supplier = mysqli_fetch_array($SQLTampilDataUbahsupplier);
                                    }
                                ?>
                                 
                                <form method="post" enctype="multipart/form-data" action="">

                                    <input class="form-control" type="hidden" name="inputan_id_supplier" value="<?= @$_GET['id'] ?>">
                                    
                                    <div class="row mb-2">
                                        <label class="col-4">Kode.</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" name="inputan_kode_supplier" required readonly value="<?php echo htmlspecialchars($idToShowsupplier); ?>">
                                        </div>
                                        <label class="col-4">Nama supplier</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" name="inputan_nama_supplier" required value="<?= @$data_ubah_supplier['nama'] ?>">
                                        </div>
                                        <label class="col-4">alamat</label>
                                        <div class="col-8">
                                        <input class="form-control" name="inputan_alamat_supplier" id="" required value="<?= @$data_ubah_supplier['alamat'] ?>">
                                        </div>
                                        <label class="col-4">Nomor Telepon</label>
                                        <div class="col-8">
                                        <input class="form-control" name="inputan_no_telepon_supplier" id="" required value="<?= @$data_ubah_supplier['no_telepon'] ?>">
                                        </div>
                                        <label class="col-4">email</label>
                                        <div class="col-8">
                                        <input class="form-control" name="inputan_email_supplier" id="" required value="<?= @$data_ubah_supplier['email'] ?>">
                                        </div>
                                        <label class="col-4">Kontak Person</label>
                                        <div class="col-8">
                                        <input class="form-control" name="inputan_kontak_person_supplier" id="" required value="<?= @$data_ubah_supplier['kontak_person'] ?>">
                                        </div>
                                        <label class="col-4">Logo Supplier</label>
                                        <div class="col-8">
                                            <input class="form-control" type="file" name="inputan_logo_supplier">
                                            <input class="form-control" type="hidden" name="nama_logo_tersimpan" value="<?= @$data_ubah_supplier['logosupllier'] ?>">
                                        </div>
                                    </div>
                                    <button name="tombol_simpan_supplier" class="btn btn-success btn-block btn-lg"> <i class="fa fa-save"></i> Simpan</button>
                                    <a href="gabung.php" class="btn btn-danger btn-block"><i class="fa fa-refresh fa-spin"></i> Muat Ulang</a>

                                </form>   
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <b>Tabel Data Supplier</b>
                            </div>
                            <div class="card-body">
                                <table class="table " id="tabel_data">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode.</th>
                                            <th>Nama Supplier</th>
                                            <th>Alamat</th>
                                            <th>Kontak</th>
                                            <th>Logo</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; 
                                            $SQLtampildatasupplier = mysqli_query($koneksi, "SELECT * FROM supplier ORDER BY id DESC");
                                            while($data_supplier = mysqli_fetch_array($SQLtampildatasupplier)) { ?>
                                        <tr style="font-size: smaller;">
                                            <td><?= $no++ ?></td>
                                            <td><?= $data_supplier['kodesupplier']?></td>
                                            <td><?= $data_supplier['nama'] ?></td>
                                            <td><?= $data_supplier['alamat'] ?></td>
                                            <td>
                                                nomer Telepon   : <?= $data_supplier['no_telepon'] ?><br>
                                                Email           : <?= $data_supplier['email'] ?><br>
                                                Kontak Person   : <?= $data_supplier['kontak_person'] ?><br>
                                            </td>
                                            <td>
                                                <img src="<?= 'img/'.$data_supplier['logosupplier'] ?>" height="100%" width="70px">
                                            </td>
                                            <td> 
                                                <a style="margin: 2px;" href="gabung.php?aksi=ubah_supplier&id=<?= $data_supplier['id'] ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                <a style="margin: 2px;" onclick="return confirm('Yakin hapus ?')" href="gabung.php?aksi=hapus_supplier&id=<?= $data_supplier['id'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>                   
            </div> 
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- fungsi Javascript / JS untuk menu tab-->
<script>
  $(document).ready(function(){
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      var target = $(e.target).attr("href") // activated tab
      sessionStorage.setItem('active_tab', target);
    });

    var activeTab = sessionStorage.getItem('active_tab');
    if(activeTab){
      $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
    }
  });
</script>
</body>
</html>

<!--=============================== BAHAN BAKU -->
<?php
function generateKodebahanbaku($koneksi) {
    // Dapatkan tanggal dan bulan saat ini
    $bulan = date('m'); // Format dua digit untuk bulan (01 - 12)
    $tanggal = date('d'); // Format dua digit untuk tanggal (01 - 31)

    // Query untuk mendapatkan id terakhir dari tabel kategoribahanbaku
    $sql = "SELECT kodebahan FROM bahanbaku ORDER BY kodebahan DESC LIMIT 1";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastKode = $row['kodebahan'];
        // Ambil 3 angka terakhir dari kode terakhir
        $lastNumber = intval(substr($lastKode, -3));
        // Tambahkan 1 ke angka terakhir untuk mendapatkan kode baru
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    } else {
        // Jika tidak ada kode sebelumnya, mulai dengan 001
        $newNumber = '001';
    }
    // Gabungkan KBB dengan bulan, tanggal, dan angka urut
    return "BH" . 
    // $bulan . 
    // $tanggal . 
    $newNumber;
}
// pendefinisian id generator
$idgenerate = generateKodebahanbaku($koneksi);
//kondisi aksi
if (isset($_GET['aksi']) && $_GET['aksi'] == 'ubah_bahanbaku' && isset($_GET['id'])) {
    $idToShowbahanbaku = @$data_ubah_bahanbaku['kodebahan'];
} else {
    $idToShowbahanbaku = $idgenerate;
}


//perintah simpan / tambah data
if(isset($_POST['tombol_simpan_bahanbaku']) and @$_GET['aksi'] == ''){
    //melakukan proses simpan data baru
    $query_simpan = mysqli_query($koneksi, "INSERT INTO bahanbaku (kodebahan, nama, satuan,stok_tersedia,tanggal_ditambahkan,id_kategori) VALUES (
        '".$_POST['inputan_kode_bahanbaku']."',
        '".$_POST['inputan_nama_bahanbaku']."',
        '".$_POST['inputan_satuan_bahanbaku']."',
        '".$_POST['inputan_stok_tersedia_bahanbaku']."',
        '".$_POST['inputan_tanggal_ditambahkan_bahanbaku']."',
        '".$_POST['inputan_kategori_bahanbaku']."'
    ) "); 

    echo "<script>alert('Operasi berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=gabung.php'> ";
}
 
//perintah simpan ubah data bahanbaku
if(isset($_POST['tombol_simpan_bahanbaku']) and @$_GET['aksi'] == 'ubah_bahanbaku'){
    //melakukan proses simpan ubah data
    $query_simpan_ubah = mysqli_query($koneksi, "UPDATE bahanbaku SET 
        kodebahan = '".$_POST['inputan_kode_bahanbaku']."',
        nama = '".$_POST['inputan_nama_bahanbaku']."',
        satuan = '".$_POST['inputan_satuan_bahanbaku']."',
        stok_tersedia = '".$_POST['inputan_stok_tersedia_bahanbaku']."',
        tanggal_ditambahkan = '".$_POST['inputan_tanggal_ditambahkan_bahanbaku']."',
        id_kategori = '".$_POST['inputan_kategori_bahanbaku']."'
        WHERE id = '".$_GET['id']."'
        ");

    echo "<script>alert('Operasi ubah data berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=gabung.php'> ";
}
//perintah hapus
if(@$_GET['aksi'] == 'hapus_bahanbaku'){
    //melakukan proses hapus data
    $query_hapus = mysqli_query($koneksi, "DELETE FROM bahanbaku where id = '".$_GET['id']."' ");

    echo "<script>alert('Hapus berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=gabung.php'> ";
}
?>
<!--=============================== KATEGORI -->
<?php
function generateKode($koneksi) {
    // Dapatkan tanggal dan bulan saat ini
    $bulan = date('m'); // Format dua digit untuk bulan (01 - 12)
    $tanggal = date('d'); // Format dua digit untuk tanggal (01 - 31)

    // Query untuk mendapatkan id terakhir dari tabel kategoribahanbaku
    $sql = "SELECT kodekategori FROM kategoribahanbaku ORDER BY kodekategori DESC LIMIT 1";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) { 
        $row = $result->fetch_assoc();
        $lastKode = $row['kodekategori'];
        // Ambil 3 angka terakhir dari kode terakhir
        $lastNumber = intval(substr($lastKode, -3));
        // Tambahkan 1 ke angka terakhir untuk mendapatkan kode baru
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    } else {
        // Jika tidak ada kode sebelumnya, mulai dengan 001
        $newNumber = '001';
    }
    // Gabungkan KBB dengan bulan, tanggal, dan angka urut
    return "KB" . 
    // $bulan . 
    // $tanggal . 
    $newNumber;
}
// pendefinisian id generator
$idgenerate = generateKode($koneksi);
if(isset($_POST['tombol_simpan_kategori']) && @$_GET['aksi'] == ''){
    //melakukan proses simpan data baru
    $query_simpan = mysqli_query($koneksi, "INSERT INTO kategoribahanbaku (kodekategori, nama, deskripsi) VALUES (
        '".$_POST['inputan_kode_kategori']."',
        '".$_POST['inputan_nama_kategori']."',
        '".$_POST['inputan_deskripsi_kategori']."'
    ) ");

    // echo "<script>alert('Operasi berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=gabung.php'> ";
}
//kondisi aksi
if (isset($_GET['aksi']) && $_GET['aksi'] == 'ubah_kategori' && isset($_GET['id'])) {
    $idToShowkategori = @$data_ubah_kategori['kodekategori'];
} else {
    $idToShowkategori = $idgenerate;
}
//perintah simpan ubah data kategori
if(isset($_POST['tombol_simpan_kategori']) && @$_GET['aksi'] == 'ubah_kategori'){
    //melakukan proses simpan ubah data
    $query_simpan_ubah = mysqli_query($koneksi, "UPDATE kategoribahanbaku SET 
        kodekategori = '".$_POST['inputan_kode_kategori']."',
        nama = '".$_POST['inputan_nama_kategori']."',
        deskripsi = '".$_POST['inputan_deskripsi_kategori']."'
        WHERE id = '".$_GET['id']."'
        ");
    echo "<script>alert('Operasi ubah data berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=gabung.php'> ";
}
//perintah hapus
if(@$_GET['aksi'] == 'hapus_kategori'){
    //melakukan proses hapus data
    $query_hapus = mysqli_query($koneksi, "DELETE FROM kategoribahanbaku where id = '".$_GET['id']."' ");
    echo "<script>alert('Hapus berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=gabung.php'> ";
}
?>
<!--=============================== PEMBELIAN -->
<?php
function generateKodepembelian($koneksi) {
    // Dapatkan tanggal dan bulan saat ini
    $bulan = date('m'); // Format dua digit untuk bulan (01 - 12)
    $tanggal = date('d'); // Format dua digit untuk tanggal (01 - 31)
    // Query untuk mendapatkan id terakhir dari tabel kategoripembelian
    $sql = "SELECT kodepembelian FROM pembelian ORDER BY kodepembelian DESC LIMIT 1";
    $result = $koneksi->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastKode = $row['kodepembelian'];
        // Ambil 3 angka terakhir dari kode terakhir
        $lastNumber = intval(substr($lastKode, -3));
        // Tambahkan 1 ke angka terakhir untuk mendapatkan kode baru
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    } else {
        // Jika tidak ada kode sebelumnya, mulai dengan 001
        $newNumber = '001';
    }
    // Gabungkan KBB dengan bulan, tanggal, dan angka urut
    return "P" . 
    // $bulan . 
    // $tanggal . 
    $newNumber;
}
// pendefinisian id generator
$idgenerate = generateKodepembelian($koneksi);
//kondisi aksi
if (isset($_GET['aksi']) && $_GET['aksi'] == 'ubah_pembelian' && isset($_GET['id'])) {
    $idToShowpembelian = @$data_ubah_pembelian['kodepembelian'];
} else {
    $idToShowpembelian = $idgenerate;
}
//perintah simpan / tambah data
if(isset($_POST['tombol_simpan_pembelian']) and @$_GET['aksi'] == ''){
    //melakukan proses simpan data baru
    $query_simpan = mysqli_query($koneksi, "INSERT INTO pembelian (kodepembelian, harga_satuan, total_beli, tanggal_pembelian, id_supplier, id_bahanbaku) VALUES (
        '".$_POST['inputan_kode_pembelian']."',
        '".$_POST['inputan_harga_satuan_pembelian']."',
        '".$_POST['inputan_total_beli_pembelian']."',
        '".$_POST['inputan_tanggal_pembelian']."',
        '".$_POST['inputan_supplier_pembelian']."',
        '".$_POST['inputan_bahanbaku_pembelian']."'
    ) ");
    echo "<script>alert('update data pembelian berhasil')</script>";
    // script update stok
    $id_bahanbaku = ($_POST['inputan_bahanbaku_pembelian']);
    $SQLtampildatabahanbaku = mysqli_query($koneksi, "SELECT stok_tersedia FROM bahanbaku 
    WHERE id='$id_bahanbaku'");
    while($data_bahanbaku = mysqli_fetch_array($SQLtampildatabahanbaku)) 
    $stok_tersedia = ($data_bahanbaku['stok_tersedia']) + ($_POST['inputan_total_beli_pembelian']);
    $query_simpan_updatestok = mysqli_query($koneksi, "UPDATE bahanbaku SET 
        stok_tersedia = '$stok_tersedia'
        WHERE id = '$id_bahanbaku'
    ");
    echo "<script>alert('Update stok berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=gabung.php'> ";
}
 
//perintah simpan ubah data pembelian
if(isset($_POST['tombol_simpan_pembelian']) and @$_GET['aksi'] == 'ubah_pembelian'){
    //melakukan proses simpan ubah data
    $query_simpan_ubah = mysqli_query($koneksi, "UPDATE pembelian SET 
        kodepembelian ='".$_POST['inputan_kode_pembelian']."',
        harga_satuan = '".$_POST['inputan_harga_satuan_pembelian']."',
        total_beli = '".$_POST['inputan_total_beli_pembelian']."',
        tanggal_pembelian = '".$_POST['inputan_tanggal_pembelian']."',
        id_supplier = '".$_POST['inputan_supplier_pembelian']."',
        id_bahanbaku = '".$_POST['inputan_bahanbaku_pembelian']."'
        WHERE id = '".$_GET['id']."'
        ");

    echo "<script>alert('Operasi ubah data berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=gabung.php'> ";
}
//perintah hapus
if(@$_GET['aksi'] == 'hapus_pembelian'){
    //melakukan proses hapus data
    $query_hapus = mysqli_query($koneksi, "DELETE FROM pembelian where id = '".$_GET['id']."' ");

    echo "<script>alert('Hapus berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=gabung.php'> ";
}
?>

<!--=============================== SUPPLIER -->
<?php

function generateKodesupplier($koneksi) {
    // Dapatkan tanggal dan bulan saat ini
    $bulan = date('m'); // Format dua digit untuk bulan (01 - 12)
    $tanggal = date('d'); // Format dua digit untuk tanggal (01 - 31)

    // Query untuk mendapatkan id terakhir dari tabel kategoribahanbaku
    $sql = "SELECT kodesupplier FROM supplier ORDER BY kodesupplier DESC LIMIT 1";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastKode = $row['kodesupplier'];
        // Ambil 3 angka terakhir dari kode terakhir
        $lastNumber = intval(substr($lastKode, -3));
        // Tambahkan 1 ke angka terakhir untuk mendapatkan kode baru
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    } else {
        // Jika tidak ada kode sebelumnya, mulai dengan 001
        $newNumber = '001';
    }
    // Gabungkan KBB dengan bulan, tanggal, dan angka urut
    return "SUP" . 
    // $bulan . 
    // $tanggal . 
    $newNumber;
}
// pendefinisian id generator
$idgenerate = generateKodesupplier($koneksi);
//kondisi aksi
if (isset($_GET['aksi']) && $_GET['aksi'] == 'ubah_supplier' && isset($_GET['id'])) {
    $idToShowsupplier = @$data_ubah_supplier['kodesupplier'];
} else {
    $idToShowsupplier = $idgenerate;
}

// simpan data
if(isset($_POST['tombol_simpan_supplier']) and @$_GET['aksi'] == ''){
    //periksa apakah file diunggah tanpa kesalahan
    if(isset($_FILES["inputan_logo_supplier"]) && $_FILES["inputan_logo_supplier"]["error"] == 0){
        $batas_ekstensi_file = array("jpg", "jpeg", "png");
        $file_pilihan = pathinfo($_FILES["inputan_logo_supplier"]["name"], PATHINFO_EXTENSION);

        //periksa ekstensi file yang di izinkan upload
        if(in_array($file_pilihan, $batas_ekstensi_file)){
            //menentukan tempat menyimpan file
            $folder_simpan = "img/";

            //me-rename file supaya tidak ada nama file yang sama
            $nama_file_baru = uniqid().'.'.$file_pilihan;
            $target_file = $folder_simpan.$nama_file_baru;

            //memindahkan file yang diunggah ke lokasi yang ditentukan & melakukan proses simpan data baru
            if(move_uploaded_file($_FILES["inputan_logo_supplier"]["tmp_name"], $target_file)){
                $query_simpan = mysqli_query($koneksi, "INSERT INTO supplier (kodesupplier, nama, alamat, no_telepon, email, kontak_person, logosupplier) VALUES (
                    '".$_POST['inputan_kode_supplier']."',
                    '".$_POST['inputan_nama_supplier']."',
                    '".$_POST['inputan_alamat_supplier']."',
                    '".$_POST['inputan_no_telepon_supplier']."',
                    '".$_POST['inputan_email_supplier']."',
                    '".$_POST['inputan_kontak_person_supplier']."',
                    '$nama_file_baru'
                    ) ");

                echo "<script>alert('Operasi berhasil.')</script>";
                echo "<meta http-equiv='refresh' content='0; url=gabung.php'> ";

            } else {
                echo "<script>alert('Maaf, terjadi kesalahan saat mengunggah file.')</script>";
            }
        } else {
            echo "<script>alert('Maaf, hanya file JPG, JPEG, dan PNG yang diperbolehkan.')</script>";
        }
    } else {
        //melakukan proses simpan data baru
                $query_simpan = mysqli_query($koneksi, "INSERT INTO supplier (kodesupplier, nama, alamat, no_telepon, email, kontak_person) VALUES (
            '".$_POST['inputan_kode_supplier']."',
            '".$_POST['inputan_nama_supplier']."',
            '".$_POST['inputan_alamat_supplier']."',
            '".$_POST['inputan_no_telepon_supplier']."',
            '".$_POST['inputan_email_supplier']."',
            '".$_POST['inputan_kontak_person_supplier']."'
        ) ");
        
        echo "<script>alert('Operasi berhasil')</script>";
        echo "<meta http-equiv='refresh' content='0; url=gabung.php'> ";
    }

}

//perintah simpan ubah data
if(isset($_POST['tombol_simpan_supplier']) and @$_GET['aksi'] == 'ubah_supplier'){
    //periksa apakah file diunggah tanpa kesalahan
    if(isset($_FILES["inputan_logo_supplier"]) && $_FILES["inputan_logo_supplier"]["error"] == 0){
        $batas_ekstensi_file = array("jpg", "jpeg", "png");
        $file_pilihan = pathinfo($_FILES["inputan_logo_supplier"]["name"], PATHINFO_EXTENSION);

        //periksa ekstensi file yang di izinkan upload
        if(in_array($file_pilihan, $batas_ekstensi_file)){
            //menentukan tempat menyimpan file
            $folder_simpan = "img/";

            //me-rename file supaya tidak ada nama file yang sama
            $nama_file_baru = uniqid().'.'.$file_pilihan;
            $target_file = $folder_simpan.$nama_file_baru;

            //memindahkan file yang diunggah ke lokasi yang ditentukan & melakukan proses simpan data baru
            if(move_uploaded_file($_FILES["inputan_logo_supplier"]["tmp_name"], $target_file)){
                //menghapus file/gambar yang tersimpan di direktori/folder
                unlink('img/'.$_POST['nama_logo_tersimpan']);
                //melakukan proses simpan ubah data
                $query_simpan_ubah = mysqli_query($koneksi, "UPDATE supplier SET 
                    kodesupplier = '".$_POST['inputan_kode_supplier']."',
                    nama = '".$_POST['inputan_nama_supplier']."',
                    alamat = '".$_POST['inputan_alamat_supplier']."',
                    no_telepon = '".$_POST['inputan_no_telepon_supplier']."',
                    email = '".$_POST['inputan_email_supplier']."',
                    kontak_person = '".$_POST['inputan_kontak_person_supplier']."',
                    logosupplier = '$nama_file_baru'
                    WHERE id = '".$_GET['id']."'
                    ");

                echo "<script>alert('Operasi berhasil.')</script>";
                echo "<meta http-equiv='refresh' content='0; url=gabung.php'> ";

            } else {
                echo "<script>alert('Maaf, terjadi kesalahan saat mengunggah file.')</script>";
            }
        } else {
            echo "<script>alert('Maaf, hanya file JPG, JPEG, dan PNG yang diperbolehkan.')</script>";
        }
    } else {
        //melakukan proses simpan ubah data
        $query_simpan_ubah = mysqli_query($koneksi, "UPDATE supplier SET 
            kodesupplier = '".$_POST['inputan_kode_supplier']."',
            nama = '".$_POST['inputan_nama_supplier']."',
            alamat = '".$_POST['inputan_alamat_supplier']."',
            no_telepon = '".$_POST['inputan_no_telepon_supplier']."',
            email = '".$_POST['inputan_email_supplier']."',
            kontak_person = '".$_POST['inputan_kontak_person_supplier']."'
            WHERE id = '".$_GET['id']."'
        ");
        
        echo "<script>alert('Operasi berhasil')</script>";
        echo "<meta http-equiv='refresh' content='0; url=gabung.php'> ";
    }
}
//perintah hapus
if(@$_GET['aksi'] == 'hapus_supplier'){
    //melakukan proses hapus data
    $query_hapus = mysqli_query($koneksi, "DELETE FROM supplier where id = '".$_GET['id']."' ");
    echo "<script>alert('Hapus berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=gabung.php'> ";
}
?>