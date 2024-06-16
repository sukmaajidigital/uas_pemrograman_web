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
    $idToShow = @$data_ubah_bahanbaku['kodebahan'];
} else {
    $idToShow = $idgenerate;
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
    echo "<meta http-equiv='refresh' content='0; url=index.php'> ";
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
    echo "<meta http-equiv='refresh' content='0; url=index.php'> ";
}
//perintah hapus
if(@$_GET['aksi'] == 'hapus_bahanbaku'){
    //melakukan proses hapus data
    $query_hapus = mysqli_query($koneksi, "DELETE FROM bahanbaku where id = '".$_GET['id']."' ");

    echo "<script>alert('Hapus berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php'> ";
}
?>