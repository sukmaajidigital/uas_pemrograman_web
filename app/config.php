<?php
$databaseServer='127.0.0.1';
$databaseUser='root';
$databasepass='';
$databaseName='pw_uas';

$koneksi = mysqli_connect($databaseServer,$databaseUser,$databasepass,$databaseName)
or 
die('koneksi gagal');
?> 