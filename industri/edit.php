<?php
include '../koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($conn,
"SELECT * FROM industri WHERE id_industri='$id'");

$data = mysqli_fetch_assoc($query);
?>