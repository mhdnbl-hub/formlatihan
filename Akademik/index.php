<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-SIAP | Sistem Informasi Akademik Politeknik</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
    }
    body {
      background-color: #f8f9fa;
    }
    .navbar-brand {
      font-weight: bold;
      font-family: monospace;
      font-size: 1.8rem;
    }
    .navbar-nav .nav-link {
      font-family: monospace;
    }
    .main-content {
      flex: 1;
    }
    footer {
      font-family: monospace;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-secondary navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php">E-SIAP</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link <?= !isset($_GET['folder']) && ($_GET['page'] ?? 'home') === 'home' ? 'active' : '' ?>" href="index.php?page=home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($_GET['folder'] ?? '') === 'mahasiswa' ? 'active' : '' ?>" href="index.php?folder=mahasiswa&page=data-mahasiswa">Mahasiswa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($_GET['folder'] ?? '') === 'prodi' ? 'active' : '' ?>" href="index.php?folder=prodi&page=data-prodi">Prodi</a>
          </li>
        </ul>

        <!-- User Info (NO dropdown, langsung tampil) -->
        <div class="d-flex align-items-center text-light small" style="font-family: monospace;">
          <div class="me-3 text-end">
            <div><?= $_SESSION['email'] ?></div>
            <div>Level: <?= $_SESSION['level'] ?></div>
          </div>
          <a href="logout.php" class="btn btn-light btn-sm">Log out</a>
        </div>

      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container my-4 main-content">
    <?php
    $folder = basename($_GET['folder'] ?? '');
    $page   = basename($_GET['page'] ?? 'home');
    $file = $folder ? "$folder/$page.php" : "$page.php";

    if (file_exists($file)) {
        include $file;
    } else {
        echo "<div class='alert alert-danger'>404 : Halaman tidak ditemukan</div>";
    }
    ?>
  </div>

  <!-- Footer -->
  <footer class="bg-secondary text-light text-center py-3">
    &copy; <?= date('Y') ?> | Muhammad Nabil al-Hafiz
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
