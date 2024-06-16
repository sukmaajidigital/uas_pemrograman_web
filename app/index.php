<?php
    include 'config.php';  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendataan Stok Bahan Baku</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Komponen FontAwesome -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <!-- memasukkan/import Google Font ke halaman web-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');
    </style>

    
    <!-- Memuat Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Script PHP dan HTML seperti di atas -->

    <!-- Memuat Bootstrap JS (opsional, tergantung kebutuhan) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


</head>
<body>
    <!-- nama aplikasi -->
    <h1 style="font-family: 'Pacifico', sans-serif; color: green;" class="text-center container mt-5"> Pendataan Stok Bahan Baku</h1>
    <div class="container mt-5">
        <div class="nav">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                <a class="nav-link <?php echo ($_SESSION['active_tab'] == 'dashboard' || !isset($_SESSION['active_tab'])) ? 'active' : ''; ?>" data-toggle="tab" href="#dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php echo ($_SESSION['active_tab'] == 'pembelian') ? 'active' : ''; ?>" data-toggle="tab" href="#pembelian">Pembelian</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php echo ($_SESSION['active_tab'] == 'Kategori') ? 'active' : ''; ?>" data-toggle="tab" href="#kategori">Kategori</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php echo ($_SESSION['active_tab'] == 'bahanbaku') ? 'active' : ''; ?>" data-toggle="tab" href="#bahanbaku">bahan Baku</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php echo ($_SESSION['active_tab'] == 'supplier') ? 'active' : ''; ?>" data-toggle="tab" href="#supplier">Supplier</a>
                </li>
            </ul>
        </div>
    <div class="mt-5">
        <div class="tab-content mt-2">
            <!-- menu -->
            <div id="dashboard" class="container tab-pane <?php echo ($_SESSION['active_tab'] == 'dashboard') ? 'active' : ''; ?>">
            <h1> Dashboard</h1>
              <h3>Halaman Laporan</h3>
                <p>Ini adalah halaman untuk mencetak laporan jadwal kuliah.</p>
                <div class="row">
                  <!-- konten form data dosen -->
                  <div class="col-12">
                      <div class="card">
                          <div class="card-header bg-secondary text-white"><b>Pilihan Laporan</b></div>
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
            </div>
            <?php include 'component/pembelian.php';?>
            <?php include 'component/kategori.php';?>
            <?php include 'component/bahanbaku.php';?>
            <?php include 'component/supplier.php';?>
             
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- fungsi Javascript / JS untuk menu tab-->
<script>
  $(document).ready(function(){
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      var target = $(e.target).attr("href") // activated tab
      sessionStorage.setItem('active_tab', target);
    });

    var activeTab = sessionStorage.getItem('active_tab');
    if(activeTab){
      $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
    }
  });
</script>
</body>
</html>