<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
  header("Location: index.php");
  exit;
}

include 'koneksi.php';

$id_user = $_SESSION['id_user'] ?? ($_SESSION['id'] ?? 0); // fallback
$nama = $_SESSION['nama'] ?? 'Mahasiswa';

// Ambil jumlah total UKM
$q_total_ukm = mysqli_query($conn, "SELECT COUNT(*) AS total FROM ukm");
$total_ukm = mysqli_fetch_assoc($q_total_ukm)['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Mahasiswa</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body { background-color: #fff8f0; font-family: 'Poppins', sans-serif; }
    .navbar-orange { background-color: #ff8800; }
    .text-orange { color: #ff8800; }
    .btn-outline-orange { color: #ff8800; border-color: #ff8800; }
    .btn-outline-orange:hover { background-color: #ff8800; color: white; }
    .banner { border-radius: 12px; overflow: hidden; max-height: 260px; object-fit: cover; width: 100%; }
    .card-featured { border: none; border-radius: 14px; box-shadow: 0 2px 15px rgba(0,0,0,0.05); }
    .card-featured img { border-top-left-radius: 14px; border-top-right-radius: 14px; max-height: 140px; object-fit: cover; width: 100%; }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-orange navbar-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">
      <span style="color: #fff;">🎓 UK</span><span style="color: #343a40; background-color: #fff; padding: 0 6px; border-radius: 4px;">Mate</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUser">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarUser">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link active" href="#">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="daftar_ukm.php">Daftar UKM</a></li>
      </ul>
      <div class="dropdown">
        <button class="btn btn-outline-light btn-sm dropdown-toggle" data-bs-toggle="dropdown">
          👤 <?= htmlspecialchars($nama) ?>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<div class="container py-4">
  <img src="https://www.umn.ac.id/wp-content/uploads/2023/07/UKM.png" class="banner mb-4" alt="Banner UKM Kampus">

  <div class="text-center mb-4">
    <h3 class="text-orange fw-semibold">Selamat Datang di UKM Kampus 👋</h3>
    <p class="text-muted">Gabung dengan komunitas yang bikin kamu berkembang. Mulai dari seni, teknologi, sampai alam bebas—semuanya ada di sini.</p>
    <blockquote class="blockquote mb-2">
      <p class="mb-2">"Aktif di UKM bukan cuma cari teman, tapi cari pengalaman."</p>
    </blockquote>
    <p class="text-muted mt-1" style="font-style: italic;">— Mahasiswa Produktif</p>
    <a href="daftar_ukm.php" class="btn btn-outline-orange mt-3">Lihat Daftar UKM</a>
  </div>

  <div class="row justify-content-center text-center mb-5">
    <div class="col-md-4">
      <div class="card border-0 shadow-sm py-4">
        <h1 class="text-orange mb-1">📌</h1>
        <h4 class="text-orange mb-0"><?= $total_ukm ?></h4>
        <small class="text-muted">Total UKM Terdaftar</small>
      </div>
    </div>
  </div>

  <div class="row align-items-center mb-5">
    <div class="col-md-6">
      <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=720&q=80"
           alt="Aktif di UKM" class="img-fluid rounded-3 shadow-sm">
    </div>
    <div class="col-md-6 mt-4 mt-md-0">
      <h5 class="fw-semibold text-orange">Kenapa Harus Aktif di UKM? 🤔</h5>
      <p class="text-muted mb-2">
        Aktif di UKM bikin kamu dapet pengalaman organisasi, teamwork, bahkan jaringan yang luas banget. Selain itu...
      </p>
      <ul class="text-muted">
        <li>Nambah skill & portofolio non-akademik</li>
        <li>Temu teman lintas jurusan & angkatan</li>
        <li>Bikin CV kamu beda saat lulus</li>
      </ul>
    </div>
  </div>

  <h5 class="text-orange mb-3 fw-semibold">UKM Unggulan</h5>
  <div class="row g-4 mb-5">
    <div class="col-md-4">
      <div class="card card-featured h-100">
        <img src="https://wallpapercave.com/wp/wp2738087.jpg" alt="UKM Musik">
        <div class="card-body">
          <h6 class="card-title fw-semibold">UKM Musik</h6>
          <p class="card-text">Gabung bareng pecinta musik kampus—dari band, akustik, sampai orkestra mini.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-featured h-100">
        <img src="https://www.umn.ac.id/wp-content/uploads/2023/04/close-up-reporter-taking-interview.jpg" alt="UKM Jurnalistik">
        <div class="card-body">
          <h6 class="card-title fw-semibold">UKM Jurnalistik</h6>
          <p class="card-text">Liputan kampus, opini kritis, dan media kreatif—semuanya kamu eksplor di sini.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-featured h-100">
        <img src="https://www.massaudubon.org/var/site/storage/images/6/2/6/1/1601626-1-eng-US/0bf34246f095-IMG_9782-1920x1280.jpg" alt="UKM Pecinta Alam">
        <div class="card-body">
          <h6 class="card-title fw-semibold">UKM Pecinta Alam</h6>
          <p class="card-text">Mendaki, eksplorasi, dan aksi hijau bareng komunitas pecinta lingkungan.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="bg-light py-4 border-top">
  <div class="container text-center">
    <p class="mb-1 fw-semibold text-orange">© <?= date('Y') ?> UKMate</p>
    <small class="text-muted">Dibuat oleh Muhammad Nabil al-Hafiz</small>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>