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
                                        </tr>
                                        
                                        <?php } ?>
                                    </tbody>
                                </table>  
                            </div>
                        </div>