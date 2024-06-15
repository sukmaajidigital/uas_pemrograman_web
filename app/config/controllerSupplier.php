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
    $idToShow = @$data_ubah_supplier['kodesupplier'];
} else {
    $idToShow = $idgenerate;
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
                $query_simpan = mysqli_query($koneksi, "INSERT INTO supplier (kodesupplier, nama, alamat, no_telepon, email, kontak_person, logosupllier) VALUES (
                    '".$_POST['inputan_kode_supplier']."',
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
                $query_simpan = mysqli_query($koneksi, "INSERT INTO supplier (kodesupplier, nama, alamat, no_telepon, email, kontak_person) VALUES (
            '".$_POST['inputan_kode_supplier']."',
            '".$_POST['inputan_nama_supplier']."',
            '".$_POST['inputan_alamat_supplier']."',
            '".$_POST['inputan_no_telepon_supplier']."',
            '".$_POST['inputan_email_supplier']."',
            '".$_POST['inputan_kontak_person_supplier']."'
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
            kodesupplier = '".$_POST['inputan_kode_supplier']."',
            nama = '".$_POST['inputan_nama_supplier']."',
            alamat = '".$_POST['inputan_alamat_supplier']."',
            no_telepon = '".$_POST['inputan_no_telepon_supplier']."',
            email = '".$_POST['inputan_email_supplier']."',
            kontak_person = '".$_POST['inputan_kontak_person_supplier']."'
            WHERE id = '".$_GET['id']."'
        ");
        
        echo "<script>alert('Operasi berhasil')</script>";
        echo "<meta http-equiv='refresh' content='0; url=index.php'> ";
    }
}
//perintah hapus
if(@$_GET['aksi'] == 'hapus_supplier'){
    //melakukan proses hapus data
    $query_hapus = mysqli_query($koneksi, "DELETE FROM supplier where id = '".$_GET['id']."' ");
    echo "<script>alert('Hapus berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php'> ";
}
?>