```php id="penempatan-crud"
<!-- penempatan/proses_tambah.php -->
<?php
include '../koneksi.php';

mysqli_query($conn, "
INSERT INTO penempatan(
nis,
id_industri,
tanggal_mulai,
tanggal_selesai,
status
)

VALUES(
'$_POST[nis]',
'$_POST[id_industri]',
'$_POST[tanggal_mulai]',
'$_POST[tanggal_selesai]',
'$_POST[status]'
)
");

header('Location: index.php');
?>

<!-- penempatan/edit.php -->
<?php
include '../koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($conn, "
SELECT * FROM penempatan
WHERE id_penempatan='$id'
");

$data = mysqli_fetch_assoc($query);

$siswa = mysqli_query($conn, "SELECT * FROM siswa");
$industri = mysqli_query($conn, "SELECT * FROM industri");
?>

<!-- penempatan/update.php -->
<?php
include '../koneksi.php';

mysqli_query($conn, "
UPDATE penempatan SET

nis='$_POST[nis]',
id_industri='$_POST[id_industri]',
tanggal_mulai='$_POST[tanggal_mulai]',
tanggal_selesai='$_POST[tanggal_selesai]',
status='$_POST[status]'

WHERE id_penempatan='$_POST[id_penempatan]'
");

header('Location: index.php');
?>

<!-- penempatan/hapus.php -->
<?php
include '../koneksi.php';

$id = $_GET['id'];

mysqli_query($conn,
"DELETE FROM penempatan
WHERE id_penempatan='$id'");

header('Location: index.php');
?>
```
