<?php include '../koneksi.php';
$query = mysqli_query($conn, "SELECT * FROM industri"); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Industri</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 p-10">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold"> Data Industri </h1> <a href="tambah.php" class="bg-blue-600 text-white px-5 py-3 rounded-xl"> + Tambah Industri </a>
    </div>
    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-200">
                <tr>
                    <th class="p-4">No</th>
                    <th>Nama Perusahaan</th>
                    <th>Alamat</th>
                    <th>Bidang Usaha</th>
                    <th>Pembimbing</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody> <?php $no = 1;
                    while ($data = mysqli_fetch_assoc($query)) : ?> <tr class="border-b hover:bg-slate-50">
                        <td class="p-4"><?= $no++; ?></td>
                        <td> <?= $data['nama_perusahaan']; ?> </td>
                        <td> <?= $data['alamat']; ?> </td>
                        <td> <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm"> <?= $data['bidang_usaha']; ?> </span> </td>
                        <td> <?= $data['pembimbing_lapangan']; ?> </td>
                        <td>
                            <div class="flex gap-2"> <a href="edit.php?id=<?= $data['id_industri']; ?>" class="bg-yellow-400 text-white px-4 py-2 rounded-lg"> Edit </a> <a href="hapus.php?id=<?= $data['id_industri']; ?>" onclick="return confirm('Yakin hapus data?')" class="bg-red-500 text-white px-4 py-2 rounded-lg"> Hapus </a> </div>
                        </td>
                    </tr> <?php endwhile; ?> </tbody>
        </table>
    </div>
</body>

</html>