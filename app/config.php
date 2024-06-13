<?php
$databaseServer='localhost';
$databaseUser='root';
$databasepass='';
$databaseName='pw_uas';

$koneksi = mysqli_connect($databaseServer,$databaseUser,$databasepass,$databaseName)
or 
die('koneksi gagal');
?> 