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
    echo "<meta http-equiv='refresh' content='0; url=index.php'> ";
}
//kondisi aksi
if (isset($_GET['aksi']) && $_GET['aksi'] == 'ubah_kategori' && isset($_GET['id'])) {
    $idToShow = @$data_ubah_kategori['kodekategori'];
} else {
    $idToShow = $idgenerate;
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
    echo "<meta http-equiv='refresh' content='0; url=index.php'> ";
}
//perintah hapus
if(@$_GET['aksi'] == 'hapus_kategori'){
    //melakukan proses hapus data
    $query_hapus = mysqli_query($koneksi, "DELETE FROM kategoribahanbaku where id = '".$_GET['id']."' ");
    echo "<script>alert('Hapus berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php'> ";
}
?>