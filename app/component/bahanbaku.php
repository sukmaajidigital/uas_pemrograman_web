<div id="bahanbaku" class="container tab-pane <?php echo ($_SESSION['active_tab'] == 'bahanbaku') ? 'active' : ''; ?>">
            <h3>Bahan Baku</h3>
            <p>Ini adalah menu untuk mengelola data bahan baku.</p>
                    <div class="col-5">
                        <div class="card">
                            <div class="card-header bg-secondary text-white"><b>Form Entri (Matakuliah)</b></div>
                            <div class="card-body">
                                <?php 
                                    //perintah untuk menampilkan data ke form entri saat melakukan ubah data
                                    if(@$_GET['aksi'] == 'ubah_bahanbaku') { 
                                        $SQLTampilDataUbahbahanbaku = mysqli_query($koneksi, "SELECT * FROM bahanbaku where id = '".$_GET['id']."' "); 
                                        $data_ubah_bahanbaku = mysqli_fetch_array($SQLTampilDataUbahbahanbaku);
                                    }
                                ?>
                                 <?php
                                 include 'config/controllerBahanbaku.php';
                                 ?>
                                <form method="post" enctype="multipart/form-data" action="">

                                    <input class="form-control" type="hidden" name="inputan_id_bahanbaku" value="<?= @$_GET['id'] ?>">
                                    <div class="row mb-2">
                                        <label class="col-4">Kode.</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" name="inputan_kode_bahanbaku" readonly value="<?php echo htmlspecialchars($idToShow); ?>">
                                        </div>
                                        <label class="col-4">Nama bahan baku</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" name="inputan_nama_bahanbaku" required value="<?= @$data_ubah_bahanbaku['nama'] ?>">
                                        </div>
                                        <label class="col-4">Satuan</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" name="inputan_satuan_bahanbaku" required value="<?= @$data_ubah_bahanbaku['satuan'] ?>">
                                        </div>
                                        <label class="col-4">Stok</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" name="inputan_stok_tersedia_bahanbaku" required value="<?= @$data_ubah_bahanbaku['stok_tersedia'] ?>">
                                        </div>
                                        <label class="col-4">Tanggal</label>
                                        <div class="col-8">
                                            <input class="form-control" type="date" name="inputan_tanggal_ditambahkan_bahanbaku" required value="<?= @$data_ubah_bahanbaku['tanggal_ditambahkan'] ?>">
                                        </div>
                                        <label class="col-4">Kategori</label>
                                        <div class="col-8">
                                        <select class="form-control" name="inputan_kategori_bahanbaku">
                                            <?php
                                                $SQLtampilkategori = mysqli_query($koneksi, "SELECT * FROM kategoribahanbaku");
                                                while($data_kategori = mysqli_fetch_array($SQLtampilkategori)) {
                                                    $selected = ($data_kategori['id'] == @$data_ubah_bahanbaku['id_kategori']) ? 'selected' : '';
                                                    echo "<option value='".$data_kategori['id']."' $selected>".$data_kategori['nama']."</option>";
                                                }
                                            ?>
                                        </select>
                                        </div>
                                        
                                    </div>
                                    <button name="tombol_simpan_bahanbaku" class="btn btn-success btn-block btn-lg"> <i class="fa fa-save"></i> Simpan</button>
                                    <a href="index.php" class="btn btn-danger btn-block"><i class="fa fa-refresh fa-spin"></i> Muat Ulang</a>

                                </form>   
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <b>Tabel Data bahanbaku</b>
                            </div>
                            <div class="card-body">
                                <table class="table " id="tabel_data">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode.</th>
                                            <th>bahan baku</th>
                                            <th>Satuan</th>
                                            <th>Stok</th>
                                            <th>Tanggal add</th>
                                            <th>kategori</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- disini saya baru tahu queri yang diajarkan pak eko ternyata berfungsi wkwk -->
                                        <?php $no = 1; 
                                            $SQLtampildatabahanbaku = mysqli_query($koneksi, "SELECT bahanbaku.*, kategoribahanbaku.nama AS nama_kategori FROM bahanbaku 
                                            JOIN kategoribahanbaku ON bahanbaku.id_kategori = kategoribahanbaku.id 
                                            ORDER BY bahanbaku.id DESC");;
                                            while($data_bahanbaku = mysqli_fetch_array($SQLtampildatabahanbaku)) 
                                            { 
                                               
                                            ?>
                                        <tr style="font-size: smaller;">
                                            <td><?= $no++ ?></td>
                                            <td><?= $data_bahanbaku['kodebahan']?></td>
                                            <td><?= $data_bahanbaku['nama'] ?></td>
                                            <td><?= $data_bahanbaku['satuan'] ?></td>
                                            <td><?= $data_bahanbaku['stok_tersedia'] ?></td>
                                            <td><?= $data_bahanbaku['tanggal_ditambahkan'] ?></td>
                                            <td><?= $data_bahanbaku['nama_kategori'] ?></td>
                                            <td>
                                                <a style="margin: 2px;" href="index.php?aksi=ubah_bahanbaku&id=<?= $data_bahanbaku['id'] ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                <a style="margin: 2px;" onclick="return confirm('Yakin hapus ?')" href="index.php?aksi=hapus_bahanbaku&id=<?= $data_bahanbaku['id'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>                   
            </div> 