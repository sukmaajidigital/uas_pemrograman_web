<div class="card">
                            <div class="card-header bg-secondary text-white">
                                <b>Tabel Data Kategori</b>
                            </div>
                            <div class="card-body">
                                <table class="table " id="tabel_data">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode.</th>
                                            <th>Kategori Barang</th>
                                            <th>Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; 
                                            $SQLtampildatakategori = mysqli_query($koneksi, "SELECT * FROM kategoribahanbaku ORDER BY id DESC");
                                            while($data_kategori = mysqli_fetch_array($SQLtampildatakategori)) { ?>
                                        <tr style="font-size: smaller;">
                                            <td><?= $no ++ ?></td>
                                            <td><?= $data_kategori['kodekategori'] ?></td>
                                            <td><?= $data_kategori['nama'] ?></td>
                                            <td><?= $data_kategori['deskripsi'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>