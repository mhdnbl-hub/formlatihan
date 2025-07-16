<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
  header("Location: index.php");
  exit;
}

if (!isset($_GET['id'])) {
  echo "UKM tidak ditemukan.";
  exit;
}

$user_id = $_SESSION['id_user'];
$nama_user = $_SESSION['nama'] ?? 'Mahasiswa';
$ukm_id = intval($_GET['id']);
$msg = "";

// Ambil data UKM
$ukm = mysqli_query($conn, "SELECT * FROM ukm WHERE id = $ukm_id");
$data_ukm = mysqli_fetch_assoc($ukm);

if (!$data_ukm) {
  echo "UKM tidak ditemukan.";
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = trim(mysqli_real_escape_string($conn, $_POST['nama_lengkap']));
  $nim = trim(mysqli_real_escape_string($conn, $_POST['nim']));
  $prodi = trim(mysqli_real_escape_string($conn, $_POST['prodi']));
  $tanggal = date('Y-m-d');

  $cek = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE id_user = $user_id AND id_ukm = $ukm_id");
  if (mysqli_num_rows($cek) === 0) {
    $insert = "INSERT INTO pendaftaran (id_user, id_ukm, nama_lengkap, nim, prodi, tanggal_daftar)
               VALUES ($user_id, $ukm_id, '$nama', '$nim', '$prodi', '$tanggal')";
    $msg = mysqli_query($conn, $insert)
      ? "<div class='alert alert-success'>✅ Pendaftaran berhasil!</div>"
      : "<div class='alert alert-danger'>❌ Gagal mendaftar. Silakan coba lagi.</div>";
  } else {
    $msg = "<div class='alert alert-warning'>⚠️ Kamu sudah mendaftar ke UKM ini sebelumnya.</div>";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Form Pendaftaran UKM</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body { background-color: #fffef9; font-family: 'Poppins', sans-serif; }
    .navbar-orange { background-color: #ff8800; }
    .text-orange { color: #ff8800; }
    .card { border-radius: 12px; }
    .btn-orange { background-color: #ff8800; color: white; border: none; }
    .btn-orange:hover { background-color: #e67600; }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-orange navbar-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="user_dashboard.php">
      <span style="color: #fff;">🎓 UK</span><span style="color: #343a40; background-color: #fff; padding: 0 6px; border-radius: 4px;">Mate</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUser">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarUser">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="user_dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link active" href="#">Form Pendaftaran</a></li>
      </ul>
      <div class="dropdown">
        <button class="btn btn-outline-light btn-sm dropdown-toggle" data-bs-toggle="dropdown">
          👤 <?= htmlspecialchars($nama_user) ?>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="#">Profil</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<div class="container py-5" style="max-width: 700px;">
  <div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
      <h5 class="mb-0">Pendaftaran: <?= htmlspecialchars($data_ukm['nama_ukm']) ?></h5>
    </div>
    <div class="card-body">
      <?= $msg ?>
      <form method="post">
        <div class="mb-3">
          <label class="form-label">Nama Lengkap</label>
          <input type="text" name="nama_lengkap" class="form-control" required />
        </div>
        <div class="mb-3">
          <label class="form-label">NIM</label>
          <input type="text" name="nim" class="form-control" required />
        </div>
        <div class="mb-3">
          <label class="form-label">Program Studi</label>
          <input type="text" name="prodi" class="form-control" required />
        </div>
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-orange">Kirim Pendaftaran</button>
          <a href="daftar_ukm.php" class="btn btn-secondary">Batal</a>
        </div>
      </form>
    </div>
  </div>
</div>

<footer class="py-4 mt-5">
  <div class="container text-center">
    <p class="mb-1 fw-semibold text-orange">© <?= date('Y') ?> UKMate • Admin Panel</p>
    <small class="text-muted">Dibuat oleh Muhammad Nabil al-Hafiz</small>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>