<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include "koneksi.php";

// === HITUNG TOTAL TAMU ===
$q_total = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tamu");
$total_tamu = mysqli_fetch_assoc($q_total)['total'];

// === HITUNG TAMU HARI INI ===
$today = date("Y-m-d");
$q_today = mysqli_query($conn, "SELECT COUNT(*) AS hari_ini FROM tamu WHERE tanggal='$today'");
$tamu_hari_ini = mysqli_fetch_assoc($q_today)['hari_ini'];

// === RIWAYAT 5 KUNJUNGAN TERBARU ===
$q_recent = mysqli_query($conn, "SELECT * FROM tamu ORDER BY id DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Buku Tamu TU</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body { background-color:#eef5ff; font-family:'Poppins', sans-serif; }
    .sidebar { width:240px; height:100vh; background:linear-gradient(180deg,#a3c9f9,#bdd6ff); color:#fff; position:fixed; padding:25px 15px; }
    .sidebar a { color:white; text-decoration:none; padding:10px 15px; border-radius:8px; display:block; margin-bottom:6px; }
    .sidebar a:hover, .sidebar a.active { background:rgba(255,255,255,0.25); }
    .content { margin-left:250px; padding:30px; }
    .card-total{background:#94bcfd;} .card-today{background:#82a8f8;} .card-user{background:#57abff;}
    .card-header {background:linear-gradient(180deg,#a3c9f9,#bdd6ff); color:#fff;}
    @media(max-width:768px){ .sidebar{position:relative; width:100%; height:auto;} .content{margin-left:0;} }
  </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <h4 class="text-center mb-4">Buku Tamu TU</h4>
  <a href="dashboard.php" class="active"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
  <a href="data_tamu.php"><i class="bi bi-people me-2"></i>Data Tamu</a>
  <a href="beranda.php"><i class="bi bi-house me-2"></i>Beranda</a>
  <hr>
 <a href="logout.php" data-bs-toggle="modal" data-bs-target="#modalLogout">
  <i class="bi bi-box-arrow-right me-2"></i>Logout
</a>

</div>

<!-- CONTENT -->
<div class="content">
  <h2 class="mb-4 text-dark">Selamat Datang, <?= $_SESSION['admin'] ?> 👋</h2>

  <!-- Cards -->
  <div class="row g-3">
    <div class="col-md-4">
      <div class="card card-total text-center p-3 shadow-sm">
        <h5>Total Tamu</h5>
        <p class="display-6 fw-bold"><?= $total_tamu ?></p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-today text-center p-3 shadow-sm">
        <h5>Kunjungan Hari Ini</h5>
        <p class="display-6 fw-bold"><?= $tamu_hari_ini ?></p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-user text-center p-3 shadow-sm">
        <h5>Admin Aktif</h5>
        <p class="display-6 fw-bold">1</p>
      </div>
    </div>
  </div>

  <!-- Alert -->
  <div class="alert alert-info mt-4">
    <h5>Halo, Admin 👋</h5>
    Tetap semangat memberikan pelayanan terbaik!
  </div>

  <!-- Riwayat -->
  <div class="card shadow-sm mt-4 mb-5">
    <div class="card-header">Riwayat Kunjungan Terakhir</div>
    <ul class="list-group list-group-flush">
      <?php while ($row = mysqli_fetch_assoc($q_recent)) { ?>
        <li class="list-group-item">
          <?= date("d M Y", strtotime($row['tanggal'])) ?> -
          <strong><?= $row['nama'] ?></strong> – <?= $row['keperluan'] ?>
        </li>
      <?php } ?>
    </ul>
  </div>
</div>


...
</div> <!-- penutup content -->

<!-- === TARUH MODAL LOGOUT DI SINI === -->
<div class="modal fade" id="modalLogout" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title fw-bold">Konfirmasi Logout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        Apakah Anda yakin ingin keluar dari akun admin?
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="logout.php" class="btn btn-danger">Ya, Logout</a>
      </div>

    </div>
  </div>
</div>
</body>
</html>
