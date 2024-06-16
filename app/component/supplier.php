<div id="supplier" class="container tab-pane <?php echo ($_SESSION['active_tab'] == 'supplier') ? 'active' : ''; ?>">
                    <h3>supplier</h3>
                    <p>Ini adalah menu untuk mengelola data supplier.</p>
                    <div class="col-5">
                        <div class="card">
                            <div class="card-header bg-secondary text-white"><b>Form Entri (Matakuliah)</b></div>
                            <div class="card-body">
                                <?php 
                                    if(@$_GET['aksi'] == 'ubah_supplier') { 
                                        $SQLTampilDataUbahsupplier = mysqli_query($koneksi, "SELECT * FROM supplier where id = '".$_GET['id']."' "); 
                                        $data_ubah_supplier = mysqli_fetch_array($SQLTampilDataUbahsupplier);
                                    }
                                ?>
                                 <?php
                                 include 'config/controllerSupplier.php';
                                 ?>
                                <form method="post" enctype="multipart/form-data" action="">

                                    <input class="form-control" type="hidden" name="inputan_id_supplier" value="<?= @$_GET['id'] ?>">
                                    
                                    <div class="row mb-2">
                                        <label class="col-4">Kode.</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" name="inputan_kode_supplier" required readonly value="<?php echo htmlspecialchars($idToShow); ?>">
                                        </div>
                                        <label class="col-4">Nama supplier</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" name="inputan_nama_supplier" required value="<?= @$data_ubah_supplier['nama'] ?>">
                                        </div>
                                        <label class="col-4">alamat</label>
                                        <div class="col-8">
                                        <input class="form-control" name="inputan_alamat_supplier" id="" required value="<?= @$data_ubah_supplier['alamat'] ?>">
                                        </div>
                                        <label class="col-4">Nomor Telepon</label>
                                        <div class="col-8">
                                        <input class="form-control" name="inputan_no_telepon_supplier" id="" required value="<?= @$data_ubah_supplier['no_telepon'] ?>">
                                        </div>
                                        <label class="col-4">email</label>
                                        <div class="col-8">
                                        <input class="form-control" name="inputan_email_supplier" id="" required value="<?= @$data_ubah_supplier['email'] ?>">
                                        </div>
                                        <label class="col-4">Kontak Person</label>
                                        <div class="col-8">
                                        <input class="form-control" name="inputan_kontak_person_supplier" id="" required value="<?= @$data_ubah_supplier['kontak_person'] ?>">
                                        </div>
                                        <label class="col-4">Logo Supplier</label>
                                        <div class="col-8">
                                            <input class="form-control" type="file" name="inputan_logo_supplier">
                                            <input class="form-control" type="hidden" name="nama_logo_tersimpan" value="<?= @$data_ubah_supplier['logosupllier'] ?>">
                                        </div>
                                    </div>
                                    <button name="tombol_simpan_supplier" class="btn btn-success btn-block btn-lg"> <i class="fa fa-save"></i> Simpan</button>
                                    <a href="index.php" class="btn btn-danger btn-block"><i class="fa fa-refresh fa-spin"></i> Muat Ulang</a>

                                </form>   
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <b>Tabel Data Supplier</b>
                            </div>
                            <div class="card-body">
                                <table class="table " id="tabel_data">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode.</th>
                                            <th>Nama Supplier</th>
                                            <th>Alamat</th>
                                            <th>Kontak</th>
                                            <th>Logo</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; 
                                            $SQLtampildatasupplier = mysqli_query($koneksi, "SELECT * FROM supplier ORDER BY id DESC");
                                            while($data_supplier = mysqli_fetch_array($SQLtampildatasupplier)) { ?>
                                        <tr style="font-size: smaller;">
                                            <td><?= $no++ ?></td>
                                            <td><?= $data_supplier['kodesupplier']?></td>
                                            <td><?= $data_supplier['nama'] ?></td>
                                            <td><?= $data_supplier['alamat'] ?></td>
                                            <td>
                                                nomer Telepon   : <?= $data_supplier['no_telepon'] ?><br>
                                                Email           : <?= $data_supplier['email'] ?><br>
                                                Kontak Person   : <?= $data_supplier['kontak_person'] ?><br>
                                            </td>
                                            <td>
                                                <img src="<?= 'img/'.$data_supplier['logosupplier'] ?>" height="100%" width="70px">
                                            </td>
                                            <td> 
                                                <a style="margin: 2px;" href="index.php?aksi=ubah_supplier&id=<?= $data_supplier['id'] ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                <a style="margin: 2px;" onclick="return confirm('Yakin hapus ?')" href="index.php?aksi=hapus_supplier&id=<?= $data_supplier['id'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>                   
            </div> 