<?php

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
                $query_simpan = mysqli_query($koneksi, "INSERT INTO supplier (id, nama, alamat, no_telepon, email, kontak_person, logosupllier) VALUES (
                    '',
                    '".$_POST['inputan_nama_supplier']."',
                    '".$_POST['inputan_alamat_supplier']."',
                    '".$_POST['inputan_no_telepon_supplier']."',
                    '".$_POST['inputan_email_supplier']."',
                    '".$_POST['inputan_kontak_person_supplier']."',
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
        $query_simpan = mysqli_query($koneksi, "INSERT INTO supplier (id, nama, alamat, no_telepon, email, kontak_person, logosupllier) VALUES (
            '',
            '".$_POST['inputan_nama_supplier']."',
            '".$_POST['inputan_alamat_supplier']."',
            '".$_POST['inputan_no_telepon_supplier']."',
            '".$_POST['inputan_email_supplier']."',
            '".$_POST['inputan_kontak_person_supplier']."',
            ''
        ) ");
        
        echo "<script>alert('Operasi berhasil')</script>";
        echo "<meta http-equiv='refresh' content='0; url=index.php'> ";
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
                unlink('img/'.$_POST['nama_foto_tersimpan']);
                //melakukan proses simpan ubah data
                $query_simpan_ubah = mysqli_query($koneksi, "UPDATE supplier SET 
                    nama = '".$_POST['inputan_nama_supplier']."',
                    alamat = '".$_POST['inputan_alamat_supplier']."',
                    no_telepon = '".$_POST['inputan_no_telepon_supplier']."',
                    email = '".$_POST['inputan_email_supplier']."',
                    kontak_person = '".$_POST['inputan_kontak_person_supplier']."',
                    logosupplier = '$nama_file_baru'
                    WHERE id = '".$_GET['id']."'
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
        $query_simpan_ubah = mysqli_query($koneksi, "UPDATE supplier SET 
            nama = '".$_POST['inputan_nama_supplier']."',
            alamat = '".$_POST['inputan_alamat_supplier']."',
            no_telepon = '".$_POST['inputan_no_telepon_supplier']."',
            email = '".$_POST['inputan_email_supplier']."',
            kontak_person = '".$_POST['inputan_kontak_person_supplier']."',
            foto_supplier = '".$_POST['nama_foto_tersimpan']."'
            WHERE id = '".$_GET['id']."'
        ");
        
        echo "<script>alert('Operasi berhasil')</script>";
        echo "<meta http-equiv='refresh' content='0; url=index.php'> ";
    }
}
?>