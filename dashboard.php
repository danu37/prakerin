<?php
session_start();
include 'koneksi.php';

/* HITUNG DATA */
$total_siswa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM siswa"));

$total_industri = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM industri"));

$total_penempatan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penempatan WHERE status='Aktif'"));

$total_jurnal = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM jurnal"));

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin PKL</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-slate-900 text-white p-6">

        <h1 class="text-3xl font-bold mb-10">
            PKL SMK
        </h1>

        <nav class="space-y-3">

            <a href="dashboard.php"
               class="block bg-blue-600 px-4 py-3 rounded-xl">
                Dashboard
            </a>

            <a href="siswa/index.php"
               class="block hover:bg-slate-800 px-4 py-3 rounded-xl transition">
                Data Siswa
            </a>

            <a href="industri/index.php"
               class="block hover:bg-slate-800 px-4 py-3 rounded-xl transition">
                Data Industri
            </a>

            <a href="penempatan/index.php"
               class="block hover:bg-slate-800 px-4 py-3 rounded-xl transition">
                Penempatan
            </a>

            <a href="jurnal/index.php"
               class="block hover:bg-slate-800 px-4 py-3 rounded-xl transition">
                Jurnal
            </a>

            <a href="logout.php"
               class="block hover:bg-red-600 px-4 py-3 rounded-xl transition">
                Logout
            </a>

        </nav>

    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-8">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">

            <div>
                <h2 class="text-3xl font-bold text-slate-800">
                    Dashboard Admin
                </h2>

                <p class="text-slate-500 mt-1">
                    Sistem Monitoring PKL / Prakerin
                </p>
            </div>

            <div class="bg-white px-5 py-3 rounded-xl shadow">
                Admin
            </div>

        </div>

        <!-- CARD -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

            <!-- SISWA -->
            <div class="bg-white p-6 rounded-2xl shadow">

                <p class="text-slate-500">
                    Total Siswa
                </p>

                <h3 class="text-4xl font-bold mt-3 text-blue-600">
                    <?= $total_siswa; ?>
                </h3>

            </div>

            <!-- INDUSTRI -->
            <div class="bg-white p-6 rounded-2xl shadow">

                <p class="text-slate-500">
                    Total Industri
                </p>

                <h3 class="text-4xl font-bold mt-3 text-green-600">
                    <?= $total_industri; ?>
                </h3>

            </div>

            <!-- PENEMPATAN -->
            <div class="bg-white p-6 rounded-2xl shadow">

                <p class="text-slate-500">
                    PKL Aktif
                </p>

                <h3 class="text-4xl font-bold mt-3 text-orange-500">
                    <?= $total_penempatan; ?>
                </h3>

            </div>

            <!-- JURNAL -->
            <div class="bg-white p-6 rounded-2xl shadow">

                <p class="text-slate-500">
                    Total Jurnal
                </p>

                <h3 class="text-4xl font-bold mt-3 text-purple-600">
                    <?= $total_jurnal; ?>
                </h3>

            </div>

        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-2xl shadow p-6">

            <div class="flex justify-between items-center mb-6">

                <h3 class="text-2xl font-bold text-slate-700">
                    Data Penempatan PKL
                </h3>

                <a href="penempatan/tambah.php"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl">
                    + Tambah
                </a>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead>
                        <tr class="border-b">

                            <th class="py-4">Nama Siswa</th>
                            <th>Perusahaan</th>
                            <th>Tanggal Mulai</th>
                            <th>Status</th>

                        </tr>
                    </thead>

                    <tbody>

                    <?php

                    $query = mysqli_query($conn, "
                        SELECT 
                            siswa.nama_siswa,
                            industri.nama_perusahaan,
                            penempatan.tanggal_mulai,
                            penempatan.status
                        FROM penempatan
                        JOIN siswa 
                            ON penempatan.nis = siswa.nis
                        JOIN industri 
                            ON penempatan.id_industri = industri.id_industri
                        ORDER BY penempatan.id_penempatan DESC
                    ");

                    while($data = mysqli_fetch_assoc($query)) :
                    ?>

                        <tr class="border-b hover:bg-slate-50">

                            <td class="py-4">
                                <?= $data['nama_siswa']; ?>
                            </td>

                            <td>
                                <?= $data['nama_perusahaan']; ?>
                            </td>

                            <td>
                                <?= $data['tanggal_mulai']; ?>
                            </td>

                            <td>

                                <?php if($data['status'] == 'Aktif') : ?>

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                        Aktif
                                    </span>

                                <?php elseif($data['status'] == 'Selesai') : ?>

                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                        Selesai
                                    </span>

                                <?php else : ?>

                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                        Batal
                                    </span>

                                <?php endif; ?>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>

</body>
</html>
