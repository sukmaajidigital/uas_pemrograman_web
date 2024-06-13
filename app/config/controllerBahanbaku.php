<?php

//perintah simpan / tambah data
if(isset($_POST['tombol_simpan_bahanbaku']) and @$_GET['aksi'] == ''){
    //melakukan proses simpan data baru
    $query_simpan = mysqli_query($koneksi, "INSERT INTO bahanbaku (id, nama, deskripsi) VALUES (
        '',
        '".$_POST['inputan_nama_bahanbaku']."',
        '".$_POST['inputan_deskripsi_bahanbaku']."'
    ) ");

    echo "<script>alert('Operasi berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php'> ";
}
 
//perintah simpan ubah data bahanbaku
if(isset($_POST['tombol_simpan_bahanbaku']) and @$_GET['aksi'] == 'ubah_bahanbaku'){
    //melakukan proses simpan ubah data
    $query_simpan_ubah = mysqli_query($koneksi, "UPDATE bahanbaku SET 
        nama = '".$_POST['inputan_nama_bahanbaku']."',
        deskripsi = '".$_POST['inputan_deskripsi_bahanbaku']."'
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