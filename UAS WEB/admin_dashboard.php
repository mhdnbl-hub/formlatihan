<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: index.php");
  exit;
}

include 'koneksi.php';

$nama_admin = $_SESSION['nama'] ?? 'Admin';

$q_total_ukm = mysqli_query($conn, "SELECT COUNT(*) AS total FROM ukm");
$total_ukm = mysqli_fetch_assoc($q_total_ukm)['total'];

$q_pendaftar = mysqli_query($conn, "SELECT COUNT(*) AS total FROM pendaftaran");
$total_pendaftar = mysqli_fetch_assoc($q_pendaftar)['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body { background-color: #f8f9fa; font-family: 'Poppins', sans-serif; }
    .navbar-dark { background-color: #343a40; }
    .card-stat {
      border-radius: 12px;
      box-shadow: 0 2px 15px rgba(0,0,0,0.05);
      transition: transform 0.2s ease;
    }
    .card-stat:hover { transform: scale(1.01); }
    .text-orange { color: #ff8800; }
    footer { border-top: 1px solid #dee2e6; background-color: #fff; }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="admin_dashboard.php">
      <span style="color: #ff8800;">UKMate</span> Admin
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarAdmin">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link active" href="admin_dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="tambah_ukm.php">Tambah UKM</a></li>
        <li class="nav-item"><a class="nav-link" href="lihat_pendaftar.php">Pendaftar</a></li>
      </ul>
      <div class="dropdown">
        <button class="btn btn-outline-light btn-sm dropdown-toggle" data-bs-toggle="dropdown">
          👤 <?= htmlspecialchars($nama_admin) ?>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<div class="container py-5">
  <div class="text-center mb-4">
    <h3 class="fw-semibold">Selamat Datang, <?= htmlspecialchars($nama_admin) ?> 👋</h3>
    <p class="text-muted">Kelola sistem pendaftaran UKM kampusmu dengan mudah dan efisien.</p>
  </div>

  <div class="row text-center mb-5">
    <div class="col-md-6">
      <div class="card card-stat py-4">
        <h4 class="text-orange fw-bold"><?= $total_ukm ?></h4>
        <p class="text-muted mb-0">Total UKM Terdaftar 🏷️</p>
      </div>
    </div>
    <div class="col-md-6 mt-4 mt-md-0">
      <div class="card card-stat py-4">
        <h4 class="text-orange fw-bold"><?= $total_pendaftar ?></h4>
        <p class="text-muted mb-0">Total Mahasiswa Mendaftar 📝</p>
      </div>
    </div>
  </div>

  <div class="row justify-content-center text-center">
    <div class="col-md-8">
      <div class="alert alert-light shadow-sm">
        <strong>Tips Admin:</strong> Selalu cek dan validasi pendaftar secara berkala untuk menghindari duplikasi 😎
      </div>
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