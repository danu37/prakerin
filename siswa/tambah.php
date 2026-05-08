<!DOCTYPE html>
<html>
<head>
<title>Tambah Siswa</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 p-10">

<form action="proses_tambah.php" method="POST"
class="bg-white p-8 rounded-2xl shadow max-w-xl mx-auto">

<h1 class="text-3xl font-bold mb-6">Tambah Siswa</h1>

<input type="text" name="nis" placeholder="NIS"
class="w-full border p-3 rounded-xl mb-4">

<input type="text" name="nama_siswa" placeholder="Nama"
class="w-full border p-3 rounded-xl mb-4">

<input type="text" name="kelas" placeholder="Kelas"
class="w-full border p-3 rounded-xl mb-4">

<input type="text" name="jurusan" placeholder="Jurusan"
class="w-full border p-3 rounded-xl mb-4">

<input type="text" name="no_hp" placeholder="No HP"
class="w-full border p-3 rounded-xl mb-4">

<button class="bg-blue-600 text-white px-5 py-3 rounded-xl">
Simpan
</button>

</form>

</body>
</html>