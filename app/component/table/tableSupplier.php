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
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>