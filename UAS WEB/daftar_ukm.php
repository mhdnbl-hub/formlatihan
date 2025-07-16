<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
  header("Location: index.php");
  exit;
}

$nama = $_SESSION['nama'] ?? 'Mahasiswa';
$ukm_list = mysqli_query($conn, "SELECT * FROM ukm ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar UKM</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body { background-color: #fff7f0; font-family: 'Poppins', sans-serif; }
    .navbar-orange { background-color: #ff8800; }
    .text-orange { color: #ff8800; }
    .card-ukm {
      border-radius: 12px;
      box-shadow: 0 2px 15px rgba(0,0,0,0.05);
      transition: transform 0.2s ease;
    }
    .card-ukm:hover { transform: scale(1.02); }
    .btn-daftar {
      background-color: #ff8800;
      color: white;
      border: none;
      transition: 0.2s ease-in-out;
    }
    .btn-daftar:hover {
      background-color: #e67600;
      transform: scale(1.01);
    }
    footer {
      background-color: #fff;
      border-top: 1px solid #dee2e6;
    }
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
        <li class="nav-item"><a class="nav-link active" href="#">Daftar UKM</a></li>
      </ul>
      <div class="dropdown">
        <button class="btn btn-outline-light btn-sm dropdown-toggle" data-bs-toggle="dropdown">
          👤 <?= htmlspecialchars($nama) ?>
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

<div class="container py-5">
  <div class="text-center mb-5">
    <h3 class="fw-semibold text-orange">Temukan UKM yang Cocok Buat Kamu 🎯</h3>
    <p class="text-muted">Jelajahi komunitas yang sesuai dengan minat, skill, dan semangatmu!</p>
  </div>

  <div class="row g-4">
    <?php while ($ukm = mysqli_fetch_assoc($ukm_list)): ?>
      <div class="col-md-6 col-lg-4">
        <div class="card card-ukm h-100 border-0">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title text-orange fw-semibold"><?= htmlspecialchars($ukm['nama_ukm']) ?></h5>
            <p class="card-text flex-grow-1"><?= nl2br(htmlspecialchars($ukm['deskripsi'])) ?></p>
            <form method="get" action="form_pendaftaran.php" class="mt-3">
              <input type="hidden" name="id" value="<?= $ukm['id'] ?>">
              <button type="submit" class="btn btn-daftar w-100">Daftar Sekarang</button>
            </form>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<footer class="py-4 mt-5">
  <div class="container text-center">
    <p class="mb-1 fw-semibold text-orange">© <?= date('Y') ?> UKMate • User Panel</p>
    <small class="text-muted">Dibuat oleh Muhammad Nabil al-Hafiz</small>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>