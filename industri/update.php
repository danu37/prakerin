<?php
include '../koneksi.php';

mysqli_query($conn, "
UPDATE industri SET

nama_perusahaan='$_POST[nama_perusahaan]',
alamat='$_POST[alamat]',
bidang_usaha='$_POST[bidang_usaha]',
pembimbing_lapangan='$_POST[pembimbing_lapangan]'

WHERE id_industri='$_POST[id_industri]'
");

header("Location: index.php");
?>