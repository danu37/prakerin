<?php
include '../koneksi.php';

mysqli_query($conn,"
UPDATE siswa SET
nama_siswa='$_POST[nama_siswa]',
kelas='$_POST[kelas]',
jurusan='$_POST[jurusan]',
no_hp='$_POST[no_hp]'
WHERE nis='$_POST[nis]'
");

header("Location: index.php");
?>