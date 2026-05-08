```php id="industri-proses-tambah"
<?php
include '../koneksi.php';

$nama = $_POST['nama_perusahaan'];
$alamat = $_POST['alamat'];
$bidang = $_POST['bidang_usaha'];
$pembimbing = $_POST['pembimbing_lapangan'];

mysqli_query($conn, "
INSERT INTO industri(
nama_perusahaan,
alamat,
bidang_usaha,
pembimbing_lapangan
)

VALUES(
'$nama',
'$alamat',
'$bidang',
'$pembimbing'
)
");

header("Location: index.php");
?>
```
