<div id="dashboard" class="container tab-pane <?php echo ($_SESSION['active_tab'] == 'dashboard') ? 'active' : ''; ?>">
            <h1> Dashboard</h1>
                <div class="row">
                  <div class="col-10">
                    <?php
                    include 'table/tablePembelian.php'
                    ?>
                    
                  </div>
                  <div class="col-2">
                      <div class="card">
                          <div class="card-header bg-secondary text-white"><b>Cetak Laporan</b></div>
                          <div class="card-body">
                              <table class="table">
                                      <form action="print.php" method="post" target="new">
                                              <button name="tombol_cetak" class="btn btn-success btn-block btn-lg"> <i class="fa fa-print"></i> Cetak</button>
                                      </form>
                              </table>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="row mt-5">
                    <div class="col-5">
                      <h2>Kategori bahan baku</h2>
                      <?php include 'component/table/tableKategori.php' ?>
                    </div>
                    <div class="col-7">
                      <h2>Bahan Baku & Stok tersedia</h2>
                      <?php include 'component/table/tableBahanbaku.php' ?>
                    </div>
                </div>
                  <h2>Supplier</h2>
                  <?php include 'component/table/tableSupplier.php' ?>
</div>