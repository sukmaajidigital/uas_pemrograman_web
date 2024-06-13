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
                                 <?php
                                 include 'config/controllerKategori.php';
                                 ?>
                                <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                    <input class="form-control" type="" name="inputan_id_kategori" value="<?php echo htmlspecialchars($idToShow); ?>" readonly>
                                    
                                    <div class="row mb-2">
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
                                    <a href="index.php" class="btn btn-danger btn-block"><i class="fa fa-refresh fa-spin"></i> Muat Ulang</a>

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
                                            <td><?= $data_kategori['id'] ?></td>
                                            <td><?= $data_kategori['nama'] ?></td>
                                            <td><?= $data_kategori['deskripsi'] ?></td>
                                            <td>
                                                <a style="margin: 2px;" href="index.php?aksi=ubah_kategori&id=<?= $data_kategori['id'] ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                <a style="margin: 2px;" onclick="return confirm('Yakin hapus ?')" href="index.php?aksi=hapus_kategori&id=<?= $data_kategori['id'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>                   
            </div> 