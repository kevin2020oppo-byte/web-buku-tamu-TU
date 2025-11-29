<?php
include "koneksi.php";

$id = $_POST['id'];
$nama = $_POST['nama'];
$instansi = $_POST['instansi'];
$hp = $_POST['hp'];
$tanggal = $_POST['tanggal'];
$waktu = $_POST['waktu'];
$keperluan = $_POST['keperluan'];
$petugas = $_POST['petugas'];

mysqli_query($conn, "UPDATE tamu SET 
    nama='$nama',
    instansi='$instansi',
    hp='$hp',
    tanggal='$tanggal',
    waktu='$waktu',
    keperluan='$keperluan',
    petugas='$petugas'
WHERE id='$id'");

header("Location: data_tamu.php");
exit();
?>
