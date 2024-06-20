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
    $idToShow = @$data_ubah_pembelian['kodepembelian'];
} else {
    $idToShow = $idgenerate;
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
    // script update stok simpan tambah data
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
    echo "<meta http-equiv='refresh' content='0; url=index.php'> ";
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
    echo "<meta http-equiv='refresh' content='0; url=index.php'> ";
}
//perintah hapus
if(@$_GET['aksi'] == 'hapus_pembelian'){
    //melakukan proses hapus data
    $query_hapus = mysqli_query($koneksi, "DELETE FROM pembelian where id = '".$_GET['id']."' ");
    // script update stok hapus data
    // $id_bahanbaku = ($_POST['inputan_bahanbaku_pembelian']);
    // $SQLtampildatabahanbaku = mysqli_query($koneksi, "SELECT stok_tersedia FROM bahanbaku 
    // WHERE id='$id_bahanbaku'");
    // while($data_bahanbaku = mysqli_fetch_array($SQLtampildatabahanbaku)) 
    // $stok_tersedia = ($data_bahanbaku['stok_tersedia']) + ($_POST['inputan_total_beli_pembelian']);
    // $query_simpan_updatestok = mysqli_query($koneksi, "UPDATE bahanbaku SET 
    //     stok_tersedia = '$stok_tersedia'
    //     WHERE id = '$id_bahanbaku'
    // ");
    echo "<script>alert('Hapus berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php'> ";
}
?>
