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
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>