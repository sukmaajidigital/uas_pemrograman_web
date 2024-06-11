<?php
    include 'config.php';  
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
</head>
<body>
    <!-- nama aplikasi -->
    <h1 style="font-family: 'Pacifico', sans-serif; color: green;" class="text-center container mt-5"> Pendataan Stok Bahan Baku</h1>
    <div class="container mt-5">
        <div class="nav">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                <a class="nav-link <?php echo ($_SESSION['active_tab'] == 'Dashboard' || !isset($_SESSION['active_tab'])) ? 'active' : ''; ?>" data-toggle="tab" href="#dashboard">Dashboard</a>
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
    <div class="container mt-5">
        <div class="tab-content mt-2">
            <!-- Dashboaard -->
            <?php include 'component/dashboard.php';?>
            <?php include 'component/kategori.php';?>
            <?php include 'component/bahanbaku.php';?>
            <?php include 'component/supplier.php';?>
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
<footer>
</footer>
</html>

<?php 


//========================================================================================= DOSEN
//perintah simpan / tambah data
if(isset($_POST['tombol_simpan_dosen']) and @$_GET['aksi'] == ''){
    //periksa apakah file diunggah tanpa kesalahan
    if(isset($_FILES["inputan_foto_dosen"]) && $_FILES["inputan_foto_dosen"]["error"] == 0){
        $batas_ekstensi_file = array("jpg", "jpeg", "png");
        $file_pilihan = pathinfo($_FILES["inputan_foto_dosen"]["name"], PATHINFO_EXTENSION);

        //periksa ekstensi file yang di izinkan upload
        if(in_array($file_pilihan, $batas_ekstensi_file)){
            //menentukan tempat menyimpan file
            $folder_simpan = "unggahan_foto/";

            //me-rename file supaya tidak ada nama file yang sama
            $nama_file_baru = uniqid().'.'.$file_pilihan;
            $target_file = $folder_simpan.$nama_file_baru;

            //memindahkan file yang diunggah ke lokasi yang ditentukan & melakukan proses simpan data baru
            if(move_uploaded_file($_FILES["inputan_foto_dosen"]["tmp_name"], $target_file)){
                $query_simpan = mysqli_query($koneksi, "INSERT INTO dosen (id_dosen, nidn_dosen, nama_dosen, jk_dosen, alamat_dosen, foto_dosen) VALUES (
                    '',
                    '".$_POST['inputan_nidn_dosen']."',
                    '".$_POST['inputan_nama_dosen']."',
                    '".$_POST['inputan_jk_dosen']."',
                    '".$_POST['inputan_alamat_dosen']."',
                    '$nama_file_baru'
                    ) ");

                echo "<script>alert('Operasi berhasil.')</script>";
                echo "<meta http-equiv='refresh' content='0; url=index.php'> ";

            } else {
                echo "<script>alert('Maaf, terjadi kesalahan saat mengunggah file.')</script>";
            }
        } else {
            echo "<script>alert('Maaf, hanya file JPG, JPEG, dan PNG yang diperbolehkan.')</script>";
        }
    } else {
        //melakukan proses simpan data baru
        $query_simpan = mysqli_query($koneksi, "INSERT INTO dosen (id_dosen, nidn_dosen, nama_dosen, jk_dosen, alamat_dosen, foto_dosen) VALUES (
            '',
            '".$_POST['inputan_nidn_dosen']."',
            '".$_POST['inputan_nama_dosen']."',
            '".$_POST['inputan_jk_dosen']."',
            '".$_POST['inputan_alamat_dosen']."',
            ''
        ) ");
        
        echo "<script>alert('Operasi berhasil')</script>";
        echo "<meta http-equiv='refresh' content='0; url=index.php'> ";
    }

}

//perintah simpan ubah data
if(isset($_POST['tombol_simpan_dosen']) and @$_GET['aksi'] == 'ubah_dosen'){
    //periksa apakah file diunggah tanpa kesalahan
    if(isset($_FILES["inputan_foto_dosen"]) && $_FILES["inputan_foto_dosen"]["error"] == 0){
        $batas_ekstensi_file = array("jpg", "jpeg", "png");
        $file_pilihan = pathinfo($_FILES["inputan_foto_dosen"]["name"], PATHINFO_EXTENSION);

        //periksa ekstensi file yang di izinkan upload
        if(in_array($file_pilihan, $batas_ekstensi_file)){
            //menentukan tempat menyimpan file
            $folder_simpan = "unggahan_foto/";

            //me-rename file supaya tidak ada nama file yang sama
            $nama_file_baru = uniqid().'.'.$file_pilihan;
            $target_file = $folder_simpan.$nama_file_baru;

            //memindahkan file yang diunggah ke lokasi yang ditentukan & melakukan proses simpan data baru
            if(move_uploaded_file($_FILES["inputan_foto_dosen"]["tmp_name"], $target_file)){
                //menghapus file/gambar yang tersimpan di direktori/folder
                unlink('unggahan_foto/'.$_POST['nama_foto_tersimpan']);
                //melakukan proses simpan ubah data
                $query_simpan_ubah = mysqli_query($koneksi, "UPDATE dosen SET 
                    nidn_dosen = '".$_POST['inputan_nidn_dosen']."',
                    nama_dosen = '".$_POST['inputan_nama_dosen']."',
                    jk_dosen = '".$_POST['inputan_jk_dosen']."',
                    alamat_dosen = '".$_POST['inputan_alamat_dosen']."',
                    foto_dosen = '$nama_file_baru'
                    WHERE id_dosen = '".$_GET['id_dosen']."'
                    ");

                echo "<script>alert('Operasi berhasil.')</script>";
                echo "<meta http-equiv='refresh' content='0; url=index.php'> ";

            } else {
                echo "<script>alert('Maaf, terjadi kesalahan saat mengunggah file.')</script>";
            }
        } else {
            echo "<script>alert('Maaf, hanya file JPG, JPEG, dan PNG yang diperbolehkan.')</script>";
        }
    } else {
        //melakukan proses simpan ubah data
        $query_simpan_ubah = mysqli_query($koneksi, "UPDATE dosen SET 
            nidn_dosen = '".$_POST['inputan_nidn_dosen']."',
            nama_dosen = '".$_POST['inputan_nama_dosen']."',
            jk_dosen = '".$_POST['inputan_jk_dosen']."',
            alamat_dosen = '".$_POST['inputan_alamat_dosen']."',
            foto_dosen = '".$_POST['nama_foto_tersimpan']."'
            WHERE id_dosen = '".$_GET['id_dosen']."'
        ");
        
        echo "<script>alert('Operasi berhasil')</script>";
        echo "<meta http-equiv='refresh' content='0; url=index.php'> ";
    }
}

//perintah hapus
if(@$_GET['aksi'] == 'hapus_dosen'){
    //melakukan proses hapus data
    $query_hapus = mysqli_query($koneksi, "DELETE FROM dosen where id_dosen = '".$_GET['id_dosen']."' ");
    //menghapus file/gambar yang tersimpan di direktori/folder
    unlink('unggahan_foto/'.$_GET['vfoto_dosen']);

    echo "<script>alert('Hapus berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php'> ";
}
?>