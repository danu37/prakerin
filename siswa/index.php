<?php
include '../koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM siswa ORDER BY nama_siswa ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>

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
    <aside class="w-64 bg-slate-900 text-white p-6 hidden md:block">

        <h1 class="text-3xl font-bold mb-10">
            PKL SMK
        </h1>

        <nav class="space-y-3">

            <a href="../dashboard.php"
               class="block hover:bg-slate-800 px-4 py-3 rounded-xl transition">
                Dashboard
            </a>

            <a href="index.php"
               class="block bg-blue-600 px-4 py-3 rounded-xl">
                Data Siswa
            </a>

            <a href="../industri/index.php"
               class="block hover:bg-slate-800 px-4 py-3 rounded-xl transition">
                Industri
            </a>

            <a href="../penempatan/index.php"
               class="block hover:bg-slate-800 px-4 py-3 rounded-xl transition">
                Penempatan
            </a>

            <a href="../jurnal/index.php"
               class="block hover:bg-slate-800 px-4 py-3 rounded-xl transition">
                Jurnal
            </a>

        </nav>

    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-8">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

            <div>
                <h2 class="text-3xl font-bold text-slate-800">
                    Data Siswa
                </h2>

                <p class="text-slate-500 mt-1">
                    Kelola data siswa PKL / Prakerin
                </p>
            </div>

            <a href="tambah.php"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl shadow transition text-center">
                + Tambah Siswa
            </a>

        </div>

        <!-- CARD INFO -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="bg-white rounded-2xl p-6 shadow">
                <p class="text-slate-500">
                    Total Siswa
                </p>

                <h3 class="text-4xl font-bold text-blue-600 mt-2">
                    <?php echo mysqli_num_rows($query); ?>
                </h3>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow">
                <p class="text-slate-500">
                    Jurusan
                </p>

                <h3 class="text-4xl font-bold text-green-600 mt-2">
                    RPL
                </h3>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow">
                <p class="text-slate-500">
                    Status
                </p>

                <h3 class="text-4xl font-bold text-orange-500 mt-2">
                    Aktif
                </h3>
            </div>

        </div>

        <!-- TABLE CARD -->
        <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

            <!-- TOP -->
            <div class="p-6 border-b flex flex-col md:flex-row gap-4 md:items-center md:justify-between">

                <h3 class="text-2xl font-bold text-slate-700">
                    List Siswa
                </h3>

                <!-- SEARCH -->
                <input 
                    type="text"
                    id="searchInput"
                    placeholder="Cari nama siswa..."
                    class="border border-slate-300 rounded-2xl px-5 py-3 outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-80"
                >

            </div>

            <!-- TABLE -->
            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="p-5">NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>No HP</th>
                            <th class="text-center">Aksi</th>

                        </tr>

                    </thead>

                    <tbody id="tableBody">

                    <?php while($data = mysqli_fetch_assoc($query)) : ?>

                        <tr class="border-b hover:bg-blue-50 transition">

                            <td class="p-5 font-medium text-slate-700">
                                <?= $data['nis']; ?>
                            </td>

                            <td>
                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold">
                                        <?= strtoupper(substr($data['nama_siswa'],0,1)); ?>
                                    </div>

                                    <div>
                                        <h4 class="font-semibold text-slate-800">
                                            <?= $data['nama_siswa']; ?>
                                        </h4>
                                    </div>

                                </div>
                            </td>

                            <td>
                                <?= $data['kelas']; ?>
                            </td>

                            <td>
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                    <?= $data['jurusan']; ?>
                                </span>
                            </td>

                            <td>
                                <?= $data['no_hp']; ?>
                            </td>

                            <td>

                                <div class="flex items-center justify-center gap-2">

                                    <a href="edit.php?nis=<?= $data['nis']; ?>"
                                       class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-xl transition">
                                        Edit
                                    </a>

                                    <a href="hapus.php?nis=<?= $data['nis']; ?>"
                                       onclick="return confirm('Yakin hapus data?')"
                                       class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl transition">
                                        Hapus
                                    </a>

                                </div>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>

<!-- SEARCH JS -->
<script>

const searchInput = document.getElementById('searchInput');
const tableBody = document.getElementById('tableBody');

searchInput.addEventListener('keyup', function(){

    const keyword = this.value.toLowerCase();
    const rows = tableBody.querySelectorAll('tr');

    rows.forEach(row => {

        const text = row.innerText.toLowerCase();

        if(text.includes(keyword)){
            row.style.display = '';
        }else{
            row.style.display = 'none';
        }

    });

});

</script>

</body>
</html>
```
