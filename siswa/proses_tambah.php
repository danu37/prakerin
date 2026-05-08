<?php
include '../koneksi.php';

$nis = $_POST['nis'];
$nama = $_POST['nama_siswa'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];
$no_hp = $_POST['no_hp'];

mysqli_query($conn,"
INSERT INTO siswa VALUES(
'$nis',
'$nama',
'$kelas',
'$jurusan',
'$no_hp'
)
");

header("Location: index.php");
?>