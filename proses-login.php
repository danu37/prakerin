<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "
    SELECT * FROM admin 
    WHERE username='$username' 
    AND password='$password'
");

$cek = mysqli_num_rows($query);

if($cek > 0){

    $_SESSION['login'] = true;
    $_SESSION['username'] = $username;

    header("Location: dashboard.php");

}else{

    echo "
    <script>
        alert('Username atau Password salah!');
        window.location='login.php';
    </script>
    ";

}
?>
