<?php
include '../koneksi.php';

$id = $_GET['id'];

mysqli_query($conn,
"DELETE FROM industri WHERE id_industri='$id'");

header("Location: index.php");
?>