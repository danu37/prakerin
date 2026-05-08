<!-- penempatan/tambah.php -->
<?php
include '../koneksi.php';

$siswa = mysqli_query($conn, "SELECT * FROM siswa");
$industri = mysqli_query($conn, "SELECT * FROM industri");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Penempatan</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 p-10">

<form action="proses_tambah.php" method="POST"
class="bg-white p-8 rounded-2xl shadow max-w-2xl mx-auto">

    <h1 class="text-3xl font-bold mb-8">
        Tambah Penempatan PKL
    </h1>

    <!-- SISWA -->
    <div class="mb-4">

        <label>Nama Siswa</label>

        <select name="nis"
                class="w-full border p-3 rounded-xl">

            <option value="">
                -- Pilih Siswa --
            </option>

            <?php while($s = mysqli_fetch_assoc($siswa)) : ?>

                <option value="<?= $s['nis']; ?>">
                    <?= $s['nama_siswa']; ?>
                </option>

            <?php endwhile; ?>

        </select>

    </div>

    <!-- INDUSTRI -->
    <div class="mb-4">

        <label>Perusahaan</label>

        <select name="id_industri"
                class="w-full border p-3 rounded-xl">

            <option value="">
                -- Pilih Industri --
            </option>

            <?php while($i = mysqli_fetch_assoc($industri)) : ?>

                <option value="<?= $i['id_industri']; ?>">
                    <?= $i['nama_perusahaan']; ?>
                </option>

            <?php endwhile; ?>

        </select>

    </div>

    <!-- TANGGAL -->
    <div class="mb-4">

        <label>Tanggal Mulai</label>

        <input type="date"
               name="tanggal_mulai"
               class="w-full border p-3 rounded-xl">

    </div>

    <div class="mb-4">

        <label>Tanggal Selesai</label>

        <input type="date"
               name="tanggal_selesai"
               class="w-full border p-3 rounded-xl">

    </div>

    <!-- STATUS -->
    <div class="mb-6">

        <label>Status</label>

        <select name="status"
                class="w-full border p-3 rounded-xl">

            <option value="Aktif">Aktif</option>
            <option value="Selesai">Selesai</option>
            <option value="Batal">Batal</option>

        </select>

    </div>

    <button class="bg-blue-600 text-white px-6 py-3 rounded-xl">
        Simpan
    </button>

</form>

</body>
</html>
