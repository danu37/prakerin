<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
}

$total_siswa = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM siswa"));
$total_industri = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM industri"));
$total_penempatan = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM penempatan"));
$total_jurnal = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM jurnal"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100">

<div class="p-10">

<h1 class="text-4xl font-bold mb-8">
Dashboard PKL
</h1>

<div class="grid grid-cols-4 gap-5">

<div class="bg-white p-6 rounded-2xl shadow">
<h2>Total Siswa</h2>
<p class="text-4xl font-bold mt-3">
<?= $total_siswa; ?>
</p>
</div>

<div class="bg-white p-6 rounded-2xl shadow">
<h2>Total Industri</h2>
<p class="text-4xl font-bold mt-3">
<?= $total_industri; ?>
</p>
</div>

<div class="bg-white p-6 rounded-2xl shadow">
<h2>Penempatan</h2>
<p class="text-4xl font-bold mt-3">
<?= $total_penempatan; ?>
</p>
</div>

<div class="bg-white p-6 rounded-2xl shadow">
<h2>Jurnal</h2>
<p class="text-4xl font-bold mt-3">
<?= $total_jurnal; ?>
</p>
</div>

</div>

<div class="mt-10 flex gap-4">
<a href="siswa/index.php" class="bg-blue-600 text-white px-5 py-3 rounded-xl">
Data Siswa
</a>

<a href="industri/index.php" class="bg-green-600 text-white px-5 py-3 rounded-xl">
Data Industri
</a>

<a href="penempatan/index.php" class="bg-orange-500 text-white px-5 py-3 rounded-xl">
Penempatan
</a>

<a href="jurnal/index.php" class="bg-purple-600 text-white px-5 py-3 rounded-xl">
Jurnal
</a>
</div>

</div>

</body>
</html>