```php id="industri-tambah"
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Industri</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 p-10">

<form action="proses_tambah.php" method="POST"
class="bg-white p-8 rounded-2xl shadow max-w-2xl mx-auto">

    <h1 class="text-3xl font-bold mb-8">
        Tambah Industri
    </h1>

    <div class="mb-4">

        <label>Nama Perusahaan</label>

        <input type="text"
               name="nama_perusahaan"
               class="w-full border p-3 rounded-xl">

    </div>

    <div class="mb-4">

        <label>Alamat</label>

        <textarea name="alamat"
                  class="w-full border p-3 rounded-xl"></textarea>

    </div>

    <div class="mb-4">

        <label>Bidang Usaha</label>

        <input type="text"
               name="bidang_usaha"
               class="w-full border p-3 rounded-xl">

    </div>

    <div class="mb-6">

        <label>Pembimbing Lapangan</label>

        <input type="text"
               name="pembimbing_lapangan"
               class="w-full border p-3 rounded-xl">

    </div>

    <button class="bg-blue-600 text-white px-6 py-3 rounded-xl">
        Simpan
    </button>

</form>

</body>
</html>
```
