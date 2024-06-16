<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'pw_uas') or die('koneksi gagal');
include 'config/controllerKategori.php';
if (isset($_POST['tombol_simpan_pembelian'])) {
    $query_simpan = mysqli_query($koneksi, "INSERT INTO pembelian (kodepembelian,id_supplier, tanggal_pembelian, total_harga) VALUES (
        '$idgenerate',
        '".$_POST['id_supplier']."',
        '".$_POST['tanggal_pembelian']."',
        '".$_POST['total_harga']."'
    )");

    $last_id_pembelian = mysqli_insert_id($koneksi);

    echo "<script>alert('Pembelian berhasil disimpan')</script>";
    echo "<meta http-equiv='refresh' content='0; url=cobapembelian.php?id_pembelian=$last_id_pembelian'>";
}

if (isset($_POST['tombol_simpan_detailpembelian'])) {
    $query_simpan_detail = mysqli_query($koneksi, "INSERT INTO detailpembelian (kodedetail,id_pembelian, id_bahan_baku, jumlah, harga_per_satuan, sub_total) VALUES (
        '$idgenerate',
        '".$_POST['id_pembelian']."',
        '".$_POST['id_bahan_baku']."',
        '".$_POST['jumlah']."',
        '".$_POST['harga_per_satuan']."',
        '".$_POST['subtotal']."'
    )");

    echo "<script>alert('Detail Pembelian berhasil disimpan')</script>";
    echo "<meta http-equiv='refresh' content='0; url=cobapembelian.php?id_pembelian=".$_POST['id_pembelian']."'>";
}

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus_pembelian') {
    $query_hapus = mysqli_query($koneksi, "DELETE FROM pembelian WHERE id = '".$_GET['id']."'");
    echo "<script>alert('Pembelian berhasil dihapus')</script>";
    echo "<meta http-equiv='refresh' content='0; url=cobapembelian.php'>";
}

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus_detailpembelian') {
    $query_hapus_detail = mysqli_query($koneksi, "DELETE FROM detailpembelian WHERE id = '".$_GET['id']."'");
    echo "<script>alert('Detail Pembelian berhasil dihapus')</script>";
    echo "<meta http-equiv='refresh' content='0; url=cobapembelian.php?id_pembelian=".$_GET['id_pembelian']."'>";
}
?>

