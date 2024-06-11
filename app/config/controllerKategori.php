<?php

//perintah simpan / tambah data
if(isset($_POST['tombol_simpan_kategori']) and @$_GET['aksi'] == ''){
    //melakukan proses simpan data baru
    $query_simpan = mysqli_query($koneksi, "INSERT INTO kategoribahanbaku (id, nama, deskripsi) VALUES (
        '',
        '".$_POST['inputan_nama_kategori']."',
        '".$_POST['inputan_deskripsi_kategori']."'
    ) ");

    echo "<script>alert('Operasi berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php'> ";
}

//perintah simpan ubah data kategori
if(isset($_POST['tombol_simpan_kategori']) and @$_GET['aksi'] == 'ubah_kategori'){
    //melakukan proses simpan ubah data
    $query_simpan_ubah = mysqli_query($koneksi, "UPDATE kategoribahanbaku SET 
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