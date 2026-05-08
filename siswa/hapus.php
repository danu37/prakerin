<?php
include '../koneksi.php';

$nis = $_GET['nis'];

mysqli_query($conn,"DELETE FROM siswa WHERE nis='$nis'");

header("Location: index.php");
?>