<div id="menu1" class="container tab-pane <?php echo ($_SESSION['active_tab'] == 'pembelian') ? 'active' : ''; ?>">
    <h3>Menu Master Data Pembelian</h3>
    <p>Ini adalah menu untuk mengelola data pembelian.</p>
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-header bg-secondary text-white"><b>Form Entri Pembelian</b></div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="">
                        <div class="row mb-2">
                            <label class="col-4">Supplier</label>
                            <div class="col-8">
                                <select class="form-control" name="id_supplier" required>
                                    <option value="">Pilih Supplier</option>
                                    <?php
                                    $query_supplier = mysqli_query($koneksi, "SELECT * FROM supplier");
                                    while ($supplier = mysqli_fetch_assoc($query_supplier)) {
                                        echo '<option value="'.$supplier['id'].'">'.$supplier['nama'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-4">Tanggal Pembelian</label>
                            <div class="col-8">
                                <input class="form-control" type="date" name="tanggal_pembelian" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-4">Total Harga</label>
                            <div class="col-8">
                                <input class="form-control" type="number" name="total_harga" required>
                            </div>
                        </div>
                        <button name="tombol_simpan_pembelian" class="btn btn-success btn-block btn-lg">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="cobapembelian.php" class="btn btn-danger btn-block">
                            <i class="fa fa-refresh fa-spin"></i> Muat Ulang
                        </a>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-7">
            <div class="card">
                <div class="card-header bg-secondary text-white"><b>Tabel Data Pembelian</b></div>
                <div class="card-body">
                    <table class="table table-bordered" id="tabel_data">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Supplier</th>
                                <th>Tanggal Pembelian</th>
                                <th>Total Harga</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query_pembelian = mysqli_query($koneksi, "SELECT pembelian.*, supplier.nama FROM pembelian JOIN supplier ON pembelian.id_supplier = supplier.id ORDER BY pembelian.id DESC");
                            while ($data_pembelian = mysqli_fetch_assoc($query_pembelian)) {
                                echo '<tr>
                                    <td>'.$no++.'</td>
                                    <td>'.$data_pembelian['nama'].'</td>
                                    <td>'.$data_pembelian['tanggal_pembelian'].'</td>
                                    <td>'.$data_pembelian['total_harga'].'</td>
                                    <td>
                                        <a href="cobapembelian.php?id_pembelian='.$data_pembelian['id'].'" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="cobapembelian.php?aksi=hapus_pembelian&id='.$data_pembelian['id'].'" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin hapus ?\')"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_GET['id_pembelian'])) { ?>
<div class="container mt-4">
    <h3>Detail Pembelian</h3>
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-header bg-secondary text-white"><b>Form Entri Detail Pembelian</b></div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="">
                        <input type="hidden" name="id_pembelian" value="<?php echo $_GET['id_pembelian']; ?>">
                        <div class="row mb-2">
                            <label class="col-4">Bahan Baku</label>
                            <div class="col-8">
                                <select class="form-control" name="id_bahan_baku" required>
                                    <option value="">Pilih Bahan Baku</option>
                                    <?php
                                    $query_bahan_baku = mysqli_query($koneksi, "SELECT * FROM bahanbaku");
                                    while ($bahan_baku = mysqli_fetch_assoc($query_bahan_baku)) {
                                        echo '<option value="'.$bahan_baku['id'].'">'.$bahan_baku['nama'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-4">Jumlah</label>
                            <div class="col-8">
                                <input class="form-control" type="number" name="jumlah" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-4">Harga per Satuan</label>
                            <div class="col-8">
                                <input class="form-control" type="number" name="harga_per_satuan" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-4">Subtotal</label>
                            <div class="col-8">
                                <input class="form-control" type="number" name="subtotal" required>
                            </div>
                        </div>
                        <button name="tombol_simpan_detailpembelian" class="btn btn-success btn-block btn-lg">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="cobapembelian.php?id_pembelian=<?php echo $_GET['id_pembelian']; ?>" class="btn btn-danger btn-block">
                            <i class="fa fa-refresh fa-spin"></i> Muat Ulang
                        </a>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-7">
            <div class="card">
                <div class="card-header bg-secondary text-white"><b>Tabel Detail Pembelian</b></div>
                <div class="card-body">
                    <table class="table table-bordered" id="tabel_data">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Bahan Baku</th>
                                <th>Jumlah</th>
                                <th>Harga per Satuan</th>
                                <th>Subtotal</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query_detailpembelian = mysqli_query($koneksi, "SELECT detailpembelian.*, bahanbaku.nama FROM detailpembelian JOIN bahanbaku ON detailpembelian.id_bahan_baku = bahanbaku.id WHERE detailpembelian.id_pembelian = '".$_GET['id_pembelian']."' ORDER BY detailpembelian.id DESC");
                            while ($data_detailpembelian = mysqli_fetch_assoc($query_detailpembelian)) {
                                echo '<tr>
                                    <td>'.$no++.'</td>
                                    <td>'.$data_detailpembelian['nama_bahan_baku'].'</td>
                                    <td>'.$data_detailpembelian['jumlah'].'</td>
                                    <td>'.$data_detailpembelian['harga_per_satuan'].'</td>
                                    <td>'.$data_detailpembelian['sub_total'].'</td>
                                    <td>
                                        <a href="cobapembelian.php?aksi=hapus_detailpembelian&id='.$data_detailpembelian['id'].'&id_pembelian='.$_GET['id_pembelian'].'" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin hapus ?\')"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
