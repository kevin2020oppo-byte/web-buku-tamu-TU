<?php
include "koneksi.php";  // WAJIB !!!

// ambil data dari form
$nama      = $_POST['nama'];
$instansi  = $_POST['instansi'];
$hp        = $_POST['hp'];
$tanggal   = $_POST['tanggal'];
$waktu     = $_POST['waktu'];
$keperluan = $_POST['keperluan'];
$petugas   = $_POST['petugas'];

// query simpan
$sql = "INSERT INTO tamu (nama, instansi, hp, tanggal, waktu, keperluan, petugas)
        VALUES ('$nama', '$instansi', '$hp', '$tanggal', '$waktu', '$keperluan', '$petugas')";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Data tamu berhasil disimpan!');
          window.location='beranda.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
