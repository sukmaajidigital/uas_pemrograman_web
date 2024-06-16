<div id="pembelian" class="container tab-pane <?php echo ($_SESSION['active_tab'] == 'pembelian') ? 'active' : ''; ?>">
            <h3>Pembelian</h3>
            <p>Ini adalah menu untuk mengelola data pembelian.</p>
            <div class="row">
                <div class="col-4">
                        <div class="card">
                            <div class="card-header bg-secondary text-white"><b>Form Entri (Matakuliah)</b></div>
                            <div class="card-body">
                                <?php 
                                    //perintah untuk menampilkan data ke form entri saat melakukan ubah data
                                    if(@$_GET['aksi'] == 'ubah_pembelian') { 
                                        $SQLTampilDataUbahpembelian = mysqli_query($koneksi, "SELECT * FROM pembelian where id = '".$_GET['id']."' "); 
                                        $data_ubah_pembelian = mysqli_fetch_array($SQLTampilDataUbahpembelian);
                                    }
                                ?>
                                 <?php
                                 include 'config/controllerpembelian.php';
                                 ?>
                                <form method="post" enctype="multipart/form-data" action="">
                                    <div class="row mb-2">
                                        <label class="col-4">Kode.</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" name="inputan_kode_pembelian" readonly value="<?php echo htmlspecialchars($idToShow);?>">
                                        </div>
                                        <!-- inputan tanggal -->
                                        <label class="col-4">Tanggal</label>
                                        <div class="col-8 mt-2">
                                            <input class="form-control" type="date" name="inputan_tanggal_pembelian" required value="<?= @$data_ubah_pembelian['tanggal_pembelian'] ?>">
                                        </div>
                                        <!-- pilihan supplier -->
                                        <label class="col-4">Supplier</label>
                                        <div class="col-8 mt-2">
                                            <select class="form-control" name="inputan_supplier_pembelian" required>
                                                <option value="">Pilih Supplier</option>
                                                <?php
                                                $query_supplier = mysqli_query($koneksi, "SELECT * FROM supplier");
                                                while ($supplier = mysqli_fetch_assoc($query_supplier)) {
                                                    $selected = ($supplier['id'] == @$data_ubah_pembelian['id_supplier']) ? 'selected' : '';
                                                    echo "<option value='".$supplier['id']."' $selected>".$supplier['nama']."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <!-- pilihan bahan baku -->
                                        <label class="col-4">Bahan Baku</label>
                                        <div class="col-8 mt-2">
                                            <select class="form-control" name="inputan_bahanbaku_pembelian" required>
                                                <option value="<?= @$data_ubah_pembelian['barangbeli'] ?>">Pilih Bahan Baku</option>
                                                <?php
                                                $query_bahan_baku = mysqli_query($koneksi, "SELECT * FROM bahanbaku");
                                                while ($bahan_baku = mysqli_fetch_assoc($query_bahan_baku)) {
                                                    $selected = ($bahan_baku['id'] == @$data_ubah_pembelian['id_bahanbaku']) ? 'selected' : '';
                                                    echo "<option value='".$bahan_baku['id']."' $selected>".$bahan_baku['nama']."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <!-- inputan harga satuan -->
                                        <label class="col-4">Harga Satuan</label>
                                        <div class="col-8 mt-2">
                                        <input class="form-control" type="number" name="inputan_harga_satuan_pembelian" required value="<?= @$data_ubah_pembelian['harga_satuan'] ?>">
                                        </div>
                                        <!-- inputan total beli -->
                                        <label class="col-4">Total Beli</label>
                                        <div class="col-8 mt-2">
                                        <input class="form-control" type="number" name="inputan_total_beli_pembelian" required value="<?= @$data_ubah_pembelian['total_beli'] ?>">
                                        </div>
                                    </div>
                                    <button name="tombol_simpan_pembelian" class="btn btn-success btn-block btn-lg"> <i class="fa fa-save"></i> Simpan</button>
                                    <a href="index.php" class="btn btn-danger btn-block"><i class="fa fa-refresh fa-spin"></i> Muat Ulang</a>
                                </form>   
                            </div>
                        </div>
                </div>
                <div class="col-4">
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <b>Tabel Data bahanbaku</b>
                            </div>
                            <div class="card-body">
                                <table class="table " id="tabel_data">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>bahan baku</th>
                                            <th>Satuan</th>
                                            <th>Stok</th>
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
                                            <td><?= $data_bahanbaku['nama'] ?></td>
                                            <td><?= $data_bahanbaku['satuan'] ?></td>
                                            <td><?= $data_bahanbaku['stok_tersedia'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                <div class="col-4">
                                <div class="card">
                                    <div class="card-header bg-secondary text-white">
                                        <b>Tabel Data Supplier</b>
                                    </div>
                                    <div class="card-body">
                                        <table class="table " id="tabel_data">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama Supplier</th>
                                                    <th>Kontak Person</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; 
                                                    $SQLtampildatasupplier = mysqli_query($koneksi, "SELECT * FROM supplier ORDER BY id DESC");
                                                    while($data_supplier = mysqli_fetch_array($SQLtampildatasupplier)) { ?>
                                                <tr style="font-size: smaller;">
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $data_supplier['nama'] ?></td>
                                                    <td><?= $data_supplier['kontak_person'] ?><br></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>  
                                    </div>
                                </div>
                </div> 
            </div>
            <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <b>Tabel Data Pembelian</b>
                            </div>
                            <div class="card-body">
                                <table class="table " id="tabel_data">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode.</th>
                                            <th>Bahan</th>
                                            <th>total beli</th>
                                            <th>harga satuan</th>
                                            <th>total harga</th>
                                            <th>supplier</th>
                                            <th>tanggal</th>
                                            <th>opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; 
                                            $SQLtampildatapembelian = mysqli_query($koneksi, "SELECT pembelian.*, bahanbaku.nama AS barangbeli, supplier.nama AS namasupplier 
                                            FROM pembelian 
                                            JOIN bahanbaku ON pembelian.id_bahanbaku = bahanbaku.id 
                                            JOIN supplier ON pembelian.id_supplier = supplier.id 
                                            ORDER BY pembelian.id DESC");
                                            while($data_pembelian = mysqli_fetch_array($SQLtampildatapembelian)) 
                                            { 
                                            $totalharga = $data_pembelian['total_beli']*$data_pembelian['harga_satuan'];
                                            ?>
                                        <tr style="font-size: smaller;">
                                            <td><?= $no++ ?></td>
                                            <td><?= $data_pembelian['kodepembelian']?></td>
                                            <td><?= $data_pembelian['barangbeli'] ?></td>
                                            <td><?= $data_pembelian['total_beli'] ?></td>
                                            <td><?= $data_pembelian['harga_satuan'] ?></td>
                                            <td><?= $totalharga?></td>
                                            <td><?= $data_pembelian['namasupplier'] ?></td>
                                            <td><?= $data_pembelian['tanggal_pembelian'] ?></td>
                                            <td>
                                                <a style="margin: 2px;" href="index.php?aksi=ubah_pembelian&id=<?= $data_pembelian['id'] ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                <a style="margin: 2px;" onclick="return confirm('Yakin hapus ?')" href="index.php?aksi=hapus_pembelian&id=<?= $data_pembelian['id'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        
                                        <?php } ?>
                                    </tbody>
                                </table>  
                            </div>
                        </div>
                </div>
                    
                                      
</div> 